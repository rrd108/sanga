<?php
namespace App\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use App\Model\Table\GroupsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\GroupsTable Test Case
 */
class GroupsTableTest extends TestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = [
		'app.groups',
		'app.grouptypes',
		'app.histories',
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
		'app.contacts_groups',
		'app.linkups',
		'app.users',
		'app.events',
		'app.eventgroups',
		'app.notifications',
		'app.contacts_users',
		'app.linkups_users',
		'app.contacts_linkups'
	];

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$config = TableRegistry::exists('Groups') ? [] : ['className' => 'App\Model\Table\GroupsTable'];
		$this->Groups = TableRegistry::get('Groups', $config);
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Groups);

		parent::tearDown();
	}

}
