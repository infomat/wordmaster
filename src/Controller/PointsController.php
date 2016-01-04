<?php
namespace App\Controller;

use App\Controller\AppController;


/**
 * Points Controller
 *
 * @property \App\Model\Table\PointsTable $Points
 */
class PointsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $this->set('points', $this->paginate($this->Points));
        $this->set('_serialize', ['points']);
    }

    /**
     * View method
     *
     * @param string|null $id Point id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $point = $this->Points->get($id, [
            'contain' => ['Users']
        ]);
        $this->set('point', $point);
        $this->set('_serialize', ['point']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $accumulatedPoints=array();
        
        $point = $this->Points->newEntity();
        if ($this->request->is('post')) {
            $point = $this->Points->patchEntity($point, $this->request->data);
            if ($this->Points->save($point)) {
                $this->Flash->success(__('The point has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The point could not be saved. Please, try again.'));
            }
        }
        $username = $this->Points->Users->find('list', ['keyField' => 'id','valueField' => 'name'], ['limit' => 200])
                                        ->toArray();
        
        $users = $this->Points->Users->find('all',[
            'contain' => ['Diarys', 'Historys', 'Points', 'Words', 
                          'CompletedWords']
        ]);
        
        //make array of most recent accumulated points
        foreach ($users as $user) {
            $accumulatedPoints[$user->id] = count($user->words)*$this->rateAddWord + 
                count($user->completed_words)*$this->rateFinishWord +
                count($user->diarys)*$this->rateJournal + 
                count($user->historys)*$this->rateHistory;
        }
  
        //make array of most recent remained points
        $remainedPoints = $this->Points->find('list', ['keyField' => 'user_id', 'valueField' => 'remained_points'], ['limit' => 200])
                                        -> order(['id'=>'ASC'])
                                        -> toArray();
                                              
        $this->set(compact('point','accumulatedPoints','remainedPoints', 'username'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Point id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $point = $this->Points->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $point = $this->Points->patchEntity($point, $this->request->data);
            if ($this->Points->save($point)) {
                $this->Flash->success(__('The point has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The point could not be saved. Please, try again.'));
            }
        }
        $users = $this->Points->Users->find('list', ['keyField' => 'id','valueField' => 'name'], ['limit' => 200])
                                        ->toArray();
        $this->set(compact('point', 'users'));
        $this->set('_serialize', ['point']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Point id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $point = $this->Points->get($id);
        if ($this->Points->delete($point)) {
            $this->Flash->success(__('The point has been deleted.'));
        } else {
            $this->Flash->error(__('The point could not be deleted. Please, try again.'));
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
        if (in_array($this->request->action, ['index']))
            return true;
    
        return parent::isAuthorized($user);
    }
}
