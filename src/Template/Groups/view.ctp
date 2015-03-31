<div class="groups view columns">
	<h2><?= h($group->name) ?></h2>
	<div class="row">
		<div class="large-5 columns strings">
			<h6 class="subheader"><?= __('Description') ?></h6>
			<p><?= h($group->description) ?></p>
			<h6 class="subheader"><?= __('Admin User Id') ?></h6>
			<p><?= $this->Number->format($group->admin_user_id) ?></p>
			<h6 class="subheader"><?= __('Shared') ?></h6>
			<p><?= $group->shared ? __('Yes') : __('No'); ?></p>
		</div>
	</div>
</div>
<div class="related row">
	<div class="column large-12">
	<h4 class="subheader"><?= __('Related Users') ?></h4>
	<?php if (!empty($group->users)): ?>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><?= __('Id') ?></th>
			<th><?= __('Name') ?></th>
			<th><?= __('Realname') ?></th>
			<th><?= __('Email') ?></th>
			<th><?= __('Phone') ?></th>
			<th><?= __('Active') ?></th>
			<th><?= __('Role') ?></th>
		</tr>
		<?php foreach ($group->users as $users): ?>
		<tr>
			<td><?= h($users->id) ?></td>
			<td><?= h($users->name) ?></td>
			<td><?= h($users->realname) ?></td>
			<td><?= h($users->email) ?></td>
			<td><?= h($users->phone) ?></td>
			<td><?= h($users->active) ?></td>
			<td><?= h($users->role) ?></td>
		</tr>
		<?php endforeach; ?>
	</table>
	<?php endif; ?>
	</div>
</div>
<div class="related row">
	<div class="column large-12">
	<h4 class="subheader"><?= __('Related Contacts') ?></h4>
	<?php if (!empty($group->contacts)): ?>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><?= __('Id') ?></th>
			<th><?= __('Name') ?></th>
			<th><?= __('Contactname') ?></th>
		</tr>
		<?php foreach ($group->contacts as $contacts): ?>
		<tr>
			<td><?= h($contacts->id) ?></td>
			<td><?= h($contacts->name) ?></td>
			<td><?= h($contacts->contactname) ?></td>
		</tr>
		<?php endforeach; ?>
	</table>
	<?php endif; ?>
	</div>
</div>
