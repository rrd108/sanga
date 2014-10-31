<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersUsergroupsFixture
 *
 */
class UsersUsergroupsFixture extends TestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = [
		'id' => ['type' => 'integer', 'length' => 6, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
		'user_id' => ['type' => 'integer', 'length' => 5, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
		'usergroup_id' => ['type' => 'integer', 'length' => 6, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
		'admin' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => 'admin could add and remove members', 'precision' => null],
		'_indexes' => [
			'fk_usergroups_has_users_users1_idx' => ['type' => 'index', 'columns' => ['user_id'], 'length' => []],
			'fk_usergroups_has_users_usergroups1_idx' => ['type' => 'index', 'columns' => ['usergroup_id'], 'length' => []],
		],
		'_constraints' => [
			'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
			'fk_usergroups_has_users_usergroups1' => ['type' => 'foreign', 'columns' => ['usergroup_id'], 'references' => ['usergroups', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
			'fk_usergroups_has_users_users1' => ['type' => 'foreign', 'columns' => ['user_id'], 'references' => ['users', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
			'user_id' => 1,
			'usergroup_id' => 1,
			'admin' => 1
		],
	];

}
