<?php
namespace App\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use App\Model\Table\UsersUsergroupsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UsersUsergroupsTable Test Case
 */
class UsersUsergroupsTableTest extends TestCase
{

/**
 * Fixtures
 *
 * @var array
 */
    public $fixtures = [
        'app.users_usergroups',
        'app.users',
        'app.events',
        'app.histories',
        'app.contacts',
        'app.zips',
        'app.countries',
        
        'app.contactsources',
        'app.groups',
        'app.groups_users',
        
        'app.contacts_groups',
        'app.skills',
        'app.contacts_skills',
        'app.contacts_users',
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
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('UsersUsergroups') ? [] : ['className' => 'App\Model\Table\UsersUsergroupsTable'];
        $this->UsersUsergroups = TableRegistry::get('UsersUsergroups', $config);
    }

/**
 * tearDown method
 *
 * @return void
 */
    public function tearDown()
    {
        unset($this->UsersUsergroups);

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
