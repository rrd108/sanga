<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions'); ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('Edit Contacts User'), ['action' => 'edit', $contactsUser->contact_id]) ?> </li>
		<li><?= $this->Form->postLink(__('Delete Contacts User'), ['action' => 'delete', $contactsUser->contact_id], ['confirm' => __('Are you sure you want to delete # %s?', $contactsUser->contact_id)]) ?> </li>
		<li><?= $this->Html->link(__('List Contacts Users'), ['action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Contacts User'), ['action' => 'add']) ?> </li>
	</ul>
</div>
<div class="contactsUsers view large-10 medium-9 columns">
	<h2><?= h($contactsUser->contact_id) ?></h2>
	<div class="row">
		<div class="large-2 larege-offset-1 columns numbers end">
			<h6 class="subheader"><?= __('Contact Id') ?></h6>
			<p><?= $this->Number->format($contactsUser->contact_id) ?></p>
			<h6 class="subheader"><?= __('User Id') ?></h6>
			<p><?= $this->Number->format($contactsUser->user_id) ?></p>
		</div>
	</div>
</div>
