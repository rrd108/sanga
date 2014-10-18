<?php
namespace App\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use App\Model\Table\UsergroupsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UsergroupsTable Test Case
 */
class UsergroupsTableTest extends TestCase {

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$config = TableRegistry::exists('Usergroups') ? [] : ['className' => 'App\Model\Table\UsergroupsTable'];
		$this->Usergroups = TableRegistry::get('Usergroups', $config);
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Usergroups);

		parent::tearDown();
	}

}
