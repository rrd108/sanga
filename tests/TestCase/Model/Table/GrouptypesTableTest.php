<?php
namespace App\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use App\Model\Table\GrouptypesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\GrouptypesTable Test Case
 */
class GrouptypesTableTest extends TestCase {

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$config = TableRegistry::exists('Grouptypes') ? [] : ['className' => 'App\Model\Table\GrouptypesTable'];
		$this->Grouptypes = TableRegistry::get('Grouptypes', $config);
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Grouptypes);

		parent::tearDown();
	}

}
