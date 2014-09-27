<!DOCTYPE html>
<html>
<head>
	<?= $this->Html->charset() ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sanga :: 
		<?= $this->fetch('title') ?>
	</title>
	<?= $this->Html->meta('icon') ?>

	<?= $this->Html->css('base.css') ?>
	<?= $this->Html->css('cake.css') ?>
	<?= $this->Html->css('sanga.css') ?>

	<?= $this->fetch('meta') ?>
	<?= $this->fetch('css') ?>
	<?= $this->fetch('script') ?>
</head>
<body>
	<header>
		<?php echo $this->Html->image('logo-small.png',
									  ['alt' => 'Sanga logo',
									   'url' => '/']); ?>
		<div class="header-title">
			<span>Sanga :: <?= $this->fetch('title') ?></span>
		</div>
		<div class="header-help">	
				<?php
					print '<span>' . $this->Html->link('Irányítószámok', '/zips') . '</span>';
					print '<span>' . $this->Html->link('Országok', '/countries') . '</span>';
					print '<span>' . $this->Html->link('Csoport típusok', '/grouptypes') . '</span>';
					print '<span>' . $this->Html->link('Kapcsolódási pontok', '/linkups') . '</span>';
					print '<span>' . $this->Html->link('Esemény csoportok', '/eventgroups') . '</span>';
					print '<span>' . $this->Html->link('Esemény típusok', '/events') . '</span>';
					print '<span>' . $this->Html->link('Kapcsolatok', '/contacts') . '</span>';
					print '<span>' . $this->Html->link('Történések', '/histories') . '</span>';
					print '<span>' . $this->Html->link('Users', ['prefix' => 'admin', 'controller' => 'Users', 'action' => 'index']) . '</span>';
					print '<span>' . $this->Html->link('Adatlapom', '/users/view') . '</span>';
					print '<span>' . $this->Html->link('Kijelentkezem', '/users/logout') . '</span>';
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
		</footer>
	</div>
</body>
</html>
