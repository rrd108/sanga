<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Contact Entity.
 */
class Contact extends Entity {

/**
 * Fields that can be mass assigned using newEntity() or patchEntity().
 *
 * @var array
 */
	protected $_accessible = [
		'name' => true,
		'contactname' => true,
		'zip_id' => true,
		'address' => true,
		'lat' => true,
		'lng' => true,
		'phone' => true,
		'email' => true,
		'birth' => true,
		'sex' => true,
		'workplace' => true,
		'google_id' => true,
		'family_id' => true,
		'contactsource_id' => true,
		'active' => true,
		'comment' => true,
		'zip' => true,
		'contactsource' => true,
		'histories' => true,
		'groups' => true,
		'linkups' => true,
		'users' => true,
		'skills' => true,
	];

}
