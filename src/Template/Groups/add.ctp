<div class="groups form columns">
<?= $this->Form->create($group) ?>
	<fieldset>
		<legend><?= __('Add Group') ?></legend>
	<?php
		
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('admin_user_id', ['options' => $users, 'empty' => __('-- Choose --')]);
		echo $this->Form->input('shared');
		echo $this->Form->input('users._ids', ['options' => $users]);
		echo $this->Form->input('contacts._ids', ['options' => $contacts]);
	?>
	</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
</div>
