<div class="contacts index columns">
	<table cellpadding="0" cellspacing="0">
	<thead>
		<tr>
			<th><?= __('Contact Person') ?></th>
			<th><?= $this->Paginator->sort('name') ?></th>
			<th><?= $this->Paginator->sort('zip_id') ?></th>
			<th><?= $this->Paginator->sort('group_id') ?></th>
			<th class="actions"><?= __('Actions') ?></th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($contacts as $contact): ?>
		<tr>
			<?php //$this->Number->format($contact->id) ?>
			<td>
				<?php
					foreach($contact->users as $user){
						$css = ($user->id == $this->Session->read('Auth.User.id')) ? 'primary' : 'success';
						print '<span class="tag tag-'.$css.'">' . $user->name . '</span>' . "\n";
					}
				?>
			</td>
			<td>
				<?php
					print h($contact->name);
					if($contact->contactname){
						print '<span class="i"> (' . h($contact->contactname) . ')</span>';
					}
				?>
			</td>
			<td>
				<?= $contact->has('zip') ? $contact->zip->zip . ' ' . $contact->zip->name : '' ?>
				<?= h($contact->address) ?>
			</td>
			<td>
				<?php
					foreach($contact->groups as $group){
						if($group->shared){
							$css = 'info';
						}
						elseif($group->admin_user_id == $this->Session->read('Auth.User.id')){
							$css = 'primary';
						}
						else{
							$css = 'success';
						}
						print '<span class="tag tag-'.$css.'">' . $group->name . '</span>' . "\n";
					}
				?>
			</td>
			<td class="actions">
				<?= $this->Html->link(__('View'), ['action' => 'view', $contact->id]) ?>
				<?php
					foreach($contact->users as $user){
						if($user->id == $this->Session->read('Auth.User.id')){
							print $this->Html->link(__('Edit'), ['action' => 'edit', $contact->id]);
							print $this->Form->postLink(__('Delete'), ['action' => 'delete', $contact->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contact->id)]);
						}
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
