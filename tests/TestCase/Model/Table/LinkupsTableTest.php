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
 * Fixtures
 *
 * @var array
 */
	public $fixtures = [
		'app.linkups',
		'app.users',
		'app.events',
		'app.eventgroups',
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
		'app.groups',
		'app.contacts_groups',
		'app.contacts_linkups',
		'app.contacts_users',
		'app.notifications',
		'app.linkups_users'
	];

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
