<?php
$this->assign('title', 'Kapcsolatok / Új');
$this->Html->addCrumb('Kapcsolatok', '/contacts');
$this->Html->addCrumb('Új', '/contacts/add');
?>
<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('List Contacts'), ['action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('List Countries'), ['controller' => 'Countries', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Country'), ['controller' => 'Countries', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Zips'), ['controller' => 'Zips', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Zip'), ['controller' => 'Zips', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Contactsources'), ['controller' => 'Contactsources', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Contactsource'), ['controller' => 'Contactsources', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Histories'), ['controller' => 'Histories', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New History'), ['controller' => 'Histories', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Groups'), ['controller' => 'Groups', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Group'), ['controller' => 'Groups', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Linkups'), ['controller' => 'Linkups', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Linkup'), ['controller' => 'Linkups', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
	</ul>
</div>
<div class="contacts form large-10 medium-9 columns">
<?= $this->Form->create($contact) ?>
	<fieldset>
		<legend><?= __('Add Contact'); ?></legend>
	<?php
		echo $this->Form->autocomplete('name', ['select' => false, 'source' => 'searchname', 'label' => 'Ismert név', 'title' => 'A kapcsolat ismert neve, pl avatott név, becenév']);
		echo $this->Form->autocomplete('contactname', ['select' => false, 'source' => 'searchname', 'label' => 'Név', 'title' => 'A kapcsolat hivatalos neve, pl polgári név, cégnév']);
		echo $this->Form->input('country_id', ['options' => $countries, 'default' => '1', 'empty' => 'Egyéb']);
		echo $this->Form->autocomplete('zip_id', ['source' => '../zips/searchzip', 'label' => __('Zip')]);
		echo $this->Form->input('address');
		echo $this->Form->input('phone');
		echo $this->Form->input('email');
		echo $this->Form->input('birth', ['type' => 'text', 'label' => 'Születési dátum']);
		echo $this->Form->input('active', ['checked' => true, 'title' => 'Az inaktív kapcsolatok az akik eltűntek, eltávoztak, elérhetetlenek, stb.']);
		echo $this->Form->input('comment', ['title' => 'Másodlagos elérhetőségek, egyéb megjegyzések']);
		echo $this->Form->input('contactsource_id', ['options' => $contactsources, 'empty' => '---Válassz---', 'label' => 'A kapcsolat forrása', 'title' => 'Hogyan kerültünk vele kapcsolatba?']);
		echo $this->Form->input('groups._ids', ['options' => $groups, 'empty' => '---Válassz---', 'title' => 'Melyik csoportokba tartozik']);
		print '<div class="addlinkups">';
			echo $this->Form->input('linkups._ids', ['type' => 'select', 'multiple' => 'checkbox',
													 'options' => $linkups,
													 'value' => $linkupsSwitched,
													 'label' => 'Kapcsolati területek',
													 'title' => 'Mely témákban vagyunk kapcsolatban']);
		print '</div>';
		echo $this->Form->input('users._ids', ['options' => $users, 'default' => $this->Session->read('Auth.User.id'), 'empty' => '---Válassz---', 'label' => 'Kapcsolattartók']);
	?>
	</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
</div>
