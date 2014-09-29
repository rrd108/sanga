<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions'); ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('Edit Contact'), ['action' => 'edit', $contact->id]) ?> </li>
		<li><?= $this->Form->postLink(__('Delete Contact'), ['action' => 'delete', $contact->id], ['confirm' => __('Are you sure you want to delete # %s?', $contact->id)]) ?> </li>
		<li><?= $this->Html->link(__('List Contacts'), ['action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Contact'), ['action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Countries'), ['controller' => 'Countries', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Country'), ['controller' => 'Countries', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Zips'), ['controller' => 'Zips', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Zip'), ['controller' => 'Zips', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Contactsources'), ['controller' => 'Contactsources', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Contactsource'), ['controller' => 'Contactsources', 'action' => 'add']) ?> </li>
	</ul>
</div>
<div class="contacts view large-10 medium-9 columns">
	<h2><?= h($contact->name) ?></h2>
	<div class="row">
		<div class="large-5 columns strings">
			<h6 class="subheader"><?= __('Name') ?></h6>
			<p><?= h($contact->name) ?></p>
			<h6 class="subheader"><?= __('Contactname') ?></h6>
			<p><?= h($contact->contactname) ?></p>
			<h6 class="subheader"><?= __('Country') ?></h6>
			<p><?= $contact->has('country') ? $this->Html->link($contact->country->name, ['controller' => 'Countries', 'action' => 'view', $contact->country->id]) : '' ?></p>
			<h6 class="subheader"><?= __('Zip') ?></h6>
			<p><?= $contact->has('zip') ? $this->Html->link($contact->zip->name, ['controller' => 'Zips', 'action' => 'view', $contact->zip->id]) : '' ?></p>
			<h6 class="subheader"><?= __('Address') ?></h6>
			<p><?= h($contact->address) ?></p>
			<h6 class="subheader"><?= __('Phone') ?></h6>
			<p><?= h($contact->phone) ?></p>
			<h6 class="subheader"><?= __('Email') ?></h6>
			<p><?= h($contact->email) ?></p>
			<h6 class="subheader"><?= __('Contactsource') ?></h6>
			<p><?= $contact->has('contactsource') ? $this->Html->link($contact->contactsource->name, ['controller' => 'Contactsources', 'action' => 'view', $contact->contactsource->id]) : '' ?></p>
		</div>
		<div class="large-2 larege-offset-1 columns numbers end">
			<h6 class="subheader"><?= __('Id') ?></h6>
			<p><?= $this->Number->format($contact->id) ?></p>
		</div>
		<div class="large-2 columns dates end">
			<h6 class="subheader"><?= __('Birth') ?></h6>
			<p><?= h($contact->birth) ?></p>
			<h6 class="subheader"><?= __('Created') ?></h6>
			<p><?= h($contact->created) ?></p>
			<h6 class="subheader"><?= __('Modified') ?></h6>
			<p><?= h($contact->modified) ?></p>
		</div>
		<div class="large-2 columns booleans end">
			<h6 class="subheader"><?= __('Active') ?></h6>
			<p><?= $contact->active ? __('Yes') : __('No'); ?></p>
		</div>
	</div>
	<div class="row texts">
		<div class="columns large-9">
			<h6 class="subheader"><?= __('Comment') ?></h6>
			<?= $this->Text->autoParagraph(h($contact->comment)); ?>
		</div>
	</div>
</div>
