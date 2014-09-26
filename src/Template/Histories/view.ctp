<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions'); ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('Edit History'), ['action' => 'edit', $history->id]) ?> </li>
		<li><?= $this->Form->postLink(__('Delete History'), ['action' => 'delete', $history->id], ['confirm' => __('Are you sure you want to delete # %s?', $history->id)]) ?> </li>
		<li><?= $this->Html->link(__('List Histories'), ['action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New History'), ['action' => 'add']) ?> </li>
	</ul>
</div>
<div class="histories view large-10 medium-9 columns">
	<h2><?= h($history->id) ?></h2>
	<div class="row">
		<div class="large-5 columns strings">
			<h6 class="subheader"><?= __('Detail') ?></h6>
			<p><?= h($history->detail) ?></p>
		</div>
		<div class="large-2 larege-offset-1 columns numbers end">
			<h6 class="subheader"><?= __('Id') ?></h6>
			<p><?= $this->Number->format($history->id) ?></p>
			<h6 class="subheader"><?= __('Contacts Id') ?></h6>
			<p><?= $this->Number->format($history->contacts_id) ?></p>
			<h6 class="subheader"><?= __('Users Id') ?></h6>
			<p><?= $this->Number->format($history->users_id) ?></p>
			<h6 class="subheader"><?= __('Amount') ?></h6>
			<p><?= $this->Number->format($history->amount) ?></p>
			<h6 class="subheader"><?= __('Events Id') ?></h6>
			<p><?= $this->Number->format($history->events_id) ?></p>
			<h6 class="subheader"><?= __('Groups Id') ?></h6>
			<p><?= $this->Number->format($history->groups_id) ?></p>
		</div>
		<div class="large-2 columns dates end">
			<h6 class="subheader"><?= __('Date') ?></h6>
			<p><?= h($history->date) ?></p>
			<h6 class="subheader"><?= __('Created') ?></h6>
			<p><?= h($history->created) ?></p>
			<h6 class="subheader"><?= __('Modified') ?></h6>
			<p><?= h($history->modified) ?></p>
		</div>
	</div>
</div>
