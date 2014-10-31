<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ContactsSkill Entity.
 */
class ContactsSkill extends Entity {

/**
 * Fields that can be mass assigned using newEntity() or patchEntity().
 *
 * @var array
 */
	protected $_accessible = [
		'contact' => true,
		'skill' => true,
	];

}
