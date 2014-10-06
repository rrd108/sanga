<?php
namespace App\Test\TestCase\Controller;

use App\Controller\HistoriesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\HistoriesController Test Case
 */
class HistoriesControllerTest extends IntegrationTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = [
		'app.histories',
		'app.contacts',
		'app.zips',
		'app.countries',
		'app.contactsources',
		'app.groups',
		'app.users',
		'app.events',
		'app.notifications',
		'app.contacts_users',
		'app.linkups',
		'app.contacts_linkups',
		'app.linkups_users',
		'app.contacts_groups',
		'app.units'
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
