<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions'); ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('Edit Eventgroup'), ['action' => 'edit', $eventgroup->id]) ?> </li>
		<li><?= $this->Form->postLink(__('Delete Eventgroup'), ['action' => 'delete', $eventgroup->id], ['confirm' => __('Are you sure you want to delete # %s?', $eventgroup->id)]) ?> </li>
		<li><?= $this->Html->link(__('List Eventgroups'), ['action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Eventgroup'), ['action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Events'), ['controller' => 'Events', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Event'), ['controller' => 'Events', 'action' => 'add']) ?> </li>
	</ul>
</div>
<div class="eventgroups view large-10 medium-9 columns">
	<h2><?= h($eventgroup->name) ?></h2>
	<div class="row">
		<div class="large-5 columns strings">
			<h6 class="subheader"><?= __('Name') ?></h6>
			<p><?= h($eventgroup->name) ?></p>
		</div>
		<div class="large-2 larege-offset-1 columns numbers end">
			<h6 class="subheader"><?= __('Id') ?></h6>
			<p><?= $this->Number->format($eventgroup->id) ?></p>
		</div>
	</div>
</div>
<div class="related row">
	<div class="column large-12">
	<h4 class="subheader"><?= __('Related Events') ?></h4>
	<?php if (!empty($eventgroup->events)): ?>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><?= __('Id') ?></th>
			<th><?= __('Name') ?></th>
			<th><?= __('Eventgroup Id') ?></th>
			<th class="actions"><?= __('Actions') ?></th>
		</tr>
		<?php foreach ($eventgroup->events as $events): ?>
		<tr>
			<td><?= h($events->id) ?></td>
			<td><?= h($events->name) ?></td>
			<td><?= h($events->eventgroup_id) ?></td>
			<td class="actions">
				<?= $this->Html->link(__('View'), ['controller' => 'Events', 'action' => 'view', $events->id]) ?>
				<?= $this->Html->link(__('Edit'), ['controller' => 'Events', 'action' => 'edit', $events->id]) ?>
				<?= $this->Form->postLink(__('Delete'), ['controller' => 'Events', 'action' => 'delete', $events->id], ['confirm' => __('Are you sure you want to delete # %s?', $events->id)]) ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
	<?php endif; ?>
	</div>
</div>
