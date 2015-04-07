<?php
echo $this->Html->script('sanga.groups.view.js', ['block' => true]);

echo $this->Html->image('remove.png', ['id' => 'ajaxremove']);
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
		echo $this->Form->button(__('Submit'),['class' => 'radius']);
		echo $this->Form->end();
		?>
		
		<h4 class="subheader"><?= __('Group Members') ?></h4>
		<p id="members">
			<?php
			if (!empty($group->contacts)) {
				foreach ($group->contacts as $contacts) {
					echo $this->Html->link(h($contacts->contactname),
										   ['controller' => 'Contacts',
											'action' => 'view', $contacts->id]);
				}
			}
			?>
		</p>
	</div>
</div>
