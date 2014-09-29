<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * LinkupsUsers Controller
 *
 * @property App\Model\Table\LinkupsUsersTable $LinkupsUsers
 */
class LinkupsUsersController extends AppController {

/**
 * Index method
 *
 * @return void
 */
	public function index() {
		$this->set('linkupsUsers', $this->paginate($this->LinkupsUsers));
	}

/**
 * View method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function view($id = null) {
		$linkupsUser = $this->LinkupsUsers->get($id, [
			'contain' => []
		]);
		$this->set('linkupsUser', $linkupsUser);
	}

/**
 * Add method
 *
 * @return void
 */
	public function add() {
		$linkupsUser = $this->LinkupsUsers->newEntity($this->request->data);
		if ($this->request->is('post')) {
			if ($this->LinkupsUsers->save($linkupsUser)) {
				$this->Flash->success('The linkups user has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The linkups user could not be saved. Please, try again.');
			}
		}
		$this->set(compact('linkupsUser'));
	}

/**
 * Edit method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function edit($id = null) {
		$linkupsUser = $this->LinkupsUsers->get($id, [
			'contain' => []
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$linkupsUser = $this->LinkupsUsers->patchEntity($linkupsUser, $this->request->data);
			if ($this->LinkupsUsers->save($linkupsUser)) {
				$this->Flash->success('The linkups user has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The linkups user could not be saved. Please, try again.');
			}
		}
		$this->set(compact('linkupsUser'));
	}

/**
 * Delete method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function delete($id = null) {
		$linkupsUser = $this->LinkupsUsers->get($id);
		$this->request->allowMethod('post', 'delete');
		if ($this->LinkupsUsers->delete($linkupsUser)) {
			$this->Flash->success('The linkups user has been deleted.');
		} else {
			$this->Flash->error('The linkups user could not be deleted. Please, try again.');
		}
		return $this->redirect(['action' => 'index']);
	}
}
