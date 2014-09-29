<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('New Contacts Group'), ['action' => 'add']) ?></li>
	</ul>
</div>
<div class="contactsGroups index large-10 medium-9 columns">
	<table cellpadding="0" cellspacing="0">
	<thead>
		<tr>
			<th><?= $this->Paginator->sort('group_id') ?></th>
			<th><?= $this->Paginator->sort('contact_id') ?></th>
			<th class="actions"><?= __('Actions') ?></th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($contactsGroups as $contactsGroup): ?>
		<tr>
			<td><?= $this->Number->format($contactsGroup->group_id) ?></td>
			<td><?= $this->Number->format($contactsGroup->contact_id) ?></td>
			<td class="actions">
				<?= $this->Html->link(__('View'), ['action' => 'view', $contactsGroup->group_id]) ?>
				<?= $this->Html->link(__('Edit'), ['action' => 'edit', $contactsGroup->group_id]) ?>
				<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $contactsGroup->group_id], ['confirm' => __('Are you sure you want to delete # {0}?', $contactsGroup->group_id)]) ?>
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
