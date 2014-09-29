<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('List Contacts Groups'), ['action' => 'index']) ?></li>
	</ul>
</div>
<div class="contactsGroups form large-10 medium-9 columns">
<?= $this->Form->create($contactsGroup) ?>
	<fieldset>
		<legend><?= __('Add Contacts Group'); ?></legend>
	<?php
	?>
	</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
</div>
