<tr>
	<?php
	echo $this->Form->create(null,
								['id' => 'hForm',
								 'url' => [
										   'controller' => 'Histories',
										   'action' => 'add'
										   ]
								 ]);
	?>
	<?php
	if ( ! isset($e_showContact) || $e_showContact) :
	?>
	<td>
		<?php
		echo $this->Form->input('contact_id', ['type' => 'hidden']);
		echo $this->Form->input('xcontact_id', ['type' => 'text', 'label' => false]);
		?>
	</td>
	<?php
	else :
		echo $this->Form->input('target_group_id', ['type' => 'hidden', 'value' => $e_group->id]);
	endif;
	?>
	<td>
		<?php
		echo $this->Form->input('date',
									['label' => false,
									 'value' => date('Y-m-d')]);
		?>
	</td>
	<td id="uName">
		<?php
		echo $this->request->session()->read('Auth.User.name');
		?>
	</td>
	<td>
		<?php
		if (isset($e_group)) {
			echo h($e_group->name);
		} else {
			echo $this->Form->input('group_id', ['type' => 'hidden']);
			echo $this->Form->input('xgroup_id', ['label' => false, 'type' => 'text']);
		}
		?>
	</td>
	<td>
		<?php
		echo $this->Form->input('event_id', ['type' => 'hidden']);
		echo $this->Form->input('xevent_id', ['label' => false, 'type' => 'text']);
		?>
	</td>
	<td>
		<?php
		echo $this->Form->input('detail', ['label' => false]);
		?>
	</td>
	<td>
		<?php
		echo $this->Form->input('quantity', [
											'label' => false,
											'class' => 'quantity'
											]);
		echo $this->Form->input('unit_id', ['type' => 'hidden']);
		echo $this->Form->input('xunit_id', ['label' => false,
										   'class' => 'thin',
										   'type' => 'text'])
		?>
	</td>
	<td id="hInfo">
		<?php
			echo $this->Form->submit('ajaxsave.png', ['id' => 'hsave']);
			echo $this->Form->end();
		?>
	</td>
</tr>