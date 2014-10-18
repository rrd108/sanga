<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UsersUsergroups Model
 */
class UsersUsergroupsTable extends Table {

/**
 * Initialize method
 *
 * @param array $config The configuration for the Table.
 * @return void
 */
	public function initialize(array $config) {
		$this->table('users_usergroups');
		$this->displayField('user_id');
		$this->primaryKey(['user_id', 'usergroup_id']);

		$this->belongsTo('Users', [
			'foreignKey' => 'user_id',
		]);
		$this->belongsTo('Usergroups', [
			'foreignKey' => 'usergroup_id',
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
			->add('user_id', 'valid', ['rule' => 'numeric'])
			->allowEmpty('user_id', 'create')
			->add('usergroup_id', 'valid', ['rule' => 'numeric'])
			->allowEmpty('usergroup_id', 'create')
			->add('admin', 'valid', ['rule' => 'boolean'])
			->allowEmpty('admin');

		return $validator;
	}

	public function getAdmin($id){
		return($this->find()
			->select(['user_id'])
			->where(['usergroup_id' => $id]));
	}
}
