<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('New History'), ['action' => 'add']) ?></li>
	</ul>
</div>
<div class="histories index large-10 medium-9 columns">
	<table cellpadding="0" cellspacing="0">
	<thead>
		<tr>
			<th><?= $this->Paginator->sort('id') ?></th>
			<th><?= $this->Paginator->sort('date') ?></th>
			<th><?= $this->Paginator->sort('contacts_id') ?></th>
			<th><?= $this->Paginator->sort('users_id') ?></th>
			<th><?= $this->Paginator->sort('detail') ?></th>
			<th><?= $this->Paginator->sort('amount') ?></th>
			<th><?= $this->Paginator->sort('events_id') ?></th>
			<th class="actions"><?= __('Actions') ?></th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($histories as $history): ?>
		<tr>
			<td><?= $this->Number->format($history->id) ?></td>
			<td><?= h($history->date) ?></td>
			<td><?= $this->Number->format($history->contacts_id) ?></td>
			<td><?= $this->Number->format($history->users_id) ?></td>
			<td><?= h($history->detail) ?></td>
			<td><?= $this->Number->format($history->amount) ?></td>
			<td><?= $this->Number->format($history->events_id) ?></td>
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
