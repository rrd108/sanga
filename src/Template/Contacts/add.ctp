<?php
//$this->assign('title', 'Kapcsolatok / Új');
//$this->Html->addCrumb('Kapcsolatok', '/contacts');
//$this->Html->addCrumb('Új', '/contacts/add');
print $this->Html->script('sanga.contacts.add.js', ['block' => true]);
?>
<div class="contacts form columns">
<?= $this->Form->create($contact) ?>
	<fieldset>
		<legend><?= __('Add Contact') ?></legend>
	<?php
		echo '<div class="input text">';
		echo '<label for="users-ids">'.__('Contact Person').'</label>';
		echo $this->element('user_checkbox');
		echo '</div>';
		
		echo $this->Form->input('name',
									   ['label' => __('Known name'),
										'title' => __('Like initiated name, nickname, etc')
										]);
		echo $this->Form->input('contactname',
									   ['label' => __('Name'),
										'title' => __('Civil name, company name, etc')
										]);
		echo $this->Form->input('xzip', ['type' => 'text', 'label' => __('Zip')]);
		echo $this->Form->input('zip_id', ['type' => 'hidden']);
		echo $this->Form->input('address');
		echo $this->Form->input('phone');
		echo $this->Form->input('email');
		echo $this->Form->input('birth', ['type' => 'text']);
		echo $this->Form->input('sex', ['type' => 'radio', 'options' => [1 => __('Male'), 2 => __('Female')]]);
		echo $this->Form->input('active', ['checked' => true, 'title' => 'Az inaktív kapcsolatok az akik eltűntek, eltávoztak, elérhetetlenek, stb.']);
		echo $this->Form->input('workplace');
		echo $this->Form->input('xfamily', ['type' => 'text', 'label' => __('Family')]);
		echo $this->Form->input('family_member_id', ['type' => 'hidden']);
		echo $this->Form->input('comment', ['title' => __('Secondary emails, phones, others')]);
		echo $this->Form->input('contactsource_id',
								['options' => $contactsources,
								 'type' => 'radio']);
		
		$fGroups = $values = [];
		foreach($groups as $group){
			//$fGroups[$group->id] = '<span class="tag tag-default">' . $group->name . '</span>';
			$fGroups[$group->id] = $group->name;
			if($group->shared){
				$values[] = $group->id;
			}
		}
		
		echo $this->Form->input('groups._ids',
								['options' => $fGroups,
								 'type' => 'select',
								 'multiple' => 'checkbox',
								 'value' => $values
								 ]);
		/*echo '<div class="input">';
			echo '<label for="groups-ids">';
				echo __('Groups');
			echo '</label>';
			foreach($groups as $group){
				echo $this->Form->checkbox('groups._ids', ['multiple' => true]);
				$myGroup = false;
				if($group->admin_user_id == $this->Session->read('Auth.User.id')){
					$myGroup = true;
				}
				if($group->shared){
					$cssDStyle = $cssStyle =  'shared';
				}
				else{
					$cssStyle = ($myGroup ? 'mine' : 'viewable');
					$cssDStyle = 'default';
				}
				echo '<span class="tag tag-' . $cssDStyle . '"
						data-css="tag-' . $cssStyle . '" 
						data-id="' . $group->id . '">';
					echo h($group->name);
				echo '</span> ';
			}
		echo '</div>';*/
		echo $this->Form->input('skills._ids', ['type' => 'text']);/*,
									   ['source' => '/skills/search',
										'label' => __('Skills'),
										'change' => 'var t = $(event.target);
													t.parent().append("<span class=\"tag tag-mine\">"+t.val()+"</span>\n");
													t.val(null);
													t.focus();
													event.preventDefault();'
										]);*/
	?>
	</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
</div>
