<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('New Contact'), ['action' => 'add']) ?></li>
	</ul>
</div>
<div class="contacts index large-10 medium-9 columns">
	<table cellpadding="0" cellspacing="0">
	<thead>
		<tr>
			<th><?= $this->Paginator->sort('id') ?></th>
			<th><?= $this->Paginator->sort('name') ?></th>
			<th><?= $this->Paginator->sort('contactname') ?></th>
			<th><?= $this->Paginator->sort('countries_id') ?></th>
			<th><?= $this->Paginator->sort('zips_id') ?></th>
			<th><?= $this->Paginator->sort('address') ?></th>
			<th><?= $this->Paginator->sort('phone') ?></th>
			<th class="actions"><?= __('Actions') ?></th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($contacts as $contact): ?>
		<tr>
			<td><?= $this->Number->format($contact->id) ?></td>
			<td><?= h($contact->name) ?></td>
			<td><?= h($contact->contactname) ?></td>
			<td><?= $this->Number->format($contact->countries_id) ?></td>
			<td><?= h($contact->zips_id) ?></td>
			<td><?= h($contact->address) ?></td>
			<td><?= h($contact->phone) ?></td>
			<td class="actions">
				<?= $this->Html->link(__('View'), ['action' => 'view', $contact->id]) ?>
				<?= $this->Html->link(__('Edit'), ['action' => 'edit', $contact->id]) ?>
				<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $contact->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contact->id)]) ?>
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
