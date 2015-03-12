<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('List Notifications'), ['action' => 'index']) ?></li>
	</ul>
</div>
<div class="notifications form large-10 medium-9 columns">
<?= $this->Form->create($notification) ?>
	<fieldset>
		<legend><?= __('Add Notification'); ?></legend>
	<?php
		echo $this->Form->input('user_id', ['options' => $users]);
		echo $this->Form->input('notification');
		echo $this->Form->input('unread', ['checked' => true]);
	?>
	</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
</div>
