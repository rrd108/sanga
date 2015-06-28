<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ContactsGroupsFixture
 *
 */
class ContactsGroupsFixture extends TestFixture
{

/**
 * Fields
 *
 * @var array
 */
    public $fields = [
        'group_id' => ['type' => 'integer', 'length' => 8, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'contact_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_groups_has_contacts_contacts1_idx' => ['type' => 'index', 'columns' => ['contact_id'], 'length' => []],
            'fk_groups_has_contacts_groups1_idx' => ['type' => 'index', 'columns' => ['group_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['group_id', 'contact_id'], 'length' => []],
            'fk_groups_has_contacts_contacts1' => ['type' => 'foreign', 'columns' => ['contact_id'], 'references' => ['contacts', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_groups_has_contacts_groups1' => ['type' => 'foreign', 'columns' => ['group_id'], 'references' => ['groups', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
        ],
        '_options' => [
        'engine' => 'InnoDB', 'collation' => 'utf8_hungarian_ci'
        ],
    ];

/**
 * Records
 *
 * @var array
 */
    public $records = [
        ['group_id' => 1, 'contact_id' => 1],
        ['group_id' => 1, 'contact_id' => 2],
        ['group_id' => 2, 'contact_id' => 6]
    ];
}
