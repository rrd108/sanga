<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions'); ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('Edit Contact'), ['action' => 'edit', $contact->id]) ?> </li>
		<li><?= $this->Form->postLink(__('Delete Contact'), ['action' => 'delete', $contact->id], ['confirm' => __('Are you sure you want to delete # %s?', $contact->id)]) ?> </li>
		<li><?= $this->Html->link(__('List Contacts'), ['action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Contact'), ['action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Zips'), ['controller' => 'Zips', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Zip'), ['controller' => 'Zips', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Contactsources'), ['controller' => 'Contactsources', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Contactsource'), ['controller' => 'Contactsources', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Histories'), ['controller' => 'Histories', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New History'), ['controller' => 'Histories', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Groups'), ['controller' => 'Groups', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Group'), ['controller' => 'Groups', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Linkups'), ['controller' => 'Linkups', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Linkup'), ['controller' => 'Linkups', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
	</ul>
</div>
<div class="contacts view large-10 medium-9 columns">
	<h2><?= h($contact->name) ?></h2>
	<div class="row">
		<div class="column large-12">
		<h4 class="subheader"><?= __('Contact person') ?></h4>
		<?php if (!empty($contact->users)): ?>
			<?php foreach ($contact->users as $users): ?>
				<span class="tag tag-danger"><?= h($users->username) ?></span>
			<?php endforeach; ?>
		<?php endif; ?>
		</div>
	</div>
	<div class="row">
		<div class="column large-12">
		<h4 class="subheader"><?= __('Linkups') ?></h4>
		<?php if (!empty($contact->linkups)): ?>
			<?php foreach ($contact->linkups as $linkups): ?>
				<span class="tag tag-success"><?= h($linkups->name) ?></span>
			<?php endforeach; ?>
		<?php endif; ?>
		</div>
	</div>
	<div class="row">
		<div class="large-11 columns strings">
			<h6 class="subheader"><?= __('Name') ?></h6>
			<p><?= h($contact->name) ?></p>
			<h6 class="subheader"><?= __('Contactname') ?></h6>
			<p><?= h($contact->contactname) ?></p>
			<h6 class="subheader"><?= __('Zip') ?></h6>
			<p><?= $contact->has('zip') ? $this->Html->link($contact->zip->zip . ' ' . $contact->zip->name, ['controller' => 'Zips', 'action' => 'view', $contact->zip->id]) : '' ?></p>
			<h6 class="subheader"><?= __('Address') ?></h6>
			<p><?= h($contact->address) ?></p>
			<h6 class="subheader"><?= __('Phone') ?></h6>
			<p><?= h($contact->phone) ?></p>
			<h6 class="subheader"><?= __('Email') ?></h6>
			<p><?= h($contact->email) ?></p>
			<h6 class="subheader"><?= __('Birth') ?></h6>
			<p><?= h($contact->birth) ?></p>
			<h6 class="subheader"><?= __('Contactsource') ?></h6>
			<p><?= $contact->has('contactsource') ? $this->Html->link($contact->contactsource->name, ['controller' => 'Contactsources', 'action' => 'view', $contact->contactsource->id]) : '' ?></p>
		</div>
		<div class="large-2 large-offset-1 columns numbers end">
			<h6 class="subheader"><?= __('Id') ?></h6>
			<p><?= $this->Number->format($contact->id) ?></p>
			<h6 class="subheader"><?= __('Lat') ?></h6>
			<p><?= $this->Number->format($contact->lat) ?></p>
			<h6 class="subheader"><?= __('Lng') ?></h6>
			<p><?= $this->Number->format($contact->lng) ?></p>
		</div>
		<div class="large-2 columns dates end">
			<h6 class="subheader"><?= __('Created') ?></h6>
			<p><?= h($contact->created) ?></p>
			<h6 class="subheader"><?= __('Modified') ?></h6>
			<p><?= h($contact->modified) ?></p>
		</div>
		<div class="large-2 columns booleans end">
			<h6 class="subheader"><?= __('Active') ?></h6>
			<p><?= $contact->active ? __('Yes') : __('No'); ?></p>
		</div>
	</div>
	<div class="row texts">
		<div class="columns large-9">
			<h6 class="subheader"><?= __('Comment') ?></h6>
			<?= $this->Text->autoParagraph(h($contact->comment)); ?>
		</div>
	</div>
</div>
<div class="related row">
	<div class="column large-12">
	<h4 class="subheader"><?= __('Related Histories') ?></h4>
	<?php if (!empty($contact->histories)): ?>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><?= __('Id') ?></th>
			<th><?= __('Contact Id') ?></th>
			<th><?= __('Date') ?></th>
			<th><?= __('User Id') ?></th>
			<th><?= __('Linkup Id') ?></th>
			<th><?= __('Event Id') ?></th>
			<th><?= __('Detail') ?></th>
			<th><?= __('Quantity') ?></th>
			<th><?= __('Unit Id') ?></th>
			<th><?= __('Group Id') ?></th>
			<th><?= __('Created') ?></th>
			<th><?= __('Modified') ?></th>
			<th class="actions"><?= __('Actions') ?></th>
		</tr>
		<?php foreach ($contact->histories as $histories): ?>
		<tr>
			<td><?= h($histories->id) ?></td>
			<td><?= h($histories->contact_id) ?></td>
			<td><?= h($histories->date) ?></td>
			<td><?= h($histories->user_id) ?></td>
			<td><?= h($histories->linkup_id) ?></td>
			<td><?= h($histories->event_id) ?></td>
			<td><?= h($histories->detail) ?></td>
			<td><?= h($histories->quantity) ?></td>
			<td><?= h($histories->unit_id) ?></td>
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
	<h4 class="subheader"><?= __('Related Groups') ?></h4>
	<?php if (!empty($contact->groups)): ?>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><?= __('Id') ?></th>
			<th><?= __('Name') ?></th>
			<th><?= __('User Id') ?></th>
			<th class="actions"><?= __('Actions') ?></th>
		</tr>
		<?php foreach ($contact->groups as $groups): ?>
		<tr>
			<td><?= h($groups->id) ?></td>
			<td><?= h($groups->name) ?></td>
			<td><?= h($groups->user_id) ?></td>
			<td class="actions">
				<?= $this->Html->link(__('View'), ['controller' => 'Groups', 'action' => 'view', $groups->id]) ?>
				<?= $this->Html->link(__('Edit'), ['controller' => 'Groups', 'action' => 'edit', $groups->id]) ?>
				<?= $this->Form->postLink(__('Delete'), ['controller' => 'Groups', 'action' => 'delete', $groups->id], ['confirm' => __('Are you sure you want to delete # %s?', $groups->id)]) ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
	<?php endif; ?>
	</div>
</div>