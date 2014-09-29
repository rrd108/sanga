<?php
namespace App\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use App\Model\Table\NotificationsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\NotificationsTable Test Case
 */
class NotificationsTableTest extends TestCase {

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
		'app.contacts_groups',
		'app.contacts_users',
		'app.linkups',
		'app.linkups_users'
	];

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$config = TableRegistry::exists('Notifications') ? [] : ['className' => 'App\Model\Table\NotificationsTable'];
		$this->Notifications = TableRegistry::get('Notifications', $config);
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Notifications);

		parent::tearDown();
	}

}
