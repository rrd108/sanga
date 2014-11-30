<div class="groups index columns">
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
		<tr>
			<?php
			echo '<td>';
				echo $this->Form->create($group, ['action' => 'add']);
				echo $this->Form->input('name', ['label' => false]);
			echo '</td>';
			echo '<td>';
				echo $this->Form->input('description', ['label' => false]);
			echo '</td>';
			echo '<td>';
				if($this->Session->read('Auth.User.id') >= 9){
					echo $this->Form->input('admin_user_id',
										['label' => false,
										 'options' => $users,
										 'value' => $this->Session->read('Auth.User.id')
										 ]);
				}
				else{
					echo '<span class="tag tag-primary">' . $this->Session->read('Auth.User.name') . '</span>';
				}
			echo '</td>';
			echo '<td>';
				echo $this->Form->input('shared', ['label' => false]);
			echo '</td>';
			//echo $this->Form->input('users._ids', ['options' => $users]);
			//echo $this->Form->input('contacts._ids', ['options' => $contacts]);
			echo '<td>';
				echo $this->Form->button(__('Submit'));
				echo $this->Form->end();
			echo '</td>';
			?>
		</tr>
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
			<td><?= ($group->shared)?'✔':'' ?></td>
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
