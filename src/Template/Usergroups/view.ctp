<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('Edit Usergroup'), ['action' => 'edit', $usergroup->id]) ?> </li>
		<li><?= $this->Form->postLink(__('Delete Usergroup'), ['action' => 'delete', $usergroup->id], ['confirm' => __('Are you sure you want to delete # %s?', $usergroup->id)]) ?> </li>
		<li><?= $this->Html->link(__('List Usergroups'), ['action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Usergroup'), ['action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
	</ul>
</div>
<div class="usergroups view large-10 medium-9 columns">
	<h2><?= h($usergroup->name) ?></h2>
	<div class="row">
		<div class="large-5 columns strings">
			<h6 class="subheader"><?= __('Name') ?></h6>
			<p><?= h($usergroup->name) ?></p>
		</div>
	</div>
	<div class="column large-12">
	<h4 class="subheader"><?= __('Related Users') ?></h4>
	<?php if (!empty($usergroup->users)): ?>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><?= __('Username') ?></th>
			<th><?= __('Realname') ?></th>
			<th><?= __('Email') ?></th>
			<th><?= __('Admin') ?></th>
		</tr>
		<?php foreach ($usergroup->users as $users): ?>
		<tr>
			<td><?= h($users->username) ?></td>
			<td><?= h($users->realname) ?></td>
			<td><?= h($users->email) ?></td>
			<td><?= h($users->_joinData->admin) ?></td>
		</tr>
		<?php endforeach; ?>
	</table>
	<?php endif; ?>
	</div>
</div>
