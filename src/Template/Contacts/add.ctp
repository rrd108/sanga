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
		echo $this->Form->input('users._ids',
								['options' => $users,
								 'type' => 'select',
								 'multiple' => 'checkbox',
								 'label' => __('Contact person'),
								 'value' => $this->Session->read('Auth.User.id')
								 ]);
		echo $this->Form->autocomplete('name',
									   ['source' => 'searchname',
										'label' => __('Known name'),
										'title' => __('Like initiated name, nickname, etc')
										]);
		echo $this->Form->autocomplete('contactname',
									   ['source' => 'searchname',
										'label' => __('Name'),
										'title' => __('Civil name, company name, etc')
										]);
		echo $this->Form->autocomplete('zip_id',
									   ['source' => '/zips/searchzip',
										'label' => __('Zip')]);
		echo $this->Form->input('address');
		echo $this->Form->input('phone');
		echo $this->Form->input('email');
		echo $this->Form->input('birth', ['type' => 'text']);
		echo $this->Form->input('sex', ['type' => 'radio', 'options' => [1 => __('Male'), 2 => __('Female')]]);
		echo $this->Form->input('active', ['checked' => true, 'title' => 'Az inaktív kapcsolatok az akik eltűntek, eltávoztak, elérhetetlenek, stb.']);
		echo $this->Form->input('workplace');
		echo $this->Form->input('family_id');
		echo $this->Form->input('comment', ['title' => 'Másodlagos elérhetőségek, egyéb megjegyzések']);
		echo $this->Form->input('contactsource_id',
								['options' => $contactsources,
								 'type' => 'radio']);
		echo $this->Form->input('groups._ids',
								['options' => $groups,
								 'type' => 'select',
								 'multiple' => 'checkbox'
								 ]);
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
