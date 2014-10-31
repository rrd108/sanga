<?php
namespace App\Model\Table;

use ArrayObject;
use Cake\Event\Event;
use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\ORM\Entity;
use Cake\Validation\Validator;
use Cake\Log\Log;

/**
 * Contacts Model
 */
class ContactsTable extends Table {

/**
 * Initialize method
 *
 * @param array $config The configuration for the Table.
 * @return void
 */
	public function initialize(array $config) {
		$this->table('contacts');
		$this->displayField('name');
		$this->primaryKey('id');
		$this->addBehavior('Timestamp');

		$this->belongsTo('Zips', [
			'foreignKey' => 'zip_id',
		]);
		$this->belongsTo('Contactsources', [
			'foreignKey' => 'contactsource_id',
		]);
		$this->hasMany('Histories', [
			'foreignKey' => 'contact_id',
			'sort' => ['Histories.date' => 'DESC']
		]);
		$this->belongsToMany('Groups', [
			'foreignKey' => 'contact_id',
			'targetForeignKey' => 'group_id',
			'joinTable' => 'contacts_groups',
			'sort' => 'Groups.name'
		]);
		$this->belongsToMany('Skills', [
			'foreignKey' => 'contact_id',
			'targetForeignKey' => 'skill_id',
			'joinTable' => 'contacts_skills',
		]);
		$this->belongsToMany('Users', [
			'foreignKey' => 'contact_id',
			'targetForeignKey' => 'user_id',
			'joinTable' => 'contacts_users',
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
			->allowEmpty('contactname')
			->add('zip_id', 'valid', ['rule' => 'numeric'])
			->allowEmpty('zip_id')
			->allowEmpty('address')
			->add('lat', 'valid', ['rule' => 'numeric'])
			->allowEmpty('lat')
			->add('lng', 'valid', ['rule' => 'numeric'])
			->allowEmpty('lng')
			->allowEmpty('phone')
			->add('email', 'valid', ['rule' => 'email'])
			->allowEmpty('email')
			->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table'])
			->add('birth', 'valid', ['rule' => 'date'])
			->allowEmpty('birth')
			->add('sex', 'valid', ['rule' => 'numeric'])
			->allowEmpty('sex')
			->allowEmpty('workplace')
			->add('family_id', 'valid', ['rule' => 'numeric'])
			->allowEmpty('family_id')
			->add('contactsource_id', 'valid', ['rule' => 'numeric'])
			->validatePresence('contactsource_id', 'create')
			->notEmpty('contactsource_id')
			->add('active', 'valid', ['rule' => 'boolean'])
			->allowEmpty('active')
			->allowEmpty('comment');

		return $validator;
	}

	public function beforeSave(Event $event, Entity $entity, ArrayObject $options){
		if((!empty($entity->name) + !empty($entity->contactname) + !empty($entity->zip_id)
				+ !empty($entity->address) + !empty($entity->phone) + !empty($entity->email)
				+ !empty($entity->birth->time) + !empty($entity->workplace)) >= 2){
			return true;
		}
		else{
			$entity->errors('name', __('At least 2 info should be filled'));
			return false;
		}
	}
	
	public function afterSave(Event $event, Entity $entity, ArrayObject $options){
		//debug($entity);
		if(!$entity->isNew()){
			$loggedInUser = $entity->loggedInUser;
			$toLog = ['name', 'contactname', 'zip_id', 'address', 'phone', 'email', 'birth', 'workplace', 'comment',
					  'linkups', 'groups', 'skills', 'users'];
			
			$oldEntity = $entity->extractOriginal($entity->visibleProperties());
			//debug($entity);
			//debug($oldEntity);
			
			foreach($toLog as $prop){
				if(isset($oldEntity[$prop]) && $entity->$prop != $oldEntity[$prop]){
					if(!is_array($oldEntity[$prop])){
						$details[] = $prop . __(' changed from ') . $oldEntity[$prop] . ' to ' . $entity->$prop;
					}
					else{
						foreach($entity->$prop as $ep){
							$ep = $ep->toArray();
							unset($ep['_joinData']);
							$newEntityProp[] = $ep;
						}
						foreach($oldEntity[$prop] as $op){
							$op = $op->toArray();
							unset($op['_joinData']);
							$oldEntityProp[] = $op;
						}
						
						foreach($oldEntityProp as $oep){
							if(!in_array($oep, $newEntityProp)){
								$details[] = $oep['name'] . __(' removed from ') . $prop;
							}
						}
						foreach($newEntityProp as $nep){
							if(!in_array($nep, $oldEntityProp)){
								$details[] = $oep['name'] . __(' added to ') . $prop;
							}
						}
						
						unset($newEntityProp, $oldEntityProp);
					}
				}
			}

			$history = TableRegistry::get('Histories');
			foreach($details as $detail){
				$data = [
					'id' => null,
					'contact_id' => $entity->id,
					'date' => date('Y-m-d'),
					'create' => date('Y-m-d'),
					'user_id' => $loggedInUser,
					'event_id' => 1,
					'detail' => $detail
				 ];
				//debug($data);
				$newHistory = $history->newEntity($data);
				//debug($newHistory);//die();
				$history->save($newHistory);
			}
		}
	}
}
