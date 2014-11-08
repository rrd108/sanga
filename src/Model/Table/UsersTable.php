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
		$this->hasMany('Notifications', [
			'foreignKey' => 'user_id',
			'sort' => ['Notifications.created' => 'DESC']
		]);
		$this->belongsToMany('Contacts', [
			'foreignKey' => 'user_id',
			'targetForeignKey' => 'contact_id',
			'joinTable' => 'contacts_users',
			'sort' => 'Contacts.name'
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
			->notEmpty('password')
			->add('password', [
					'length' => [
							'rule' => ['minLength', 6],
							'message' => __('At least 6 characters long')
							],
					'custom' => [
							'rule' => [$this, 'checkPasswordStrength']
							]
					])
			->allowEmpty('realname')
			->add('email', 'valid', ['rule' => 'email'])
			->allowEmpty('email')
			->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table'])
			->allowEmpty('phone')
			->add('active', 'valid', ['rule' => 'boolean'])
			->allowEmpty('active')
			->add('role', 'valid', ['rule' => 'numeric'])
			->notEmpty('role');

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
	
}
