<?php

namespace App\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use App\Model\Table\UsergroupsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UsergroupsTable Test Case
 */
class UsergroupsTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Usergroups',
        'app.Users',
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
        $config = TableRegistry::exists('Usergroups') ? [] : ['className' => 'App\Model\Table\UsergroupsTable'];
        $this->Usergroups = TableRegistry::get('Usergroups', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Usergroups);

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

    public function testFindOwnedBy()
    {
        $actual = $this->Usergroups->find('ownedBy', ['User.id' => 1])
            ->hydrate(false)
            ->extract('id')
            ->toArray();
        $expected = [1, 2];
        $this->assertEquals($expected, $actual);
    }

    public function testJoin()
    {
        $actual = $this->Usergroups->join(1, 2);
        $this->AssertTrue($actual->users[0]->_joinData->joined);

        $this->AssertNull($this->Usergroups->join(1, 4));
    }

    public function testFindMemberships()
    {
        $actual = $this->Usergroups->find('memberships', ['User.id' => 3])
            ->hydrate(false)
            ->extract('id')
            ->toArray();
        $expected = [1];
        $this->AssertEquals($expected, $actual);

        $actual = $this->Usergroups->find('memberships', ['User.id' => 2])
            ->hydrate(false)
            ->extract('id')
            ->toArray();
        $expected = [1, 2];
        $this->AssertEquals($expected, $actual);
    }
}
