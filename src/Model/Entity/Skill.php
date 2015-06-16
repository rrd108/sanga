<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Skill Entity.
 */
class Skill extends Entity
{

    /**
 * Fields that can be mass assigned using newEntity() or patchEntity().
 *
 * @var array
 */
    protected $_accessible = [
        'name' => true,
        'contacts' => true,
    ];
}
