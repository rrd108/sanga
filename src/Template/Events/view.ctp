<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions'); ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('Edit Event'), ['action' => 'edit', $event->id]) ?> </li>
		<li><?= $this->Form->postLink(__('Delete Event'), ['action' => 'delete', $event->id], ['confirm' => __('Are you sure you want to delete # %s?', $event->id)]) ?> </li>
		<li><?= $this->Html->link(__('List Events'), ['action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Event'), ['action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Eventgroups'), ['controller' => 'Eventgroups', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Eventgroup'), ['controller' => 'Eventgroups', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Histories'), ['controller' => 'Histories', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New History'), ['controller' => 'Histories', 'action' => 'add']) ?> </li>
	</ul>
</div>
<div class="events view large-10 medium-9 columns">
	<h2><?= h($event->name) ?></h2>
	<div class="row">
		<div class="large-5 columns strings">
			<h6 class="subheader"><?= __('Name') ?></h6>
			<p><?= h($event->name) ?></p>
			<h6 class="subheader"><?= __('Eventgroup') ?></h6>
			<p><?= $event->has('eventgroup') ? $this->Html->link($event->eventgroup->name, ['controller' => 'Eventgroups', 'action' => 'view', $event->eventgroup->id]) : '' ?></p>
		</div>
		<div class="large-2 larege-offset-1 columns numbers end">
			<h6 class="subheader"><?= __('Id') ?></h6>
			<p><?= $this->Number->format($event->id) ?></p>
		</div>
	</div>
</div>
<div class="related row">
	<div class="column large-12">
	<h4 class="subheader"><?= __('Related Histories') ?></h4>
	<?php if (!empty($event->histories)): ?>
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
		<?php foreach ($event->histories as $histories): ?>
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
