<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $eventgroup->id], ['confirm' => __('Are you sure you want to delete # %s?', $eventgroup->id)]) ?></li>
		<li><?= $this->Html->link(__('List Eventgroups'), ['action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('List Events'), ['controller' => 'Events', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Event'), ['controller' => 'Events', 'action' => 'add']) ?> </li>
	</ul>
</div>
<div class="eventgroups form large-10 medium-9 columns">
<?= $this->Form->create($eventgroup) ?>
	<fieldset>
		<legend><?= __('Edit Eventgroup'); ?></legend>
	<?php
		echo $this->Form->input('name');
	?>
	</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
</div>
