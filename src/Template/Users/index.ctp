<div class="sidebar-wrapper">
	<nav class="side-nav">
		<ul>
			<li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?></li>
		</ul>
	</nav>
</div>
<!-- sidebar wrapper -->

<div class="content-wrapper">
	<div class="row">
		<div class="users index large-10 medium-9 columns">
			<table cellpadding="0" cellspacing="0">
			<thead>
				<tr>
					<th><?= $this->Paginator->sort('id') ?></th>
					<th><?= $this->Paginator->sort('name') ?></th>
					<th><?= $this->Paginator->sort('realname') ?></th>
					<th><?= $this->Paginator->sort('email') ?></th>
					<th><?= $this->Paginator->sort('phone') ?></th>
					<th><?= $this->Paginator->sort('active') ?></th>
					<th class="actions"><?= __('Actions') ?></th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($users as $user): ?>
				<tr>
					<td><?= $this->Number->format($user->id) ?></td>
					<td><?= h($user->name) ?></td>
					<td><?= h($user->realname) ?></td>
					<td><?= h($user->email) ?></td>
					<td><?= h($user->phone) ?></td>
					<td><?= h($user->active) ?></td>
					<td class="actions">
						<?= $this->Html->link(__('View'), ['action' => 'view', $user->id]) ?>
						<?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id]) ?>
						<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
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
	</div>
</div>