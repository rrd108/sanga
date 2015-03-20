<?= $this->Html->charset() ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sanga :: 
	<?= $this->fetch('title') ?>
</title>
<?php
echo $this->Html->meta('icon');

echo $this->Html->css('default.css');
echo $this->Html->css('main.css');

echo $this->Html->css('jquery-ui.min.css');
echo $this->Html->css('jquery-ui.structure.min.css');
echo $this->Html->css('jquery-ui.theme.min.css');

echo $this->Html->css('sanga.css');

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