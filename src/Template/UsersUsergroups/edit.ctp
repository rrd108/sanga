<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $usersUsergroup->user_id], ['confirm' => __('Are you sure you want to delete # {0}?', $usersUsergroup->user_id)]) ?></li>
		<li><?= $this->Html->link(__('List Users Usergroups'), ['action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Usergroups'), ['controller' => 'Usergroups', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Usergroup'), ['controller' => 'Usergroups', 'action' => 'add']) ?> </li>
	</ul>
</div>
<div class="usersUsergroups form large-10 medium-9 columns">
<?= $this->Form->create($usersUsergroup) ?>
	<fieldset>
		<legend><?= __('Edit Users Usergroup') ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('admin');
	?>
	</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
</div>
