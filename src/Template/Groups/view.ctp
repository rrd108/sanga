<?php
echo $this->Html->script('sanga.groups.view.js', ['block' => true]);
echo $this->Html->css('daterangepicker.css', ['block' => true]);

echo $this->Html->script('sanga.add.history.entry.js', ['block' => true]);
echo $this->Html->script('sanga.histories.index.js', ['block' => true]);

echo $this->Html->script('moment.min.js', ['block' => true]);
echo $this->Html->script('jquery.daterangepicker.js', ['block' => true]);

?>
<div class="groups view columns">
	<h2><?= h($group->name) ?></h2>
	<div class="row">
		<div class="large-5 columns strings">
			<h6 class="subheader">
				<?= __('Description') ?> : 
				<?= h($group->description) ?>
			</h6>
			<h6 class="subheader">
				<?= __('Admin User') ?> : 
				<?= $group->admin_user->name ?>
			</h6>
			<h6 class="subheader">
				<?= __('Shared') ?> : 
				<?= $group->shared ? __('Yes') : __('No'); ?>
			</h6>
			<h6 class="subheader">
				<?= __('Members') ?> : 
				<?= count($group->contacts); ?>
			</h6>
		</div>
	</div>
</div>

<div class="related row">
	<div class="column large-12">
	<h4 class="subheader"><?= __('Has access as group member') ?></h4>
	<?php if (!empty($group->users)): ?>
		<ul>
		<?php foreach ($group->users as $users): ?>
		<li>
			<?= h($users->name) ?>
		</li>
		<?php endforeach; ?>
		</ul>
	<?php endif; ?>
	</div>
</div>

<div class="related row">
	<div class="column large-12">
		<h4 class="subheader"><?= __('Add Contacts to this Group') ?></h4>
		<?php
		echo $this->Form->create(null, ['id' => 'addMember']);
		echo $this->Form->input('name', ['label' => __('Contactname or Legalname')]);
		echo $this->Form->end();
		?>
		
		<h4 class="subheader"><?= __('Group Members') ?></h4>
		<ul id="members">
			<?php
			if (!empty($group->contacts)) {
				foreach ($group->contacts as $contacts) {
					echo '<li>';
						echo $this->Html->link($contacts->contactname ? h($contacts->contactname) : h($contacts->legalname),
													   ['controller' => 'Contacts',
														'action' => 'view', $contacts->id]);
						echo $this->Html->image('remove.png',
														['class' => 'ajaxremove',
														 'title' => __('Click to remove from group')]);
					echo '</li>';
				}
			}
			?>
		</ul>
	</div>
</div>


<div class="related row">
	<div class="column large-12">
		<h4 class="subheader"><?= __('Add History Event to all Group Members') ?></h4>
		<table id="hTable" cellpadding="0" cellspacing="0">
			<tr>
				<th><?= $this->Paginator->sort('date') ?></th>
				<th><?= $this->Paginator->sort('user_id') ?></th>
				<th><?= $this->Paginator->sort('group_id') ?></th>
				<th><?= $this->Paginator->sort('event_id') ?></th>
				<th><?= $this->Paginator->sort('detail') ?></th>
				<th><?= $this->Paginator->sort('quantity') ?></th>
				<th class="actions"><?= __('Actions') ?></th>
			</tr>
			<?= $this->element('history-add-form', ['e_showContact' => false, 'e_group' => $group]) ?>
		</table>
	</div>
</div>
