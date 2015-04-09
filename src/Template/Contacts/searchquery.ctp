<?php
echo $this->Html->script('sanga.contacts.searchquery.js', ['block' => true]);
?>

<div class="contacts index columns large-12">
	<h1><?= __('Queries'); ?></h1>
	<?php
	echo $this->Form->create();
	
		echo '<div class="row" id="query-select-box">';
			echo '<h2>' . __('I want to see') . '</h2>';
			echo '<span class="tag tag-default" data-name="Contacts.contactname">' . __('Contactname') . '</span>';
			echo '<span class="tag tag-default" data-name="Contacts.legalname">' . __('Legalname') . '</span>';
			echo '<span class="tag tag-default" data-name="Contacts.zip.zip">' . __('Zip') . '</span>';
			echo '<span class="tag tag-default" data-name="Contacts.zip.name">' . __('City') . '</span>';
			echo '<span class="tag tag-default" data-name="Contacts.address">' . __('Address') . '</span>';
			echo '<span class="tag tag-default" data-name="Contacts.phone">' . __('Phone') . '</span>';
			echo '<span class="tag tag-default" data-name="Contacts.email">' . __('Email') . '</span>';
			echo '<span class="tag tag-default" data-name="Contacts.birth">' . __('Birth') . '</span>';
			echo '<span class="tag tag-default" data-name="Contacts.sex">' . __('Sex') . '</span>';
			echo '<span class="tag tag-default" data-name="Contacts.workplace">' . __('Workplace') . '</span>';
			echo '<span class="tag tag-default" data-name="Contacts.workplace_zip.zip">' . __('Workplace_zip') . '</span>';
			echo '<span class="tag tag-default" data-name="Contacts.workplace_zip.name">' . __('Workplace_city') . '</span>';
			echo '<span class="tag tag-default" data-name="Contacts.workplace_address">' . __('Workplace_address') . '</span>';
			echo '<span class="tag tag-default" data-name="Contacts.workplace_phone">' . __('Workplace_phone') . '</span>';
			echo '<span class="tag tag-default" data-name="Contacts.workplace_email">' . __('Workplace_email') . '</span>';
			//family members
			echo '<span class="tag tag-default" data-name="Contacts.contactsource">' . __('Contactsource') . '</span>';
			echo '<span class="tag tag-default" data-name="Contacts.comment">' . __('Comment') . '</span>';
			echo '<span class="tag tag-default" data-name="Contacts.created">' . __('Created') . '</span>';
			echo '<span class="tag tag-default" data-name="Contacts.modified">' . __('Modified') . '</span>';
		echo '</div>';
		
		echo '<h2>' . __('Where') . '</h2>';
		echo '<div class="row" id="where">';
		echo '</div>';

		echo $this->Form->button(__('Search'), ['class' => 'radius']);
	echo $this->Form->end();
	?>
</div>

<div class="contacts form large-10 medium-9 columns">
	<table cellpadding="0" cellspacing="0">
	<thead>
		<tr>
			<?php
			foreach ($selected as $field) {
				echo '<th>';
					echo __(ucwords($field));
				echo '</th>';
			}
			?>
		</tr>
	</thead>
	<tbody>
		<?php
		if (isset($result)) {
			foreach ($result as $res) {
				echo '<tr>';
				foreach ($selected as $field) {
					echo '<td>';
						echo $res->$field;
					echo '</td>';
				}
				echo '</tr>';
			}
		}
		?>
	</tbody>
	</table>
</div>