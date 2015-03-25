<div class="row">
<div class="contacts index columns large-12">
	<table cellpadding="0" cellspacing="0">
	<thead>
		<tr>
			<th><?= __('Contact Person') ?></th>
			<th><?= $this->Paginator->sort('name') . ' (' . $this->Paginator->sort('contactname') . ')' ?></th>
			<th><?= $this->Paginator->sort('zip_id') ?></th>
			<th><?= __('Phone') ?></th>
			<th><?= __('Groups') ?></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($contacts as $contact): ?>
		<tr>
			<td>
				<?php
					foreach($contact->users as $user){
						$css = ($user->id == $this->Session->read('Auth.User.id')) ? 'mine' : 'viewable';
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
				<?= h($contact->phone) ?>
			</td>
			<td>
				<?php
					foreach($contact->groups as $group){
						if($group->shared){
							$css = 'viewable';
						}
						elseif($group->admin_user_id == $this->Session->read('Auth.User.id')){
							$css = 'mine';
						}
						else{
							$css = 'shared';
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
		<ul class="pagination centered">
		<?php
			echo $this->Paginator->prev('< ' . __('previous'));
			echo $this->Paginator->numbers();
			echo $this->Paginator->next(__('next') . ' >');
		?>
		</ul>
		<div class="pagination-counter"><?= $this->Paginator->counter() ?></div>
	</div>
</div>
</div>