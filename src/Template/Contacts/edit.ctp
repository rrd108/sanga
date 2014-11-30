<div class="contacts form columns">
<?= $this->Form->create($contact) ?>
	<fieldset>
		<legend><?= __('Edit Contact') ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('contactname');
		echo $this->Form->autocomplete('zip_id', ['source' => '/zips/searchzip', 'label' => __('Zip'), 'value' => isset($contact->zip) ? $contact->zip->zip . ' ' . $contact->zip->name : '']);
		echo $this->Form->input('address');
		echo $this->Form->input('phone');
		echo $this->Form->input('email');
		echo $this->Form->input('birth', ['type' => 'text', 'value' => $contact->birth ? $contact->birth->format('Y-m-d') : null]);
		echo $this->Form->input('sex', ['type' => 'radio', 'options' => [1 => __('Male'), 2 => __('Female')]]);
		echo $this->Form->input('active', ['checked' => true, 'title' => 'Az inaktív kapcsolatok az akik eltűntek, eltávoztak, elérhetetlenek, stb.']);
		echo $this->Form->input('workplace');
		echo $this->Form->autocomplete('family_id', ['source' => 'searchname', 'label' => __('Family'), 'title' => __('Choose family member')]);		
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
