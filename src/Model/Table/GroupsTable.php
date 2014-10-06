<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Groups Model
 */
class GroupsTable extends Table {

/**
 * Initialize method
 *
 * @param array $config The configuration for the Table.
 * @return void
 */
	public function initialize(array $config) {
		$this->table('groups');
		$this->displayField('name');
		$this->primaryKey('id');

		$this->belongsTo('Users', [
			'foreignKey' => 'user_id',
		]);
		$this->hasMany('Histories', [
			'foreignKey' => 'group_id',
		]);
		$this->belongsToMany('Contacts', [
			'foreignKey' => 'group_id',
			'targetForeignKey' => 'contact_id',
			'joinTable' => 'contacts_groups',
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
			->add('user_id', 'valid', ['rule' => 'numeric'])
			->allowEmpty('user_id');

		return $validator;
	}

}
