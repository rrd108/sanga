<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions'); ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('Edit Group'), ['action' => 'edit', $group->id]) ?> </li>
		<li><?= $this->Form->postLink(__('Delete Group'), ['action' => 'delete', $group->id], ['confirm' => __('Are you sure you want to delete # %s?', $group->id)]) ?> </li>
		<li><?= $this->Html->link(__('List Groups'), ['action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Group'), ['action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Grouptypes'), ['controller' => 'Grouptypes', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Grouptype'), ['controller' => 'Grouptypes', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Histories'), ['controller' => 'Histories', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New History'), ['controller' => 'Histories', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Contacts'), ['controller' => 'Contacts', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Contact'), ['controller' => 'Contacts', 'action' => 'add']) ?> </li>
	</ul>
</div>
<div class="groups view large-10 medium-9 columns">
	<h2><?= h($group->name) ?></h2>
	<div class="row">
		<div class="large-5 columns strings">
			<h6 class="subheader"><?= __('Name') ?></h6>
			<p><?= h($group->name) ?></p>
			<h6 class="subheader"><?= __('Grouptype') ?></h6>
			<p><?= $group->has('grouptype') ? $this->Html->link($group->grouptype->name, ['controller' => 'Grouptypes', 'action' => 'view', $group->grouptype->id]) : '' ?></p>
		</div>
		<div class="large-2 larege-offset-1 columns numbers end">
			<h6 class="subheader"><?= __('Id') ?></h6>
			<p><?= $this->Number->format($group->id) ?></p>
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
			<th><?= __('Date') ?></th>
			<th><?= __('Contact Id') ?></th>
			<th><?= __('User Id') ?></th>
			<th><?= __('Detail') ?></th>
			<th><?= __('Amount') ?></th>
			<th><?= __('Event Id') ?></th>
			<th><?= __('Group Id') ?></th>
			<th><?= __('Created') ?></th>
			<th><?= __('Modified') ?></th>
			<th class="actions"><?= __('Actions') ?></th>
		</tr>
		<?php foreach ($group->histories as $histories): ?>
		<tr>
			<td><?= h($histories->id) ?></td>
			<td><?= h($histories->date) ?></td>
			<td><?= h($histories->contact_id) ?></td>
			<td><?= h($histories->user_id) ?></td>
			<td><?= h($histories->detail) ?></td>
			<td><?= h($histories->amount) ?></td>
			<td><?= h($histories->event_id) ?></td>
			<td><?= h($histories->group_id) ?></td>
			<td><?= h($histories->created) ?></td>
			<td><?= h($histories->modified) ?></td>
			<td class="actions">
				<?= $this->Html->link(__('View'), ['controller' => 'Histories', 'action' => 'view', $histories->id]) ?>
				<?= $this->Html->link(__('Edit'), ['controller' => 'Histories', 'action' => 'edit', $histories->id]) ?>
				<?= $this->Form->postLink(__('Delete'), ['controller' => 'Histories', 'action' => 'delete', $histories->id], ['confirm' => __('Are you sure you want to delete # %s?', $histories->id)]) ?>
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
			<th><?= __('Country Id') ?></th>
			<th><?= __('Zip Id') ?></th>
			<th><?= __('Address') ?></th>
			<th><?= __('Phone') ?></th>
			<th><?= __('Email') ?></th>
			<th><?= __('Birth') ?></th>
			<th><?= __('Active') ?></th>
			<th><?= __('Comment') ?></th>
			<th><?= __('Created') ?></th>
			<th><?= __('Modified') ?></th>
			<th><?= __('Contactsource Id') ?></th>
			<th class="actions"><?= __('Actions') ?></th>
		</tr>
		<?php foreach ($group->contacts as $contacts): ?>
		<tr>
			<td><?= h($contacts->id) ?></td>
			<td><?= h($contacts->name) ?></td>
			<td><?= h($contacts->contactname) ?></td>
			<td><?= h($contacts->country_id) ?></td>
			<td><?= h($contacts->zip_id) ?></td>
			<td><?= h($contacts->address) ?></td>
			<td><?= h($contacts->phone) ?></td>
			<td><?= h($contacts->email) ?></td>
			<td><?= h($contacts->birth) ?></td>
			<td><?= h($contacts->active) ?></td>
			<td><?= h($contacts->comment) ?></td>
			<td><?= h($contacts->created) ?></td>
			<td><?= h($contacts->modified) ?></td>
			<td><?= h($contacts->contactsource_id) ?></td>
			<td class="actions">
				<?= $this->Html->link(__('View'), ['controller' => 'Contacts', 'action' => 'view', $contacts->id]) ?>
				<?= $this->Html->link(__('Edit'), ['controller' => 'Contacts', 'action' => 'edit', $contacts->id]) ?>
				<?= $this->Form->postLink(__('Delete'), ['controller' => 'Contacts', 'action' => 'delete', $contacts->id], ['confirm' => __('Are you sure you want to delete # %s?', $contacts->id)]) ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
	<?php endif; ?>
	</div>
</div>
