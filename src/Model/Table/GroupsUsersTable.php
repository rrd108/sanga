<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * GroupsUsers Model
 */
class GroupsUsersTable extends Table {

/**
 * Initialize method
 *
 * @param array $config The configuration for the Table.
 * @return void
 */
	public function initialize(array $config) {
		$this->table('groups_users');
		$this->displayField('group_id');
		$this->primaryKey(['id']);

		$this->belongsTo('Groups', [
			'foreignKey' => 'group_id',
		]);
		$this->belongsTo('Users', [
			'foreignKey' => 'user_id',
		]);
		/*$this->belongsTo('Groups', [
			'foreignKey' => 'intersection_group_id',
		]);*/
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
			->add('group_id', 'valid', ['rule' => 'numeric'])
			->validatePresence('group_id', 'create')
			->notEmpty('group_id')
			->add('user_id', 'valid', ['rule' => 'numeric'])
			->validatePresence('user_id', 'create')
			->notEmpty('user_id')
			->add('intersection_group_id', 'valid', ['rule' => 'numeric'])
			->allowEmpty('intersection_group_id');

		return $validator;
	}

}
