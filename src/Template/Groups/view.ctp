<div class="groups view columns">
	<h2><?= h($group->name) ?></h2>
	<div class="row">
		<div class="large-5 columns strings">
			<h6 class="subheader"><?= __('Name') ?></h6>
			<p><?= h($group->name) ?></p>
			<h6 class="subheader"><?= __('Description') ?></h6>
			<p><?= h($group->description) ?></p>
		</div>
		<div class="large-2 large-offset-1 columns numbers end">
			<h6 class="subheader"><?= __('Id') ?></h6>
			<p><?= $this->Number->format($group->id) ?></p>
			<h6 class="subheader"><?= __('Admin User Id') ?></h6>
			<p><?= $this->Number->format($group->admin_user_id) ?></p>
		</div>
		<div class="large-2 columns booleans end">
			<h6 class="subheader"><?= __('Shared') ?></h6>
			<p><?= $group->shared ? __('Yes') : __('No'); ?></p>
		</div>
	</div>
</div>
<div class="related row">
	<div class="column large-12">
	<h4 class="subheader"><?= __('Related Histories') ?></h4>
	<?php if (!empty($group->histories)): ?>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><?= __('Id') ?></th>
			<th><?= __('Contact Id') ?></th>
			<th><?= __('Date') ?></th>
			<th><?= __('User Id') ?></th>
			<th><?= __('Group Id') ?></th>
			<th><?= __('Event Id') ?></th>
			<th><?= __('Detail') ?></th>
			<th><?= __('Quantity') ?></th>
			<th><?= __('Unit Id') ?></th>
			<th><?= __('Family') ?></th>
			<th><?= __('Created') ?></th>
			<th><?= __('Modified') ?></th>
			<th class="actions"><?= __('Actions') ?></th>
		</tr>
		<?php foreach ($group->histories as $histories): ?>
		<tr>
			<td><?= h($histories->id) ?></td>
			<td><?= h($histories->contact_id) ?></td>
			<td><?= h($histories->date) ?></td>
			<td><?= h($histories->user_id) ?></td>
			<td><?= h($histories->group_id) ?></td>
			<td><?= h($histories->event_id) ?></td>
			<td><?= h($histories->detail) ?></td>
			<td><?= h($histories->quantity) ?></td>
			<td><?= h($histories->unit_id) ?></td>
			<td><?= h($histories->family) ?></td>
			<td><?= h($histories->created) ?></td>
			<td><?= h($histories->modified) ?></td>
			<td class="actions">
				<?= $this->Html->link(__('View'), ['controller' => 'Histories', 'action' => 'view', $histories->id]) ?>
				<?= $this->Html->link(__('Edit'), ['controller' => 'Histories', 'action' => 'edit', $histories->id]) ?>
				<?= $this->Form->postLink(__('Delete'), ['controller' => 'Histories', 'action' => 'delete', $histories->id], ['confirm' => __('Are you sure you want to delete # {0}?', $histories->id)]) ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
	<?php endif; ?>
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
			<th><?= __('Password') ?></th>
			<th><?= __('Realname') ?></th>
			<th><?= __('Email') ?></th>
			<th><?= __('Phone') ?></th>
			<th><?= __('Active') ?></th>
			<th><?= __('Role') ?></th>
			<th><?= __('Created') ?></th>
			<th><?= __('Modified') ?></th>
			<th class="actions"><?= __('Actions') ?></th>
		</tr>
		<?php foreach ($group->users as $users): ?>
		<tr>
			<td><?= h($users->id) ?></td>
			<td><?= h($users->name) ?></td>
			<td><?= h($users->password) ?></td>
			<td><?= h($users->realname) ?></td>
			<td><?= h($users->email) ?></td>
			<td><?= h($users->phone) ?></td>
			<td><?= h($users->active) ?></td>
			<td><?= h($users->role) ?></td>
			<td><?= h($users->created) ?></td>
			<td><?= h($users->modified) ?></td>
			<td class="actions">
				<?= $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'view', $users->id]) ?>
				<?= $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'edit', $users->id]) ?>
				<?= $this->Form->postLink(__('Delete'), ['controller' => 'Users', 'action' => 'delete', $users->id], ['confirm' => __('Are you sure you want to delete # {0}?', $users->id)]) ?>
			</td>
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
			<th><?= __('Zip Id') ?></th>
			<th><?= __('Address') ?></th>
			<th><?= __('Lat') ?></th>
			<th><?= __('Lng') ?></th>
			<th><?= __('Phone') ?></th>
			<th><?= __('Email') ?></th>
			<th><?= __('Birth') ?></th>
			<th><?= __('Sex') ?></th>
			<th><?= __('Workplace') ?></th>
			<th><?= __('Family Id') ?></th>
			<th><?= __('Contactsource Id') ?></th>
			<th><?= __('Active') ?></th>
			<th><?= __('Comment') ?></th>
			<th><?= __('Created') ?></th>
			<th><?= __('Modified') ?></th>
			<th class="actions"><?= __('Actions') ?></th>
		</tr>
		<?php foreach ($group->contacts as $contacts): ?>
		<tr>
			<td><?= h($contacts->id) ?></td>
			<td><?= h($contacts->name) ?></td>
			<td><?= h($contacts->contactname) ?></td>
			<td><?= h($contacts->zip_id) ?></td>
			<td><?= h($contacts->address) ?></td>
			<td><?= h($contacts->lat) ?></td>
			<td><?= h($contacts->lng) ?></td>
			<td><?= h($contacts->phone) ?></td>
			<td><?= h($contacts->email) ?></td>
			<td><?= h($contacts->birth) ?></td>
			<td><?= h($contacts->sex) ?></td>
			<td><?= h($contacts->workplace) ?></td>
			<td><?= h($contacts->family_id) ?></td>
			<td><?= h($contacts->contactsource_id) ?></td>
			<td><?= h($contacts->active) ?></td>
			<td><?= h($contacts->comment) ?></td>
			<td><?= h($contacts->created) ?></td>
			<td><?= h($contacts->modified) ?></td>
			<td class="actions">
				<?= $this->Html->link(__('View'), ['controller' => 'Contacts', 'action' => 'view', $contacts->id]) ?>
				<?= $this->Html->link(__('Edit'), ['controller' => 'Contacts', 'action' => 'edit', $contacts->id]) ?>
				<?= $this->Form->postLink(__('Delete'), ['controller' => 'Contacts', 'action' => 'delete', $contacts->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contacts->id)]) ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
	<?php endif; ?>
	</div>
</div>
