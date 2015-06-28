<?php
namespace App\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use App\Model\Table\GroupsUsersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\GroupsUsersTable Test Case
 */
class GroupsUsersTableTest extends TestCase
{

/**
 * Fixtures
 *
 * @var array
 */
    public $fixtures = [
        'app.groups_users',
        'app.groups',
        'app.users',
        'app.events',
        'app.histories',
        'app.contacts',
        'app.zips',
        'app.countries',
        'app.contactsources',
        'app.contacts_groups',
        'app.skills',
        'app.contacts_skills',
        'app.contacts_users',
        'app.units',
        'app.notifications',
        'app.groups_users',
        'app.usergroups',
        'app.users_usergroups'
    ];

/**
 * setUp method
 *
 * @return void
 */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('GroupsUsers') ? [] : ['className' => 'App\Model\Table\GroupsUsersTable'];
        $this->GroupsUsers = TableRegistry::get('GroupsUsers', $config);
    }

/**
 * tearDown method
 *
 * @return void
 */
    public function tearDown()
    {
        unset($this->GroupsUsers);

        parent::tearDown();
    }

/**
 * Test initialize method
 *
 * @return void
 */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

/**
 * Test validationDefault method
 *
 * @return void
 */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
