<?php
namespace App\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use App\Model\Table\UnitsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UnitsTable Test Case
 */
class UnitsTableTest extends TestCase {

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$config = TableRegistry::exists('Units') ? [] : ['className' => 'App\Model\Table\UnitsTable'];
		$this->Units = TableRegistry::get('Units', $config);
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Units);

		parent::tearDown();
	}

}
