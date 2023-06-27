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
        'app.UsersUsergroups',
        'app.Users',
        'app.Events',
        'app.Histories',
        'app.Contacts',
        'app.Zips',
        'app.Countries',

        'app.Contactsources',
        'app.Groups',
        'app.GroupsUsers',

        'app.ContactsGroups',
        'app.Skills',
        'app.ContactsSkills',
        'app.ContactsUsers',
        'app.Units',
        'app.Notifications',
        'app.Usergroups',
        'app.UsersUsergroups'
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
