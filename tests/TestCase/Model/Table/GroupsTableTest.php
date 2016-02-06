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
        'app.groups',
        'app.groups_users',
        'app.users',
        'app.events',
        'app.histories',
        'app.contacts',
        'app.zips',
        'app.countries',
        'app.contactsources',
        'app.contacts_groups',
        'app.contacts_users',
        'app.skills',
        'app.contacts_skills',
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
        $actual = $this->Groups->isAdmin(2,3);
        $this->assertTrue($actual);

        $actual = $this->Groups->isAdmin(1,3);
        $this->assertFalse($actual);
    }

    public function testIsWritable()
    {
        $actual = $this->Groups->isWritable(2,1);
        $this->assertTrue($actual);

        $actual = $this->Groups->isWritable(3,1);
        $this->assertFalse($actual);

        $actual = $this->Groups->isWritable(2,2);
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
