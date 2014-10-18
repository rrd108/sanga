<?php
namespace App\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use App\Model\Table\UsersUsergroupsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UsersUsergroupsTable Test Case
 */
class UsersUsergroupsTableTest extends TestCase {

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$config = TableRegistry::exists('UsersUsergroups') ? [] : ['className' => 'App\Model\Table\UsersUsergroupsTable'];
		$this->UsersUsergroups = TableRegistry::get('UsersUsergroups', $config);
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->UsersUsergroups);

		parent::tearDown();
	}

}
