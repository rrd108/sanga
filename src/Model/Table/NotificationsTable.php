<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Notifications Model
 */
class NotificationsTable extends Table {

/**
 * Initialize method
 *
 * @param array $config The configuration for the Table.
 * @return void
 */
	public function initialize(array $config) {
		$this->table('notifications');
		$this->displayField('id');
		$this->primaryKey('id');
		$this->addBehavior('Timestamp');

		$this->belongsTo('Users', [
			'foreignKey' => 'user_id',
		]);
		$this->belongsTo('Senders', [
			'className' => 'Users',
			'foreignKey' => 'sender_id',
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
			->allowEmpty('sender_id')
			->add('user_id', 'valid', ['rule' => 'numeric'])
			->requirePresence('user_id', 'create')
			->notEmpty('user_id')
			->allowEmpty('notification')
			->add('unread', 'valid', ['rule' => 'boolean'])
			->allowEmpty('unread');

		return $validator;
	}

		public function findUnread(Query $query, array $options){
			$query->where([
					'Notifications.unread' => true,
					'Notifications.user_id' => $options['User.id']
					]);
			return $query;
		}
}
