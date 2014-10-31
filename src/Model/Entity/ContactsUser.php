<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ContactsUser Entity.
 */
class ContactsUser extends Entity {

/**
 * Fields that can be mass assigned using newEntity() or patchEntity().
 *
 * @var array
 */
	protected $_accessible = [
		'contact' => true,
		'user' => true,
	];

}
