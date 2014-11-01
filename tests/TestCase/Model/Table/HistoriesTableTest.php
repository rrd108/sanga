<?php
namespace App\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use App\Model\Table\HistoriesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\HistoriesTable Test Case
 */
class HistoriesTableTest extends TestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = [
		'app.histories',
		'app.contacts',
		'app.zips',
		'app.countries',
		'app.contactsources',
		'app.groups',
		'app.users',
		'app.events',
		'app.notifications',
		'app.contacts_users',
		
		
		
		'app.usergroups',
		'app.users_usergroups',
		'app.contacts_groups',
		'app.skills',
		'app.contacts_skills',
		'app.units'
	];

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$config = TableRegistry::exists('Histories') ? [] : ['className' => 'App\Model\Table\HistoriesTable'];
		$this->Histories = TableRegistry::get('Histories', $config);
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Histories);

		parent::tearDown();
	}

/**
 * Test initialize method
 *
 * @return void
 */
	public function testInitialize() {
		$this->markTestIncomplete('Not implemented yet.');
	}

/**
 * Test validationDefault method
 *
 * @return void
 */
	public function testValidationDefault() {
		$this->markTestIncomplete('Not implemented yet.');
	}

}
