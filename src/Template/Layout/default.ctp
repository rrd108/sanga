<!DOCTYPE html>
<html>
<head>
	<?= $this->Html->charset() ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sanga :: 
		<?= $this->fetch('title') ?>
	</title>
	<?php
	print $this->Html->meta('icon');

	print $this->Html->css('base.css');
	print $this->Html->css('cake.css');
	
	print $this->Html->css('superfish.css');
	
	print $this->Html->css('sanga.css');
	
	print $this->Html->script('jquery-2.1.1.min.js');
	print $this->Html->script('superfish.js');
	print $this->Html->script('hoverIntent.js');
	
	print $this->Html->script('sanga.js');

	print $this->fetch('meta');
	print $this->fetch('css');
	print $this->fetch('script');
	?>
</head>
<body>
	<header>
		<?php echo $this->Html->image('logo-small.png',
									  ['alt' => 'Sanga logo',
									   'url' => '/']); ?>
		<div class="header-title">
			<span>&nbsp;<?php echo $this->Html->getCrumbs(' / ', ''); ?></span>
		</div>
		<div class="header-help">
			<?php
			if($this->Session->read('Auth.User.id')):
			?>
			<ul class="sf-menu">
				<li>
					☠ Admin
					<ul>
						<?php
							print '<li>' . $this->Html->link('❶ Irányítószámok', '/zips') . '</li>';
							print '<li>' . $this->Html->link('☢ Országok', '/countries') . '</li>';
							print '<li>' . $this->Html->link('☻ Felhasználók', ['prefix' => 'admin', 'controller' => 'Users', 'action' => 'index']) . '</li>';
						?>
					</ul>
				</li>
				<li>
					⚙ Törzsadatok
					<ul>
						<?php
							print '<li>' . $this->Html->link('⚓ Kapcsolat források', '/contactsources') . '</li>';
							print '<li>' . $this->Html->link('✪ Csoport típusok', '/grouptypes') . '</li>';
							print '<li>' . $this->Html->link('⁂ Csoportok', '/groups') . '</li>';
							print '<li>' . $this->Html->link('♼ Kapcsolódási pontok', '/linkups') . '</li>';
							print '<li>' . $this->Html->link('♣ Esemény csoportok', '/eventgroups') . '</li>';
							print '<li>' . $this->Html->link('✿ Esemény típusok', '/events') . '</li>';
						?>
					</ul>
				</li>
				<li>
					★ Adataim
					<ul>
						<?php
							print '<li>' . $this->Html->link('☭ Adatlapom', '/users/view') . '</li>';
							print '<li>' . $this->Html->link('⚠ Értesítések', '/notifiations') . '</li>';
							print '<li>' . $this->Html->link('⊗ Kijelentkezem', '/users/logout') . '</li>';
						?>
					</ul>
				</li>
				<li>
					✽ CRM
					<ul>
						<?php
							print '<li>' . $this->Html->link('♥ Kapcsolatok', '/contacts') . '</li>';
							print '<li>' . $this->Html->link('⚑ Történések', '/histories') . '</li>';
						?>
					</ul>
				</li>
			</ul>
			<?php
			endif;
			?>
		</div>
	</header>
	<div id="container">
		
		<div id="content">
			<?= $this->Flash->render() ?>

			<div class="row">
				<?= $this->fetch('content') ?>
			</div>
		</div>
		<footer>
			<?php
				//debug($this->request->params['controller']);
			?>
		</footer>
	</div>
</body>
</html>
