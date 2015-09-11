<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

use Cake\I18n\I18n;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
 * Components this controller uses.
 *
 * Component names should not include the `Component` suffix. Components
 * declared in subclasses will be merged with components declared here.
 *
 * @var array
 */
    public $components = [
        'Flash',
        'RequestHandler',
        'Cookie',
        'Auth' => [
            'authenticate' => [
                'Form' => [
                    'fields' => [
                        'username' => 'email'
                        ]
                    ]
                ],
            'logoutRedirect' => '/'
        ]
    ];

    public function beforeFilter(Event $event)
    {
        $this->Auth->config('authorize', ['Controller']);
        $this->Auth->deny();

        //get locale cookie
        $locale = $this->Cookie->read('User.locale');
        if ($locale) {
            I18n::locale(h($locale));
        }
    }

    public function getErrors($errors)
    {
        $errorsString = '';
        foreach ($errors as $field => $errs) {
            foreach ($errs as $rule => $error) {
                $errorsString .= $field . ': ' . $error . ' ';
            }
        }
        return $errorsString;
    }
}
