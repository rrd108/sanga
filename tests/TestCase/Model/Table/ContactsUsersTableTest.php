<?php

namespace App\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use App\Model\Table\ContactsUsersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ContactsUsersTable Test Case
 */
class ContactsUsersTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ContactsUsers',
        'app.Contacts',
        'app.Zips',
        'app.Countries',
        'app.Contactsources',
        'app.Histories',
        'app.Users',
        'app.Events',
        'app.Groups',
        'app.ContactsGroups',
        'app.Notifications',
        'app.Usergroups',
        'app.UsersUsergroups',
        'app.Units',
        'app.Skills',
        'app.ContactsSkills'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ContactsUsers') ? [] : ['className' => 'App\Model\Table\ContactsUsersTable'];
        $this->ContactsUsers = TableRegistry::get('ContactsUsers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ContactsUsers);

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
