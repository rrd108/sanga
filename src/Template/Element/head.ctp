<?= $this->Html->charset() ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sanga ::
    <?= $this->fetch('title') ?>
</title>

<?= $this->Html->meta('icon') ?>

<?= $this->Html->css(
    [
        //'default',
        //'main',
        'https://fonts.googleapis.com/css?family=Quicksand',
        'animate',  //for noty
        'foundation.min',
        'foundation-icons',
        'sanga.min'
    ]
) ?>
<?php
echo $this->Html->script('jquery.js');    //this should be the very first js file
echo $this->Html->script('jquery-ui.min.js');

//dropdown menu
echo $this->Html->script('superfish.js');
echo $this->Html->script('hoverIntent.js');

echo $this->Html->script('jquery.ui.autocomplete.html.js');
echo $this->Html->script('ui.datepicker-hu.js');
echo $this->Html->script('jquery.rStorage.min.js');

echo $this->Html->script('jquery.noty.packaged.min.js');
echo $this->Html->script('foundation.min');

echo $this->Html->script('sanga.js');

echo $this->fetch('meta');
echo $this->fetch('css');
echo $this->fetch('script');
?>