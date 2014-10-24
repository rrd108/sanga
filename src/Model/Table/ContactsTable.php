<?php
namespace App\Model\Table;

use ArrayObject;
use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\ORM\Entity;
use Cake\Validation\Validator;

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
			//Error: __('At least 3 info should be filled');
			return false;
		}
	}
}
