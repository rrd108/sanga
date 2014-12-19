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
			->add('birth', 'valid', ['rule' => 'date'])
			->allowEmpty('birth')
			->add('sex', 'valid', ['rule' => 'numeric'])
			->allowEmpty('sex')
			->allowEmpty('workplace')
			->add('family_id', 'valid', ['rule' => 'alphanumeric'])
			->allowEmpty('family_id')
			->add('contactsource_id', 'valid', ['rule' => 'numeric'])
			->allowEmpty('contactsource_id')
			->add('active', 'valid', ['rule' => 'boolean'])
			->allowEmpty('active')
			->allowEmpty('comment');

		return $validator;
	}

	public function beforeSave(Event $event, Entity $entity, ArrayObject $options){
		if((!empty($entity->name) + !empty($entity->contactname) + !empty($entity->zip_id)
				+ !empty($entity->address) + !empty($entity->phone) + !empty($entity->email)
				+ !empty($entity->birth->time) + !empty($entity->workplace)
				+ !empty($entity->contactsource_id)) >= 2){
			return true;
		}
		else{
			$entity->errors('name', __('At least 2 info should be filled'));
			return false;
		}
	}
	
	public function afterSave(Event $event, Entity $entity, ArrayObject $options){
		//debug($entity);
		if(!$entity->isNew()){		//update
			$loggedInUser = $entity->loggedInUser;
			$addr = ['zip_id', 'address'];
			$toLog = ['name', 'contactname', 'phone', 'email', 'birth', 'workplace', 'comment',
					  'groups', 'skills', 'users'];
			$toLog = array_merge($toLog, $addr);
			
			$oldEntity = $entity->extractOriginal($entity->visibleProperties());
			
			$details = [];

			foreach($toLog as $prop){
				if(isset($oldEntity[$prop])){		//we had some data in this property
					if($entity->$prop != $oldEntity[$prop]){	//and we changed it
						if(!is_array($oldEntity[$prop])){
							if($oldEntity[$prop] && $entity->$prop){
								$details[] = $prop . ' ' . __('changed from ') . $oldEntity[$prop] . ' ' . __('to') . ' ' . $entity->$prop;
							}
							elseif($oldEntity[$prop]){
								$details[] = $prop . ': ' . $oldEntity[$prop] . ' ' . __('removed');
							}
							else{
								$details[] = $prop . ': ' . $entity->$prop . ' ' . __('added');
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
									$details[] = $oep['name'] . ' ' . __('removed from') . ' ' . $prop;
								}
							}
							foreach($newEntityProp as $nep){
								if(!in_array($nep, $oldEntityProp)){
									$details[] = $nep['name'] . ' ' . __('added to') . ' ' . $prop;
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
 * name, contactname	similar [name, contactname]
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
							->select(['id', 'name', 'contactname', 'lat', 'lng']);
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
									'name' => $contact->name,
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
					->select(['id', 'name', 'contactname', 'phone']);
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
						->select(['id', 'name', 'contactname', 'email'])
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
						->select(['id', 'name', 'contactname', 'birth'])
						->where(['birth' => $q->birth]);
		}
		return $duplicates;
	}	

	public function checkDuplicatesOnNames($distance = 4){
		$query = $this->find()
				->select(['id', 'name', 'contactname']);
		
		$duplicates = $foundPairs = [];
		
		foreach($query as $q){
			$toSelect = [];
			$toSelect[] = 'id';
			$toSelect[] = 'name';
			$toSelect[] = 'contactname';

			if($q->name){
				$levenshteinNameName = 'LEVENSHTEIN(name, "'. $q->name . '")';
				$levenshteinContactnameName = 'LEVENSHTEIN(contactname, "'. $q->name . '")';
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
			if($q->name){
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
								'name' => $name->name,
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
	
	public function findMine(Query $query, array $options){
		return $query
				->matching('Users', function($q) use ($options) {
					    return $q->where(['Users.id IN ' => $options['User.id']]);
					});
	}
	
	public function findInGroups(Query $query, array $options){
		return $query
				->matching('Groups', function($q) use ($options){
						return $q->where(['Groups.id IN ' => $options['groupIds']]);
					});
	}

}