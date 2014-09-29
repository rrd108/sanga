<?php
namespace App\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use App\Model\Table\LinkupsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LinkupsTable Test Case
 */
class LinkupsTableTest extends TestCase {

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$config = TableRegistry::exists('Linkups') ? [] : ['className' => 'App\Model\Table\LinkupsTable'];
		$this->Linkups = TableRegistry::get('Linkups', $config);
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Linkups);

		parent::tearDown();
	}

}
