<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions'); ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('Edit Contactsource'), ['action' => 'edit', $contactsource->id]) ?> </li>
		<li><?= $this->Form->postLink(__('Delete Contactsource'), ['action' => 'delete', $contactsource->id], ['confirm' => __('Are you sure you want to delete # %s?', $contactsource->id)]) ?> </li>
		<li><?= $this->Html->link(__('List Contactsources'), ['action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Contactsource'), ['action' => 'add']) ?> </li>
	</ul>
</div>
<div class="contactsources view large-10 medium-9 columns">
	<h2><?= h($contactsource->name) ?></h2>
	<div class="row">
		<div class="large-5 columns strings">
			<h6 class="subheader"><?= __('Name') ?></h6>
			<p><?= h($contactsource->name) ?></p>
		</div>
		<div class="large-2 larege-offset-1 columns numbers end">
			<h6 class="subheader"><?= __('Id') ?></h6>
			<p><?= $this->Number->format($contactsource->id) ?></p>
		</div>
	</div>
</div>
