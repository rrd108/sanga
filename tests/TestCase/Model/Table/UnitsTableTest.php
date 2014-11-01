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
 * Fixtures
 *
 * @var array
 */
	public $fixtures = [
		'app.units',
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
		'app.contacts_skills'
	];

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
