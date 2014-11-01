<?php
namespace App\Test\TestCase\Controller;

use App\Controller\ContactsGroupsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\ContactsGroupsController Test Case
 */
class ContactsGroupsControllerTest extends IntegrationTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = [
		'app.contacts_groups',
		'app.groups',
		
		'app.histories',
		'app.contacts',
		'app.zips',
		'app.countries',
		
		'app.contactsources',
		'app.skills',
		'app.contacts_skills',
		'app.users',
		'app.events',
		'app.notifications',
		'app.contacts_users',
		'app.groups_users',
		
		'app.usergroups',
		'app.users_usergroups',
		'app.units'
	];

/**
 * Test index method
 *
 * @return void
 */
	public function testIndex() {
		$this->markTestIncomplete('Not implemented yet.');
	}

/**
 * Test view method
 *
 * @return void
 */
	public function testView() {
		$this->markTestIncomplete('Not implemented yet.');
	}

/**
 * Test add method
 *
 * @return void
 */
	public function testAdd() {
		$this->markTestIncomplete('Not implemented yet.');
	}

/**
 * Test edit method
 *
 * @return void
 */
	public function testEdit() {
		$this->markTestIncomplete('Not implemented yet.');
	}

/**
 * Test delete method
 *
 * @return void
 */
	public function testDelete() {
		$this->markTestIncomplete('Not implemented yet.');
	}

}
