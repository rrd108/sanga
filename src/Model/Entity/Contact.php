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
		'active' => true,
		'comment' => true,
		'contactsource_id' => true,
		'name_translation' => true,
		'contactname_translation' => true,
		'address_translation' => true,
		'phone_translation' => true,
		'birth_translation' => true,
		'active_translation' => true,
		'comment_translation' => true,
		'_i18n' => true,
		'country' => true,
		'zip' => true,
		'contactsource' => true,
		'histories' => true,
		'groups' => true,
		'linkups' => true,
		'users' => true,
	];

}
