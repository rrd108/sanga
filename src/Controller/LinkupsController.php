<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Linkups Controller
 *
 * @property App\Model\Table\LinkupsTable $Linkups
 */
class LinkupsController extends AppController {

/**
 * Index method
 *
 * @return void
 */
	public function index() {
		$this->set('linkups', $this->paginate($this->Linkups));
	}

/**
 * View method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function view($id = null) {
		$linkup = $this->Linkups->get($id, [
			'contain' => []
		]);
		$this->set('linkup', $linkup);
	}

/**
 * Add method
 *
 * @return void
 */
	public function add() {
		$linkup = $this->Linkups->newEntity($this->request->data);
		if ($this->request->is('post')) {
			if ($this->Linkups->save($linkup)) {
				$this->Flash->success('The linkup has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The linkup could not be saved. Please, try again.');
			}
		}
		$this->set(compact('linkup'));
	}

/**
 * Edit method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function edit($id = null) {
		$linkup = $this->Linkups->get($id, [
			'contain' => []
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$linkup = $this->Linkups->patchEntity($linkup, $this->request->data);
			if ($this->Linkups->save($linkup)) {
				$this->Flash->success('The linkup has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The linkup could not be saved. Please, try again.');
			}
		}
		$this->set(compact('linkup'));
	}

/**
 * Delete method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function delete($id = null) {
		$linkup = $this->Linkups->get($id);
		$this->request->allowMethod('post', 'delete');
		if ($this->Linkups->delete($linkup)) {
			$this->Flash->success('The linkup has been deleted.');
		} else {
			$this->Flash->error('The linkup could not be deleted. Please, try again.');
		}
		return $this->redirect(['action' => 'index']);
	}
}
