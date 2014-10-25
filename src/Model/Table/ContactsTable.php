<?php
namespace App\Model\Table;

use ArrayObject;
use Cake\Event\Event;
use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\ORM\Entity;
use Cake\Validation\Validator;
use Cake\Log\Log;

/**
 * Contacts Model
 */
class ContactsTable extends Table {

/**
 * Initialize method
 *
 * @param array $config The configuration for the Table.
 * @return void
 */
	public function initialize(array $config) {
		$this->table('contacts');
		$this->displayField('name');
		$this->primaryKey('id');
		$this->addBehavior('Timestamp');

		$this->belongsTo('Zips', [
			'foreignKey' => 'zip_id',
		]);
		$this->belongsTo('Contactsources', [
			'foreignKey' => 'contactsource_id',
		]);
		$this->hasMany('Histories', [
			'foreignKey' => 'contact_id',
		]);
		$this->belongsToMany('Groups', [
			'foreignKey' => 'contact_id',
			'targetForeignKey' => 'group_id',
			'joinTable' => 'contacts_groups',
		]);
		$this->belongsToMany('Linkups', [
			'foreignKey' => 'contact_id',
			'targetForeignKey' => 'linkup_id',
			'joinTable' => 'contacts_linkups',
		]);
		$this->belongsToMany('Users', [
			'foreignKey' => 'contact_id',
			'targetForeignKey' => 'user_id',
			'joinTable' => 'contacts_users',
		]);
		$this->belongsToMany('Skills', [
			'foreignKey' => 'contact_id',
			'targetForeignKey' => 'skill_id',
			'joinTable' => 'contacts_skills',
		]);
	}

/**
 * Default validation rules.
 *
 * @param \Cake\Validation\Validator $validator
 * @return \Cake\Validation\Validator
 */
	public function validationDefault(Validator $validator) {
		$validator
			->add('id', 'valid', ['rule' => 'numeric'])
			->allowEmpty('id', 'create')
			->allowEmpty('name')
			->allowEmpty('contactname')
			->add('zip_id', 'valid', ['rule' => 'numeric'])
			->validatePresence('zip_id', 'create')
			->allowEmpty('zip_id')
			->allowEmpty('address')
			->allowEmpty('phone')
			->add('email', 'valid', ['rule' => 'email'])
			->allowEmpty('email')
			->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table'])
			->add('birth', 'valid', ['rule' => 'date'])
			->allowEmpty('birth')
			->allowEmpty('workplace')
			->allowEmpty('sex')
			->add('active', 'valid', ['rule' => 'boolean'])
			->allowEmpty('active')
			->allowEmpty('comment')
			->add('contactsource_id', 'valid', ['rule' => 'numeric'])
			->validatePresence('contactsource_id', 'create')
			->notEmpty('contactsource_id');

		return $validator;
	}

	public function beforeSave(Event $event, Entity $entity, ArrayObject $options){
		if((!empty($entity->name) + !empty($entity->contactname) + !empty($entity->zip_id)
				+ !empty($entity->address) + !empty($entity->phone) + !empty($entity->email)
				+ !empty($entity->birth->time) + !empty($entity->workplace)) >= 2){
			return true;
		}
		else{
			$entity->errors('name', __('At least 2 info should be filled'));
			return false;
		}
	}
	
	public function afterSave(Event $event, Entity $entity, ArrayObject $options){
		//debug($entity);
		if(!$entity->isNew()){
			$loggedInUser = $entity->loggedInUser;
			$toLog = ['name', 'contactname', 'zip_id', 'address', 'phone', 'email', 'birth', 'workplace',
					  'comment', 'linkups', 'groups', 'skills', 'users'];
			foreach($entity->extractOriginal($entity->visibleProperties()) as $i => $value){
				if($entity->$i != $value && in_array($i, $toLog)){
					if(!is_array($value)){
						//debug($entity->$i);
						//debug($value);
						$data = [
								'id' => null,
								'contact_id' => $entity->id,
								'date' => date('Y-m-d'),
								'create' => date('Y-m-d'),
								'user_id' => $loggedInUser,
								'event_id' => 1,
								'detail' => $i . __(' changed from ') . $value . ' to ' . $entity->$i
								 ];
						//debug($data);
						$history = TableRegistry::get('Histories');
						$newHistory = $history->newEntity($data);
						//debug($newHistory);die();
						$history->save($newHistory);
					}
					else{
						Log::write('debug', 'Contacts/afterSave : change in related data');
					}
				}
			}
		}
	}
}
