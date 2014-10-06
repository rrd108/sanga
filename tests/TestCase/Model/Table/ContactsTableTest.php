<?php
namespace App\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use App\Model\Table\ContactsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ContactsTable Test Case
 */
class ContactsTableTest extends TestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = [
		'app.contacts',
		'app.contacts_name_translation',
		'app.contacts_contactname_translation',
		'app.contacts_address_translation',
		'app.contacts_phone_translation',
		'app.contacts_birth_translation',
		'app.contacts_active_translation',
		'app.contacts_comment_translation',
		'app.i18n',
		'app.countries',
		'app.zips',
		'app.contactsources',
		'app.histories',
		'app.users',
		'app.events',
		'app.groups',
		'app.contacts_groups',
		'app.notifications',
		'app.contacts_users',
		'app.linkups',
		'app.contacts_linkups',
		'app.linkups_users'
	];

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$config = TableRegistry::exists('Contacts') ? [] : ['className' => 'App\Model\Table\ContactsTable'];
		$this->Contacts = TableRegistry::get('Contacts', $config);
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Contacts);

		parent::tearDown();
	}

}
