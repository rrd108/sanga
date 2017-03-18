<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\ForbiddenException;
use Cake\Event\Event;

use Cake\Routing\Router;
use Cake\Network\Email\Email;

use Cake\I18n\I18n;

/**
 * Users Controller
 *
 * @property App\Model\Table\UsersTable $Users
 *
 * user roles: 1 - normal
 *                 9 - CRM admin
 *                 10 - admin
 */
class UsersController extends AppController
{

    public $components = ['RBruteForce.RBruteForce'];

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // Allow users to access logout without logged in
        $this->Auth->allow(['logout', 'forgotpass', 'resetpass']);
    }

    public function isAuthorized($user = null)
    {
        return true;
    }

    public function index()
    {
        $this->set(
            'users',
            $this->paginate(
                $this->Users->find()
                    ->contain('Contacts')
                    ->order(['Users.name'])
            )
        );
    }

    /**
     * View method
     *
     * @param  string $id
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException
     */
    public function view()
    {
        $id = $this->Auth->user('id');
        $user = $this->Users->get(
            $id,
            [
                'contain' => ['Events', 'Groups', 'Usergroups']
            ]
        );
        $this->set('user', $user);
    }

    /**
     * Edit method
     *
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException
     */
    public function edit()
    {
        $user = $this->Users->get(
            $this->Auth->user('id'),
            [
                'contain' => ['Contacts', 'Groups', 'Usergroups']
            ]
        );
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            $saved = $this->Users->save($user);

            I18n::locale(h($user->locale));
            $this->Cookie->write('User.locale', h($user->locale));

            if ($saved) {
                $json = ['save' => __('The user has been saved.')];
            } else {
                $error = '';
                foreach ($user->errors() as $field => $err) {
                    $error .= $field . ': ';
                    foreach ($err as $e) {
                        $error .= $e;
                    }
                }
                $json = [
                    'save' => __('The user could not be saved. Please, try again.'),
                    'error' => $error
                ];
            }
        }
        $this->set(compact('json'));
        $this->set('_serialize', 'json');
    }

    public function search()
    {
        $query = $this->Users->find()
            ->select(['id', 'name'])
            ->where(['name LIKE "'.$this->request->getQuery('term').'%"']);
        foreach ($query as $row) {
            $result[] = ['value' => $row->id,
                              'label' => $row->name
                              ];
        }
        //debug($result);die();
        $this->set(compact('result'));
        $this->set('_serialize', 'result');
    }

    public function login()
    {
        if ($this->request->getData('passreminder')) {
            $this->forgotpass();
        } elseif ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                $this->removeResetToken($user);

                I18n::locale(h($user['locale']));
                $this->Cookie->write('User.locale', h($user['locale']));

                $user = $this->Users->get($this->Auth->user('id'));
                $user['last_login'] = date('Y-m-d H:i:s');
                $this->Users->save($user);

                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->RBruteForce->check(['maxAttempts' => 3, 'dataLog' => true]);        //should be here - so banned out user would not able to login with correct password
            $this->Flash->error(__('Invalid username or password, try again'));
        }
    }

    private function removeResetToken($user)
    {
        //remove reset token on sucessful login (the user find out the pass, and did not used the token)
        $id = $this->Auth->user('id');
        $user = $this->Users->get($id);
        $user->resettoken = '';
        $this->Users->save($user);
    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

    private function forgotpass()
    {
        if ($this->request->getData('email') != '') {
            $user = $this->Users->find()
                ->where(['email' => $this->request->getData('email')])
                ->first();
            if (!empty($user)) {
                //create and save random token
                $token = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 32);
                $user = $this->Users->patchEntity($user, $this->request->getData());
                $user->resettoken = $token;
                if ($this->Users->save($user)) {
                    $token = $user->id . ',' . $token;
                    $baseUrl = Router::url(['_full' => true]);
                    $resetlink = Router::url(
                        [
                            '_full' => true,
                            'controller' => 'Users',
                            'action' => 'resetpass',
                            $token
                        ]
                    );

                    $email = new Email('default');
                    $email->setFrom(['forgotpass@sanga.1108.cc' => __('Password reset request')])
                        ->setTo($user->email)
                        ->setSubject(__('Password reset'))
                        ->setEmailFormat('html')
                        ->setTemplate('resetpass')
                        ->setViewVars(['resetlink' => $resetlink, 'baseUrl' => $baseUrl]);

                    if ($email->send()) {
                        $this->Flash->success(__('We sent an email to you, describing how to set up a new password.'));
                        $this->set('mailsent', true);
                    } else {
                        $this->Flash->error(__('Something went wrong with the password reminder email. Please try again later.'));
                    }
                } else {
                    $this->Flash->error(__('Token creation error. Please try again later.'));
                }
            } else {
                $this->Flash->error(__('We do not have this email address in our database. Are you sure you are registered with this?'));
            }
        } else {
            $this->Flash->error(__('You should provide your registered email address'));
        }
    }

    public function resetpass($token)
    {
        if (!empty($token)) {
            $u = explode(',', $token);
            $user = $this->Users->find()
                ->where(['id' => $u[0], 'resettoken' => $u[1]])
                ->first();
            if (!empty($user)) {
                $tempPass = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8);

                $user = $this->Users->patchEntity($user, $this->request->getData());
                $user->password = $tempPass;
                $user->resettoken = '';
                $this->Users->save($user);
                $this->Flash->success(__('Your temporary password is: {0} Please log in.', [$tempPass]));
                $this->render('login');
            }
        }
        $this->Flash->error(__('It seems you are trying to access an invalid token.'));
    }

    public function dashboard()
    {
        $lastweek = strtotime('-7 days', strtotime('now'));
        $nextweek = strtotime('+7 days', strtotime('now'));

        $dash['contacts']['total'] = $this->Users->Contacts
            ->find()->count();

        $dash['contacts']['newtotal'] = $this->Users->Contacts
            ->find()
            ->where(['Contacts.created >=' => $lastweek])
            ->count();

        $dash['histories']['total'] = $this->Users->Histories
            ->find()->count();

        $dash['contacts']['own'] = $this->Users->Contacts
            ->find('ownedBy', ['User.id' => $this->Auth->user('id')])->count();

        $dash['contacts']['birthdayown'] = $this->Users->Contacts
            ->find('ownedBy', ['User.id' => $this->Auth->user('id')])
            ->where(
                [
                    'CONCAT(MONTH(Contacts.birth),"-",DAY(Contacts.birth)) >=' => date('n-j'),
                    'CONCAT(MONTH(Contacts.birth),"-",DAY(Contacts.birth)) <=' => date('n-j', $nextweek)
                ]
            )
            ->count();

        $dash['contacts']['newown'] = $this->Users->Contacts
            ->find('ownedBy', ['User.id' => $this->Auth->user('id')])
            ->where(['Contacts.created >=' => $lastweek])
            ->count();

        $dash['histories']['own'] = $this->Users->Histories
            ->find('ownedBy', ['User.id' => $this->Auth->user('id')])
            ->count();

        $dash['histories']['week'] = $this->Users->Histories
            ->find('ownedBy', ['User.id' => $this->Auth->user('id')])
            ->where(['Histories.date >= ' => date('Y-m-d', $lastweek)])
            ->count();

        $dash['histories']['last2weeks'] = $this->Users->Histories
            ->find('ownedBy', ['User.id' => $this->Auth->user('id')])
            ->where(['Histories.date >= ' => date('Y-m-d', strtotime('-14 days', strtotime('now')))])
            ->count();

        $this->set(compact('dash'));
    }
}
