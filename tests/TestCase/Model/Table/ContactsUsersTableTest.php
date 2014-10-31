<?php
namespace App\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use App\Model\Table\ContactsUsersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ContactsUsersTable Test Case
 */
class ContactsUsersTableTest extends TestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = [
		'app.contacts_users',
		'app.contacts',
		'app.zips',
		'app.countries',
		'app.contactsources',
		'app.histories',
		'app.users',
		'app.events',
		'app.groups',
		'app.contacts_groups',
		'app.notifications',
		'app.linkups',
		'app.contacts_linkups',
		'app.linkups_users',
		'app.usergroups',
		'app.users_usergroups',
		'app.units',
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
		$config = TableRegistry::exists('ContactsUsers') ? [] : ['className' => 'App\Model\Table\ContactsUsersTable'];
		$this->ContactsUsers = TableRegistry::get('ContactsUsers', $config);
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ContactsUsers);

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
