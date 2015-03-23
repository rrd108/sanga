<div class="row">
<?php
echo $this->Html->script('sanga.contacts.searchquery.js', ['block' => true]);
?>
<div class="contacts form large-6 medium-8 small-centered columns">
<h2><?= __('Queries'); ?></h2>
<?= $this->Form->create() ?>
	
	<?php
		//echo $this->Form->input('name');
		echo '<div class="row"><div class="column large-12">';
		echo $this->Form->input('xzip',
									['type' => 'text',
									'label' => __('City')]);
		echo '</div></div>';
		echo '<div class="row"><div class="column large-12">';
		echo $this->Form->input('zip_id',
									['type' => 'hidden']);

		echo '</div></div>';
		echo '<div class="row"><div class="column large-12">';
		echo $this->Form->input('area', ['label' => __('Area')]);
		echo '</div></div>';
		echo '<div class="row"><div class="column large-12">';
		echo $this->Form->input('xgroup',
									['type' => 'text',
									 'label' => __('Group')]);
		echo '</div></div>';
		echo '<div class="row"><div class="column large-12">';
		echo $this->Form->input('group_id', ['type' => 'hidden']);
		echo '</div></div>';
	?>

<div class="row"><div class="column large-12">
<?= $this->Form->button(__('Search'), ['class' => 'radius']) ?>
</div></div>
<?= $this->Form->end() ?>
</div>

<div class="contacts form large-10 medium-9 columns">
<?php
if (isset($result)) {
	foreach($result as $row){
		echo $row->name . ' ';
		if (isset($row->zip)) {
			echo $row->zip->zip . ' ';
			echo $row->zip->name . ' ';
		}
		echo intval($row->distance) . ' km<br>';
	}
}
?>
</div>
</div>