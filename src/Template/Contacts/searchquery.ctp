<?php
echo $this->Html->script('sanga.contacts.searchquery.js', ['block' => true]);
?>
<div class="contacts form large-10 medium-9 columns">
<?= $this->Form->create() ?>
	<fieldset>
		<legend><?= __('Queries'); ?></legend>
	<?php
		//echo $this->Form->input('name');
		echo $this->Form->input('xzip',
									['type' => 'text',
									'label' => __('City')]);
		echo $this->Form->input('zip_id',
									['type' => 'hidden']);
		echo $this->Form->input('area', ['label' => __('Area')]);
		echo $this->Form->input('xgroup',
									['type' => 'text',
									 'label' => __('Group')]);
		echo $this->Form->input('group_id', ['type' => 'hidden']);
	?>
	</fieldset>
<?= $this->Form->button(__('Search')) ?>
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