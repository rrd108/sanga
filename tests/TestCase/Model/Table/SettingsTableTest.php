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
        'Settings' => 'app.settings',
        'Users' => 'app.users',
        'Events' => 'app.events',
        'Histories' => 'app.histories',
        'Contacts' => 'app.contacts',
        'Zips' => 'app.zips',
        'Countries' => 'app.countries',
        'WorkplaceZips' => 'app.zips',
        'Contactsources' => 'app.contactsources',
        'Groups' => 'app.groups',
        'AdminUsers' => 'app.users',
        'AdminGroups' => 'app.groups',
        'ContactsGroups' => 'app.contacts_groups',
        'groups_users' => 'app.groups_users',
        'Notifications' => 'app.notifications',
        'ContactsUsers' => 'app.contacts_users',
        'Usergroups' => 'app.usergroups',
        'UsersUsergroups' => 'app.users_usergroups',
        'Skills' => 'app.skills',
        'ContactsSkills' => 'app.contacts_skills',
        'Units' => 'app.units'
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
}
