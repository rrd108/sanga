<?php
namespace App\Test\TestCase\Controller;

use App\Controller\GroupsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\GroupsController Test Case
 */
class GroupsControllerTest extends IntegrationTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = [
		'app.groups',
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
		'app.contacts_groups',
		'app.linkups',
		'app.linkups_users',
		'app.contacts_users',
		'app.contacts_linkups',
		'app.notifications'
	];

/**
 * testIndex method
 *
 * @return void
 */
	public function testIndex() {
		$this->markTestIncomplete('testIndex not implemented.');
	}

/**
 * testView method
 *
 * @return void
 */
	public function testView() {
		$this->markTestIncomplete('testView not implemented.');
	}

/**
 * testAdd method
 *
 * @return void
 */
	public function testAdd() {
		$this->markTestIncomplete('testAdd not implemented.');
	}

/**
 * testEdit method
 *
 * @return void
 */
	public function testEdit() {
		$this->markTestIncomplete('testEdit not implemented.');
	}

/**
 * testDelete method
 *
 * @return void
 */
	public function testDelete() {
		$this->markTestIncomplete('testDelete not implemented.');
	}

}
