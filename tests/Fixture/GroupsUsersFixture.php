<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * GroupsUsersFixture
 *
 */
class GroupsUsersFixture extends TestFixture
{

/**
 * Fields
 *
 * @var array
 */
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 5, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'group_id' => ['type' => 'integer', 'length' => 8, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'user_id' => ['type' => 'integer', 'length' => 5, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'intersection_group_id' => ['type' => 'integer', 'length' => 8, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_groups_has_users_users1_idx' => ['type' => 'index', 'columns' => ['user_id'], 'length' => []],
            'fk_groups_has_users_groups1_idx' => ['type' => 'index', 'columns' => ['group_id'], 'length' => []],
            'fk_groups_users_groups1_idx' => ['type' => 'index', 'columns' => ['intersection_group_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_groups_has_users_groups1' => ['type' => 'foreign', 'columns' => ['group_id'], 'references' => ['groups', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_groups_has_users_users1' => ['type' => 'foreign', 'columns' => ['user_id'], 'references' => ['users', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_groups_users_groups1' => ['type' => 'foreign', 'columns' => ['intersection_group_id'], 'references' => ['groups', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
        //['id' => '1','group_id' => '1','user_id' => '3','intersection_group_id' => NULL]
    ];
}
