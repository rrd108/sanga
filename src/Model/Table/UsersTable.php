<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 */
class UsersTable extends Table {

/**
 * Initialize method
 *
 * @param array $config The configuration for the Table.
 * @return void
 */
	public function initialize(array $config) {
		$this->table('users');
		$this->displayField('name');
		$this->primaryKey('id');
		$this->addBehavior('Timestamp');

		$this->hasMany('Events', [
			'foreignKey' => 'user_id',
			'sort' => 'Events.name'
		]);
		$this->hasMany('Histories', [
			'foreignKey' => 'user_id',
			'sort' => ['Histories.date' => 'DESC']
		]);
		$this->hasMany('AdminGroups', [
			'className' => 'Groups',
			'foreignKey' => 'admin_user_id'
		]);
		$this->hasMany('Notifications', [
			'foreignKey' => 'user_id',
			'sort' => ['Notifications.created' => 'DESC']
		]);
		$this->hasMany('Settings', [
			'foreignKey' => 'user_id'
		]);
		$this->belongsToMany('Contacts', [
			'foreignKey' => 'user_id',
			'targetForeignKey' => 'contact_id',
			'joinTable' => 'contacts_users',
			'sort' => 'Contacts.contactname'
		]);
		$this->belongsToMany('Groups', [
			'through' => 'groups_users',
			'sort' => 'Groups.name'
		]);
		$this->belongsToMany('Usergroups', [
			'foreignKey' => 'user_id',
			'targetForeignKey' => 'usergroup_id',
			'joinTable' => 'users_usergroups',
			'sort' => 'Usergroups.name'
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
			->add('name', 'unique',
				  ['rule' => 'validateUnique',
				   'message' => __('This username is already taken'),
				   'provider' => 'table'])
			->notEmpty('password')
			->add('password', [
					'length' => [
							'rule' => ['minLength', 6],
							'message' => __('Should be at least 6 characters long!')
							],
					'custom' => [
							'rule' => [$this, 'checkPasswordStrength'],
							'message' => __('Should contain small and capital letters, numbers or special characters!')
							]
					])
			->allowEmpty('realname')
			->allowEmpty('email')
			->add('email', 'valid',
				  ['rule' => 'email',
				   'message' => __('Should be a real email address!')
				   ])
			->add('email', 'unique',
				  ['rule' => 'validateUnique',
				   'message' => __('There is an other user with this email address!'),
				   'provider' => 'table'])
			->allowEmpty('phone')
			->add('active', 'valid', ['rule' => 'boolean'])
			->allowEmpty('active')
			->add('role', 'valid', ['rule' => 'numeric'])
			->notEmpty('role')
			->allowEmpty('resettoken')
			->allowEmpty('google_contacts_refresh_token');

		return $validator;
	}

/**
 * Measuring password strength
 * The password is strong if there are at least 3 of these characters presents in it:
 *   letter, capital letter, number, special character
 * @param string $value the given password string
 * @return true on strong password and false otherwise
 */
	static function checkPasswordStrength($value, $context){
		$minStrength = 3;
		$strength = 0;
		$patterns = ['/[a-z]/',
					 '/[A-Z]/',
					 '/[0-9]/',
					 '/[!"£$%^&*()`{}\[\]:@~;\'#<>?,.\/\\-=_+\|]/'];
		foreach($patterns as $pattern){
			if(preg_match($pattern, $value, $matches)){
				$strength++;
			}
		}
		if($strength >= $minStrength){
			return true;
		}
		return false;
	}

	public function isAdminUser($userId){
		$user = $this->get($userId);
		if ($user->role >= 9) {
			return true;
		}
		return false;
	}


/**
 * Find users who has access to the contact
 */
	public function findHasAccess(Query $query, array $options){
		return $query;
	}
	
/**
 * Find users who has access to the contact, because the user owns
 * (are the contact persons for) the contact
 */
	public function findHasAccessByOwner(Query $query, array $options){
		return $query
				->matching('Contacts', function($q) use ($options) {
					    return $q->where(['Contacts.id IN ' => $options['Contact.id']]);
					});
	}

/**
 * Find users who has access to the contact because the user has access to a group
 * where the contact is a member
 */
	public function findHasAccessByGroup(Query $query, array $options){
		return $query;
	}

/**
 * Find users who has access to the contact because the user is the owner of a usergroup
 * where there is user who has access to the user
 */
	public function findHasAccessByUsergroup(Query $query, array $options){
		return $query;
	}
}
