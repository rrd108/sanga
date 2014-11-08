<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $contact->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contact->id)]) ?></li>
		<li><?= $this->Html->link(__('List Contacts'), ['action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('List Zips'), ['controller' => 'Zips', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Zip'), ['controller' => 'Zips', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Families'), ['controller' => 'Families', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Family'), ['controller' => 'Families', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Contactsources'), ['controller' => 'Contactsources', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Contactsource'), ['controller' => 'Contactsources', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Histories'), ['controller' => 'Histories', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New History'), ['controller' => 'Histories', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Groups'), ['controller' => 'Groups', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Group'), ['controller' => 'Groups', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Skills'), ['controller' => 'Skills', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Skill'), ['controller' => 'Skills', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
	</ul>
</div>
<div class="contacts form large-10 medium-9 columns">
<?= $this->Form->create($contact) ?>
	<fieldset>
		<legend><?= __('Edit Contact') ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('contactname');
		echo $this->Form->autocomplete('zip_id', ['source' => '../zips/searchzip', 'label' => __('Zip'), 'value' => $contact->zip->zip . ' ' . $contact->zip->name]);
		//echo $this->Form->input('zip_id', ['options' => $zips]);
		echo $this->Form->input('address');
		echo $this->Form->input('phone');
		echo $this->Form->input('email');
		echo $this->Form->input('birth', ['type' => 'text', 'value' => $contact->birth ? $contact->birth->format('Y-m-d') : null]);
		echo $this->Form->input('sex', ['type' => 'radio', 'options' => [1 => __('Male'), 2 => __('Female')]]);
		echo $this->Form->input('active', ['checked' => true, 'title' => 'Az inaktív kapcsolatok az akik eltűntek, eltávoztak, elérhetetlenek, stb.']);
		echo $this->Form->input('workplace');
		echo $this->Form->autocomplete('family_id', ['select' => true, 'source' => 'searchname', 'label' => __('Family'), 'title' => __('Choose family member')]);		
		echo $this->Form->input('contactsource_id', ['options' => $contactsources]);
		echo $this->Form->input('comment', ['title' => 'Másodlagos elérhetőségek, egyéb megjegyzések']);
		echo $this->Form->input('groups._ids', ['options' => $groups]);
		echo $this->Form->input('skills._ids', ['options' => $skills]);
		echo $this->Form->input('users._ids', ['options' => $users]);
	?>
	</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
</div>
