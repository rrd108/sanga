<?php

namespace App\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use App\Model\Table\ContactsourcesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ContactsourcesTable Test Case
 */
class ContactsourcesTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Contactsources',
        'app.Contacts',
        'app.Zips',
        'app.Countries',
        'app.Histories',
        'app.Users',
        'app.Events',
        'app.Groups',
        'app.ContactsGroups',
        'app.Notifications',
        'app.ContactsUsers',



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
        $config = TableRegistry::exists('Contactsources') ? [] : ['className' => 'App\Model\Table\ContactsourcesTable'];
        $this->Contactsources = TableRegistry::get('Contactsources', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Contactsources);

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
