<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;
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
		$this->primaryKey(['id']);
		$this->addBehavior('Timestamp');

		$this->belongsTo('Countries', [
			'foreignKey' => 'country_id',
		]);
		$this->belongsTo('Zips', [
			'foreignKey' => 'zip_id',
		]);
		$this->belongsTo('Contactsources', [
			'foreignKey' => 'contactsource_id',
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
			->add('country_id', 'valid', ['rule' => 'numeric'])
			->validatePresence('country_id', 'create')
			->notEmpty('country_id')
			->add('zip_id', 'valid', ['rule' => 'numeric'])
			->validatePresence('zip_id', 'create')
			->notEmpty('zip_id')
			->allowEmpty('address')
			->allowEmpty('phone')
			->add('email', 'valid', ['rule' => 'email'])
			->allowEmpty('email')
			->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table'])
			->add('birth', 'valid', ['rule' => 'date'])
			->allowEmpty('birth')
			->add('active', 'valid', ['rule' => 'boolean'])
			->allowEmpty('active')
			->allowEmpty('comment')
			->add('contactsource_id', 'valid', ['rule' => 'numeric'])
			->allowEmpty('contactsource_id', 'create');

		return $validator;
	}

}
