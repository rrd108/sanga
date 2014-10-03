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
		<li><?= $this->Html->link(__('List Histories'), ['controller' => 'Histories', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New History'), ['controller' => 'Histories', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Groups'), ['controller' => 'Groups', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Group'), ['controller' => 'Groups', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Linkups'), ['controller' => 'Linkups', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Linkup'), ['controller' => 'Linkups', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
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
<div class="related row">
	<div class="column large-12">
	<h4 class="subheader"><?= __('Related Histories') ?></h4>
	<?php if (!empty($contact->histories)): ?>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><?= __('Id') ?></th>
			<th><?= __('Date') ?></th>
			<th><?= __('Contact Id') ?></th>
			<th><?= __('User Id') ?></th>
			<th><?= __('Detail') ?></th>
			<th><?= __('Amount') ?></th>
			<th><?= __('Event Id') ?></th>
			<th><?= __('Group Id') ?></th>
			<th><?= __('Created') ?></th>
			<th><?= __('Modified') ?></th>
			<th class="actions"><?= __('Actions') ?></th>
		</tr>
		<?php foreach ($contact->histories as $histories): ?>
		<tr>
			<td><?= h($histories->id) ?></td>
			<td><?= h($histories->date) ?></td>
			<td><?= h($histories->contact_id) ?></td>
			<td><?= h($histories->user_id) ?></td>
			<td><?= h($histories->detail) ?></td>
			<td><?= h($histories->amount) ?></td>
			<td><?= h($histories->event_id) ?></td>
			<td><?= h($histories->group_id) ?></td>
			<td><?= h($histories->created) ?></td>
			<td><?= h($histories->modified) ?></td>
			<td class="actions">
				<?= $this->Html->link(__('View'), ['controller' => 'Histories', 'action' => 'view', $histories->id]) ?>
				<?= $this->Html->link(__('Edit'), ['controller' => 'Histories', 'action' => 'edit', $histories->id]) ?>
				<?= $this->Form->postLink(__('Delete'), ['controller' => 'Histories', 'action' => 'delete', $histories->id], ['confirm' => __('Are you sure you want to delete # %s?', $histories->id)]) ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
	<?php endif; ?>
	</div>
</div>
<div class="related row">
	<div class="column large-12">
	<h4 class="subheader"><?= __('Related Groups') ?></h4>
	<?php if (!empty($contact->groups)): ?>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><?= __('Id') ?></th>
			<th><?= __('Name') ?></th>
			<th><?= __('Grouptype Id') ?></th>
			<th class="actions"><?= __('Actions') ?></th>
		</tr>
		<?php foreach ($contact->groups as $groups): ?>
		<tr>
			<td><?= h($groups->id) ?></td>
			<td><?= h($groups->name) ?></td>
			<td><?= h($groups->grouptype_id) ?></td>
			<td class="actions">
				<?= $this->Html->link(__('View'), ['controller' => 'Groups', 'action' => 'view', $groups->id]) ?>
				<?= $this->Html->link(__('Edit'), ['controller' => 'Groups', 'action' => 'edit', $groups->id]) ?>
				<?= $this->Form->postLink(__('Delete'), ['controller' => 'Groups', 'action' => 'delete', $groups->id], ['confirm' => __('Are you sure you want to delete # %s?', $groups->id)]) ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
	<?php endif; ?>
	</div>
</div>
<div class="related row">
	<div class="column large-12">
	<h4 class="subheader"><?= __('Related Linkups') ?></h4>
	<?php if (!empty($contact->linkups)): ?>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><?= __('Id') ?></th>
			<th><?= __('Name') ?></th>
			<th class="actions"><?= __('Actions') ?></th>
		</tr>
		<?php foreach ($contact->linkups as $linkups): ?>
		<tr>
			<td><?= h($linkups->id) ?></td>
			<td><?= h($linkups->name) ?></td>
			<td class="actions">
				<?= $this->Html->link(__('View'), ['controller' => 'Linkups', 'action' => 'view', $linkups->id]) ?>
				<?= $this->Html->link(__('Edit'), ['controller' => 'Linkups', 'action' => 'edit', $linkups->id]) ?>
				<?= $this->Form->postLink(__('Delete'), ['controller' => 'Linkups', 'action' => 'delete', $linkups->id], ['confirm' => __('Are you sure you want to delete # %s?', $linkups->id)]) ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
	<?php endif; ?>
	</div>
</div>
<div class="related row">
	<div class="column large-12">
	<h4 class="subheader"><?= __('Related Users') ?></h4>
	<?php if (!empty($contact->users)): ?>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><?= __('Id') ?></th>
			<th><?= __('Username') ?></th>
			<th><?= __('Password') ?></th>
			<th><?= __('Realname') ?></th>
			<th><?= __('Email') ?></th>
			<th><?= __('Phone') ?></th>
			<th><?= __('Active') ?></th>
			<th><?= __('Role') ?></th>
			<th><?= __('Created') ?></th>
			<th><?= __('Modified') ?></th>
			<th class="actions"><?= __('Actions') ?></th>
		</tr>
		<?php foreach ($contact->users as $users): ?>
		<tr>
			<td><?= h($users->id) ?></td>
			<td><?= h($users->username) ?></td>
			<td><?= h($users->password) ?></td>
			<td><?= h($users->realname) ?></td>
			<td><?= h($users->email) ?></td>
			<td><?= h($users->phone) ?></td>
			<td><?= h($users->active) ?></td>
			<td><?= h($users->role) ?></td>
			<td><?= h($users->created) ?></td>
			<td><?= h($users->modified) ?></td>
			<td class="actions">
				<?= $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'view', $users->id]) ?>
				<?= $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'edit', $users->id]) ?>
				<?= $this->Form->postLink(__('Delete'), ['controller' => 'Users', 'action' => 'delete', $users->id], ['confirm' => __('Are you sure you want to delete # %s?', $users->id)]) ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
	<?php endif; ?>
	</div>
</div>
<div id="map" class="row">
<?php
if($contact->lat){
	$place = 'latLng : ['.$contact->lat.','.$contact->lng.']';
}
else{
	$place = 'address : ' . $contact->country->name . ' ' . $contact->zip->name . ' ' . $contact->address;
}
$this->Html->scriptStart(['block' => true]);
?>
$(function() {
	$('#map').gmap3({
			map : {
				options : {
					zoom : 13,
					center : [<?php print $contact->zip->lat . ', ' . $contact->zip->lng; ?>]
					}
				},
			marker:{
				address: <?php print $place; ?>
				}
			});
});
<?php
$this->Html->scriptEnd();
?>
</div>
