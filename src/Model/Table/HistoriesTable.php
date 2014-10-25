<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Histories Model
 */
class HistoriesTable extends Table {

/**
 * Initialize method
 *
 * @param array $config The configuration for the Table.
 * @return void
 */
	public function initialize(array $config) {
		$this->table('histories');
		$this->displayField('id');
		$this->primaryKey('id');
		$this->addBehavior('Timestamp');

		$this->belongsTo('Contacts', [
			'foreignKey' => 'contact_id',
		]);
		$this->belongsTo('Users', [
			'foreignKey' => 'user_id',
		]);
		$this->belongsTo('Linkups', [
			'foreignKey' => 'linkup_id',
		]);
		$this->belongsTo('Events', [
			'foreignKey' => 'event_id',
		]);
		$this->belongsTo('Units', [
			'foreignKey' => 'unit_id',
		]);
		$this->belongsTo('Groups', [
			'foreignKey' => 'group_id',
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
			->add('contact_id', 'valid', ['rule' => 'numeric'])
			->validatePresence('contact_id', 'create')
			->notEmpty('contact_id')
			->add('date', 'valid', ['rule' => 'date'])
			->notEmpty('date')
			->add('user_id', 'valid', ['rule' => 'numeric'])
			->validatePresence('user_id', 'create')
			->allowEmpty('user_id')
			->add('linkup_id', 'valid', ['rule' => 'numeric'])
			->allowEmpty('linkup_id')
			->add('event_id', 'valid', ['rule' => 'numeric'])
			->validatePresence('event_id', 'create')
			->notEmpty('event_id')
			->allowEmpty('detail')
			->add('quantity', 'valid', ['rule' => 'decimal'])
			->allowEmpty('quantity')
			->add('unit_id', 'valid', ['rule' => 'numeric'])
			->allowEmpty('unit_id')
			->add('group_id', 'valid', ['rule' => 'numeric'])
			->allowEmpty('group_id');

		return $validator;
	}

}
