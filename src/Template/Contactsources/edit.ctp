<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $contactsource->id], ['confirm' => __('Are you sure you want to delete # %s?', $contactsource->id)]) ?></li>
		<li><?= $this->Html->link(__('List Contactsources'), ['action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('List Contacts'), ['controller' => 'Contacts', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Contact'), ['controller' => 'Contacts', 'action' => 'add']) ?> </li>
	</ul>
</div>
<div class="contactsources form large-10 medium-9 columns">
<?= $this->Form->create($contactsource) ?>
	<fieldset>
		<legend><?= __('Edit Contactsource'); ?></legend>
	<?php
		echo $this->Form->input('name');
	?>
	</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
</div>
