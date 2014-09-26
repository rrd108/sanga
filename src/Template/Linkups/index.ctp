<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('New Linkup'), ['action' => 'add']) ?></li>
	</ul>
</div>
<div class="linkups index large-10 medium-9 columns">
	<table cellpadding="0" cellspacing="0">
	<thead>
		<tr>
			<th><?= $this->Paginator->sort('id') ?></th>
			<th><?= $this->Paginator->sort('name') ?></th>
			<th class="actions"><?= __('Actions') ?></th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($linkups as $linkup): ?>
		<tr>
			<td><?= $this->Number->format($linkup->id) ?></td>
			<td><?= h($linkup->name) ?></td>
			<td class="actions">
				<?= $this->Html->link(__('View'), ['action' => 'view', $linkup->id]) ?>
				<?= $this->Html->link(__('Edit'), ['action' => 'edit', $linkup->id]) ?>
				<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $linkup->id], ['confirm' => __('Are you sure you want to delete # {0}?', $linkup->id)]) ?>
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
