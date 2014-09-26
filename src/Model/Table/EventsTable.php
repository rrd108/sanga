<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Events Model
 */
class EventsTable extends Table {

/**
 * Initialize method
 *
 * @param array $config The configuration for the Table.
 * @return void
 */
	public function initialize(array $config) {
		$this->table('events');
		$this->displayField('name');
		$this->primaryKey('id');

		$this->belongsTo('Eventgroups', [
			'foreignKey' => 'eventgroups_id',
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
			->add('eventgroups_id', 'valid', ['rule' => 'numeric'])
			->validatePresence('eventgroups_id', 'create')
			->notEmpty('eventgroups_id');

		return $validator;
	}

}
