<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('List Events'), ['action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('List Eventgroups'), ['controller' => 'Eventgroups', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Eventgroup'), ['controller' => 'Eventgroups', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Histories'), ['controller' => 'Histories', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New History'), ['controller' => 'Histories', 'action' => 'add']) ?> </li>
	</ul>
</div>
<div class="events form large-10 medium-9 columns">
<?= $this->Form->create($event) ?>
	<fieldset>
		<legend><?= __('Add Event'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('eventgroup_id', ['options' => $eventgroups]);
	?>
	</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
</div>
