<?php
namespace App\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use App\Model\Table\ContactsSkillsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ContactsSkillsTable Test Case
 */
class ContactsSkillsTableTest extends TestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = [
		'app.contacts_skills',
		'app.contacts',
		'app.zips',
		'app.countries',
		'app.contactsources',
		'app.histories',
		'app.users',
		'app.events',
		'app.groups',
		'app.contacts_groups',
		'app.notifications',
		'app.contacts_users',
		
		
		
		'app.usergroups',
		'app.users_usergroups',
		'app.units',
		'app.skills'
	];

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$config = TableRegistry::exists('ContactsSkills') ? [] : ['className' => 'App\Model\Table\ContactsSkillsTable'];
		$this->ContactsSkills = TableRegistry::get('ContactsSkills', $config);
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ContactsSkills);

		parent::tearDown();
	}

/**
 * Test initialize method
 *
 * @return void
 */
	public function testInitialize() {
		$this->markTestIncomplete('Not implemented yet.');
	}

/**
 * Test validationDefault method
 *
 * @return void
 */
	public function testValidationDefault() {
		$this->markTestIncomplete('Not implemented yet.');
	}

}
