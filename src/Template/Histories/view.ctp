<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions'); ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('Edit History'), ['action' => 'edit', $history->id]) ?> </li>
		<li><?= $this->Form->postLink(__('Delete History'), ['action' => 'delete', $history->id], ['confirm' => __('Are you sure you want to delete # %s?', $history->id)]) ?> </li>
		<li><?= $this->Html->link(__('List Histories'), ['action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New History'), ['action' => 'add']) ?> </li>
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
<div class="histories view large-10 medium-9 columns">
	<h2><?= h($history->id) ?></h2>
	<div class="row">
		<div class="large-5 columns strings">
			<h6 class="subheader"><?= __('Contact') ?></h6>
			<p><?= $history->has('contact') ? $this->Html->link($history->contact->name, ['controller' => 'Contacts', 'action' => 'view', $history->contact->id]) : '' ?></p>
			<h6 class="subheader"><?= __('User') ?></h6>
			<p><?= $history->has('user') ? $this->Html->link($history->user->name, ['controller' => 'Users', 'action' => 'view', $history->user->id]) : '' ?></p>
			<h6 class="subheader"><?= __('Linkup') ?></h6>
			<p><?= $history->has('linkup') ? $this->Html->link($history->linkup->name, ['controller' => 'Linkups', 'action' => 'view', $history->linkup->id]) : '' ?></p>
			<h6 class="subheader"><?= __('Event') ?></h6>
			<p><?= $history->has('event') ? $this->Html->link($history->event->name, ['controller' => 'Events', 'action' => 'view', $history->event->id]) : '' ?></p>
			<h6 class="subheader"><?= __('Detail') ?></h6>
			<p><?= h($history->detail) ?></p>
			<h6 class="subheader"><?= __('Unit') ?></h6>
			<p><?= $history->has('unit') ? $this->Html->link($history->unit->name, ['controller' => 'Units', 'action' => 'view', $history->unit->id]) : '' ?></p>
			<h6 class="subheader"><?= __('Group') ?></h6>
			<p><?= $history->has('group') ? $this->Html->link($history->group->name, ['controller' => 'Groups', 'action' => 'view', $history->group->id]) : '' ?></p>
		</div>
		<div class="large-2 large-offset-1 columns numbers end">
			<h6 class="subheader"><?= __('Id') ?></h6>
			<p><?= $this->Number->format($history->id) ?></p>
			<h6 class="subheader"><?= __('Quantity') ?></h6>
			<p><?= $this->Number->format($history->quantity) ?></p>
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
