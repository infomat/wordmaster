<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    public $paginate = [
        'limit' => 25,
        'users' => [
        'Users.user_id' => 'asc'
        ]
    ];
    
    /* Initialize */
    public function initialize()
    {
        parent::initialize();
    }
    
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
        $this->Auth->allow(['signup', 'logout']);

    }
    
    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                //save login time at auth to get access globally
                $user['lastLoginTime'] = Time::now();
                $this->Auth->setUser($user);
                
                $query = $this->Users->get($user['id'], [
                    'contain' => []
                ]);
                $query->lastLoginTime = $user['lastLoginTime'];
                $this->Users->save($query);
                
                //save to history with user ID
                //this seems to be not good way..... 
                $this->loadModel('Historys');
                $history = $this->Historys->newEntity();
                $history->user_id = $user['id'];
                $this->Historys->save($history);
                
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid username or password, try again'));
        }
    }

    public function logout()
    {
        
        return $this->redirect($this->Auth->logout());
    }
    
     /**
     * Signup method (For users)
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function signup()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            //default role_id: user
            $user-> role = 'user';
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Your information has been saved.'));
                return $this->redirect(['controller' => 'Words','action' => 'index']);
            }
            $this->Flash->error(__('Unable to add your information.'));
        }
        
        $this->set(compact('user'));
    }
    
    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('users', $this->paginate($this->Users));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Diarys', 'Historys', 'Points', 'Words']
        ]);
        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
    
    public function isAuthorized($user)
    {
        if ($user['role'] == 'admin'){
            if (in_array($this->request->action, ['delete'])) {
                $user_id = (int)$this->request->params['pass'][0];
                if ($user_id == $user['user_id']){
                    return false;
                }
            }
            return true;  
        }

        if (in_array($this->request->action, ['edit','view'])) {
            $user_id = (int)$this->request->params['pass'][0];
            if ($user_id == $user['user_id']) {
                return true;
            }
        }
        return parent::isAuthorized($user);
    }
}
