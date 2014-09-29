<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Grouptype Entity.
 */
class Grouptype extends Entity {

/**
 * Fields that can be mass assigned using newEntity() or patchEntity().
 *
 * @var array
 */
	protected $_accessible = [
		'name' => true,
		'groups' => true,
	];

}
