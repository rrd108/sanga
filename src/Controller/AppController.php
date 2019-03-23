<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
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
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    public $components = [
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

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
            'viewClassMap' => [
                'csv' => 'CsvView.Csv'
            ]
        ]);
        $this->loadComponent('Flash');

        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
    }

    public function beforeFilter(Event $event)
    {
        $this->Auth->setConfig('authorize', ['Controller']);
        $this->Auth->deny();

        //get locale cookie
        $locale = $this->Cookie->read('User.locale');
        if ($locale) {
            I18n::setLocale(h($locale));
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
