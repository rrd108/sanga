<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ContactsGroup Entity.
 */
class ContactsGroup extends Entity {

/**
 * Fields that can be mass assigned using newEntity() or patchEntity().
 *
 * @var array
 */
	protected $_accessible = [
		'group' => true,
		'contact' => true,
	];

}
