<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('New History'), ['action' => 'add']) ?></li>
		<li><?= $this->Html->link(__('List Contacts'), ['controller' => 'Contacts', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Contact'), ['controller' => 'Contacts', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Linkups'), ['controller' => 'Linkups', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Linkup'), ['controller' => 'Linkups', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Events'), ['controller' => 'Events', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Event'), ['controller' => 'Events', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Units'), ['controller' => 'Units', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Unit'), ['controller' => 'Units', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Groups'), ['controller' => 'Groups', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Group'), ['controller' => 'Groups', 'action' => 'add']) ?> </li>
	</ul>
</div>
<div class="histories index large-10 medium-9 columns">
	<table cellpadding="0" cellspacing="0">
	<thead>
		<tr>
			<th><?= $this->Paginator->sort('id') ?></th>
			<th><?= $this->Paginator->sort('contact_id') ?></th>
			<th><?= $this->Paginator->sort('date') ?></th>
			<th><?= $this->Paginator->sort('user_id') ?></th>
			<th><?= $this->Paginator->sort('linkup_id') ?></th>
			<th><?= $this->Paginator->sort('event_id') ?></th>
			<th><?= $this->Paginator->sort('detail') ?></th>
			<th class="actions"><?= __('Actions') ?></th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($histories as $history): ?>
		<tr>
			<td><?= $this->Number->format($history->id) ?></td>
			<td>
				<?= $history->has('contact') ? $this->Html->link($history->contact->name, ['controller' => 'Contacts', 'action' => 'view', $history->contact->id]) : '' ?>
			</td>
			<td><?= h($history->date) ?></td>
			<td>
				<?= $history->has('user') ? $this->Html->link($history->user->username, ['controller' => 'Users', 'action' => 'view', $history->user->id]) : '' ?>
			</td>
			<td>
				<?= $history->has('linkup') ? $this->Html->link($history->linkup->name, ['controller' => 'Linkups', 'action' => 'view', $history->linkup->id]) : '' ?>
			</td>
			<td>
				<?= $history->has('event') ? $this->Html->link($history->event->name, ['controller' => 'Events', 'action' => 'view', $history->event->id]) : '' ?>
			</td>
			<td><?= h($history->detail) ?></td>
			<td class="actions">
				<?= $this->Html->link(__('View'), ['action' => 'view', $history->id]) ?>
				<?= $this->Html->link(__('Edit'), ['action' => 'edit', $history->id]) ?>
				<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $history->id], ['confirm' => __('Are you sure you want to delete # {0}?', $history->id)]) ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
	<div class="paginator">
		<ul class="pagination">
		<?php
			echo $this->Paginator->prev('< ' . __('previous'));
			echo $this->Paginator->numbers();
			echo $this->Paginator->next(__('next') . ' >');
		?>
		</ul>
		<p><?= $this->Paginator->counter() ?></p>
	</div>
</div>
