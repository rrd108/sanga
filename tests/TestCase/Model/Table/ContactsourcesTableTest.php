<?php
namespace App\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use App\Model\Table\ContactsourcesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ContactsourcesTable Test Case
 */
class ContactsourcesTableTest extends TestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = [
		'app.contactsources',
		'app.contacts',
		'app.zips',
		'app.countries',
		'app.histories',
		'app.users',
		'app.events',
		'app.groups',
		'app.contacts_groups',
		'app.notifications',
		'app.contacts_users',
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
		$config = TableRegistry::exists('Contactsources') ? [] : ['className' => 'App\Model\Table\ContactsourcesTable'];
		$this->Contactsources = TableRegistry::get('Contactsources', $config);
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Contactsources);

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
