<!DOCTYPE html>
<html>
<head>
	<?= $this->Html->charset() ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sanga :: 
		<?= $this->fetch('title') ?>
	</title>
	<?php
	echo $this->Html->meta('icon');

	// echo $this->Html->css('base.css');
	// echo $this->Html->css('cake.css');
	echo $this->Html->css('default.css');
	echo $this->Html->css('main.css');
		
	// echo $this->Html->css('superfish.css');	//dropdown menu
	
	echo $this->Html->css('jquery-ui.min.css');
	echo $this->Html->css('jquery-ui.structure.min.css');
	echo $this->Html->css('jquery-ui.theme.min.css');
	
	// echo $this->Html->css('animate.css');
	// echo $this->Html->css('sanga.css');
	
	echo $this->Html->script('jquery.js');	//this should be the very first js file
	
	//dropdown menu
	echo $this->Html->script('superfish.js');
	echo $this->Html->script('hoverIntent.js');
		
	echo $this->Html->script('jquery-ui.min.js');
	echo $this->Html->script('jquery.ui.autocomplete.html.js');
	echo $this->Html->script('ui.datepicker-hu.js');
	echo $this->Html->script('jquery.rStorage.min.js');
	
	echo $this->Html->script('jquery.noty.packaged.min.js');
	
	echo $this->Html->script('sanga.js');

	echo $this->fetch('meta');
	echo $this->fetch('css');
	echo $this->fetch('script');
	?>
</head>
<body>
	<header>
		<?php echo $this->element('menu'); ?>
	</header>
	<main id="container" class="primary-content">
		<?= $this->Flash->render() ?>
		<div class="row">
			<?= $this->fetch('content') ?>
		</div>
	</main>
	<footer>
		<?php
			//debug($this->Notifications);
		?>
	</footer>
</body>
</html>
