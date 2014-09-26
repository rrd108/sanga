<?php
namespace App\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use App\Model\Table\EventsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EventsTable Test Case
 */
class EventsTableTest extends TestCase {

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$config = TableRegistry::exists('Events') ? [] : ['className' => 'App\Model\Table\EventsTable'];
		$this->Events = TableRegistry::get('Events', $config);
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Events);

		parent::tearDown();
	}

}
