<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Units Controller
 *
 * @property App\Model\Table\UnitsTable $Units
 */
class UnitsController extends AppController {

/**
 * Index method
 *
 * @return void
 */
	public function index() {
		$this->set('units', $this->paginate($this->Units));
	}

/**
 * View method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function view($id = null) {
		$unit = $this->Units->get($id, [
			'contain' => ['Histories']
		]);
		$this->set('unit', $unit);
	}

/**
 * Add method
 *
 * @return void
 */
	public function add() {
		$unit = $this->Units->newEntity($this->request->data);
		if ($this->request->is('post')) {
			if ($this->Units->save($unit)) {
				$this->Flash->success('The unit has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The unit could not be saved. Please, try again.');
			}
		}
		$this->set(compact('unit'));
	}

/**
 * Edit method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function edit($id = null) {
		$unit = $this->Units->get($id, [
			'contain' => []
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$unit = $this->Units->patchEntity($unit, $this->request->data);
			if ($this->Units->save($unit)) {
				$this->Flash->success('The unit has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The unit could not be saved. Please, try again.');
			}
		}
		$this->set(compact('unit'));
	}

/**
 * Delete method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function delete($id = null) {
		$unit = $this->Units->get($id);
		$this->request->allowMethod(['post', 'delete']);
		if ($this->Units->delete($unit)) {
			$this->Flash->success('The unit has been deleted.');
		} else {
			$this->Flash->error('The unit could not be deleted. Please, try again.');
		}
		return $this->redirect(['action' => 'index']);
	}
}
