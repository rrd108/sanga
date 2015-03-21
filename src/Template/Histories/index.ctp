<div class="row">
	<div class="column large-12">
<?php
echo $this->Html->script('sanga.add.history.entry.js', ['block' => true]);
echo $this->Html->script('sanga.histories.index.js', ['block' => true]);

echo $this->element('ajax-images');
?>
<div class="histories index columns">
	<?php
	echo $this->Form->create(null,
								['id' => 'hForm',
								 'url' => [
										   'controller' => 'Histories',
										   'action' => 'add'
										   ]
								 ]);
	?>
	<table id="hTable" cellpadding="0" cellspacing="0">
	<thead>
		<tr>
			<th><?= $this->Paginator->sort('contact_id') ?></th>
			<th><?= $this->Paginator->sort('date') ?></th>
			<th><?= $this->Paginator->sort('user_id') ?></th>
			<th><?= $this->Paginator->sort('group_id') ?></th>
			<th><?= $this->Paginator->sort('event_id') ?></th>
			<th><?= $this->Paginator->sort('detail') ?></th>
			<th><?= $this->Paginator->sort('quantity') ?></th>
			<th class="actions"><?= __('Actions') ?></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>
				<?php
				echo $this->Form->input('contact_id', ['type' => 'hidden']);
				echo $this->Form->input('xcontact_id', ['type' => 'text', 'label' => false]);
				?>
			</td>
			<td>
				<?php
				echo $this->Form->input('date',
											['label' => false,
											 'value' => date('Y-m-d'),
											 'class' => 'dontdel']);
				?>
			</td>
			<td id="uName">
				<?php
				echo $this->Session->read('Auth.User.name');
				?>
			</td>
			<td>
				<?php
				echo $this->Form->input('group_id', ['type' => 'hidden']);
				echo $this->Form->input('xgroup_id', ['label' => false, 'type' => 'text']);
				?>
			</td>
			<td>
				<?php
				echo $this->Form->input('event_id', ['type' => 'hidden']);
				echo $this->Form->input('xevent_id', ['label' => false, 'type' => 'text']);
				?>
			</td>
			<td>
				<?php
				echo $this->Form->input('detail', ['label' => false]);
				?>
			</td>
			<td>
				<?php
				/*echo $this->Form->input('quantity');
				echo $this->Form->input('unit_id', ['options' => $units]);*/
				?>
			</td>
			<td id="hInfo">			
				<?php
				//echo $this->Form->input('family');
				?>
			</td>
		</tr>
		
		<?php foreach ($histories as $history): ?>
		<tr>
			<td>
				<?= $history->has('contact') ? $this->Html->link($history->contact->name, ['controller' => 'Contacts', 'action' => 'view', $history->contact->id]) : '' ?>
			</td>
			<td><?= $history->date->format('Y-m-d') ?></td>
			<td>
				<?= $history->has('user') ? $this->Html->link($history->user->name, ['controller' => 'Users', 'action' => 'view', $history->user->id]) : '' ?>
			</td>
			<td>
				<?= $history->has('group') ? $this->Html->link($history->group->name, ['controller' => 'Groups', 'action' => 'view', $history->group->id]) : '' ?>
			</td>
			<td>
				<?= $history->has('event') ? $this->Html->link($history->event->name, ['controller' => 'Events', 'action' => 'view', $history->event->id]) : '' ?>
			</td>
			<td><?= h($history->detail) ?></td>
			<td><?= h($history->quantity) ?></td>
			<td class="actions">
				<?= $this->Html->link(__('Edit'), ['action' => 'edit', $history->id]) ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
	</table>
	<?php
	echo $this->Form->end();
	?>
	<div class="paginator">
		<ul class="pagination centered">
		<?php
			echo $this->Paginator->prev('< ' . __('previous'));
			echo $this->Paginator->numbers();
			echo $this->Paginator->next(__('next') . ' >');
		?>
		</ul>
		<div class="pagination-counter"><?= $this->Paginator->counter() ?></div>
	</div>
</div>
	</div>
</div>
