<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Groups Controller
 *
 * @property App\Model\Table\GroupsTable $Groups
 */
class GroupsController extends AppController
{

    public function isAuthorized($user = null)
    {
        if ($this->request['action'] == 'add' || $this->request['action'] == 'index') {
            if ($user['role'] >= 9) {
                return true;
            }
            return false;
        }
        return true;
    }

    /**
 * Index method
 *
 * @return void
 */
    public function index()
    {
        $groups = $this->Groups->find()
            ->contain(['Contacts', 'AdminUsers']);
        $this->set('groups', $this->paginate($groups));
    }
}
