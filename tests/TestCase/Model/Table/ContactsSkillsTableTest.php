<?php

namespace App\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use App\Model\Table\ContactsSkillsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ContactsSkillsTable Test Case
 */
class ContactsSkillsTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ContactsSkills',
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
        'app.ContactsUsers',



        'app.Usergroups',
        'app.UsersUsergroups',
        'app.Units',
        'app.Skills'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ContactsSkills') ? [] : ['className' => 'App\Model\Table\ContactsSkillsTable'];
        $this->ContactsSkills = TableRegistry::get('ContactsSkills', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ContactsSkills);

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
