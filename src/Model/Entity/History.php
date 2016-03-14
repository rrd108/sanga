<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * History Entity.
 */
class History extends Entity
{

    /**
 * Fields that can be mass assigned using newEntity() or patchEntity().
 *
 * @var array
 */
    protected $_accessible = [
        'contact_id' => true,
        'date' => true,
        'user_id' => true,
        'group_id' => true,
        'event_id' => true,
        'detail' => true,
        'quantity' => true,
        'unit_id' => true,
        'family' => true,
        'contact' => true,
        'user' => true,
        'linkup' => true,
        'event' => true,
        'unit' => true,
        'group' => true,
    ];

    public function _getShortDetail () {
        if (strlen($this->_properties['detail']) > 100) {
            return substr($this->_properties['detail'], 0, 100) . '...';
        } else {
            return $this->_properties['detail'];
        }
    }
}
