<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Contactsource Entity.
 */
class Contactsource extends Entity
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
