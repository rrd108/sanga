<?php

namespace App\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use App\Model\Table\GroupsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\GroupsTable Test Case
 */
class GroupsTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Groups',
        'app.GroupsUsers',
        'app.Users',
        'app.Events',
        'app.Histories',
        'app.Contacts',
        'app.Zips',
        'app.Countries',
        'app.Contactsources',
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
        $config = TableRegistry::exists('Groups') ? [] : ['className' => 'App\Model\Table\GroupsTable'];
        $this->Groups = TableRegistry::get('Groups', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Groups);

        parent::tearDown();
    }

    public function testFindAccessible()
    {
        $actual = $this->Groups->find('accessible', ['User.id' => 3, 'shared' => true])
            ->hydrate(false)
            ->extract('id')
            ->toArray();
        $expected = [2, 1];
        $this->assertEquals($expected, $actual);

        $actual = $this->Groups->find('accessible', ['User.id' => 2])
            ->hydrate(false)
            ->extract('id')
            ->toArray();
        $expected = [2, 1, 3];
        $this->assertEquals($expected, $actual);
    }

    public function testIsAdmin()
    {
        $actual = $this->Groups->isAdmin(2, 3);
        $this->assertTrue($actual);

        $actual = $this->Groups->isAdmin(1, 3);
        $this->assertFalse($actual);
    }

    public function testIsWritable()
    {
        $actual = $this->Groups->isWritable(2, 1);
        $this->assertTrue($actual);

        $actual = $this->Groups->isWritable(3, 1);
        $this->assertFalse($actual);

        $actual = $this->Groups->isWritable(2, 2);
        $this->assertTrue($actual);

        $actual = $this->Groups->isWritable(2, null);
        $this->assertFalse($actual);
    }

    public function testIsReadable()
    {
        $actual = $this->Groups->isReadable(2, 1);
        $this->assertTrue($actual);

        $actual = $this->Groups->isReadable(3, 3);
        $this->assertFalse($actual);

        $actual = $this->Groups->isReadable(3, 1);
        $this->assertTrue($actual);
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
