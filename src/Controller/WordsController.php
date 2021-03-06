<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;
use Cake\Event\Event;
use Cake\Mailer\Email;

/**
 * Words Controller
 *
 * @property \App\Model\Table\WordsTable $Words
 */
class WordsController extends AppController
{

    /* Initialize */
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');
    }
    
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        $this->Cookie->configKey('loginTime', 'path', '/');
        $this->Cookie->configKey('loginTime', ['encryption'=>false, 'httpOnly' => false]);
        
    }
    /**
     * Index method
     *
     * @return void
     */
    public function index($id = null)
    {
        $loginuser = $this->Auth->user();
        
        $this->paginate = [
            'contain' => ['Users']
        ];
        
        if ($id == null) {
            $Words = $this->Words->find('all')
                    ->contain(['Users'])
                    ->where(['user_id' => $loginuser['id']])
                    ->andWhere(['completed ' => 0]);
        } else if ($id == 0) {
            $Words = $this->Words->find('all')
                    ->contain(['Users'])
                    ->where(['user_id' => $loginuser['id']])
                    ->andWhere(['completed ' => 1])
                    ->order(['Words.modified' => 'DESC']);
        } else {
            $Words = $this->Words->find('all')
                    ->contain(['Users'])
                    ->order(['Words.created' => 'DESC']);
        }
        $this->set('index', $id);
        $this->set('words', $this->paginate($Words));
        $this->set('_serialize', ['words']);
    }
    
     /**
     * Index method
     *
     * @return void
     */
    public function game1($id = null)
    {
        $loginuser = $this->Auth->user();
        
        date_default_timezone_set('America/Toronto');
        
        $loginuser = $this->Auth->user();
        $this->loadModel('Historys');
        $tryCount = $this->Historys->find()
                        ->where(['user_id' => $loginuser['id'],'mark is not' => null,'DATE(created)' => date('y-m-d')])
                        ->count();
        if ($tryCount > 0){
            $this->Flash->error(__('Oops! You already tried reviewing today'));
                return $this->redirect(['controller' => 'Words','action' => 'index']);
        }
        
        //To make review again after 1 day.
        $refDateTime = Time::now()->subDays(1);
        $refDateTime->setTime(23,59);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            //make correct answer as completed
            //store history
            //calculate good answer
            //add points
            $correctIDs = explode(",", $this->request->data['correctIDs']);
            if ($correctIDs[0] == '') {
                $this->Flash->error(__('Oops! Nothing to update'));
                return $this->redirect(['controller' => 'Words','action' => 'index']);
            }
            
            foreach ($correctIDs AS $id) {
                $correctProblem = $this->Words->get($id);
                $correctProblem -> completed = 1; 

                if (!$this->Words->save($correctProblem)) {
                    $this->Flash->error(__('Oops! Result is not saved due to some reasons.'));
                } 
            }
            
            //save review data
            $this->loadModel('Historys');
            $history = $this->Historys->newEntity();
            $history->user_id = $this->Auth->user('id');
            $history->lastLoginTime = $this->Auth->user('lastLoginTime');
            $history->duration = 0;
            $history->mark = $this->request->data['finalmarks'];
            $this->Historys->save($history);
            
            $this->loadModel('Users');
            $user = $this->Users->get($this->Auth->user('id'), [
                'contain' => ['Diarys', 'Historys', 'Points', 'Words','CompletedWords']
            ]);

            $sum = 0;
            foreach ($user->diarys as $diary) {
                $sum = $sum + ((str_word_count($diary['body'])) % $this->maxWord) * $this->rateJournalWord;    
            }
            
            $numWords = 0;
            foreach ($user->words as $word) {
                if ($word->meaning != null)  {
                    $numWords++;
                }
            }
            $accumulatedPoints = $numWords*$this->rateAddWord + count($user->completed_words)*$this->rateFinishWord +
                                    count($user->diarys)*$this->rateJournal + count($user->historys)*$this->rateHistory+$sum;
            if ($user->points == null) {
                $lastPoints = 0;
            } else {
                $lastPoints = end($user->points)->remained_points;
            }

            if (($accumulatedPoints - $lastPoints) > 100) {
                $this->Flash->success(__('Congratulations!! 100 points reached.'));
                //send Email to admin, if user has reached 100 points which worth $10
                $this->commentmail(($accumulatedPoints - $lastPoints), $loginuser['name'], 'cch.choi@gmail.com');
                return $this->redirect(['controller' => 'Points','action' => 'index']);
            } else {
                $this->Flash->success(__('Thank you~'));
                return $this->redirect(['controller' => 'Words','action' => 'index']);
            }
        }
        $problems= $this->Words->find('all')
                ->contain(['Users'])
                ->where(['user_id' => $loginuser['id'],'completed ' => 0,'Words.created <' => $refDateTime]);

        if ($problems->isEmpty()) {
           $this->Flash->success(__('Great!!! You have nothing to review.')); 
           return $this->redirect(['controller' => 'Words','action' => 'index']);
        }
        $this->set(compact('problems','loginuser'));
    }
    
    /**
     * Search method
     *
     * @return void
     */
    public function search($word = null)
    {
        
        $loginuser = $this->Auth->user();
        
        $this->paginate = [
            'contain' => ['Users']
        ];
                
        $Words = $this->Words->find('all')
                ->contain(['Users'])
                ->where(['english LIKE' => '%'.$this->request->query['searchword'].'%']);
   
        $this->set('words', $this->paginate($Words));
        $this->set('_serialize', ['words']);
    }
    /**
     * View method
     *
     * @param string|null $id Word id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $word = $this->Words->get($id, [
            'contain' => ['Users', 'Tags']
        ]);
        $this->set('word', $word);
        $this->set('_serialize', ['word']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $loginuser = $this->Auth->user();
        
        $word = $this->Words->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['english'] = trim($this->request->data['english']);
            $word = $this->Words->patchEntity($word, $this->request->data);
            if (($this->Auth->user('id') != null) && ($word->user_id==null)) {
                $word->user_id = $this->Auth->user('id');
            }  
            if (($loginuser['role'] != 'admin') && 
                (($this->request->data['meaning'] == null) 
                 || ($this->request->data['example'] == null))) {
                $this->Flash->error(__('The meaning or example field should filled!'));
            } else {
                if ($this->Words->save($word)) {
                    $this->loadModel('Users');
                    $user = $this->Users->get($word->user_id, [
                        'contain' => ['Diarys', 'Historys', 'Points', 'Words','CompletedWords']
                    ]);

                    $sum = 0;
                    foreach ($user->diarys as $diary) {
                        $sum = $sum + ((str_word_count($diary['body'])) % $this->maxWord) * $this->rateJournalWord;    
                    }
                    $numWords = 0;
                    foreach ($user->words as $word) {
                        if ($word->meaning != null)  {
                            $numWords++;
                        }
                    }
                    $accumulatedPoints = $numWords*$this->rateAddWord + count($user->completed_words)*$this->rateFinishWord +
                                            count($user->diarys)*$this->rateJournal + count($user->historys)*$this->rateHistory + $sum;
                    if ($user->points != null) {
                        $lastPoints = end($user->points)->remained_points;
                    } else {
                        $lastPoints = 0;
                    }

                    if (($accumulatedPoints - $lastPoints) > 100) {
                        $this->Flash->success(__('Congratulations!! 100 points reached.'));
                        //send Email to admin, if user has reached 100 points which worth $10
                        $this->commentmail(($accumulatedPoints - $lastPoints), $loginuser['name'], 'cch.choi@gmail.com');
                        return $this->redirect(['controller' => 'Points','action' => 'index']);
                    } else {
                        $this->Flash->success(__('The word has been saved.'));
                        if ($loginuser['role']=='admin') {
                            return $this->redirect(['action' => 'add']);
                        } else {
                            return $this->redirect(['action' => 'index']);
                        }
                    }

                } else {
                    $this->Flash->error(__('The word is duplicated. It could not be saved'));
                }
            }
        }
        $tags = $this->Words->Tags->find('list', ['limit' => 200]);
        $username = $this->Words->Users->find('list', ['keyField' => 'id','valueField' => 'name'], ['limit' => 200])
                                        ->toArray();
        $this->set(compact('word', 'tags', 'username'));
        $this->set('_serialize', ['word']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Word id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $word = $this->Words->get($id, [
            'contain' => ['Tags']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->request->data['english'] = trim($this->request->data['english']);
            $word = $this->Words->patchEntity($word, $this->request->data);
            if ($this->Words->save($word)) {
                $this->Flash->success(__('The word has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The word could not be saved. Please, try again.'));
            }
        }
        $users = $this->Words->Users->find('list', ['limit' => 200]);
        $tags = $this->Words->Tags->find('list', ['limit' => 200]);
        $this->set(compact('word', 'users', 'tags'));
        $this->set('_serialize', ['word']);
    }
    /**
     * Uncomplete method
     * To change complete status from true to false when needed
     * @param string|null $id Word id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function uncomplete($id = null)
    {
        $word = $this->Words->get($id,['contain' => ['Users']]);
        $word->completed = 0;
    
        if ($this->Words->save($word)) {
            $this->Flash->success(__('The word has been uncompleted.'));
            return $this->redirect(['action' => 'index']);
        } else {
            $this->Flash->error(__('The word could not be uncompleted. Please, try again.'));
        }
    }
    
    /**
     * Delete method
     *
     * @param string|null $id Word id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $word = $this->Words->get($id);
        if ($this->Words->delete($word)) {
            $this->Flash->success(__('The word has been deleted.'));
        } else {
            $this->Flash->error(__('The word could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
    
    /**
     * isAuthorized method
     * Authorization depedning on role
     * @param string|null $id Word id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function isAuthorized($user)
    {
        if ($user['role'] == 'admin') 
            return true; 
        
        if (in_array($this->request->action, ['index', 'add', 'search','game1']))
            return true;
        
        // The owner of an word can edit and delete it
        if (in_array($this->request->action, ['edit', 'delete', 'view', 'uncomplete'])) {
            $word_id = (int)$this->request->params['pass'][0];
            if ($this->Words->isOwnedBy($word_id, $user['id'])) {
                return true;
            }
        }
        return parent::isAuthorized($user);
    }
    
    /**
     * commentmail method
     * Send Email using postmark addon
     * @param string|null $id Word id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    
    public function commentmail($points, $name, $email)
    {
        $subject = $name." have reached ".$points." points to redeem.";
        $mailText = "Hello, \r\n".
            $name."has gained ".$points." points to redeem, since it has been redeemed.\r\n".
            "http://sunnyword.herokuapp.com/points/index";
        self::sendmail($email, $subject, $mailText);
    }
    
    /**
     * sendmail method
     * Send Email using postmark addon
     * @param string|null $id Word id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function sendmail($email, $subject, $mailText)
    {  
        
        $mail = "mail";
        $loginuser = $this->Auth->user();
        $data = [];

        $data = [
            'mailFrom' => 'cchoi1803@conestogac.on.ca',
            'email' => $email,
            'mailSubject' => $subject,
            'mailText' => $mailText
        ];

        $email = new Email('default');
        $email->from(['cchoi1803@conestogac.on.ca' => 'Word Master']);
        $email->to($data['email']);
        $email->subject($data['mailSubject']); 
        $email->send($data['mailText']); 

        $this->set('result', $data);    
    }
}
