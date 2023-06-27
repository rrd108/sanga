<?php

namespace App\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use App\Model\Table\UsersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UsersTable Test Case
 */
class UsersTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Users',
        'app.Events',
        'app.Histories',
        'app.Contacts',
        'app.Zips',
        'app.Countries',
        'app.Contactsources',
        'app.Groups',
        'app.ContactsGroups',
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
        $config = TableRegistry::exists('Users') ? [] : ['className' => 'App\Model\Table\UsersTable'];
        $this->Users = TableRegistry::get('Users', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Users);
        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        //$this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        //$this->markTestIncomplete('Not implemented yet.');
    }

    public function testCheckPasswordStrength()
    {
        $this->assertEquals(false, $this->Users->checkPasswordStrength('abc', null));
        $this->assertEquals(false, $this->Users->checkPasswordStrength('abcA', null));

        $this->assertEquals(true, $this->Users->checkPasswordStrength('abcA!', null));
        $this->assertEquals(true, $this->Users->checkPasswordStrength('abcA!1', null));
    }

    public function testIsAdminUser()
    {
        $actual = $this->Users->isAdminUser(1);
        $this->assertTrue($actual);

        $actual = $this->Users->isAdminUser(4);
        $this->assertTrue($actual);

        $actual = $this->Users->isAdminUser(2);
        $this->assertFalse($actual);
    }

    public function testGetUnderAdminOf()
    {
        $actual = $this->Users->getUnderAdminOf(1)->extract('id')->toArray();
        $expected = [3, 2, 2];
        $this->assertEquals($expected, $actual);

        $actual = $this->Users->getUnderAdminOf(2)->extract('id')->toArray();
        $expected = [];
        $this->assertEquals($expected, $actual);
    }
}
