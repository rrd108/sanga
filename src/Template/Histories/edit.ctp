<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $history->id], ['confirm' => __('Are you sure you want to delete # %s?', $history->id)]) ?></li>
		<li><?= $this->Html->link(__('List Histories'), ['action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('List Contacts'), ['controller' => 'Contacts', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Contact'), ['controller' => 'Contacts', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Linkups'), ['controller' => 'Linkups', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Linkup'), ['controller' => 'Linkups', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Events'), ['controller' => 'Events', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Event'), ['controller' => 'Events', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Units'), ['controller' => 'Units', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Unit'), ['controller' => 'Units', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Groups'), ['controller' => 'Groups', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Group'), ['controller' => 'Groups', 'action' => 'add']) ?> </li>
	</ul>
</div>
<div class="histories form large-10 medium-9 columns">
<?= $this->Form->create($history) ?>
	<fieldset>
		<legend><?= __('Edit History'); ?></legend>
	<?php
		echo $this->Form->input('contact_id', ['options' => $contacts]);
		echo $this->Form->input('date');
		echo $this->Form->input('user_id', ['options' => $users]);
		echo $this->Form->input('linkup_id', ['options' => $linkups]);
		echo $this->Form->input('event_id', ['options' => $events]);
		echo $this->Form->input('detail');
		echo $this->Form->input('quantity');
		echo $this->Form->input('unit_id', ['options' => $units]);
		echo $this->Form->input('group_id', ['options' => $groups]);
	?>
	</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
</div>
