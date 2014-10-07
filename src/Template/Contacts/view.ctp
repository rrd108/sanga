<?php
$this->Html->scriptStart(['block' => true]);
?>
$(function() {
	$( "#tabs" ).tabs({active : 0}).addClass( "ui-tabs-vertical ui-helper-clearfix" );
	$( "#tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
});
<?php
$this->Html->scriptEnd();
?>
<div id="tabs" class="row">
	<div class="actions columns large-2 medium-3">
		<h3><?= __('Actions') ?></h3>
		<ul class="side-nav">
			<li><a href="#tabs-1">Személyi adatok</a></li>
			<li><a href="#tabs-2">Történések</a></li>
			<li><a href="#tabs-3">Kapcsolati területek</a></li>
			<li><a href="#tabs-4">Csoportok</a></li>
		</ul>
	</div>
	<div id="tabs-1" class="contacts view large-10 medium-9 columns">
		<h2><?= h($contact->name) ?></h2>
		<div class="row">
			<div class="large-11 columns strings">
				<h6 class="subheader"><?= __('Name') ?></h6>
				<p>&nbsp;<?= h($contact->name) ?></p>
				<h6 class="subheader"><?= __('Contactname') ?></h6>
				<p>&nbsp;<?= h($contact->contactname) ?></p>
				<h6 class="subheader"><?= __('Contact person') ?></h6>
				<?php if (!empty($contact->users)): ?>
					<?php foreach ($contact->users as $users): ?>
						<p>&nbsp;<?= h($users->realname) ?></p>
					<?php endforeach; ?>
				<?php endif; ?>
				<h6 class="subheader"><?= __('Zip') ?></h6>
				<p>&nbsp;<?= $contact->has('zip') ? $this->Html->link($contact->zip->zip . ' ' . $contact->zip->name, ['controller' => 'Zips', 'action' => 'view', $contact->zip->id]) : '' ?></p>
				<h6 class="subheader"><?= __('Address') ?></h6>
				<p>&nbsp;<?= h($contact->address) ?></p>
				<h6 class="subheader"><?= __('Phone') ?></h6>
				<p>&nbsp;<?= h($contact->phone) ?></p>
				<h6 class="subheader"><?= __('Email') ?></h6>
				<p>&nbsp;<?= h($contact->email) ?></p>
				<h6 class="subheader"><?= __('Birth') ?></h6>
				<p>&nbsp;<?= h($contact->birth) ?></p>
				<h6 class="subheader"><?= __('Contactsource') ?></h6>
				<p>&nbsp;<?= $contact->has('contactsource') ? $this->Html->link($contact->contactsource->name, ['controller' => 'Contactsources', 'action' => 'view', $contact->contactsource->id]) : '' ?></p>
				<h6 class="subheader"><?= __('Active') ?></h6>
				<p>&nbsp;<?= $contact->active ? __('Yes') : __('No'); ?></p>
				<h6 class="subheader"><?= __('Comment') ?></h6>
				<?= $this->Text->autoParagraph(h($contact->comment)); ?>
			</div>
		</div>
	</div>
	<div id="tabs-2" class="contacts view large-10 medium-9 columns">
		<h2><?= h($contact->name) ?></h2>
		<div class="column large-12">
		<?php if (!empty($contact->histories)): ?>
		<table cellpadding="0" cellspacing="0">
			<tr>
				<th><?= __('Date') ?></th>
				<th><?= __('User') ?></th>
				<th><?= __('Linkup') ?></th>
				<th><?= __('Event') ?></th>
				<th><?= __('Detail') ?></th>
				<th><?= __('Quantity') ?></th>
			</tr>
			<?php foreach ($contact->histories as $histories): ?>
			<tr>
				<td><?php print substr($histories->date,0,13); ?></td>
				<td><?= h($histories->user->realname) ?></td>
				<td><?= h($histories->linkup->name) ?></td>
				<td><?= h($histories->event->name) ?></td>
				<td><?= h($histories->detail) ?></td>
				<td class="r">
					<?php
						if(isset($histories->unit->name)){
							print h($this->Number->currency($histories->quantity, $histories->unit->name));
						}
						else{
							print h($histories->quantity);
						}
					?>
				</td>
			</tr>
			<?php endforeach; ?>
		</table>
		<?php endif; ?>
		</div>
	</div>
	<div id="tabs-3" class="contacts view large-10 medium-9 columns">
		<h2><?= h($contact->name) ?></h2>
		<div class="column large-12">
			<div class="column large-12">
			<?php if (!empty($contact->linkups)): ?>
				<?php foreach ($contact->linkups as $linkups): ?>
					<span class="tag tag-success"><?= h($linkups->name) ?></span>
				<?php endforeach; ?>
			<?php endif; ?>
			</div>
		</div>
	</div>
	<div id="tabs-4" class="contacts view large-10 medium-9 columns">
		<h2><?= h($contact->name) ?></h2>
		<div class="column large-12">
		<?php if (!empty($contact->groups)): ?>
		<table cellpadding="0" cellspacing="0">
			<tr>
				<th><?= __('Id') ?></th>
				<th><?= __('Name') ?></th>
				<th><?= __('User Id') ?></th>
				<th class="actions"><?= __('Actions') ?></th>
			</tr>
			<?php foreach ($contact->groups as $groups): ?>
			<tr>
				<td><?= h($groups->id) ?></td>
				<td><?= h($groups->name) ?></td>
				<td><?= h($groups->user_id) ?></td>
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
</div>