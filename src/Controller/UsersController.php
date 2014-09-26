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
			$this->Flash->error(__('Invalid username or password, try again'));
		}
	}
	
	public function logout() {
		return $this->redirect($this->Auth->logout());
	}

/**
 * View method
 *
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function view() {
		$user = $this->Users->get($this->Auth->user('id'),
								  ['contain' => []]);
		$this->set('user', $user);
	}

/**
 * Edit method
 *
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function edit() {
		$user = $this->Users->get($this->Auth->user('id'),
								  ['contain' => []]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$user = $this->Users->patchEntity($user, $this->request->data);
			if ($this->Users->save($user)) {
				$this->Flash->success('The user has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The user could not be saved. Please, try again.');
			}
		}
		$this->set(compact('user'));
	}
}