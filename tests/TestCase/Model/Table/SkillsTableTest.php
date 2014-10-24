<?php
namespace App\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use App\Model\Table\SkillsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SkillsTable Test Case
 */
class SkillsTableTest extends TestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = [
		'app.skills',
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
		'app.linkups',
		'app.contacts_linkups',
		'app.linkups_users',
		'app.usergroups',
		'app.users_usergroups',
		'app.units',
		'app.contacts_skills'
	];

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$config = TableRegistry::exists('Skills') ? [] : ['className' => 'App\Model\Table\SkillsTable'];
		$this->Skills = TableRegistry::get('Skills', $config);
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Skills);

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
