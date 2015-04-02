<div class="sidebar-wrapper">
	<nav class="side-nav">
		<ul>
        <li><?= $this->Html->link(__('Sample import file'), $this->Html->webroot . '/files/contact_csv-import.xlsx') ?></li>
		</ul>
	</nav>
</div>
<!-- sidebar wrapper -->

<div class="content-wrapper">
	<div class="row">
		<h1><?= __('Contact Import') ?></h1>
		<div class="imports index large-10 medium-9 columns">
			<?php
			echo $this->Form->create(null, ['type' => 'file']);
			echo $this->Form->input('file', ['type' => 'file']);
			echo $this->Form->submit();
			echo $this->Form->end();
			?>
		</div>
	</div>
	
	<div class="row">
		<h2><?= __('Imported') ?></h2>
		<div class="imports index large-10 medium-9 columns">
			<p class="message success">
				<?= __('Imported {0} contacts', $imported) ?>
			</p>
		</div>
	</div>

	<div class="row">
		<h3><?= __('Errors') ?></h3>
		<div class="imports index large-10 medium-9 columns">
			<p class="message error">
				<?= __('Not imported {0} contacts', $notImported) ?>
			</p>
			<?php
			//debug($fields);
			//debug($errors);
			echo '<table>';
				echo $this->Html->tableHeaders($fields);
				foreach ($errors as $e) {
					echo '<tr>';
						foreach ($fields as $field) {
							echo '<td>';
								if (isset($e['data'][$field])) {
									if (isset($e['errors'][$field])) {
										echo '<span class="message error" title="'.$e['errors'][$field].'">';
											echo $e['data'][$field];
										echo '</span>';
									} else{
										echo $e['data'][$field];
									}
								}
							echo '</td>';
						}
					echo '</tr>';
				}
			echo '</table>';
			/*
			echo $this->Form->create(null, ['type' => 'file']);
			echo $this->Form->input('contactname');
			echo $this->Form->input('legalname');
			echo $this->Form->input('zip_id', ['options' => $zips]);
			echo $this->Form->input('address');
			echo $this->Form->input('phone');
			echo $this->Form->input('email');
			echo $this->Form->input('birth');
			echo $this->Form->input('comment');
			echo $this->Form->input('contactsource_id', ['options' => $contactsources, 'empty' => '---Válassz---']);
			echo $this->Form->input('skills._ids', ['options' => $skills, 'empty' => '---Válassz---']);
			echo $this->Form->input('groups._ids', ['options' => $groups, 'empty' => '---Válassz---']);
			echo $this->Form->submit();
			echo $this->Form->end();
			*/
			?>
		</div>
	</div>
</div>
