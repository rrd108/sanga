<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Document Entity.
 */
class Document extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'contact_id' => true,
        'user_id' => true,
        'name' => true,
        'file_name' => true,
        'file_type' => true,
        'size' => true,
        'data' => true,
        'contact' => true,
        'user' => true
    ];
}
