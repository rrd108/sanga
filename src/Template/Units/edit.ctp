<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $unit->id], ['confirm' => __('Are you sure you want to delete # %s?', $unit->id)]) ?></li>
		<li><?= $this->Html->link(__('List Units'), ['action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('List Histories'), ['controller' => 'Histories', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New History'), ['controller' => 'Histories', 'action' => 'add']) ?> </li>
	</ul>
</div>
<div class="units form large-10 medium-9 columns">
<?= $this->Form->create($unit) ?>
	<fieldset>
		<legend><?= __('Edit Unit'); ?></legend>
	<?php
		echo $this->Form->input('name');
	?>
	</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
</div>
