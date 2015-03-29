<?php
echo $this->Html->script('sanga.contacts.index.js', ['block' => true]);
?>
<div id="dialog">
	<h4><?= __('Choose columns to display') ?></h4>
	<?php
	echo $this->Form->create($contacts, ['id' => 'settingsForm']);
	echo $this->Form->input('contactname', ['type' => 'checkbox']);
	echo $this->Form->input('name', ['type' => 'checkbox']);
	echo $this->Form->input('zip_id', ['type' => 'checkbox']);
	echo $this->Form->input('address', ['type' => 'checkbox']);
	echo $this->Form->input('phone', ['type' => 'checkbox']);
	echo $this->Form->input('email', ['type' => 'checkbox']);
	echo $this->Form->input('birth', ['type' => 'checkbox']);
	echo $this->Form->input('workplace', ['type' => 'checkbox']);
	echo $this->Form->input('workplace_zip_id', ['type' => 'checkbox']);
	echo $this->Form->input('workplace_address', ['type' => 'checkbox']);
	echo $this->Form->input('workplace_phone', ['type' => 'checkbox']);
	echo $this->Form->input('workplace_email', ['type' => 'checkbox']);
	echo $this->Form->input('contactsource_id', ['type' => 'checkbox']);

	echo $this->Form->input('users', ['type' => 'checkbox']);
	echo $this->Form->input('skills', ['type' => 'checkbox']);
	echo $this->Form->input('groups', ['type' => 'checkbox']);

	echo $this->Form->input('sName', ['type' => 'hidden', 'value' => 'Contacts/index']);
	echo $this->Form->button(__('Submit'), ['id' => 'submitSettings', 'class' => 'radius']);
	echo $this->Form->end();
	?>
</div>
<div class="row">
<div class="contacts index columns large-12">
	<table cellpadding="0" cellspacing="0">
	<thead>
		<tr>
			<th><?= __('Contact Person') ?></th>
			<th><?= $this->Paginator->sort('name') . ' (' . $this->Paginator->sort('contactname') . ')' ?></th>
			<th><?= __('Email') ?></th>
			<th><?= __('Phone') ?></th>
			<th>
				<?php
				echo __('Groups');
				echo $this->Html->image('settings.png',
										['id' => 'settings',
										 'title' => _('Choose columns to display')]);
				?>
			</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($contacts as $contact): ?>
		<tr>
			<td>
				<?php
					if (isset($contact->users)){
						foreach($contact->users as $user){
							$css = ($user->id == $this->Session->read('Auth.User.id')) ? 'mine' : 'viewable';
							print '<span class="tag tag-'.$css.'">' . $user->name . '</span>' . "\n";
						}
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
				<?= h($contact->email) ?>
			</td>
			<td>
				<?= h($contact->phone) ?>
			</td>
			<td>
				<?php
					if (isset($contact->groups)){
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