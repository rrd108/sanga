<?php
namespace App\Test\TestCase\Controller;

use App\Controller\UsergroupsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\UsergroupsController Test Case
 */
class UsergroupsControllerTest extends IntegrationTestCase
{

/**
 * Fixtures
 *
 * @var array
 */
    public $fixtures = [
        'app.usergroups',
        'app.users',
        'app.events',
        'app.histories',
        'app.contacts',
        'app.zips',
        'app.countries',
        
        'app.contactsources',
        'app.groups',
        'app.groups_users',
        
        'app.contacts_groups',
        'app.skills',
        'app.contacts_skills',
        'app.contacts_users',
        'app.units',
        'app.notifications',
        'app.users_usergroups',
        'app.users_usergroups'
    ];

/**
 * Test index method
 *
 * @return void
 */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

/**
 * Test view method
 *
 * @return void
 */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

/**
 * Test add method
 *
 * @return void
 */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

/**
 * Test edit method
 *
 * @return void
 */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

/**
 * Test delete method
 *
 * @return void
 */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
