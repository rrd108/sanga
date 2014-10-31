<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('Edit Contactsource'), ['action' => 'edit', $contactsource->id]) ?> </li>
		<li><?= $this->Form->postLink(__('Delete Contactsource'), ['action' => 'delete', $contactsource->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contactsource->id)]) ?> </li>
		<li><?= $this->Html->link(__('List Contactsources'), ['action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Contactsource'), ['action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Contacts'), ['controller' => 'Contacts', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Contact'), ['controller' => 'Contacts', 'action' => 'add']) ?> </li>
	</ul>
</div>
<div class="contactsources view large-10 medium-9 columns">
	<h2><?= h($contactsource->name) ?></h2>
	<div class="row">
		<div class="large-5 columns strings">
			<h6 class="subheader"><?= __('Name') ?></h6>
			<p><?= h($contactsource->name) ?></p>
		</div>
		<div class="large-2 large-offset-1 columns numbers end">
			<h6 class="subheader"><?= __('Id') ?></h6>
			<p><?= $this->Number->format($contactsource->id) ?></p>
		</div>
	</div>
</div>
<div class="related row">
	<div class="column large-12">
	<h4 class="subheader"><?= __('Related Contacts') ?></h4>
	<?php if (!empty($contactsource->contacts)): ?>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><?= __('Id') ?></th>
			<th><?= __('Name') ?></th>
			<th><?= __('Contactname') ?></th>
			<th><?= __('Zip Id') ?></th>
			<th><?= __('Address') ?></th>
			<th><?= __('Lat') ?></th>
			<th><?= __('Lng') ?></th>
			<th><?= __('Phone') ?></th>
			<th><?= __('Email') ?></th>
			<th><?= __('Birth') ?></th>
			<th><?= __('Sex') ?></th>
			<th><?= __('Workplace') ?></th>
			<th><?= __('Family Id') ?></th>
			<th><?= __('Contactsource Id') ?></th>
			<th><?= __('Active') ?></th>
			<th><?= __('Comment') ?></th>
			<th><?= __('Created') ?></th>
			<th><?= __('Modified') ?></th>
			<th class="actions"><?= __('Actions') ?></th>
		</tr>
		<?php foreach ($contactsource->contacts as $contacts): ?>
		<tr>
			<td><?= h($contacts->id) ?></td>
			<td><?= h($contacts->name) ?></td>
			<td><?= h($contacts->contactname) ?></td>
			<td><?= h($contacts->zip_id) ?></td>
			<td><?= h($contacts->address) ?></td>
			<td><?= h($contacts->lat) ?></td>
			<td><?= h($contacts->lng) ?></td>
			<td><?= h($contacts->phone) ?></td>
			<td><?= h($contacts->email) ?></td>
			<td><?= h($contacts->birth) ?></td>
			<td><?= h($contacts->sex) ?></td>
			<td><?= h($contacts->workplace) ?></td>
			<td><?= h($contacts->family_id) ?></td>
			<td><?= h($contacts->contactsource_id) ?></td>
			<td><?= h($contacts->active) ?></td>
			<td><?= h($contacts->comment) ?></td>
			<td><?= h($contacts->created) ?></td>
			<td><?= h($contacts->modified) ?></td>
			<td class="actions">
				<?= $this->Html->link(__('View'), ['controller' => 'Contacts', 'action' => 'view', $contacts->id]) ?>
				<?= $this->Html->link(__('Edit'), ['controller' => 'Contacts', 'action' => 'edit', $contacts->id]) ?>
				<?= $this->Form->postLink(__('Delete'), ['controller' => 'Contacts', 'action' => 'delete', $contacts->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contacts->id)]) ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
	<?php endif; ?>
	</div>
</div>
