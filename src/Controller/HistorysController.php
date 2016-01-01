<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Historys Controller
 *
 * @property \App\Model\Table\HistorysTable $Historys
 */
class HistorysController extends AppController
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
        $Historys = $this->Historys->find('all')
                    ->contain(['Users'])
                    ->where(['user_id' => $loginuser['id']])
                    ->order(['Historys.created' => 'DESC']);
            
        $this->set('historys', $this->paginate($Historys));
        $this->set('_serialize', ['historys']);
    }

    /**
     * View method
     *
     * @param string|null $id History id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $history = $this->Historys->get($id, [
            'contain' => ['Users']
        ]);
        $this->set('history', $history);
        $this->set('_serialize', ['history']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $history = $this->Historys->newEntity();
        if ($this->request->is('post')) {
            $history = $this->Historys->patchEntity($history, $this->request->data);
            if ($this->Historys->save($history)) {
                $this->Flash->success(__('The history has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The history could not be saved. Please, try again.'));
            }
        }
        $users = $this->Historys->Users->find('list', ['limit' => 200]);
        $this->set(compact('history', 'users'));
        $this->set('_serialize', ['history']);
    }

    /**
     * Edit method
     *
     * @param string|null $id History id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $history = $this->Historys->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $history = $this->Historys->patchEntity($history, $this->request->data);
            if ($this->Historys->save($history)) {
                $this->Flash->success(__('The history has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The history could not be saved. Please, try again.'));
            }
        }
        $users = $this->Historys->Users->find('list', ['limit' => 200]);
        $this->set(compact('history', 'users'));
        $this->set('_serialize', ['history']);
    }

    /**
     * Delete method
     *
     * @param string|null $id History id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $history = $this->Historys->get($id);
        if ($this->Historys->delete($history)) {
            $this->Flash->success(__('The history has been deleted.'));
        } else {
            $this->Flash->error(__('The history could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
