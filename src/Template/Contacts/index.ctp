<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('New Contact'), ['action' => 'add']) ?></li>
		<li><?= $this->Html->link(__('List Zips'), ['controller' => 'Zips', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Zip'), ['controller' => 'Zips', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Families'), ['controller' => 'Families', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Family'), ['controller' => 'Families', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Contactsources'), ['controller' => 'Contactsources', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Contactsource'), ['controller' => 'Contactsources', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Histories'), ['controller' => 'Histories', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New History'), ['controller' => 'Histories', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Groups'), ['controller' => 'Groups', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Group'), ['controller' => 'Groups', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Skills'), ['controller' => 'Skills', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Skill'), ['controller' => 'Skills', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
	</ul>
</div>
<div class="contacts index large-10 medium-9 columns">
	<table cellpadding="0" cellspacing="0">
	<thead>
		<tr>
			<th><?= __('Contact Person') ?></th>
			<th><?= $this->Paginator->sort('name') ?></th>
			<th><?= $this->Paginator->sort('contactname') ?></th>
			<th><?= $this->Paginator->sort('zip_id') ?></th>
			<th><?= $this->Paginator->sort('address') ?></th>
			<th><?= $this->Paginator->sort('workplace') ?></th>
			<th class="actions"><?= __('Actions') ?></th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($contacts as $contact): ?>
		<tr>
			<?php //$this->Number->format($contact->id) ?>
			<td>
				<?php
					foreach($contact->users as $user){
						$css = ($user->id == $this->Session->read('Auth.User.id')) ? 'success' : 'info';
						print '<span class="tag tag-'.$css.'">' . $user->name . '</span>' . "\n";
					}
				?>
			</td>
			<td><?= h($contact->name) ?></td>
			<td><?= h($contact->contactname) ?></td>
			<td>
				<?= $contact->has('zip') ? $this->Html->link($contact->zip->zip . ' ' . $contact->zip->name, ['controller' => 'Zips', 'action' => 'view', $contact->zip->id]) : '' ?>
			</td>
			<td><?= h($contact->address) ?></td>
			<td><?= h($contact->workplace) ?></td>
			<td class="actions">
				<?= $this->Html->link(__('View'), ['action' => 'view', $contact->id]) ?>
				<?= $this->Html->link(__('Edit'), ['action' => 'edit', $contact->id]) ?>
				<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $contact->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contact->id)]) ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
	<div class="paginator">
		<ul class="pagination">
		<?php
			echo $this->Paginator->prev('< ' . __('previous'));
			echo $this->Paginator->numbers();
			echo $this->Paginator->next(__('next') . ' >');
		?>
		</ul>
		<p><?= $this->Paginator->counter() ?></p>
	</div>
</div>
