<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;
use Cake\Event\Event;

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
            
            $this->Flash->success(__('Thank you~'));
            return $this->redirect(['controller' => 'Words','action' => 'index']);
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
        $word = $this->Words->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['english'] = trim($this->request->data['english']);
            $word = $this->Words->patchEntity($word, $this->request->data);
            if ($this->Auth->user('id') != null) {
                $word->user_id = $this->Auth->user('id');
            }
            if ($this->Words->save($word)) {
                $this->Flash->success(__('The word has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The word is duplicated. It could not be saved'));
            }
        }
        $tags = $this->Words->Tags->find('list', ['limit' => 200]);
        $this->set(compact('word', 'tags'));
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
}
