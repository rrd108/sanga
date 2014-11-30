<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Usergroups Model
 */
class UsergroupsTable extends Table {

/**
 * Initialize method
 *
 * @param array $config The configuration for the Table.
 * @return void
 */
	public function initialize(array $config) {
		$this->table('usergroups');
		$this->displayField('name');
		$this->primaryKey('id');

		$this->belongsTo('AdminUsers', [
			'className' => 'Users',
			'foreignKey' => 'admin_user_id',
		]);
		$this->belongsToMany('Users', [
			'foreignKey' => 'usergroup_id',
			'targetForeignKey' => 'user_id',
			'joinTable' => 'users_usergroups',
			'sort' => 'User.name'
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
			->validatePresence('name', 'create')
			->notEmpty('name')
			->add('admin_user_id', 'valid', ['rule' => 'numeric'])
			->validatePresence('admin_user_id', 'create')
			->notEmpty('admin_user_id');

		return $validator;
	}

}
