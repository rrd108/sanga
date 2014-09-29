<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('New Linkups User'), ['action' => 'add']) ?></li>
	</ul>
</div>
<div class="linkupsUsers index large-10 medium-9 columns">
	<table cellpadding="0" cellspacing="0">
	<thead>
		<tr>
			<th><?= $this->Paginator->sort('linkup_id') ?></th>
			<th><?= $this->Paginator->sort('user_id') ?></th>
			<th><?= $this->Paginator->sort('role') ?></th>
			<th class="actions"><?= __('Actions') ?></th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($linkupsUsers as $linkupsUser): ?>
		<tr>
			<td><?= $this->Number->format($linkupsUser->linkup_id) ?></td>
			<td><?= $this->Number->format($linkupsUser->user_id) ?></td>
			<td><?= h($linkupsUser->role) ?></td>
			<td class="actions">
				<?= $this->Html->link(__('View'), ['action' => 'view', $linkupsUser->linkup_id]) ?>
				<?= $this->Html->link(__('Edit'), ['action' => 'edit', $linkupsUser->linkup_id]) ?>
				<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $linkupsUser->linkup_id], ['confirm' => __('Are you sure you want to delete # {0}?', $linkupsUser->linkup_id)]) ?>
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
