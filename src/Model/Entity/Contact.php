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
		'country_id' => true,
		'zip_id' => true,
		'address' => true,
		'phone' => true,
		'email' => true,
		'birth' => true,
		'active' => true,
		'comment' => true,
		'country' => true,
		'zip' => true,
		'contactsource' => true,
	];

}
