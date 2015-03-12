<div class="contacts form large-10 medium-9 columns">
<?= $this->Form->create() ?>
	<fieldset>
		<legend><?= __('Queries'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('zip_id');
		echo $this->Form->input('area');
		echo $this->Form->input('group_id');
	?>
	</fieldset>
<?= $this->Form->button(__('Search')) ?>
<?= $this->Form->end() ?>
</div>

<div class="contacts form large-10 medium-9 columns">
<?php
if (isset($result)) {
	foreach($result as $row){
		print $row->name . ' ' . $row->zip->zip . ' ' . $row->zip->name . ' ' . intval($row->distance) . ' km<br>';
	}
}
?>
</div>