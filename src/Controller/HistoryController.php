<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * History Controller
 *
 * @property \App\Model\Table\HistoryTable $History
 */
class HistoryController extends AppController
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
        $this->set('history', $this->paginate($this->History));
        $this->set('_serialize', ['history']);
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
        $history = $this->History->get($id, [
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
        $history = $this->History->newEntity();
        if ($this->request->is('post')) {
            $history = $this->History->patchEntity($history, $this->request->data);
            if ($this->History->save($history)) {
                $this->Flash->success(__('The history has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The history could not be saved. Please, try again.'));
            }
        }
        $users = $this->History->Users->find('list', ['limit' => 200]);
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
        $history = $this->History->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $history = $this->History->patchEntity($history, $this->request->data);
            if ($this->History->save($history)) {
                $this->Flash->success(__('The history has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The history could not be saved. Please, try again.'));
            }
        }
        $users = $this->History->Users->find('list', ['limit' => 200]);
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
        $history = $this->History->get($id);
        if ($this->History->delete($history)) {
            $this->Flash->success(__('The history has been deleted.'));
        } else {
            $this->Flash->error(__('The history could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
