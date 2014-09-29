<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Linkups Model
 */
class LinkupsTable extends Table {

/**
 * Initialize method
 *
 * @param array $config The configuration for the Table.
 * @return void
 */
	public function initialize(array $config) {
		$this->table('linkups');
		$this->displayField('name');
		$this->primaryKey('id');

		$this->belongsToMany('Users', [
			'foreignKey' => 'linkup_id',
			'targetForeignKey' => 'user_id',
			'joinTable' => 'linkups_users',
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
			->allowEmpty('name');

		return $validator;
	}

}
