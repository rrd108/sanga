<?php

namespace App\Test\TestCase\Controller;

use App\Controller\ContactsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\ContactsController Test Case
 */
class ContactsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Contacts',
        'app.Zips',
        'app.Countries',
        'app.Contactsources',
        'app.Histories',
        'app.Users',
        'app.Events',
        'app.Notifications',
        'app.Settings',
        'app.ContactsUsers',
        'app.Groups',
        'app.ContactsGroups',
        'app.GroupsUsers',
        'app.Usergroups',
        'app.UsersUsergroups',
        'app.Units',
        'app.Documents',
        'app.Skills',
        'app.ContactsSkills'
    ];

    public function testAddUnauthenticatedFails()
    {
        $this->get('/contacts/add');
        $this->assertRedirect(['controller' => 'Users', 'action' => 'login']);
    }

    private function authenticate()
    {
        $this->session([
            'Auth' => [
                'User' => [
                    'id' => 1,
                    'name' => 'admin',
                ]
            ]
        ]);
    }

    /**
     * Test isAuthorized method
     *
     * @return void
     */
    /*public function testIsAuthorized()
    {
        $this->assertResponseOk();
    }*/

    /**
     * Test showmap method
     *
     * @return void
     */
    public function testShowmap()
    {
        $this->authenticate();
        $this->get('contacts/showmap');
        $this->assertResponseOk();
    }

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->authenticate();
        $this->get('contacts');
        $this->assertResponseOk();
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->authenticate();
        $this->get('contacts/view/1');
        $this->assertResponseOk();
    }
}
