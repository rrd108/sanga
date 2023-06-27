<?php

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SettingsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SettingsTable Test Case
 */
class SettingsTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'Settings' => 'app.Settings',
        'Users' => 'app.Users',
        'Events' => 'app.Events',
        'Histories' => 'app.Histories',
        'Contacts' => 'app.Contacts',
        'Zips' => 'app.Zips',
        'Countries' => 'app.Countries',
        'WorkplaceZips' => 'app.Zips',
        'Contactsources' => 'app.Contactsources',
        'Groups' => 'app.Groups',
        'AdminUsers' => 'app.Users',
        'AdminGroups' => 'app.Groups',
        'ContactsGroups' => 'app.ContactsGroups',
        'groups_users' => 'app.GroupsUsers',
        'Notifications' => 'app.Notifications',
        'ContactsUsers' => 'app.ContactsUsers',
        'Usergroups' => 'app.Usergroups',
        'UsersUsergroups' => 'app.UsersUsergroups',
        'Skills' => 'app.Skills',
        'ContactsSkills' => 'app.ContactsSkills',
        'Units' => 'app.Units'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Settings') ? [] : ['className' => 'App\Model\Table\SettingsTable'];
        $this->Settings = TableRegistry::get('Settings', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Settings);

        parent::tearDown();
    }

    public function testGetSavedQueries()
    {
        $expected = [];
        $actual = $this->Settings->getSavedQueries(10)->toArray();
        $this->assertEquals($expected, $actual);

        $expected = [1, 2];
        $actual = $this->Settings->getSavedQueries(1)->extract('id')->toArray();
        $this->assertEquals($expected, $actual);
    }

    public function testGetDefaultGroups()
    {
        //$expected = null;  //if there is no such row in the database we get null
        $expected = [6, 7];
        $actual = $this->Settings->getDefaultGroups();
        $this->assertEquals($expected, $actual);
    }

    public function testGetDefaultContactFields()
    {
        $expected = [];
        $actual = $this->Settings->getDefaultContactFields(10);
        $this->assertEquals($expected, $actual);

        $expected = [
            'Contacts.contactname', 'Contacts.legalname', 'Contacts.zip_id',
            'Contacts.phone', 'Contacts.email', 'Contacts.users'
        ];
        $actual = $this->Settings->getDefaultContactFields(2);
        $this->assertEquals($expected, $actual);
    }
}
