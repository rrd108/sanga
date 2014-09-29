<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $grouptype->id], ['confirm' => __('Are you sure you want to delete # %s?', $grouptype->id)]) ?></li>
		<li><?= $this->Html->link(__('List Grouptypes'), ['action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('List Groups'), ['controller' => 'Groups', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Group'), ['controller' => 'Groups', 'action' => 'add']) ?> </li>
	</ul>
</div>
<div class="grouptypes form large-10 medium-9 columns">
<?= $this->Form->create($grouptype) ?>
	<fieldset>
		<legend><?= __('Edit Grouptype'); ?></legend>
	<?php
		echo $this->Form->input('name');
	?>
	</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
</div>
