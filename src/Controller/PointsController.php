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
        $users = $this->Points->Users->find('list', ['limit' => 200]);
        $this->set(compact('point', 'users'));
        $this->set('_serialize', ['point']);
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
        $users = $this->Points->Users->find('list', ['limit' => 200]);
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
}
