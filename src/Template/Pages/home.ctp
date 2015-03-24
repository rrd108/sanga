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
					<li><?= $this->Html->link(__('List Contacts'), ['controller' => 'Contacts', 'action' => 'index']) ?> </li>
					<li><?= $this->Html->link(__('New Contact'), ['controller' => 'Contacts', 'action' => 'add']) ?> </li>
					<li><?= $this->Html->link(__('List Histories'), ['controller' => 'Histories', 'action' => 'index']) ?> </li>
					<li><?= $this->Html->link(__('New History'), ['controller' => 'Histories', 'action' => 'add']) ?> </li>
				</ul>
			</nav>
		</div>

		<div class="content-wrapper">
			<div class="row"><div class="large-10 medium-9 columns">
				<h1>Ha gond van</h1>
				<dl>
					<dt>Admin</dt>
						<dd>Radharadhya dasa
							<ul>
								<li>rrd@krisna.hu</li>
								<li>+36 30 505 12 66</li>
							</ul>
						</dd>
					<dt>CRM Admin</dt>
						<dd>Vaidarbhi dd
							<ul>
								<li>vbdd@krisna.hu</li>
								<li>+36 20 415 7311</li>
							</ul>
						</dd>
				</dl>
			</div></div>
		</div>
	</main>
	<footer></footer>
</body>
</html>
