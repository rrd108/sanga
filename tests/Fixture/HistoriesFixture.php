<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * HistoriesFixture
 *
 */
class HistoriesFixture extends TestFixture
{

/**
 * Fields
 *
 * @var array
 */
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'contact_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'date' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'user_id' => ['type' => 'integer', 'length' => 5, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'group_id' => ['type' => 'integer', 'length' => 8, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'event_id' => ['type' => 'integer', 'length' => 5, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'detail' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'quantity' => ['type' => 'decimal', 'length' => 10, 'precision' => 2, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => ''],
        'unit_id' => ['type' => 'integer', 'length' => 5, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'family' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'fk_histories_contacts1_idx' => ['type' => 'index', 'columns' => ['contact_id'], 'length' => []],
            'fk_histories_users1_idx' => ['type' => 'index', 'columns' => ['user_id'], 'length' => []],
            'fk_histories_events1_idx' => ['type' => 'index', 'columns' => ['event_id'], 'length' => []],
            'fk_histories_groups1_idx' => ['type' => 'index', 'columns' => ['group_id'], 'length' => []],
            'fk_histories_units1_idx' => ['type' => 'index', 'columns' => ['unit_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_histories_contacts1' => ['type' => 'foreign', 'columns' => ['contact_id'], 'references' => ['contacts', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_histories_events1' => ['type' => 'foreign', 'columns' => ['event_id'], 'references' => ['events', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_histories_groups1' => ['type' => 'foreign', 'columns' => ['group_id'], 'references' => ['groups', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_histories_units1' => ['type' => 'foreign', 'columns' => ['unit_id'], 'references' => ['units', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_histories_users1' => ['type' => 'foreign', 'columns' => ['user_id'], 'references' => ['users', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
        [
            'id' => 1,
            'contact_id' => 1,
            'date' => '2014-10-30',
            'user_id' => 1,
            'group_id' => 1,
            'event_id' => 1,
            'detail' => 'Lorem ipsum dolor sit amet',
            'quantity' => '',
            'unit_id' => 1,
            'family' => 1,
            'created' => '2014-10-30 12:19:40',
            'modified' => '2014-10-30 12:19:40'
        ],
        [
            'id' => 2,
            'contact_id' => 2,
            'date' => '2014-10-30',
            'user_id' => 1,
            'group_id' => 1,
            'event_id' => 1,
            'detail' => 'Lorem ipsum dolor sit amet',
            'quantity' => '',
            'unit_id' => 1,
            'family' => 1,
            'created' => '2014-10-30 12:19:40',
            'modified' => '2014-10-30 12:19:40'
        ],
        [
            'id' => 3,
            'contact_id' => 1,
            'date' => '2014-10-30',
            'user_id' => 1,
            'group_id' => 1,
            'event_id' => 1,
            'detail' => 'Lorem ipsum dolor sit amet',
            'quantity' => '',
            'unit_id' => 1,
            'family' => 1,
            'created' => '2014-10-30 12:19:40',
            'modified' => '2014-10-30 12:19:40'
        ],
    ];
}
