<div class="contacts index columns">
	<table cellpadding="0" cellspacing="0">
	<thead>
		<tr>
			<th><?= __('Contact Person') ?></th>
			<th><?= $this->Paginator->sort('name') ?></th>
			<th><?= $this->Paginator->sort('zip_id') ?></th>
			<th><?= __('Groups') ?></th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($contacts as $contact): ?>
		<tr>
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
					print $this->Html->link(h($contact->name), ['action' => 'view', $contact->id]);
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
