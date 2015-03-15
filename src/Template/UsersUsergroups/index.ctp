<div class="sidebar-wrapper">
	<nav class="side-nav">
		<ul>
			<li><?= $this->Html->link(__('New Users Usergroup'), ['action' => 'add']) ?></li>
			<li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
			<li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
			<li><?= $this->Html->link(__('List Usergroups'), ['controller' => 'Usergroups', 'action' => 'index']) ?> </li>
			<li><?= $this->Html->link(__('New Usergroup'), ['controller' => 'Usergroups', 'action' => 'add']) ?> </li>
		</ul>
	</nav>
</div>
<!-- sidebar wrapper -->


<div class="content-wrapper">
	<div class="row">
		<div class="usersUsergroups index large-10 medium-9 columns">
			<table cellpadding="0" cellspacing="0">
			<thead>
				<tr>
					<th><?= $this->Paginator->sort('id') ?></th>
					<th><?= $this->Paginator->sort('user_id') ?></th>
					<th><?= $this->Paginator->sort('usergroup_id') ?></th>
					<th><?= $this->Paginator->sort('admin') ?></th>
					<th class="actions"><?= __('Actions') ?></th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($usersUsergroups as $usersUsergroup): ?>
				<tr>
					<td><?= $this->Number->format($usersUsergroup->id) ?></td>
					<td>
						<?= $usersUsergroup->has('user') ? $this->Html->link($usersUsergroup->user->name, ['controller' => 'Users', 'action' => 'view', $usersUsergroup->user->id]) : '' ?>
					</td>
					<td>
						<?= $usersUsergroup->has('usergroup') ? $this->Html->link($usersUsergroup->usergroup->name, ['controller' => 'Usergroups', 'action' => 'view', $usersUsergroup->usergroup->id]) : '' ?>
					</td>
					<td><?= h($usersUsergroup->admin) ?></td>
					<td class="actions">
						<?= $this->Html->link(__('View'), ['action' => 'view', $usersUsergroup->user_id]) ?>
						<?= $this->Html->link(__('Edit'), ['action' => 'edit', $usersUsergroup->user_id]) ?>
						<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $usersUsergroup->user_id], ['confirm' => __('Are you sure you want to delete # {0}?', $usersUsergroup->user_id)]) ?>
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
