<?php //debug($contacts->toArray()); ?>
<table cellpadding="0" cellspacing="0">
<thead>
	<tr>
		<th>
			<?php
			if ($settings) {
				echo $this->Html->image('settings.png',
									['id' => 'settings',
									 'title' => _('Choose columns to display')]);
			}
			?>
		</th>

		<?php
		foreach($fields as $field) {
			echo '<th>';
				if (in_array($field, ['contactname', 'legalname'])) {
					echo $this->Paginator->sort(__($field));
				} else {
					if (isset($fieldNames)) {
						echo $fieldNames[$field];
					} else {
						echo __(ucwords($field));
					}
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
		foreach($fields as $field) {
			echo '<td>';
				switch ($field) {
					case 'zip_id' :
						echo $contact->has('zip') ? $contact->zip->zip . ' ' . $contact->zip->name : '' ;
						break;
					case 'Zips.zip' :
						echo $contact->has('zip') ? $contact->zip->zip : '' ;
						break;
					case 'Zips.name' :
						echo $contact->has('zip') ? $contact->zip->name : '' ;
						break;
					case 'workplace_zip_id' :
						echo $contact->has('workplace_zip') ? $contact->workplace_zip->zip . ' ' . $contact->workplace_zip->name : '' ;
						break;
					case 'WorkplaceZips.zip' :
						echo $contact->has('workplace_zip') ? $contact->workplace_zip->zip : '' ;
						break;
					case 'WorkplaceZips.name' :
						echo $contact->has('workplace_zip') ? $contact->workplace_zip->name : '' ;
						break;
					case 'birth' : 
						echo isset($contact->birth) ? h($contact->birth->format('Y-m-d')) : '';
						break;
					case 'contactsource_id' :
						echo $contact->has('contactsource') ? '<span class="tag tag-shared">' . $contact->contactsource->name . '</span>' : '' ;
						break;
					case 'Contactsources.name' :
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
						echo h($contact->$field);
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
