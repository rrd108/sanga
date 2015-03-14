<div class="sidebar-wrapper">
	<nav class="side-nav">
		<ul>
			<li><?= $this->Html->link(__('Edit Skill'), ['action' => 'edit', $skill->id]) ?> </li>
			<li><?= $this->Form->postLink(__('Delete Skill'), ['action' => 'delete', $skill->id], ['confirm' => __('Are you sure you want to delete # {0}?', $skill->id)]) ?> </li>
			<li><?= $this->Html->link(__('List Skills'), ['action' => 'index']) ?> </li>
			<li><?= $this->Html->link(__('New Skill'), ['action' => 'add']) ?> </li>
			<li><?= $this->Html->link(__('List Contacts'), ['controller' => 'Contacts', 'action' => 'index']) ?> </li>
			<li><?= $this->Html->link(__('New Contact'), ['controller' => 'Contacts', 'action' => 'add']) ?> </li>
		</ul>
	</nav>
</div>
<!-- sidebar wrapper -->


<div class="content-wrapper">
	<div class="row">
		<div class="skills view large-10 medium-9 columns">
			<h2><?= h($skill->name) ?></h2>
			<div class="row">
				<div class="large-5 columns strings">
					<h6 class="subheader"><?= __('Name') ?></h6>
					<p><?= h($skill->name) ?></p>
				</div>
				<div class="large-2 large-offset-1 columns numbers end">
					<h6 class="subheader"><?= __('Id') ?></h6>
					<p><?= $this->Number->format($skill->id) ?></p>
				</div>
			</div>
		</div>
		<div class="related row">
			<div class="column large-12">
			<h4 class="subheader"><?= __('Related Contacts') ?></h4>
			<?php if (!empty($skill->contacts)): ?>
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
					<th><?= __('Active') ?></th>
					<th><?= __('Comment') ?></th>
					<th><?= __('Created') ?></th>
					<th><?= __('Modified') ?></th>
					<th><?= __('Contactsource Id') ?></th>
					<th class="actions"><?= __('Actions') ?></th>
				</tr>
				<?php foreach ($skill->contacts as $contacts): ?>
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
					<td><?= h($contacts->active) ?></td>
					<td><?= h($contacts->comment) ?></td>
					<td><?= h($contacts->created) ?></td>
					<td><?= h($contacts->modified) ?></td>
					<td><?= h($contacts->contactsource_id) ?></td>
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
	</div>
</div>
