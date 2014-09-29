<?php
namespace App\Test\TestCase\Controller;

use App\Controller\NotificationsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\NotificationsController Test Case
 */
class NotificationsControllerTest extends IntegrationTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = [
		'app.notifications',
		'app.users',
		'app.histories',
		'app.contacts',
		'app.countries',
		'app.zips',
		'app.contactsources',
		'app.events',
		'app.eventgroups',
		'app.groups',
		'app.grouptypes',
		'app.contacts_users',
		'app.linkups',
		'app.linkups_users'
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
