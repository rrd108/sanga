<?php
namespace App\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use App\Model\Table\ContactsGroupsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ContactsGroupsTable Test Case
 */
class ContactsGroupsTableTest extends TestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = [
		'app.contacts_groups',
		'app.groups',
		'app.users',
		'app.events',
		'app.histories',
		'app.contacts',
		'app.zips',
		'app.countries',
		'app.contactsources',
		'app.linkups',
		'app.contacts_linkups',
		'app.linkups_users',
		'app.contacts_users',
		'app.skills',
		'app.contacts_skills',
		'app.units',
		'app.notifications',
		'app.usergroups',
		'app.users_usergroups'
	];

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$config = TableRegistry::exists('ContactsGroups') ? [] : ['className' => 'App\Model\Table\ContactsGroupsTable'];
		$this->ContactsGroups = TableRegistry::get('ContactsGroups', $config);
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ContactsGroups);

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
