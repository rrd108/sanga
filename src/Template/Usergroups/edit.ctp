<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $usergroup->id], ['confirm' => __('Are you sure you want to delete # {0}?', $usergroup->id)]) ?></li>
		<li><?= $this->Html->link(__('List Usergroups'), ['action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
	</ul>
</div>
<div class="usergroups form large-10 medium-9 columns">
<?= $this->Form->create($usergroup) ?>
	<fieldset>
		<legend><?= __('Edit Usergroup') ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('admin_user_id', ['options' => $users]);
		echo $this->Form->input('users._ids', ['options' => $users]);
	?>
	</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
</div>
