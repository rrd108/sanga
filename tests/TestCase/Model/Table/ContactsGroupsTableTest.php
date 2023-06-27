<?php

namespace App\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use App\Model\Table\ContactsGroupsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ContactsGroupsTable Test Case
 */
class ContactsGroupsTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ContactsGroups',
        'app.Groups',
        'app.Users',
        'app.Events',
        'app.Histories',
        'app.Contacts',
        'app.Zips',
        'app.Countries',
        'app.Contactsources',
        'app.ContactsUsers',
        'app.Skills',
        'app.ContactsSkills',
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
        $config = TableRegistry::exists('ContactsGroups') ? [] : ['className' => 'App\Model\Table\ContactsGroupsTable'];
        $this->ContactsGroups = TableRegistry::get('ContactsGroups', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ContactsGroups);

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
