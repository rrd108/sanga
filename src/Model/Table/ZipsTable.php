<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Zips Model
 */
class ZipsTable extends Table {

/**
 * Initialize method
 *
 * @param array $config The configuration for the Table.
 * @return void
 */
	public function initialize(array $config) {
		$this->table('zips');
		$this->displayField('zip');
		$this->primaryKey('id');

		$this->belongsTo('Countries', [
			'foreignKey' => 'country_id',
		]);
		$this->hasMany('Contacts', [
			'foreignKey' => 'zip_id',
			'sort' => 'Contacts.name'
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
			->add('country_id', 'valid', ['rule' => 'numeric'])
			->allowEmpty('country_id', 'create')
			->allowEmpty('zip')
			->allowEmpty('name')
			->add('lat', 'valid', ['rule' => 'numeric'])
			->validatePresence('lat', 'create')
			->notEmpty('lat')
			->add('lng', 'valid', ['rule' => 'numeric'])
			->validatePresence('lng', 'create')
			->notEmpty('lng');

		return $validator;
	}

}
