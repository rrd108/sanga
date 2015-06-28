<?php
namespace App\Test\TestCase\Controller;

use App\Controller\NotificationsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\NotificationsController Test Case
 */
class NotificationsControllerTest extends IntegrationTestCase
{

/**
 * Fixtures
 *
 * @var array
 */
    public $fixtures = [
        'app.notifications',
        'app.users',
        'app.events',
        'app.histories',
        'app.contacts',
        'app.zips',
        'app.countries',
        
        'app.contactsources',
        'app.groups',
        
        'app.contacts_groups',
        'app.groups_users',
        
        'app.skills',
        'app.contacts_skills',
        'app.contacts_users',
        'app.units',
        'app.usergroups',
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
