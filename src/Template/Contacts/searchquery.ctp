<?php
echo $this->Html->script('sanga.contacts.searchquery.js', ['block' => true]);
?>

<div class="contacts index columns large-12">
	<h1><?= __('Queries'); ?></h1>
	<?php
	echo $this->Form->create(null, ['type' => 'get']);
	
		echo '<div class="row" id="query-select-box">';
			echo '<h2>' . __('I want to see') . '</h2>';
			$filterFields = [
				'contactname' => __('Contactname'),
				'legalname' => __('Legalname'),
				'zip.zip' => __('Zip'),
				'zip.name' => __('City'),
				'address' => __('Address'),
				'phone' => __('Phone'),
				'email' => __('Email'),
				'birth' => __('Birth'),
				'sex' => __('Sex'),
				'workplace' => __('Workplace'),
				'workplace_zip.zip' => __('Workplace_zip'),
				'workplace_zip.name' => __('Workplace_city'),
				'workplace_address' => __('Workplace_address'),
				'workplace_phone' => __('Workplace_phone'),
				'workplace_email' => __('Workplace_email'),
				'contactsource' => __('Contactsource'),
				'comment' => __('Comment'),
				'created' => __('Created'),
				'modified' => __('Modified')
				];
			foreach($filterFields as $field => $label) {
				if ( ! empty($selected) && in_array($field, $selected)) {
					$css = 'tag-viewable';
				} else {
					$css = 'tag-default';
				}
				echo '<span class="tag ' . $css . '" data-name="Contacts.'.$field.'">';
					echo $label;
				echo '</span>';
			}
		echo '</div>';
		
		echo '<h2>' . __('Where') . '</h2>';
		echo '<div class="row" id="where">';
			//debug($this->request->data);
			$c = 0;
			foreach ($this->request->query as $name => $value) {
				if (strpos($name, 'connect_') === 0) {
					/*$connect = '<img
									class="fl"
									title="*és* Kattints a módosításhoz!"
									src="/~rrd/sanga/img/and.png">';*/
					if ($value == '&'){
						$img = 'and.png';
						$title = '*' . __('and') . '* ' . __('Click to change');
					} else {
						$img = 'or.png';
						$title = '*' . __('or') . '* ' . __('Click to change');
					}
					$connect = $this->Html->image($img,
												['class' => 'fl',
												 'title' => $title]);
					$connect .=	 '<input
									type="hidden"
									value="'. $value . '"
									name="connect_' . $dataName . '">';
				} elseif (strpos($name, 'condition_') === 0) {
					$dataName = str_replace('_', '.', str_replace('condition_', '', $name));
					echo '<div data-name="' . $dataName . '">';
						if ($c) {
							echo $connect;
							$connect = '';
						} else {
							$c++;
						}
						echo $this->Html->image('plus.png',
												['class' => 'fl',
												 'data-name' => $dataName]);
						echo '<label id="l' . str_replace('.', '_', $dataName) . '" for="' . $dataName . '">';
							echo __(ucwords(substr(strstr($dataName, '.'), 1)));
						echo '</label>';
						echo $this->Form->select($name . '[]',
												 ['&%' => __('contains'),
												  '&=' => '=',
												  '&!' => __('not'),
												  '&<' => '<',
												  '&>' => '>'],
												 ['value' => $value]);
				} elseif (strpos($name, 'field_') === 0) {
					echo '<input
							type="text"
							name="field_' . $dataName . '[]"
							value="' . $value[0] . '">';
					echo '</div>';
				}
			}
		echo '</div>';

		echo $this->Form->button(__('Search'), ['class' => 'radius']);
	echo $this->Form->end();
	?>
</div>

<div class="contacts form large-10 medium-9 columns">
	<?php
	echo '<h2>' . __('Search results') . '</h2>';
	
	if (isset($contacts)){
		echo $this->element('contacts_table',
							[
							 'fields' => $selected,
							 'contacts' => $contacts,
							 'settings' => false
							 ]);
	}
	?>

</div>