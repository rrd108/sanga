<?php
namespace App\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use App\Model\Table\ZipsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ZipsTable Test Case
 */
class ZipsTableTest extends TestCase {

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$config = TableRegistry::exists('Zips') ? [] : ['className' => 'App\Model\Table\ZipsTable'];
		$this->Zips = TableRegistry::get('Zips', $config);
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Zips);

		parent::tearDown();
	}

}
