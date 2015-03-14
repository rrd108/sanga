<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $notification->id], ['confirm' => __('Are you sure you want to delete # %s?', $notification->id)]) ?></li>
		<li><?= $this->Html->link(__('List Notifications'), ['action' => 'index']) ?></li>
	</ul>
</div>
<div class="notifications form large-10 medium-9 columns">
<?= $this->Form->create($notification) ?>
	<fieldset>
		<legend><?= __('Edit Notification'); ?></legend>
	<?php
		echo $this->Form->input('user_id', ['options' => $users]);
		echo $this->Form->input('notification');
		echo $this->Form->input('unread');
	?>
	</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
</div>
