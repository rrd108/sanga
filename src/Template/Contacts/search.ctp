<div class="contacts form large-10 medium-9 columns">
<?= $this->Form->create() ?>
	<fieldset>
		<legend><?= __('Search'); ?></legend>
	<?php
		echo $this->Form->autocomplete('zip_id', ['source' => 'zips/searchzip', 'label' => __('Zip')]);
		echo $this->Form->input('area');
		echo $this->Form->autocomplete('group_id', ['source' => 'groups/searchgroup', 'label' => __('Group')]);
	?>
	</fieldset>
<?= $this->Form->button(__('Search')) ?>
<?= $this->Form->end() ?>
</div>
<div class="contacts form large-10 medium-9 columns">
<?php
	foreach($result as $row){
		print $row->name . ' ' . $row->zip->zip . ' ' . $row->zip->name . ' ' . intval($row->distance) . ' km<br>';
	}
?>
</div>