<?php
//echo $this->Html->script('gmap3.min.js');
//echo $this->Html->script('http://maps.google.com/maps/api/js?sensor=false&amp;language=hu');
echo $this->Html->script('sanga.contacts.view.js', ['block' => true]);

//edit link
echo $this->Html->link($this->Html->image('edit.png'),
					   ['action' => 'edit', $contact->id],
					   ['id' => 'editlink', 'escape' => false]);

echo $this->element('ajax-images');

echo $this->Form->create($contact, ['id'=> 'editForm', 'action' => 'edit', $contact->id]);
?>
<div id="tabs" class="row">
	<div class="actions columns large-2 medium-3">
		<h3><?= __('Actions') ?></h3>
		<ul class="side-nav">
			<li id="tabnav-1"><a href="#tabs-1"><?= __('Personal data') ?></a></li>
			<li id="tabnav-2"><a href="#tabs-2"><?= __('Family') ?></a></li>
			<li id="tabnav-3"><a href="#tabs-3"><?= __('Workplace and skills') ?></a></li>
			<li id="tabnav-4"><a href="#tabs-4"><?= __('Histories') ?></a></li>
			<li id="tabnav-5"><a href="#tabs-5"><?= __('Groups') ?></a></li>
			<li id="tabnav-6"><a href="#tabs-6"><?= __('Finances') ?></a></li>
		</ul>
	</div>
	<div id="tabs-1" class="contacts view large-10 medium-9 columns">
		<h2><?= h($contact->name) ?></h2>
		<div class="row">
			<div class="large-11 columns strings">

				<h6 class="subheader"><?= __('Known name') ?></h6>
				<p>
					&nbsp;
					<span class="dta"><?= h($contact->name) ?></span>
					<?php
					echo $this->Form->input('name',
									   ['templates' => ['inputContainer' => '{{content}}'],
										'class' => 'editbox',
										'label' => false,
										'value' => h($contact->name),
										'title' => __('Like initiated name, nickname, etc')
										]);
					?>
				</p>

				<h6 class="subheader"><?= __('Contactname') ?></h6>
				<p>
					&nbsp;
					<span class="dta"><?= h($contact->contactname) ?></span>
					<?php
					echo $this->Form->input('contactname',
									   ['templates' => ['inputContainer' => '{{content}}'],
										'class' => 'editbox',
										'label' => false,
										'value' => h($contact->contactname),
										'title' => __('Civil name, company name, etc')
										]);
					?>
				</p>

				<h6 class="subheader"><?= __('Contact person') ?></h6>
				<p>
					&nbsp;
					<span class="dta">
						<?php
						if (!empty($contact->users)){
							$myContact = false;
							foreach ($contact->users as $usr){
								$css = 'viewable';
								if($usr->id == $this->Session->read('Auth.User.id')){
									$myContact = true;
									$css = 'mine';
								}
								echo '<span class="tag tag-' . $css . '">' . h($usr->name) . '</span> ';
							}
						}
						?>
					</span>
					<?php
					echo '<span class="editbox tag tag-danger">NOT IMPLEMENTED</span>';
					echo '<span class="editbox">' . $this->element('user_checkbox') . '</span>';
					?>
				</p>

				<h6 class="subheader"><?= __('Address') ?></h6>
				<p>
					&nbsp;
					<span class="dta"><?= $contact->zip->zip . ' ' . $contact->zip->name . ' ' .  h($contact->address) ?></span>
					<?php
					echo '<span class="editbox tag tag-danger">NOT IMPLEMENTED</span>';
					/*
					echo $this->Form->input('xzip', ['type' => 'text', 'label' => __('Zip')]);
					echo $this->Form->input('zip_id', ['type' => 'hidden']);
					*/
					echo $this->Form->input('zip_id',
											['templates' => ['inputContainer' => '{{content}}'],
											 'type' => 'text',
											'class' => 'editbox',
											'label' => false,
											 'value' => isset($contact->zip) ? $contact->zip->zip . ' ' . $contact->zip->name : ''
											 ]);
					echo $this->Form->input('address',
											['templates' => ['inputContainer' => '{{content}}'],
											'class' => 'editbox',
											'label' => false,
											 'value' => $contact->address
											 ]);

					?>
				</p>

				<h6 class="subheader"><?= __('Phone') ?></h6>
				<p>
					&nbsp;
					<span class="dta"><?= h($contact->phone) ?></span>
					<?php
					echo $this->Form->input('phone',
											['templates' => ['inputContainer' => '{{content}}'],
											'class' => 'editbox',
											'label' => false,
											'value' => $contact->phone
											]);
					?>
				</p>

				<h6 class="subheader"><?= __('Email') ?></h6>
				<p>
					&nbsp;
					<span class="dta"><?= h($contact->email) ?></span>
					<?php
					echo $this->Form->input('email',
											['templates' => ['inputContainer' => '{{content}}'],
											'class' => 'editbox',
											'label' => false,
											'value' => $contact->email
											]);
					?>
				</p>

				<h6 class="subheader"><?= __('Birth') ?></h6>
				<p>
					&nbsp;
					<span class="dta">
						<?php
						if($contact->birth){
							echo h($contact->birth->format('Y-m-d'));
						}
						?>
					</span>
					<?php
					echo '<span class="editbox tag tag-danger">NOT IMPLEMENTED</span>';
					?>
				</p>

				<h6 class="subheader"><?= __('Sex') ?></h6>
				<p>
					&nbsp;
					<span class="dta">
						<?php
						if($contact->sex == 1){
							echo __('Male');
						}
						else if($contact->sex == 2){
							echo __('Female');
						}
						else{
							echo __('Unknown');
						}
						?>
					</span>
					<?php
					echo '<span class="editbox tag tag-danger">NOT IMPLEMENTED</span>';
					?>
				</p>

				<h6 class="subheader"><?= __('Contactsource') ?></h6>
				<p>
					&nbsp;
					<span class="dta">
						<?= $contact->has('contactsource') ? $this->Html->link($contact->contactsource->name, ['controller' => 'Contactsources', 'action' => 'view', $contact->contactsource->id]) : '' ?>
					</span>
					<?php
					echo '<span class="editbox tag tag-danger">NOT IMPLEMENTED</span>';
					?>
				</p>					

				<h6 class="subheader"><?= __('Active') ?></h6>
				<p>
					&nbsp;
					<span class="dta"><?= $contact->active ? __('Yes') : __('No'); ?></span>
					<?php
					echo '<span class="editbox tag tag-danger">NOT IMPLEMENTED</span>';
					?>
				</p>

				<h6 class="subheader"><?= __('Comment') ?></h6>
				<p>
					&nbsp;
					<span class="dta">
						<?= h($contact->comment); ?>
					</span>
					<?php
					echo $this->Form->input('comment',
											['templates' => ['inputContainer' => '{{content}}'],
											'class' => 'editbox',
											'label' => false,
											'title' => __('Secondary emails, phones, others')
											]);
					?>
				</p>
			</div>
			<div id="mapsmall"></div>
				<?php
				/*
				if($contact->lat):
					$this->Html->scriptStart(['block' => true]);
					?>
					$(function(){
						$("#mapsmall").gmap3({
						  map:{
							options: {
							  center:[<?= $contact->lat ?>,<?= $contact->lng ?>],
							  zoom: 8,
							  mapTypeId: google.maps.MapTypeId.TERRAIN
							}
						  },
						 marker:{
							latLng:[<?= $contact->lat ?>,<?= $contact->lng ?>]
						 }
						});
					});
					<?php
					$this->Html->scriptEnd();
				endif;
				*/
				?>
		</div>
	</div>
	<div id="tabs-2" class="contacts view large-10 medium-9 columns">
		<h2><?= h($contact->name) ?></h2>
		<div class="row">
			<div class="large-11 columns strings">
				<h6 class="subheader"><?= __('Family') ?></h6>
				<p>&nbsp;<?= h($contact->family_id) ?></p>
				<ul>
				<?php
				foreach($family as $familymember){
					if($familymember->id != $contact->id){
						echo '<li>';
							$name = '';
							$name .= $familymember->name ? $familymember->name : '';
							$name .= $familymember->contactname ? ' (' . $familymember->contactname . ')' : '';
							echo $this->Html->link($name,
											   ['action' => 'view', $familymember->id]);
						echo '</li>';
					}
					//echo $familymember->id . ' ' . $familymember->name . ' ' . $familymember->contactname . '<br>';
				}
				?>
				</ul>
			</div>
		</div>
	</div>
	<div id="tabs-3" class="contacts view large-10 medium-9 columns">
		<h2><?= h($contact->name) ?></h2>
		<div class="row">
			<div class="large-11 columns strings">
				<h6 class="subheader"><?= __('Workplace') ?></h6>
				<p>&nbsp;<?= h($contact->workplace) ?></p>
				<h6 class="subheader"><?= __('Skills') ?></h6>
				<p>&nbsp;
					<?php if (!empty($contact->skills)): ?>
						<?php
						foreach ($contact->skills as $skills):
							echo '<span class="tag tag-shared">';
								echo h($skills->name);
							echo '</span> ';
						endforeach;
						?>
					<?php endif; ?>
				</p>
			</div>
		</div>
	</div>
	<div id="tabs-4" class="contacts view large-10 medium-9 columns">
		<h2><?= h($contact->name) ?></h2>
		<div class="column large-12">
		<?php if (!empty($histories)): ?>
		<table cellpadding="0" cellspacing="0">
			<tr>
				<th><?= $this->Paginator->sort('date') ?></th>
				<th><?= $this->Paginator->sort('User.name') ?></th>
				<th><?= $this->Paginator->sort('Group.name') ?></th>
				<th><?= $this->Paginator->sort('Event.name') ?></th>
				<th><?= $this->Paginator->sort('detail') ?></th>
				<th><?= $this->Paginator->sort('quantity') ?></th>
			</tr>
			<?php foreach ($histories as $history): ?>
			<tr>
				<td><?php echo $history->date->format('Y-m-d'); ?></td>
				<td>
					<?php
					if(isset($history->user->name)){
						echo $history->user->name;
					}
					?>
				</td>
				<td>
					<?php
					if($history->group){
						echo $history->group->name;
					}
					?>
				</td>
				<td><?= h($history->event->name) ?></td>
				<td><?= h($history->detail) ?></td>
				<td class="r">
					<?php
						if(isset($history->unit->name)){
							echo h($this->Number->currency($history->quantity, $history->unit->name));
						}
						else{
							echo h($history->quantity);
						}
					?>
				</td>
			</tr>
			<?php endforeach; ?>
		</table>
		<div class="paginator">
			<ul class="pagination">
			<?php
				echo $this->Paginator->prev('< ' . __('previous'));
				echo $this->Paginator->numbers();
				echo $this->Paginator->next(__('next') . ' >');
			?>
			</ul>
			<p><?= $this->Paginator->counter() ?></p>
		</div>
		<?php endif; ?>
		</div>
	</div>
	<div id="tabs-5" class="contacts view large-10 medium-9 columns">
		<h2><?= h($contact->name) ?></h2>
		<h3><?= __('Member') ?></h3>
		<div class="column large-12" id="member">
			<?php
				$cGroups = [];;
				if (!empty($contact->groups)):

					foreach ($contact->groups as $groups):
						$myGroup = false;
						$cGroups[] = $groups->id;
						if($groups->admin_user_id == $this->Session->read('Auth.User.id')){
							$myGroup = true;
						}
						$cssStyle = $groups->shared ? 'shared' : ($myGroup ? 'mine' : 'viewable');
						
						$draggable = '';
						if($myContact || $myGroup){
							$draggable = 'draggable';
						}
						
				?>
						<span class="<?= $draggable ?> member tag tag-<?= $cssStyle ?>"
								data-css="tag-<?= $cssStyle ?>" 
								data-id="<?= $groups->id ?>"><?= h($groups->name) ?></span>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>

		<h3><?= __('Not member') ?></h3>
		<div class="column large-12" id="notmember">
			<?php
				foreach($accessibleGroups as $group){
					if(!in_array($group->id, $cGroups)){
						//$cGroups[] = $group->id;
						$cssStyle = $group->shared ? 'info' : (($group->admin_user_id == $this->Session->read('Auth.User.id')) ? 'primary' : 'success');
						echo "\n" .
							'<span class="draggable notmember tag tag-default"
									data-css="tag-'.$cssStyle.'"
									data-id="' . $group->id . '">' .
								h($group->name) .
							'</span>';
					}
				}
			?>
		</div>
	</div>
	<div id="tabs-6" class="contacts view large-10 medium-9 columns">
		<h2><?= h($contact->name) ?></h2>
	</div>
</div>
<?php
echo $this->Form->end();
?>