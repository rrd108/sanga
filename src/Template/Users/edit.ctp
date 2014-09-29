<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # %s?', $user->id)]) ?></li>
		<li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('List Histories'), ['controller' => 'Histories', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New History'), ['controller' => 'Histories', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Notifications'), ['controller' => 'Notifications', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Notification'), ['controller' => 'Notifications', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Contacts'), ['controller' => 'Contacts', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Contact'), ['controller' => 'Contacts', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Linkups'), ['controller' => 'Linkups', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Linkup'), ['controller' => 'Linkups', 'action' => 'add']) ?> </li>
	</ul>
</div>
<div class="users form large-10 medium-9 columns">
<?= $this->Form->create($user) ?>
	<fieldset>
		<legend><?= __('Edit User'); ?></legend>
	<?php
		echo $this->Form->input('username');
		echo $this->Form->input('password');
		echo $this->Form->input('realname');
		echo $this->Form->input('email');
		echo $this->Form->input('phone');
		echo $this->Form->input('active');
		echo $this->Form->input('role');
		echo $this->Form->input('contacts._ids', ['options' => $contacts]);
		echo $this->Form->input('linkups._ids', ['options' => $linkups]);
	?>
	</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
</div>
