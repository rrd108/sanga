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
		
	print $this->Html->css('superfish.css');	//dropdown menu
	
	print $this->Html->css('jquery-ui.min.css');
	print $this->Html->css('jquery-ui.structure.min.css');
	print $this->Html->css('jquery-ui.theme.min.css');
	
	print $this->Html->css('sanga.css');
	
	print $this->Html->script('jquery.js');
	
	//dropdown menu
	print $this->Html->script('superfish.js');
	print $this->Html->script('hoverIntent.js');
		
	print $this->Html->script('jquery-ui.min.js');
	print $this->Html->script('jquery.ui.autocomplete.html.js');
	print $this->Html->script('ui.datepicker-hu.js');
	
	print $this->Html->script('gmap3.min.js');
	print $this->Html->script('http://maps.google.com/maps/api/js?sensor=false&amp;language=hu');
	
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
							print '<li>' . $this->Html->link('❶ ' . __('Zips'), '/zips') . '</li>';
							print '<li>' . $this->Html->link('☢ ' . __('Countries'), '/countries') . '</li>';
							print '<li>' . $this->Html->link('❖ ' . __('Units'), '/units') . '</li>';
							print '<li>' . $this->Html->link('☻ ' . __('Users'), ['prefix' => 'admin', 'controller' => 'Users', 'action' => 'index']) . '</li>';
						?>
					</ul>
				</li>
				<li>
					⚙ Törzsadatok
					<ul>
						<?php
							print '<li>' . $this->Html->link('⚓ Kapcsolat források', '/contactsources') . '</li>';
							print '<li>' . $this->Html->link('⁂ ' . __('Groups'), '/groups') . '</li>';
							print '<li>' . $this->Html->link('♼ Kapcsolódási pontok', '/linkups') . '</li>';
							print '<li>' . $this->Html->link('✿ Esemény típusok', '/events') . '</li>';
							print '<li>' . $this->Html->link('✋ ' . __('User groups'), '/usergroups') . '</li>';
						?>
					</ul>
				</li>
				<li>
					★ Adataim
					<?php
						$nc = '';
						if($notification_count)
							print $nc = '<span class="notice">'.$notification_count.'</span>';
					?>
					<ul>
						<?php
							print '<li>' . $this->Html->link('☭ Adatlapom', '/users/view') . '</li>';
							print '<li>' . $this->Html->link('⚠ Értesítések '.$nc, '/notifications', ['escapeTitle' => false]) . '</li>';
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
							print '<li>' . $this->Html->link('♛ Lekérdezések', '/contacts/search') . '</li>';
							print '<li>' . $this->Html->link('✈ Térkép', '/contacts/showmap') . '</li>';
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
				//debug($this->Notifications);
			?>
		</footer>
	</div>
</body>
</html>
