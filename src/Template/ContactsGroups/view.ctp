<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions'); ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('Edit Contacts Group'), ['action' => 'edit', $contactsGroup->group_id]) ?> </li>
		<li><?= $this->Form->postLink(__('Delete Contacts Group'), ['action' => 'delete', $contactsGroup->group_id], ['confirm' => __('Are you sure you want to delete # %s?', $contactsGroup->group_id)]) ?> </li>
		<li><?= $this->Html->link(__('List Contacts Groups'), ['action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Contacts Group'), ['action' => 'add']) ?> </li>
	</ul>
</div>
<div class="contactsGroups view large-10 medium-9 columns">
	<h2><?= h($contactsGroup->group_id) ?></h2>
	<div class="row">
		<div class="large-2 larege-offset-1 columns numbers end">
			<h6 class="subheader"><?= __('Group Id') ?></h6>
			<p><?= $this->Number->format($contactsGroup->group_id) ?></p>
			<h6 class="subheader"><?= __('Contact Id') ?></h6>
			<p><?= $this->Number->format($contactsGroup->contact_id) ?></p>
		</div>
	</div>
</div>
