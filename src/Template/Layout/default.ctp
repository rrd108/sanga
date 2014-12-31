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
	
	print $this->Html->css('animate.css');
	print $this->Html->css('sanga.css');
	
	print $this->Html->script('jquery.js');
	
	//dropdown menu
	print $this->Html->script('superfish.js');
	print $this->Html->script('hoverIntent.js');
		
	print $this->Html->script('jquery-ui.min.js');
	print $this->Html->script('jquery.ui.autocomplete.html.js');
	print $this->Html->script('ui.datepicker-hu.js');
	print $this->Html->script('jquery.rStorage.min.js');
	
	print $this->Html->script('jquery.noty.packaged.min.js');
	
	print $this->Html->script('sanga.js');

	print $this->fetch('meta');
	print $this->fetch('css');
	print $this->fetch('script');
	?>
</head>
<body>
	<header>
		<?php echo $this->element('menu'); ?>
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
