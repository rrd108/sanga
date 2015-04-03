<?php
namespace App\Model\Table;

use ArrayObject;
use Cake\Event\Event;
use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\ORM\Entity;
use Cake\ORM\RulesChecker;
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
		$this->displayField('contactname');
		$this->primaryKey('id');
		$this->addBehavior('Timestamp');

		$this->belongsTo('Zips', [
			'foreignKey' => 'zip_id',
		]);
        $this->belongsTo('WorkplaceZips', [
			'className' => 'Zips',
            'foreignKey' => 'workplace_zip_id'
        ]);
		$this->belongsTo('Contactsources', [
			'foreignKey' => 'contactsource_id',
		]);
		$this->hasMany('Histories', [
			'foreignKey' => 'contact_id',
			'sort' => ['Histories.date' => 'DESC', 'Histories.id' => 'DESC']
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
			'sort' => 'Skills.name'
		]);
		$this->belongsToMany('Users', [
			'foreignKey' => 'contact_id',
			'targetForeignKey' => 'user_id',
			'joinTable' => 'contacts_users',
			'sort' => 'Users.name'
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
			->allowEmpty('legalname')
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
			->add('birth', 'valid', ['rule' => 'date'])
			->allowEmpty('birth')
			->add('sex', 'valid', ['rule' => ['inList', [1, 2]],
								   'message' => __('Sex is 1 for male and 2 for female or empty')])
			->allowEmpty('sex')
            ->allowEmpty('workplace')
            ->allowEmpty('workplace_address')
            ->allowEmpty('workplace_phone')
            ->allowEmpty('workplace_email')
  			->add('family_id', 'valid', ['rule' => 'alphanumeric'])
			->allowEmpty('family_id')
			->add('contactsource_id', 'valid', ['rule' => 'numeric'])
			->allowEmpty('contactsource_id')
			->add('active', 'valid', ['rule' => 'boolean'])
			->allowEmpty('active')
			->allowEmpty('comment')
			->allowEmpty('google_id');

		return $validator;
	}

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['zip_id'], 'Zips'));
        $rules->add($rules->existsIn(['workplace_zip_id'], 'Zips'));
        $rules->add($rules->existsIn(['contactsource_id'], 'Contactsources'));
        return $rules;
    }

	public function beforeSave(Event $event, Entity $entity, ArrayObject $options){
		if ($entity->isNew()) {
			if ((!empty($entity->name) + !empty($entity->contactname) + !empty($entity->zip_id)
					+ !empty($entity->address) + !empty($entity->phone) + !empty($entity->email)
					+ !empty($entity->birth->time) + !empty($entity->workplace)
					+ !empty($entity->contactsource_id) + !empty($entity->family_id)) >= 2) {
				return true;
			} else {
				$entity->errors('name', __('At least 2 info should be filled'));
				return false;
			}
		}
		return true;
	}
	
	public function afterSave(Event $event, Entity $entity, ArrayObject $options){
		//debug($entity);
		if(!$entity->isNew()){		//update
			$loggedInUser = $entity->loggedInUser;
			$addr = ['zip_id', 'address'];
			$toLog = ['legalname', 'contactname', 'phone', 'email', 'birth', 'workplace', 'comment',
					  'groups', 'skills', 'users'];
			$toLog = array_merge($toLog, $addr);
			
			$oldEntity = $entity->extractOriginal($entity->visibleProperties());
			
			$details = [];

			foreach($toLog as $prop){
				if(isset($oldEntity[$prop])){		//we had some data in this property
					if($entity->$prop != $oldEntity[$prop]){	//and we changed it
						if(!is_array($oldEntity[$prop])){
							if($oldEntity[$prop] && $entity->$prop){
								$details[] = __('{0} changed from {1}  to {2}', [$prop, $oldEntity[$prop], $entity->$prop]);
							}
							elseif($oldEntity[$prop]){
								$details[] = __('{0}: {1} removed', [$prop, $oldEntity[$prop]]);
							}
							else{
								$details[] = __('{0}: {1} added', [$prop, $entity->$prop]);
							}
						}
						else{
							$newEntityProp = $oldEntityProp = [];
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
									$details[] = __('{0} removed from {1}', [$oep['name'], $prop]);
								}
							}
							foreach($newEntityProp as $nep){
								if(!in_array($nep, $oldEntityProp)){
									$details[] = __('{0} added to {1}', [$nep['name'], $prop]);
								}
							}
						}
						if(in_array($prop, $addr)){	//the address or zip changed or both
							$this->setGeo($entity->id);
						}
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
		else{	//insert
			$this->setGeo($entity->id);
		}
	}
	
	private function setGeo($id){
		exec(WWW_ROOT . '../bin/cake geo set_geo_for_user ' . $id . ' > /dev/null &');
	}	

/*
 * Searching for duplicates: checkDuplicatesOn()
 * 
 * legalname, contactname	similar [legalname, contactname]
 * lat, lng				near (SQL float equality) - handles address
 * phone				remove non numeric, if not start with 00 or +, suppose it is +36 and add it
 * email				same
 * birth				same
 * 
 */

	public function checkDuplicatesOnGeo(){
		$geos = $this->find()
				->select(['id', 'lat', 'lng']);
		
		$duplicates = $foundPairs = [];
		$delta = 0.0001;	//10m
		foreach($geos as $geo){
			if($geo->lat){
				$query = $this->find()
							->select(['id', 'legalname', 'contactname', 'lat', 'lng']);
				$exprLat = $query->newExpr()->add('ABS(lat - ' . $geo['lat'] . ') < ' . $delta);
				$exprLng = $query->newExpr()->add('ABS(lng - ' . $geo['lng'] . ') < ' . $delta);
				$query
					->where([
							 $exprLat,
							 $exprLng,
							 'id !=' => $geo->id
							]);
				$contacts = $query->toArray();
				if(count($contacts)){
					foreach($contacts as $contact){
						if(!in_array($contact->id, $foundPairs) && !in_array($geo->id, $foundPairs)){
							$foundPairs[] = $contact->id;
							$foundPairs[] = $geo->id;
							$duplicates[$geo->id][] = [
									'id' => $contact->id,
									'legalname' => $contact->legalname,
									'contactname' => $contact->contactname,
									'lat' => $contact->lat,
									'lng' => $contact->lng
									];
						}
					}
				}
			}
		}
		return $duplicates;
	}	


	public function checkDuplicatesOnPhone(){
		$removes = 'REPLACE(
						REPLACE(
							REPLACE(
								REPLACE(
									REPLACE(
										REPLACE(phone, "+", ""),
									"-", ""),
								" ", ""),
							"/", ""),
						"(", ""),
					")", "")';

		$removes = 	'CONCAT(
						REPLACE(
							SUBSTRING('.$removes.',	1, 4), "0036", "36"
						),
						SUBSTRING('.$removes.', 5)
					)';
		
		$tPhone = 'CONCAT(
						REPLACE(
							SUBSTRING('.$removes.',	1, 2), "06", "36"
						),
						SUBSTRING('.$removes.', 3)
					)';

		$query = $this->find()
				->select(['db' => 'COUNT(id)',
						  'tPhone' => $tPhone])
				->where(['phone != ' => ''])
				->group(['tPhone'])
				->having(['db > ' => 1])
				->order(['db' => 'DESC']);
		
		$duplicates = [];
		
		foreach($query as $q){
			$query = $this->find()
					->select(['id', 'legalname', 'contactname', 'phone']);
			$duplicates[] = $query->where([$tPhone . ' = ' => $q->tPhone]);
		}
		
		return $duplicates;
	}

	public function checkDuplicatesOnEmail(){
		$query = $this->find()
				->select(['email', 'db' => 'COUNT(*)'])
				->where(['email != ' => ''])
				->group(['email'])
				->having(['db > ' => 1]);
		
		$duplicates = [];
		foreach($query as $q){
			$duplicates[] = $this->find()
						->select(['id', 'legalname', 'contactname', 'email'])
						->where(['email' => $q->email]);
		}
		return $duplicates;
	}	

	public function checkDuplicatesOnBirth(){
		$query = $this->find()
				->select(['birth', 'db' => 'COUNT(*)'])
				->where(['birth != ' => ''])
				->group(['birth'])
				->having(['db > ' => 1]);
		
		$duplicates = [];
		foreach($query as $q){
			$duplicates[] = $this->find()
						->select(['id', 'legalname', 'contactname', 'birth'])
						->where(['birth' => $q->birth]);
		}
		return $duplicates;
	}	

	public function checkDuplicatesOnNames($distance = 4){
		$query = $this->find()
				->select(['id', 'legalname', 'contactname']);
		
		$duplicates = $foundPairs = [];
		
		foreach($query as $q){
			$toSelect = [];
			$toSelect[] = 'id';
			$toSelect[] = 'legalname';
			$toSelect[] = 'contactname';

			if($q->legalname){
				$levenshteinNameName = 'LEVENSHTEIN(name, "'. $q->legalname . '")';
				$levenshteinContactnameName = 'LEVENSHTEIN(contactname, "'. $q->legalname . '")';
				$toSelect['levenshteinNameName'] = $query->newExpr()->add($levenshteinNameName);
				$toSelect['levenshteinContactnameName'] = $query->newExpr()->add($levenshteinContactnameName);
			}
			if($q->contactname){
				$levenshteinNameContactname = 'LEVENSHTEIN(name, "'. $q->contactname . '")';
				$levenshteinContactnameContactname = 'LEVENSHTEIN(contactname, "'. $q->contactname . '")';
				$toSelect['levenshteinNameContactname'] = $query->newExpr()->add($levenshteinNameContactname);
				$toSelect['levenshteinContactnameContactname'] = $query->newExpr()->add($levenshteinContactnameContactname);
			}

			$names = $this->find()
					->select($toSelect);
			if($q->legalname){
				$names->orWhere($levenshteinNameName . ' < ' . $distance)
						->orWhere($levenshteinContactnameName . ' < ' . $distance);
			}
			if($q->contactname){
				$names->orWhere($levenshteinNameContactname . ' < ' . $distance)
						->orWhere($levenshteinContactnameContactname . ' < ' . $distance);
			}
			$names->andWhere(['id != ' => $q->id]);
			$names->toArray();

			if(count($names)){
				foreach($names as $name){
					if(!in_array($name->id, $foundPairs) && !in_array($q->id, $foundPairs)){
						$foundPairs[] = $name->id;
						$foundPairs[] = $q->id;
						$duplicates[$q->id][] = [
								'id' => $name->id,
								'name' => $name->legalname,
								'contactname' => $name->contactname,
								'levenshteinNameName' => $name->levenshteinNameName,
								'levenshteinContactnameName' => $name->levenshteinContactnameName,
								'levenshteinNameContactname' => $name->levenshteinNameContactname,
								'levenshteinContactnameContactname' => $name->levenshteinContactnameContactname
								];
					}
				}
			}
		}
		return $duplicates;
	}
	
/**
 * Find contacts owned by given user(s)
 * The given users are the contact persons for the contact
 */
	public function findOwnedBy(Query $query, array $options){
		return $query
				->matching('Users', function($q) use ($options) {
					    return $q->where(['Users.id IN ' => $options['User.id']]);
					});
	}
	
/**
 * Find contacts who are members of the given groups
 */
	public function findInGroups(Query $query, array $options){
		return $query
				->matching('Groups', function($q) use ($options){
						return $q->where(['Groups.id IN ' => $options['groupIds']]);
					});
	}
	
/**
 * Is the contact accessible for the user because
 * 		the user is a contact person for the contact, or
 * 		the contact is in a group what is accessible by the user, or
 * 		the contact person of the contact is a member of a usergroup what is created by the user
 */
	public function isAccessible($contactId, $userId){
		if ($this->Users->isAdminUser ($userId)) {
			return true;
		}
		if ($this->isAccessibleAsContactPerson($contactId, $userId)) {
			return true;
		}
		if ($this->isAccessibleAsGroupMember($contactId, $userId)) {
			return true;
		}
		if ($this->isAccessibleAsUsergroupMember($contactId, $userId)) {
			return true;
		}
		return false;
	}

/**
 * Is the contact accessible for the user because
 * 		the user is a contact person for the contact
 */	
	private function isAccessibleAsContactPerson($contactId, $userId){
		$contact = $this->find()
			->select('id')
			->where(['Contacts.id' => $contactId])
			->matching('Users', function($q) use ($userId) {
					    return $q->where(['Users.id' => $userId]);
					})
			->toArray();
		//debug($contact);
		if (isset($contact[0]) && $contact[0]['id'] == $contactId){
			//Log::write('debug', 'Accessibel as contact person ' . $contactId . ' :: ' . $userId);
			return true;
		}
		return false;
	}

/**
 * Is the contact accessible for the user because
 * 		the contact is in a group what is accessible by the user
 */
	private function isAccessibleAsGroupMember($contactId, $userId){
		$groupIds = $this->getGroupMemberships($contactId);
		if (count($groupIds)) {
			//user has access for the group as a member or admin
			$userAsMember = $this->Users->find()
						->where(['Users.id' => $userId])
						->matching('Groups', function($q) use ($groupIds) {
									return $q->where(['Groups.id IN ' => $groupIds]);
								})
						->toArray();
			if (count($userAsMember)) {
				//Log::write('debug', 'Accessibel as group member ' . $contactId . ' :: ' . $userId);
				return true;
			}

			$userAsAdmin = $this->Users->find()
						->where(['Users.id' => $userId])
						->matching('AdminGroups', function($q) use ($userId, $groupIds) {
									return $q->where(['AdminGroups.admin_user_id' => $userId,
													  'AdminGroups.id IN' => $groupIds]);
								})
						->toArray();
			if (count($userAsAdmin)) {
				//Log::write('debug', 'Accessibel as group admin ' . $contactId . ' :: ' . $userId);
				return true;
			}
		}
		return false;
	}

/**
 * Is the contact accessible for the user because
 * 		the contact person of the contact is a member of a usergroup what is created by the user
 */	
	private function isAccessibleAsUsergroupMember($contactId, $userId){
		//get contact persons
		$_contactUsers = $this->get($contactId, ['contain' => 'Users']);
		foreach($_contactUsers->users as $u){
			$userIds[] = $u->id;
		}
		//get their usergroup memberships
		$_usergroupMemberships = $this->Users->find()
					->matching('Usergroups', function($q) use ($userIds) {
							return $q->where(['Users.id IN ' => $userIds]);
						});
		foreach ($_usergroupMemberships as $uId) {
			if (isset($uId->_matchingData['Usergroups']->admin_user_id)) {
				$userIds[] = $uId->_matchingData['Usergroups']->admin_user_id;
			}
			if (isset($uId->_matchingData['UserUsergroups']->user_id)) {
				$userIds[] = $uId->_matchingData['UserUsergroups']->user_id;
			}
		}
		if(in_array($userId, $userIds)) {
			return true;
		}
		return false;
	}

//group memberships of the contact
	private function getGroupMemberships($contactId) {
		$contactGroups = $this->find()
			->contain(['Groups'])
			->where(['Contacts.id' => $contactId]);
		$groupIds = [];
		foreach ($contactGroups as $c) {
			foreach ($c->groups as $g) {
				$groupIds[] = $g->id;
			}
		}
		return $groupIds;
	}
	
/*
 * Which users has acess to this contact
 */
	public function hasAccess($contactId) {
		$access = ['contactPersons' => [], 'groupMembers' => [], 'usergroupMembers' => []];

		//has access as contact person
		$contact = $this->get($contactId, ['contain' => ['Users']]);
		$access['contactPersons'] = $contact->users;

		//has access as group member
		$groupIds = $this->getGroupMemberships($contactId);
		if (count($groupIds)) {
			//user has access for the group as a member or admin
			$userAsMember = $this->Users->find()
						->matching('Groups', function($q) use ($groupIds) {
									return $q->where(['Groups.id IN ' => $groupIds]);
								})
						->toArray();
			//debug($userAsMember);
			$access['groupMembers'] = $userAsMember;

			$userAsAdmin = $this->Users->find()
						->matching('AdminGroups', function($q) use ($groupIds) {
									return $q->where(['AdminGroups.id IN' => $groupIds]);
								})
						->toArray();
			//debug($userAsAdmin);
			$access['groupMembers'][] = $userAsAdmin[0];		//only 1 user could be the admin fro a group
			//debug($access);
		}

		//has access as usergroup member
		//get contact persons ids
		foreach($contact->users as $u){
			$userIds[] = $u->id;
		}
		//debug($userIds);
		//get their usergroup memberships
		$usergroupMemberships = $this->Users->find()
					->matching('Usergroups', function($q) use ($userIds) {
							return $q->where(['Users.id IN ' => $userIds]);
						})
					->toArray();
		foreach ($usergroupMemberships as $u) {
			//get the usergroup admin
			$usergroupAdmin = $this->Users->get($u->_matchingData['Usergroups']->admin_user_id);
			array_unshift($usergroupMemberships, $usergroupAdmin);
		}
		$access['usergroupMembers'] = $usergroupMemberships;
		
		return $access;
	}

}
