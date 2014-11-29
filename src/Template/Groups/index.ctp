<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('New Group'), ['action' => 'add']) ?></li>
		<li><?= $this->Html->link(__('List Histories'), ['controller' => 'Histories', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New History'), ['controller' => 'Histories', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Contacts'), ['controller' => 'Contacts', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Contact'), ['controller' => 'Contacts', 'action' => 'add']) ?> </li>
	</ul>
</div>
<div class="groups index large-10 medium-9 columns">
	<table cellpadding="0" cellspacing="0">
	<thead>
		<tr>
			<th><?= $this->Paginator->sort('name') ?></th>
			<th><?= $this->Paginator->sort('description') ?></th>
			<th><?= $this->Paginator->sort('admin_user_id') ?></th>
			<th><?= $this->Paginator->sort('shared') ?></th>
			<th class="actions"><?= __('Actions') ?></th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($groups as $group): ?>
		<tr>
			<td>
				<?php
				if($group->shared){
					$css = 'info';
				}
				elseif($group->admin_user_id == $this->Session->read('Auth.User.id')){
					$css = 'primary';
				}
				else{
					$css = 'success';
				}
				echo '<span class="tag tag-'.$css.'">' . $group->name . '</span>';
				?>
			</td>
			<td><?= h($group->description) ?></td>
			<td>
				<?php
				$css = ($group->admin_user_id == $this->Session->read('Auth.User.id')) ? 'primary' : 'success';
				print '<span class="tag tag-'.$css.'">' . $group->admin_user->name . '</span>';
				?>
			</td>
			<td><?= h($group->shared) ?></td>
			<td class="actions">
				<?= $this->Html->link(__('View'), ['action' => 'view', $group->id]) ?>
				<?php
				if($group->admin_user_id == $this->Session->read('Auth.User.id')){
					echo $this->Html->link(__('Edit'), ['action' => 'edit', $group->id]);
					echo $this->Form->postLink(__('Delete'), ['action' => 'delete', $group->id], ['confirm' => __('Are you sure you want to delete # {0}?', $group->id)]);
				}
				?>
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
