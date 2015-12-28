<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Diarys Controller
 *
 * @property \App\Model\Table\DiarysTable $Diarys
 */
class DiarysController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $loginuser = $this->Auth->user();
        
        $this->paginate = [
            'contain' => ['Users']
        ];
        
        $Diarys = $this->Diarys->find('all')
                    ->contain(['Users'])
                    ->where(['user_id' => $loginuser['id']]);
        
        $this->set('diarys', $this->paginate($Diarys));
        $this->set('_serialize', ['diarys']);
    }

    /**
     * View method
     *
     * @param string|null $id Diary id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $diary = $this->Diarys->get($id, [
            'contain' => ['Users']
        ]);
        $this->set('diary', $diary);
        $this->set('_serialize', ['diary']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $diary = $this->Diarys->newEntity();
        if ($this->request->is('post')) {
            $diary = $this->Diarys->patchEntity($diary, $this->request->data);
            if ($this->Auth->user('id') != null) {
                $diary->user_id = $this->Auth->user('id');
            }
            if ($this->Diarys->save($diary)) {
                $this->Flash->success(__('The diary has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The diary could not be saved. Please, try again.'));
            }
        }
        $users = $this->Diarys->Users->find('list', ['limit' => 200]);
        $this->set(compact('diary', 'users'));
        $this->set('_serialize', ['diary']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Diary id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $diary = $this->Diarys->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $diary = $this->Diarys->patchEntity($diary, $this->request->data);
            if ($this->Diarys->save($diary)) {
                $this->Flash->success(__('The diary has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The diary could not be saved. Please, try again.'));
            }
        }
        $users = $this->Diarys->Users->find('list', ['limit' => 200]);
        $this->set(compact('diary', 'users'));
        $this->set('_serialize', ['diary']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Diary id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $diary = $this->Diarys->get($id);
        if ($this->Diarys->delete($diary)) {
            $this->Flash->success(__('The diary has been deleted.'));
        } else {
            $this->Flash->error(__('The diary could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
    
    /**
     * isAuthorized method
     * Authorization depedning on role
     * @param string|null $id Diary id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function isAuthorized($user)
    {
        if (in_array($this->request->action, ['index', 'add']))
            return true;
        
        // The owner of an order can edit and delete it
        if (in_array($this->request->action, ['edit', 'delete', 'view'])) {
            $diary_id = (int)$this->request->params['pass'][0];
            if ($this->Diarys->isOwnedBy($diary_id, $user['id'])) {
                return true;
            }
        }
        return parent::isAuthorized($user);
    }
}
