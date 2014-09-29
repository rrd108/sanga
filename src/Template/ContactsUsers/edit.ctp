<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $contactsUser->contact_id], ['confirm' => __('Are you sure you want to delete # %s?', $contactsUser->contact_id)]) ?></li>
		<li><?= $this->Html->link(__('List Contacts Users'), ['action' => 'index']) ?></li>
	</ul>
</div>
<div class="contactsUsers form large-10 medium-9 columns">
<?= $this->Form->create($contactsUser) ?>
	<fieldset>
		<legend><?= __('Edit Contacts User'); ?></legend>
	<?php
	?>
	</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
</div>
