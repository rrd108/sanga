<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Countries Controller
 *
 * @property App\Model\Table\CountriesTable $Countries
 */
class CountriesController extends AppController {

	public function isAuthorized($user = null) {
        return true;
    }

/**
 * Index method
 *
 * @return void
 */
	public function index() {
		$this->set('countries', $this->paginate($this->Countries));
	}

/**
 * View method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function view($id = null) {
		$country = $this->Countries->get($id, [
			'contain' => ['Zips']
		]);
		$this->set('country', $country);
	}

/**
 * Add method
 *
 * @return void
 */
	public function add() {
		$country = $this->Countries->newEntity($this->request->data);
		if ($this->request->is('post')) {
			if ($this->Countries->save($country)) {
				$this->Flash->success('The country has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The country could not be saved. Please, try again.');
			}
		}
		$this->set(compact('country'));
	}

/**
 * Edit method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function edit($id = null) {
		$country = $this->Countries->get($id, [
			'contain' => []
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$country = $this->Countries->patchEntity($country, $this->request->data);
			if ($this->Countries->save($country)) {
				$this->Flash->success('The country has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The country could not be saved. Please, try again.');
			}
		}
		$this->set(compact('country'));
	}

/**
 * Delete method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function delete($id = null) {
		$country = $this->Countries->get($id);
		$this->request->allowMethod(['post', 'delete']);
		if ($this->Countries->delete($country)) {
			$this->Flash->success('The country has been deleted.');
		} else {
			$this->Flash->error('The country could not be deleted. Please, try again.');
		}
		return $this->redirect(['action' => 'index']);
	}
}
