<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\ForbiddenException;
use Cake\Event\Event;

use Cake\Routing\Router;
use Cake\Network\Email\Email;

/**
 * Users Controller
 *
 * @property App\Model\Table\UsersTable $Users
 *
 * user roles: 1 - normal
 * 				9 - CRM admin
 * 				10 - admin
 */
class UsersController extends AppController {
	
	public $components = ['RBruteForce.RBruteForce'];

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        // Allow users to access logout without logged in
	    $this->Auth->allow(['logout', 'forgotpass', 'resetpass']);
    }

	public function isAuthorized($user = null) {
		if ($this->request['action'] == 'add' || $this->request['action'] == 'index') {
			if ($user['role'] >= 9) {
				return true;
			}
			return false;
		}
        return true;
    }

	public function search(){
		$query = $this->Users->find()
				->select(['id', 'name'])
				->where(['name LIKE "'.$this->request->query('term').'%"']);
		foreach($query as $row){
			$result[] = array('value' => $row->id,
							  'label' => $row->name
							  );
		}
		//debug($result);die();
		$this->set(compact('result'));
		$this->set('_serialize', 'result');
	}
	
	public function login() {
		if (isset($this->request->data['passreminder'])) {
			$this->forgotpass();
		} elseif ($this->request->is('post')) {
			$user = $this->Auth->identify();
			if ($user) {
				$this->Auth->setUser($user);
				$this->removeResetToken();
				return $this->redirect($this->Auth->redirectUrl());
			}
			$this->RBruteForce->check(['maxAttempts' => 3, 'dataLog' => true]);		//should be here - so banned out user would not able to login with correct password
			$this->Flash->error(__('Invalid username or password, try again'));
		}
	}
	
	private function removeResetToken($user) {
		//remove reset token on sucessful login (the user find out the pass, and did not used the token)
		$id = $this->Auth->user('id');
		$user = $this->Users->get($id);
		$user->resettoken = '';
		$this->Users->save($user);
	}
	
	public function logout() {
		return $this->redirect($this->Auth->logout());
	}
	
	private function forgotpass(){
		if ($this->request->data['email'] != '') {
			$user = $this->Users->find()
				->where(['email' => $this->request->data['email']])
				->first();
			if(!empty($user)) {
				//create and save random token
				$token = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 32);
				$user = $this->Users->patchEntity($user, $this->request->data);
				$user->resettoken = $token;
				$this->Users->save($user);
				$token = $user->id . ',' . $token;
				
				$baseUrl = Router::url(['_full' => true]);
				$resetlink = Router::url(['_full' => true,
										   'controller' => 'Users',
										   'action' => 'resetpass',
										   $token
										   ]);
				
				$email = new Email('default');
				$email->from(['forgotpass@sanga.1108.cc' => __('Password reset request')])
					->to($user->email)
					->subject(__('Password reset'))
					->emailFormat('html')
					->template('resetpass')
					->viewVars(['resetlink' => $resetlink, 'baseUrl' => $baseUrl]);
				
				if($email->send()) {
					$this->Flash->success(__('We sent an email to you, describing how to set up a new password.'));
					$this->set('mailsent', true);
				} else {
					$this->Flash->error(__('Something went wrong with the password reminder email. Please try again later.'));
				}
			} else {
				$this->Flash->error(__('We do not have this email address in our database. Are you sure you are registered with this?'));
			}
		} else {
			$this->Flash->error(__('You should provide your registered email address'));
		}
	}
	
	public function resetpass($token){
		if(!empty($token)){
			$u = explode(',', $token);
			$user = $this->Users->find()
					->where(['id' => $u[0], 'resettoken' => $u[1]])
					->first();
			if(!empty($user)){
				$tempPass = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8);
				
				$user = $this->Users->patchEntity($user, $this->request->data);
				$user->password = $tempPass;
				$user->resettoken = '';
				$this->Users->save($user);
				$this->Flash->success(sprintf('Your temporary password is: %s Please log in.', $tempPass));
				$this->render('login');
			}
		}
	}

/**
 * Index method
 *
 * @return void
 */
	public function index() {
		$this->set('users', $this->paginate($this->Users));
	}

/**
 * View method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function view($id = null) {
		//$id = $id ? $id : $this->Auth->user('id');
		$id = $this->Auth->user('id');
		$user = $this->Users->get($id, [
			'contain' => ['Contacts', 'Events', 'Groups', 'Histories', 'Notifications']
		]);
		$this->set('user', $user);
	}

/**
 * Add method
 *
 * @return void
 */
	public function add() {
		$user = $this->Users->newEntity($this->request->data);
		if ($this->request->is('post')) {
			if ($this->Users->save($user)) {
				$this->Flash->success('The user has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The user could not be saved. Please, try again.');
			}
		}
		$contacts = $this->Users->Contacts->find('list');
		$groups = $this->Users->Groups->find('list');
		$usergroups = $this->Users->Usergroups->find('list');
		$this->set(compact('user', 'contacts', 'groups', 'usergroups'));
	}

/**
 * Edit method
 *
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function edit() {
		$user = $this->Users->get($this->Auth->user('id'), [
			'contain' => ['Contacts', 'Groups', 'Usergroups']
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$user = $this->Users->patchEntity($user, $this->request->data);
			$saved = $this->Users->save($user);
			if ($saved) {
				$json = ['save' => __('The contact has been saved.')];
			} else {
				$error = '';
				foreach($user->errors() as $field => $err) {
					$error .= $field . ': ';
					foreach($err as $e) {
						$error .= $e;
					}
				}
				$json = [
						 'save' => __('The contact could not be saved. Please, try again.'),
						 'error' => $error
						 ];
			}
		}
		$this->set(compact('json'));
		$this->set('_serialize', 'json');
	}
	
	public function dashboard(){
		$today = strtotime('now');
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
				->where([
						 'Contacts.birth >=' => $today,
						 'Contacts.birth >=' => $nextweek
						 ])
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

/**
 * Delete method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	/*public function delete($id = null) {
		$user = $this->Users->get($id);
		$this->request->allowMethod(['post', 'delete']);
		if ($this->Users->delete($user)) {
			$this->Flash->success('The user has been deleted.');
		} else {
			$this->Flash->error('The user could not be deleted. Please, try again.');
		}
		return $this->redirect(['action' => 'index']);
	}*/
}
