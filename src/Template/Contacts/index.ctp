<?php
echo $this->Html->script('sanga.contacts.index.js', ['block' => true]);
?>
<div id="dialog">
	<h4><?= __('Choose columns to display') ?></h4>
	<?php
	echo $this->Form->create($contacts, ['id' => 'settingsForm']);
	echo $this->Form->input('contactname', ['type' => 'checkbox']);
	echo $this->Form->input('legalname', ['type' => 'checkbox']);
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
			<th><?= $this->Html->image('settings.png',
										['id' => 'settings',
										 'title' => _('Choose columns to display')]) ?></th>

			<?php
			foreach($this->request->data as $d => $x) {
				echo '<th>';
					if (in_array($d, ['contactname', 'legalname'])) {
						echo $this->Paginator->sort(__($d));
					} else {
						echo __(ucwords($d));
					}
				echo '</th>';
			}
			?>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($contacts as $contact): ?>
		<tr>
			<td>
				<?php
				$cs = '';
				if ($contact->sex) {
					$cs = $contact->sex;
				}
				echo $this->Html->link($this->Html->image('contact'.$cs.'.png'),
									  ['action' => 'view', $contact->id],
									  ['escape' => false, 'title' => __('View')]);
				?>
			</td>
			<?php
			foreach($this->request->data as $d => $x) {
				echo '<td>';
					switch ($d) {
						case 'zip_id' :
							echo $contact->has('zip') ? $contact->zip->zip . ' ' . $contact->zip->name : '' ;
							break;
						case 'workplace_zip_id' :
							echo $contact->has('workplace_zip') ? $contact->workplace_zip->zip . ' ' . $contact->workplace_zip->name : '' ;
							break;
						case 'birth' : 
							echo isset($contact->birth) ? h($contact->birth->format('Y-m-d')) : '';
							break;
						case 'contactsource_id' :
							echo $contact->has('contactsource') ? '<span class="tag tag-shared">' . $contact->contactsource->name . '</span>' : '' ;
							break;
						case 'users' : 
							if (isset($contact->users)){
								foreach($contact->users as $user){
									$css = ($user->id == $this->Session->read('Auth.User.id')) ? 'mine' : 'viewable';
									print '<span class="tag tag-'.$css.'">' . $user->name . '</span>' . "\n";
								}
							}
							break;
						case 'skills' : 
							if (isset($contact->skills)){
								foreach($contact->skills as $skill){
									print '<span class="tag tag-shared">' . $skill->name . '</span>' . "\n";
								}
							}
							break;
						case 'groups' : 
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
							break;
						default : 
							echo h($contact->$d);
					}
				echo '</td>';
			}
			?>
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