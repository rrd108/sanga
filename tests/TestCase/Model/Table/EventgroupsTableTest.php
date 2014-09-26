<?php
namespace App\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use App\Model\Table\EventgroupsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EventgroupsTable Test Case
 */
class EventgroupsTableTest extends TestCase {

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$config = TableRegistry::exists('Eventgroups') ? [] : ['className' => 'App\Model\Table\EventgroupsTable'];
		$this->Eventgroups = TableRegistry::get('Eventgroups', $config);
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Eventgroups);

		parent::tearDown();
	}

}
