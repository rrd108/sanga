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
			'foreignKey' => 'admin_user_id',
		]);
		$this->hasMany('Histories', [
			'foreignKey' => 'group_id',
			'sort' => ['Histories.date' => 'DESC']
		]);
		$this->belongsToMany('Contacts', [
			'foreignKey' => 'group_id',
			'targetForeignKey' => 'contact_id',
			'joinTable' => 'contacts_groups',
			'sort' => 'Contacts.name'
		]);
		$this->belongsToMany('Users', [
			'through' => 'groups_users'
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
			->notEmpty('name')
			->allowEmpty('description')
			->add('admin_user_id', 'valid', ['rule' => 'numeric'])
			->allowEmpty('admin_user_id')
			->add('public', 'valid', ['rule' => 'boolean'])
			->validatePresence('public', 'create')
			->allowEmpty('public');

		return $validator;
	}
	
	public function findAccessible(Query $query, array $options){
		return $query
				->where(['admin_user_id' => $options['User.id']])
				->orWhere(['public' => true])
				->matching('Users', function($q) use ($options){
					return $q->orWhere(['Users.id' => $options['User.id']]);
				});
	}


}
