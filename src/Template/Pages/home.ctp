<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;

$this->layout = false;

if (!Configure::read('debug')):
    throw new NotFoundException();
endif;

$cakeDescription = 'Sanga';
?>
<!DOCTYPE html>
<html>
<head>
    <?php echo $this->element('head'); ?>
</head>
<body>
    <header>
        <?php echo $this->element('menu'); ?>
    </header>
    <main id="container" class="primary-content">
        <div class="sidebar-wrapper">
            <nav class="side-nav">
                <ul>
                    <li><?= $this->Html->link(__('List Contacts'), ['controller' => 'Contacts', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link(__('New Contact'), ['controller' => 'Contacts', 'action' => 'add']) ?></li>
                    <li><?= $this->Html->link(__('List Histories'), ['controller' => 'Histories', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link(__('New History'), ['controller' => 'Histories', 'action' => 'add']) ?></li>
                </ul>
            </nav>
        </div>

        <div class="content-wrapper">
            <div class="row"><div class="large-10 medium-9 columns">
                <h1>Bemutató viedók</h1>
                <ul>
                    <li><?= $this->Html->link('Új kapcsolat felvitele', $this->Html->webroot . '/files/uj_contact_felvitele.ogv') ?> (12 MB)</li>
                </ul>
                
            </div></div>
            <div class="row"><div class="large-10 medium-9 columns">
                <h1>Gyakori kérdések</h1>
                <dl>
                    <dt>Hogyan tudom módosítani a kapcsolat adatait?</dt>
                        <dd>
                            Ha az egérrel rámutatsz az adatra (pl a kapcsolat nevére) akkor jobb oldalon megjelenik egy kis ceruza ikon.
                            Erre kattintva az adat szerkeszthetővé válik. Ha átírtad akkor a beviteli mező mellett megjelenik egy kis pipa, a mentéshez erre kell rákattintani.
                        </dd>
                </dl>
                
                <p>Ha bármi kérdésed van írj egy értesítést <?= $this->Html->link('rrd', ['controller' => 'Notifications', 'action' => 'add', 2]) ?>-nek!</p>
            </div></div>
        </div>
    </main>
    <footer></footer>
</body>
</html>
