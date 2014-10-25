<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Contacts Controller
 *
 * @property App\Model\Table\ContactsTable $Contacts
 */
class ContactsController extends AppController {
	
	public $helpers = ['Number'];

	//ajax keresések a név mezőkben
	public function searchname(){
		$query = $this->Contacts->find()
				->select(['id', 'name', 'contactname'])
				->where(['name LIKE "%'.$this->request->query('term').'%"'])
				->orWhere(['contactname LIKE "%'.$this->request->query('term').'%"']);
		//debug($query);
		$highlight = array('format' => '<span class="b i">\1</span>');
		foreach($query as $row){
			$result[] = array('value' => $row->id,
							  'label' => String::highlight($row->name, $this->request->query('term'), $highlight)  . ' : ' .
										String::highlight($row->contactname, $this->request->query('term'), $highlight));
		}
		//debug($result);die();
		$this->set('result', $result);
	}

	//cím adatok lekérdezése a mapon való megjelenéshez
	public function showmap(){
		$result = $this->Contacts->find()
				->contain(['Zips' => ['Countries']])
				->select(['Contacts.lat', 'Contacts.lng', 'Zips.zip', 'Zips.name', 'Countries.name'])
				->where('Contacts.lat != 0')
				->toArray();
		//debug($result);
		$this->set('result', $result);
	}
	
	//mindenféle lekérdezések
	public function search(){
		
		if($this->request->data){
			/*
			 debug($this->request->data);
			 [
				'zip_id' => '162',
				'area' => '50',
				'active' => '1',
				'linkup_id' => '5'
			]
			*/
			
			$center = $this->Contacts->Zips->find()
					->select(['lat', 'lng'])
					->where(['id' => $this->request->data['zip_id']])
					;//->toArray();
			$cent = $center->toArray();
			//debug($cent[0]->lat);
			
			$expr = $center->newExpr()->add('(3956 *2 * ASIN( SQRT( POWER( SIN( ( '.$cent[0]->lat.
											' - abs( Contacts.lat ) ) * pi( ) /180 /2 ) , 2 ) + COS( '.$cent[0]->lat.
											' * pi( ) /180 ) * COS( abs( Contacts.lat ) * pi( ) /180 ) * POWER( SIN( ( '.
											$cent[0]->lng.' - Contacts.lng ) * pi( ) /180 /2 ) , 2 ) ) ))');
			//debug($expr);
			
			$result = $this->Contacts->find()
					->contain(['Zips', 'Linkups'])
					->select(['name', 'Zips.zip', 'Zips.name', 'distance' => $expr])
					->where(['active' => true,
							 'distance' => $expr])
					->matching('Linkups', function($q){
						return $q->where(['Linkups.id' => $this->request->data['linkup_id']]);
						})
					->having(['distance <=' => $this->request->data['area']])
					->order(['distance' => 'ASC']);
					//->toArray();
			//debug($result);
			$this->set('result', $result);
		}
	}

/**
 * Index method
 *
 * @return void
 */
	public function index() {
		$this->paginate = [
			'contain' => ['Zips', 'Contactsources']
		];
		$this->set('contacts', $this->paginate($this->Contacts));
	}

/**
 * View method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function view($id = null) {
		$contact = $this->Contacts->get($id, [
			'contain' => ['Zips', 'Contactsources', 'Groups' => ['Users'], 'Skills', 'Linkups' => ['Users'], 'Users']
		]);
		$this->set('contact', $contact);
		
		$this->paginate = [
			'contain' => ['Contacts', 'Users', 'Linkups', 'Events', 'Units', 'Groups']
		];
		$histories = $this->Contacts->Histories->find()
				->where(['contact_id' => $id]);
		$this->set('histories', $this->paginate($histories));
	}

/**
 * Add method
 *
 * @return void
 */
	public function add() {
		$contact = $this->Contacts->newEntity($this->request->data);
		if ($this->request->is('post')) {
			if ($this->Contacts->save($contact)) {
				$this->Flash->success('The contact has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				debug($contact->errors());
				$this->Flash->error('The contact could not be saved. Please, try again.');
			}
		}
		$zips = $this->Contacts->Zips->find('list', ['idField' => 'id', 'valueField' => 'full_zip']);
		$contactsources = $this->Contacts->Contactsources->find('list');
		$groups = $this->Contacts->Groups->find('list');
		$skills = $this->Contacts->Skills->find('list');
		$linkups = $this->Contacts->Linkups->find('list');
		$_linkupsSwitched = $this->Contacts->Linkups->find('list')->select('id')->where('switched = 1')->toArray();
		foreach($_linkupsSwitched as $i => $l){
			$linkupsSwitched[] = $i;
		}
		//debug($linkupsSwitched);
		$users = $this->Contacts->Users->find('list');
		$this->set(compact('contact', 'countries', 'zips', 'contactsources', 'groups', 'skills',
						   'linkups', 'linkupsSwitched', 'users'));
	}

/**
 * Edit method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function edit($id = null) {
		$contact = $this->Contacts->get($id, [
			'contain' => ['Groups', 'Linkups', 'Users', 'Zips']
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$contact = $this->Contacts->patchEntity($contact, $this->request->data);
			$contact->loggedInUser = $this->Auth->user('id');
			if ($this->Contacts->save($contact)) {
				exec(WWW_ROOT . '../bin/cake db_refine set_geo_for_user ' . $id . ' > /dev/null &');
				$this->Flash->success('The contact has been saved.');
				return $this->redirect(['action' => 'view', $id]);
			} else {
				$this->Flash->error('The contact could not be saved. Please, try again.');
			}
		}
		$zips = $this->Contacts->Zips->find('list');
		$contactsources = $this->Contacts->Contactsources->find('list');
		$groups = $this->Contacts->Groups->find('list');
		$skills = $this->Contacts->Skills->find('list');
		$linkups = $this->Contacts->Linkups->find('list');
		$users = $this->Contacts->Users->find('list');
		$this->set(compact('contact', 'zips', 'contactsources', 'groups', 'skills', 'linkups', 'users'));
	}

/**
 * Delete method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function delete($id = null) {
		$contact = $this->Contacts->get($id);
		$this->request->allowMethod('post', 'delete');
		if ($this->Contacts->delete($contact)) {
			$this->Flash->success('The contact has been deleted.');
		} else {
			$this->Flash->error('The contact could not be deleted. Please, try again.');
		}
		return $this->redirect(['action' => 'index']);
	}
}