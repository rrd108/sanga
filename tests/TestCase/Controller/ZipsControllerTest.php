<?php
namespace App\Test\TestCase\Controller;

use App\Controller\ZipsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\ZipsController Test Case
 */
class ZipsControllerTest extends IntegrationTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = [
		'app.zips',
		'app.countries',
		'app.contacts',
		'app.contacts_name_translation',
		'app.contacts_contactname_translation',
		'app.contacts_address_translation',
		'app.contacts_phone_translation',
		'app.contacts_birth_translation',
		'app.contacts_active_translation',
		'app.contacts_comment_translation',
		'app.i18n',
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
