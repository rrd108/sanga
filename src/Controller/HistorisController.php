<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Historis Controller
 *
 * @property App\Model\Table\HistorisTable $Historis
 */
class HistorisController extends AppController {

/**
 * Index method
 *
 * @return void
 */
	public function index() {
		$this->set('historis', $this->paginate($this->Historis));
	}

/**
 * View method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function view($id = null) {
		$histori = $this->Historis->get($id, [
			'contain' => []
		]);
		$this->set('histori', $histori);
	}

/**
 * Add method
 *
 * @return void
 */
	public function add() {
		$histori = $this->Historis->newEntity($this->request->data);
		if ($this->request->is('post')) {
			if ($this->Historis->save($histori)) {
				$this->Flash->success('The histori has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The histori could not be saved. Please, try again.');
			}
		}
		$this->set(compact('histori'));
	}

/**
 * Edit method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function edit($id = null) {
		$histori = $this->Historis->get($id, [
			'contain' => []
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$histori = $this->Historis->patchEntity($histori, $this->request->data);
			if ($this->Historis->save($histori)) {
				$this->Flash->success('The histori has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The histori could not be saved. Please, try again.');
			}
		}
		$this->set(compact('histori'));
	}

/**
 * Delete method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function delete($id = null) {
		$histori = $this->Historis->get($id);
		$this->request->allowMethod('post', 'delete');
		if ($this->Historis->delete($histori)) {
			$this->Flash->success('The histori has been deleted.');
		} else {
			$this->Flash->error('The histori could not be deleted. Please, try again.');
		}
		return $this->redirect(['action' => 'index']);
	}
}
