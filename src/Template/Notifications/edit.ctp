<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $notification->id], ['confirm' => __('Are you sure you want to delete # %s?', $notification->id)]) ?></li>
		<li><?= $this->Html->link(__('List Notifications'), ['action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
	</ul>
</div>
<div class="notifications form large-10 medium-9 columns">
<?= $this->Form->create($notification) ?>
	<fieldset>
		<legend><?= __('Edit Notification'); ?></legend>
	<?php
		echo $this->Form->input('notification');
		echo $this->Form->input('unread');
	?>
	</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
</div>
