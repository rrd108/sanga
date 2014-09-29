<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('List Groups'), ['action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('List Grouptypes'), ['controller' => 'Grouptypes', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Grouptype'), ['controller' => 'Grouptypes', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Histories'), ['controller' => 'Histories', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New History'), ['controller' => 'Histories', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Contacts'), ['controller' => 'Contacts', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Contact'), ['controller' => 'Contacts', 'action' => 'add']) ?> </li>
	</ul>
</div>
<div class="groups form large-10 medium-9 columns">
<?= $this->Form->create($group) ?>
	<fieldset>
		<legend><?= __('Add Group'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('grouptype_id', ['options' => $grouptypes]);
		echo $this->Form->input('contacts._ids', ['options' => $contacts]);
	?>
	</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
</div>
