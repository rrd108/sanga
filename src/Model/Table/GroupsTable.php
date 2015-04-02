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

		$this->belongsTo('AdminUsers', [
			'className' => 'Users',
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
			'sort' => 'Contacts.contactname'
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
			->add('shared', 'valid', ['rule' => 'boolean'])
			->allowEmpty('shared');

		return $validator;
	}
	
/**
 * Find acessible groups for the user
 *
 * @param Cake\ORM\Query $query
 * @param array $options
 * 					User.id	-	we seraching the accessible groups for this user
 * 					shared	-	if set the result will include shared groups
 * @return \Cake\Validation\Validator
 */
	public function findAccessible(Query $query, array $options){
		if(isset($options['shared'])){
			$shared = ['shared' => true];
		}
		else{
			$shared = null;
		}
		return $query
				->orWhere($shared)
				->orWhere(['admin_user_id' => $options['User.id']])
				->orWhere(['Groups.id IN' => $this->findWhereMember($query, $options)])
				->order(['Groups.name']);
	}
	
	private function findWhereMember(Query $query, array $options){
		$_query = $this->query($query);
		$memberships = $_query->matching('Users', function($q) use ($options){
					return $q->where(['Users.id' => $options['User.id']]);
					});
		$memberInGroup = [];
		foreach($memberships as $m){
			$memberInGroup[] = $m->id;
		}
		return $memberInGroup;
	}
}
