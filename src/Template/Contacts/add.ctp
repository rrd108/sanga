<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('List Contacts'), ['action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('List Countries'), ['controller' => 'Countries', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Country'), ['controller' => 'Countries', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Zips'), ['controller' => 'Zips', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Zip'), ['controller' => 'Zips', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Contactsources'), ['controller' => 'Contactsources', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Contactsource'), ['controller' => 'Contactsources', 'action' => 'add']) ?> </li>
	</ul>
</div>
<div class="contacts form large-10 medium-9 columns">
<?= $this->Form->create($contact) ?>
	<fieldset>
		<legend><?= __('Add Contact'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('contactname');
		echo $this->Form->input('country_id', ['options' => $countries]);
		echo $this->Form->input('zip_id', ['options' => $zips]);
		echo $this->Form->input('address');
		echo $this->Form->input('phone');
		echo $this->Form->input('email');
		echo $this->Form->input('birth');
		echo $this->Form->input('active');
		echo $this->Form->input('comment');
	?>
	</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
</div>
