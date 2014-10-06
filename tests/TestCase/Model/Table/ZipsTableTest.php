<?php
namespace App\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use App\Model\Table\ZipsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ZipsTable Test Case
 */
class ZipsTableTest extends TestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = [
		'app.zips',
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
		'app.contactsources',
		'app.histories',
		'app.users',
		'app.notifications',
		'app.contacts_users',
		'app.linkups',
		'app.linkups_users',
		'app.events',
		'app.eventgroups',
		'app.groups',
		'app.grouptypes',
		'app.contacts_groups',
		'app.contacts_linkups'
	];

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$config = TableRegistry::exists('Zips') ? [] : ['className' => 'App\Model\Table\ZipsTable'];
		$this->Zips = TableRegistry::get('Zips', $config);
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Zips);

		parent::tearDown();
	}

}
