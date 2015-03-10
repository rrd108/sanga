<div class="groups view columns">
	<h2><?= h($group->name) ?></h2>
	<div class="row">
		<div class="large-5 columns strings">
			<h6 class="subheader"><?= __('Name') ?></h6>
			<p><?= h($group->name) ?></p>
			<h6 class="subheader"><?= __('Description') ?></h6>
			<p><?= h($group->description) ?></p>
			<h6 class="subheader"><?= __('Id') ?></h6>
			<p><?= $this->Number->format($group->id) ?></p>
			<h6 class="subheader"><?= __('Admin User Id') ?></h6>
			<p><?= $this->Number->format($group->admin_user_id) ?></p>
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
			<th><?= __('Contact.name') ?></th>
			<th><?= __('Date') ?></th>
			<th><?= __('User Name') ?></th>
			<th><?= __('Event Name') ?></th>
			<th><?= __('Detail') ?></th>
			<th><?= __('Quantity') ?></th>
			<th><?= __('Unit Name') ?></th>
			<th><?= __('Family') ?></th>
			<th class="actions"><?= __('Actions') ?></th>
		</tr>
		<?php foreach ($group->histories as $histories): ?>
		<tr>
			<td><?= h($histories->contact->name) ?></td>
			<td><?= h($histories->date) ?></td>
			<td><?= h($histories->user->name) ?></td>
			<td><?= h($histories->event->name) ?></td>
			<td><?= h($histories->detail) ?></td>
			<td><?= h($histories->quantity) ?></td>
			<td>
				<?php
				if (isset($histories->unit->name)) {
					echo h($histories->unit->name);
				}
				?>
			</td>
			<td><?= h($histories->family) ?></td>
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
			<th><?= __('Realname') ?></th>
			<th><?= __('Email') ?></th>
			<th><?= __('Phone') ?></th>
			<th><?= __('Active') ?></th>
			<th><?= __('Role') ?></th>
			<th class="actions"><?= __('Actions') ?></th>
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
			<th><?= __('Phone') ?></th>
			<th><?= __('Email') ?></th>
			<th><?= __('Active') ?></th>
			<th class="actions"><?= __('Actions') ?></th>
		</tr>
		<?php foreach ($group->contacts as $contacts): ?>
		<tr>
			<td><?= h($contacts->id) ?></td>
			<td><?= h($contacts->name) ?></td>
			<td><?= h($contacts->contactname) ?></td>
			<td><?= h($contacts->zip_id) ?></td>
			<td><?= h($contacts->address) ?></td>
			<td><?= h($contacts->phone) ?></td>
			<td><?= h($contacts->email) ?></td>
			<td><?= h($contacts->active) ?></td>
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
