<?php
namespace App\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use App\Model\Table\UsersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UsersTable Test Case
 */
class UsersTableTest extends TestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = [
		'app.users',
		'app.events',
		'app.histories',
		'app.contacts',
		'app.zips',
		'app.countries',
		'app.contactsources',
		'app.groups',
		'app.contacts_groups',
		
		
		
		'app.contacts_users',
		'app.skills',
		'app.contacts_skills',
		'app.units',
		'app.notifications',
		'app.usergroups',
		'app.users_usergroups'
	];

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$config = TableRegistry::exists('Users') ? [] : ['className' => 'App\Model\Table\UsersTable'];
		$this->Users = TableRegistry::get('Users', $config);
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Users);
		parent::tearDown();
	}

/**
 * Test initialize method
 *
 * @return void
 */
	public function testInitialize() {
		//$this->markTestIncomplete('Not implemented yet.');
	}

/**
 * Test validationDefault method
 *
 * @return void
 */
	public function testValidationDefault() {
		//$this->markTestIncomplete('Not implemented yet.');
	}
	
	public function testCheckPasswordStrength(){
		$this->assertEquals(false, $this->Users->checkPasswordStrength('abc', null));
		$this->assertEquals(false, $this->Users->checkPasswordStrength('abcA', null));

		$this->assertEquals(true, $this->Users->checkPasswordStrength('abcA!', null));
		$this->assertEquals(true, $this->Users->checkPasswordStrength('abcA!1', null));
	}

}
