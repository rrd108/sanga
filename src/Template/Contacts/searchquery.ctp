<?php
echo $this->Html->script('sanga.contacts.searchquery.js', ['block' => true]);
?>

	<div class="contacts index columns large-12">
		<h2><?= __('Queries'); ?></h2>
		<?php
		echo $this->Form->create();
		$this->Form->templates([
						'inputContainer' => '<div class="thin">{{content}}</div>'
						]);
		?>
			
			<?php
				echo '<div class="row">';
					echo $this->Form->input('name');
				echo '</div>';

				echo '<div class="row">';
					echo $this->Form->input('xzip',
											['type' => 'text',
											'label' => __('City'),
											 'class' => 'radius']);
					echo $this->Form->input('zip_id',
											['type' => 'hidden']);
		
				echo '</div>';
		
				echo '<div class="row">';
					echo $this->Form->input('area', ['label' => __('Area')]);
				echo '</div>';
		
				echo '<div class="row">';
					echo $this->Form->input('xgroup',
											['type' => 'text',
											 'label' => __('Group')]);
					echo $this->Form->input('group_id', ['type' => 'hidden']);
				echo '</div>';
				
				
				//result coloumns
			?>
		
			<?= $this->Form->button(__('Search'), ['class' => 'radius']) ?>
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