<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('Edit Rbruteforcelog'), ['action' => 'edit', $rbruteforcelog->id]) ?> </li>
		<li><?= $this->Form->postLink(__('Delete Rbruteforcelog'), ['action' => 'delete', $rbruteforcelog->id], ['confirm' => __('Are you sure you want to delete # {0}?', $rbruteforcelog->id)]) ?> </li>
		<li><?= $this->Html->link(__('List Rbruteforcelogs'), ['action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Rbruteforcelog'), ['action' => 'add']) ?> </li>
	</ul>
</div>
<div class="rbruteforcelogs view large-10 medium-9 columns">
	<h2><?= h($rbruteforcelog->id) ?></h2>
	<div class="row">
		<div class="large-2 large-offset-1 columns numbers end">
			<h6 class="subheader"><?= __('Id') ?></h6>
			<p><?= $this->Number->format($rbruteforcelog->id) ?></p>
		</div>
	</div>
	<div class="row texts">
		<div class="columns large-9">
			<h6 class="subheader"><?= __('Data') ?></h6>
			<?= $this->Text->autoParagraph(h($rbruteforcelog->data)); ?>
		</div>
	</div>
</div>
