<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $zip->id], ['confirm' => __('Are you sure you want to delete # %s?', $zip->id)]) ?></li>
		<li><?= $this->Html->link(__('List Zips'), ['action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('List Contacts'), ['controller' => 'Contacts', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Contact'), ['controller' => 'Contacts', 'action' => 'add']) ?> </li>
	</ul>
</div>
<div class="zips form large-10 medium-9 columns">
<?= $this->Form->create($zip) ?>
	<fieldset>
		<legend><?= __('Edit Zip'); ?></legend>
	<?php
		echo $this->Form->input('zip');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
</div>
