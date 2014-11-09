<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\ForbiddenException;
use Cake\Event\Event;

/**
 * Users Controller
 *
 * @property App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController {
	
	public $components = ['RBruteForce.RBruteForce'];

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        // Allow users to logout.
	    // You should not add the "login" action to allow list. Doing so would
	    // cause problems with normal functioning of AuthComponent.
	    $this->Auth->allow(['logout']);
    }

	public function login() {
		if ($this->request->is('post')) {
			$user = $this->Auth->identify();
			if ($user) {
				$this->Auth->setUser($user);
				return $this->redirect($this->Auth->redirectUrl());
			}
			$this->RBruteForce->check(['maxAttempts' => 3, 'dataLog' => true]);		//should be here - so banned out user would not able to login with correct password
			$this->Flash->error(__('Invalid username or password, try again'));
		}
	}
	
	public function logout() {
		return $this->redirect($this->Auth->logout());
	}

/**
 * Index method
 *
 * @return void
 */
	public function index() {
		$this->set('users', $this->paginate($this->Users));
	}

/**
 * View method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function view($id = null) {
		$id = $id ? $id : $this->Auth->user('id');
		$user = $this->Users->get($id, [
			'contain' => ['Contacts', 'Events', 'Groups', 'Histories', 'Notifications']
		]);
		$this->set('user', $user);
	}

/**
 * Add method
 *
 * @return void
 */
	public function add() {
		$user = $this->Users->newEntity($this->request->data);
		if ($this->request->is('post')) {
			if ($this->Users->save($user)) {
				$this->Flash->success('The user has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The user could not be saved. Please, try again.');
			}
		}
		$contacts = $this->Users->Contacts->find('list');
		$groups = $this->Users->Groups->find('list');
		$usergroups = $this->Users->Usergroups->find('list');
		$this->set(compact('user', 'contacts', 'groups', 'usergroups'));
	}

/**
 * Edit method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function edit($id) {
		$user = $this->Users->get($id, [
			'contain' => ['Contacts', 'Groups', 'Usergroups']
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$user = $this->Users->patchEntity($user, $this->request->data);
			if ($this->Users->save($user)) {
				$this->Flash->success('The user has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The user could not be saved. Please, try again.');
			}
		}
		$contacts = $this->Users->Contacts->find('list');
		$groups = $this->Users->Groups->find('list');
		$usergroups = $this->Users->Usergroups->find('list');
		$this->set(compact('user', 'contacts', 'groups', 'usergroups'));
	}

/**
 * Delete method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function delete($id = null) {
		$user = $this->Users->get($id);
		$this->request->allowMethod(['post', 'delete']);
		if ($this->Users->delete($user)) {
			$this->Flash->success('The user has been deleted.');
		} else {
			$this->Flash->error('The user could not be deleted. Please, try again.');
		}
		return $this->redirect(['action' => 'index']);
	}
}
