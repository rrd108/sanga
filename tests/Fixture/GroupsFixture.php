<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * GroupsFixture
 *
 */
class GroupsFixture extends TestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = [
		'id' => ['type' => 'integer', 'length' => 8, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
		'name' => ['type' => 'string', 'length' => 45, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
		'description' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
		'admin_user_id' => ['type' => 'integer', 'length' => 5, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => 'admin could add or remove users to/from the group in groups_users table', 'precision' => null, 'autoIncrement' => null],
		'shared' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => 'All users will see the existence of this group, but not the members', 'precision' => null],
		'_indexes' => [
			'fk_groups_users1_idx' => ['type' => 'index', 'columns' => ['admin_user_id'], 'length' => []],
			'shareds' => ['type' => 'index', 'columns' => ['shared'], 'length' => []],
		],
		'_constraints' => [
			'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
			'fk_groups_users1' => ['type' => 'foreign', 'columns' => ['admin_user_id'], 'references' => ['users', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
		['id' => '1','name' => 'NVD','description' => '','admin_user_id' => '1','shared' => '1'],
		['id' => '2','name' => 'Budapest','description' => '','admin_user_id' => '2','shared' => '1'],
		['id' => '3','name' => 'Seva-puja','description' => 'Seva-puja tagok','admin_user_id' => '2','shared' => '0']
	];

}
