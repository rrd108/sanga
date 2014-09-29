<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Grouptypes Controller
 *
 * @property App\Model\Table\GrouptypesTable $Grouptypes
 */
class GrouptypesController extends AppController {

/**
 * Index method
 *
 * @return void
 */
	public function index() {
		$this->set('grouptypes', $this->paginate($this->Grouptypes));
	}

/**
 * View method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function view($id = null) {
		$grouptype = $this->Grouptypes->get($id, [
			'contain' => ['Groups']
		]);
		$this->set('grouptype', $grouptype);
	}

/**
 * Add method
 *
 * @return void
 */
	public function add() {
		$grouptype = $this->Grouptypes->newEntity($this->request->data);
		if ($this->request->is('post')) {
			if ($this->Grouptypes->save($grouptype)) {
				$this->Flash->success('The grouptype has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The grouptype could not be saved. Please, try again.');
			}
		}
		$this->set(compact('grouptype'));
	}

/**
 * Edit method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function edit($id = null) {
		$grouptype = $this->Grouptypes->get($id, [
			'contain' => []
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$grouptype = $this->Grouptypes->patchEntity($grouptype, $this->request->data);
			if ($this->Grouptypes->save($grouptype)) {
				$this->Flash->success('The grouptype has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The grouptype could not be saved. Please, try again.');
			}
		}
		$this->set(compact('grouptype'));
	}

/**
 * Delete method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function delete($id = null) {
		$grouptype = $this->Grouptypes->get($id);
		$this->request->allowMethod('post', 'delete');
		if ($this->Grouptypes->delete($grouptype)) {
			$this->Flash->success('The grouptype has been deleted.');
		} else {
			$this->Flash->error('The grouptype could not be deleted. Please, try again.');
		}
		return $this->redirect(['action' => 'index']);
	}
}
