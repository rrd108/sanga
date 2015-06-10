<?php
//echo $this->Html->script('gmap3.min.js');
//echo $this->Html->script('http://maps.google.com/maps/api/js?sensor=false&amp;language=hu');
echo $this->Html->script('sanga.contacts.view.js', ['block' => true]);
echo $this->Html->script('sanga.contacts.add.js', ['block' => true]);
echo $this->Html->script('sanga.add.history.entry.js', ['block' => true]);

if(isset($contact)) :

//edit link
echo $this->Html->link($this->Html->image('edit.png'),
					   ['action' => 'edit', $contact->id],
					   ['id' => 'editlink', 'escape' => false]);

echo $this->element('ajax-images');
?>
<div id="dialog">
	<h4><?= __('Show system events') ?></h4>
	<?php
	echo $this->Form->create($contact, ['id' => 'settingsForm']);
	echo $this->Form->input('systemevents',
							['type' => 'checkbox',
							 'label' => __('Show system events')]);

	echo $this->Form->input('sName', ['type' => 'hidden', 'value' => 'Contacts/view/history/system']);
	echo $this->Form->button(__('Submit'), ['id' => 'submitSettings', 'class' => 'radius']);
	echo $this->Form->end();
	?>
</div>

<div id="tabs">
	<div class="sidebar-wrapper">
		<nav class="side-nav">
			<ul class="side-nav">
				<li id="tabnav-1"><a href="#tabs-1"><?= __('Personal data') ?></a></li>
				<li id="tabnav-2"><a href="#tabs-2"><?= __('Family') ?></a></li>
				<li id="tabnav-3"><a href="#tabs-3"><?= __('Workplace and skills') ?></a></li>
				<li id="tabnav-4"><a href="#tabs-4"><?= __('Groups') ?></a></li>
				<li id="tabnav-5"><a href="#tabs-5"><?= __('Histories') ?></a></li>
				<li id="tabnav-6"><a href="#tabs-6"><?= __('Finances') ?></a></li>
				<li id="tabnav-7"><a href="#tabs-7"><?= __('Access') ?></a></li>
				<li id="tabnav-8"><a href="#tabs-8"><?= __('Send a mail') ?></a></li>
				<li id="tabnav-9"><a href="#tabs-9"><?= __('Documents') ?></a></li>
			</ul>
		</nav>
	</div>
	<div class="content-wrapper">
	<div class="row">	
	<?php
	echo $this->Form->create($contact, ['id'=> 'editForm', 'action' => 'edit']);
	?>
	
	<div id="tabs-1" class="contacts view large-10 medium-9 columns">
		<h2>
			<?= h($contact->contactname) ?>
			<?php
			if ($contact->google_id) {
				echo $this->Html->image('google.png');
			} else {
				echo $this->Html->link(
								$this->Html->image('google-inactive.png',
												   ['id' => 'gImg',
													'title' => __('Save to Google Contacts')]
												   ),
								['action' => 'google_save', $contact->id],
								['id' => 'gSave', 'escape' => false]);
			}
			?>
		</h2>
		<div class="row">
			<?php
			if (file_exists(WWW_ROOT . 'img/contacts/' . $contact->id . '.jpg')) {
				$img = $contact->id . '.jpg';
			} else {
				$img = 'noimg.png';
			}
			echo $this->Html->image('contacts/' . $img, ['class' => 'fl']);
			?>
			<div class="large-9 columns strings">

				<div class="row">
					<div class="column large-4">
						<label><?= __('Known name') ?></label>
					</div><!-- column -->
					<div class="column large-8">					
						<p class="ed">
							<span class="dta"><?= h($contact->contactname) ?></span>
							<?php
							echo $this->Form->input('contactname',
											   ['templates' => ['inputContainer' => '{{content}}'],
												'class' => 'editbox',
												'label' => false,
												'value' => h($contact->contactname),
												'title' => __('Like initiated name, nickname, etc')
												]);
							?>
						</p>
					</div><!-- column -->
				</div><!-- row -->

				<div class="row">
					<div class="column large-4">
						<label><?= __('Legal name') ?></label>
					</div><!-- column -->
					<div class="column large-8">
						<p class="ed">
							<span class="dta"><?= h($contact->legalname) ?></span>
							<?php
							echo $this->Form->input('legalname',
											   ['templates' => ['inputContainer' => '{{content}}'],
												'class' => 'editbox',
												'label' => false,
												'value' => h($contact->legalname),
												'title' =>  __('Civil name, official legal name, etc')
												]);
							?>
						</p>
					</div><!-- column -->
				</div><!-- row -->

				<div class="row">
					<div class="column large-4">
						<label><?= __('Contact person') ?></label>
					</div>
					<div class="column large-8">
						<p>
							<span>
								<?php
								if (!empty($contact->users)){
									$myContact = false;
									foreach ($contact->users as $usr){
										$css = 'viewable';
										if($usr->id == $this->request->session()->read('Auth.User.id')){
											$myContact = true;
											$css = 'mine';
										}
										echo '<span class="tag tag-' . $css . '">' . h($usr->name) . '</span> ';
									}
								}
								?>
							</span>
							<?php
							//contact person change - dev questions - on hold
							//echo '<span>' . $this->element('user_checkbox') . '</span>';
							?>
						</p>
					</div>
				</div>

				<div class="row">
					<div class="column large-4">
						<label><?= __('Address') ?></label>
					</div>
					<div class="column large-8">
					<p class="ed">
						<?php
						echo '<span class="dta zip zip-zip">';
							if(isset($contact->zip)){
								echo $contact->zip->zip;
							}
						echo '</span> ';
						echo '<span class="dta zip-name">';
							if(isset($contact->zip)){
								echo $contact->zip->name;
							}
						echo '</span> ';
						echo $this->Form->input('zip_id',
												['type' => 'hidden',
												 'value' => isset($contact->zip) ? $contact->zip->id : false]);
						
						echo $this->Form->input('xzip',
												['templates' => ['inputContainer' => '{{content}}'],
												 'type' => 'text',
												'class' => 'editbox zip',
												'label' => false,
												 'value' => isset($contact->zip) ? $contact->zip->zip : ''
												 ]);
						
						echo '<span class="dta addr address">';
							echo h($contact->address);
						echo '</span>';
						echo $this->Form->input('address',
												['templates' => ['inputContainer' => '{{content}}'],
												'class' => 'editbox addr',
												'label' => false,
												 'value' => $contact->address
												 ]);
	
						?>
					</p>
					</div>
				</div>

				<div class="row">
				<div class="column large-4">
					<label><?= __('Phone') ?></label>
				</div>
				<div class="column large-8">
					<p class="ed">
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
				</div></div>

				<div class="row">
				<div class="column large-4">
					<label><?= __('Email') ?></label>
				</div>
				<div class="column large-8">
					<p class="ed">
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
				</div></div>

				<div class="row">
				<div class="column large-4">
					<label><?= __('Birth') ?></label>
				</div>
				<div class="column large-8">
					<p class="ed">
						<span class="dta">
							<?php
							if($contact->birth){
								echo h($contact->birth->format('Y-m-d'));
							}
							?>
						</span>
						<?php
						echo $this->Form->input('birth',
												['templates' => ['inputContainer' => '{{content}}'],
												'type' => 'text',
												'class' => 'editbox',
												'label' => false,
												'value' => $contact->birth ? h($contact->birth->format('Y-m-d')) : null
												]);
						?>
					</p>
				</div></div>

				<div class="row">
				<div class="column large-4">
					<label><?= __('Sex') ?></label>
					</div>
					<div class="column large-8">
					<p class="ed">
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
						echo $this->Form->input('sex',
												['type' => 'radio',
												'options' => [1 => __('Male'), 2 => __('Female')],
												'templates' => ['inputContainer' => '<span class="editbox" id="sex">{{content}}</span>',
																'nestingLabel' => '{{input}}{{text}}'],
												'label' => false,
												'value' => $contact->sex
												]);
						?>
					</p>
				</div></div>

				<div class="row">
				<div class="column large-4">
					<label><?= __('Contactsource') ?></label>
					</div>
					<div class="column large-8">
					<p class="ed">
						<span class="dta">
							<?= $contact->has('contactsource') ? $this->Html->link($contact->contactsource->name, ['controller' => 'Contactsources', 'action' => 'view', $contact->contactsource->id]) : '' ?>
						</span>
						<?php
						echo '<span class="editbox tag tag-danger">NOT IMPLEMENTED</span>';
						?>
					</p>
				</div></div>

				<div class="row"><div class="column large-12">
					<label><?= __('Active') ?></label>
					<p class="ed">
						&nbsp;
						<span class="dta"><?= $contact->active ? __('Yes') : __('No'); ?></span>
						<?php
						echo $this->Form->input('active',
												['templates' => ['inputContainer' => '{{content}}'],
												'class' => 'editbox chg',
												'label' => false,
												'checked' => $contact->active,
												'value' => $contact->active
												]);
						?>
					</p>
				</div></div>

				<div class="row"><div class="column large-12">
					<label><?= __('Comment') ?></label>
					<p class="ed">
						<span class="dta">
							<?= nl2br(h($contact->comment)); ?>
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
				</div></div>
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
		<h2><?= h($contact->contactname) ?></h2>
		<div class="row">
			<div class="column large-9">
		<div class="row">
			<div class="large-4 columns strings">
				<label><?= __('Family') ?></label>
			</div>
			<div class="large-8 columns strings">
				<p class="ed">
					<?php
					//echo $contact->family_id;
					?>
						<span class="dta"></span>
						<?php
						foreach($family as $familymember){
							if($familymember->id != $contact->id){
								echo '<span class="tag tag-viewable draggable">';
									$name = '';
									$name .= $familymember->contactname ? $familymember->contactname : '';
									$name .= $familymember->legalname ? ' (' . $familymember->legalname . ')' : '';
									echo $this->Html->link($name,
													   ['action' => 'view', $familymember->id]);
								echo '</span> ';
							}
						}
						?>
					<?php
					echo $this->Form->input('family_member_id', ['type' => 'hidden']);
					echo $this->Form->input('xfamily',
											['templates' => ['inputContainer' => '{{content}}'],
											 'type' => 'text',
											 'class' => 'editbox family',
											 'label' => false
											 ]);
					?>
				</p>
				<div class="column large-12" id="notfamilymember">
					<div class="delete-close"></div>
				</div>
			</div>
		</div>
			</div>
		</div>
	</div>
	
	<div id="tabs-3" class="contacts view large-10 medium-9 columns">
		<h2><?= h($contact->contactname) ?></h2>
		<div class="row">
			<div class="large-9 columns strings">
				<div class="row">
					<div class="large-4 column">
						<label><?= __('Workplace') ?></label>
					</div>
					<div class="large-8 column">
						<p class="ed">
							
							<span class="dta"><?= h($contact->workplace) ?></span>
							<?php
							echo $this->Form->input('workplace',
													['templates' => ['inputContainer' => '{{content}}'],
													'class' => 'editbox',
													'label' => false,
													'value' => $contact->workplace
													]);
							?>
						</p>
					</div>
				</div>

				<div class="row">
					<div class="column large-4">
						<label><?= __('Workplace Address') ?></label>
					</div>
					<div class="column large-8">
					<p class="ed">
						<?php
						echo '<span class="dta workplace_zip workplace_zip-zip">';
							if(isset($contact->workplace_zip)){
								echo $contact->workplace_zip->zip;
							}
						echo '</span> ';

						echo '<span class="dta workplace_zip-name">';
							if(isset($contact->workplace_zip)){
								echo $contact->workplace_zip->name;
							}
						echo '</span> ';

						echo $this->Form->input('workplace_zip_id',
												['type' => 'hidden',
												 'value' => isset($contact->workplace_zip) ? $contact->workplace_zip->id : false]);
						
						echo $this->Form->input('xworkplace_zip',
												['templates' => ['inputContainer' => '{{content}}'],
												 'type' => 'text',
												'class' => 'editbox zip',
												'label' => false,
												 'value' => isset($contact->workplace_zip) ? $contact->workplace_zip->zip : ''
												 ]);
						
						echo '<span class="dta addr workplace_address">';
							echo h($contact->workplace_address);
						echo '</span>';

						echo $this->Form->input('workplace_address',
												['templates' => ['inputContainer' => '{{content}}'],
												'class' => 'editbox addr',
												'label' => false,
												 'value' => $contact->workplace_address
												 ]);
	
						?>
					</p>
					</div>
				</div>

				<div class="row">
					<div class="large-4 column">
						<label><?= __('Workplace Phone') ?></label>
					</div>
					<div class="large-8 column">
						<p class="ed">
							
							<span class="dta"><?= h($contact->workplace_phone) ?></span>
							<?php
							echo $this->Form->input('workplace_phone',
													['templates' => ['inputContainer' => '{{content}}'],
													'class' => 'editbox',
													'label' => false,
													'value' => $contact->workplace_phone
													]);
							?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="large-4 column">
						<label><?= __('Workplace Email') ?></label>
					</div>
					<div class="large-8 column">
						<p class="ed">
							
							<span class="dta"><?= h($contact->workplace_email) ?></span>
							<?php
							echo $this->Form->input('workplace_email',
													['templates' => ['inputContainer' => '{{content}}'],
													'class' => 'editbox',
													'label' => false,
													'value' => $contact->workplace_email
													]);
							?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="large-4 column">
						<label><?= __('Skills') ?></label>
					</div>
					<div class="large-8 column">
						<p class="ed">
							<span class="dta">
							<?php if (!empty($contact->skills)): ?>
								<?php
								foreach ($contact->skills as $skills):
									echo '<span class="tag tag-shared removeable" data-id="' . $skills->id . '">';
										echo h($skills->name);
									echo '</span> ';
								endforeach;
								?>
							<?php endif; ?>
							</span>
							<?php
							echo $this->Form->input('skills',
									['templates' => ['inputContainer' => '{{content}}'],
									 'class' => 'editbox',
									 'label' => false,
									 'value' => false,
									 'type' => 'text']);
							?>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<?php
	echo $this->Form->end();
	?>
	
	<div id="tabs-4" class="contacts view large-10 medium-9 columns">
		<h2><?= h($contact->contactname) ?></h2>
		<h3><?= __('Member') ?></h3>
		<div class="column large-12" id="member">
			<?php
				$cGroups = [];;
				if (!empty($contact->groups)):

					foreach ($contact->groups as $groups):
						$myGroup = false;
						$cGroups[] = $groups->id;
						if($groups->admin_user_id == $this->request->session()->read('Auth.User.id')){
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
						$cssStyle = $group->shared ? 'shared' : (($group->admin_user_id == $this->request->session()->read('Auth.User.id')) ? 'mine' : 'viewable');
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

	<div id="tabs-5" class="contacts view large-12 columns">
		<h2><?= h($contact->contactname) ?></h2>
		<div class="row">
			<div class="column large-12">
				<?php if (!empty($histories)): ?>
					<?php
					echo $this->Form->create(null,
												['id' => 'hForm',
												 'url' => [
														   'controller' => 'Histories',
														   'action' => 'add'
														   ]
												 ]);
					?>
					<table id="hTable" cellpadding="0" cellspacing="0">
						<thead>
							<tr>
								<th><?= $this->Html->image('settings.png',
										['id' => 'settings',
										 'title' => _('Settings')]) ?></th>
								<th><?= $this->Paginator->sort('date') ?></th>
								<th><?= $this->Paginator->sort('User.name') ?></th>
								<th><?= $this->Paginator->sort('Group.name') ?></th>
								<th><?= $this->Paginator->sort('Event.name') ?></th>
								<th><?= $this->Paginator->sort('detail') ?></th>
								<th><?= $this->Paginator->sort('quantity') ?></th>
								<th>&nbsp;&nbsp;&nbsp;&nbsp;</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td></td>
								<td>
									<?php
									echo $this->Form->input('contact_id',
																['type' => 'hidden',
																 'value' => $contact->id,
																 'class' => 'dontdel'
																 ]);
									echo $this->Form->input('date',
															['label' => false,
															 'value' => date('Y-m-d'),
															 'class' => 'dontdel']);
									?>
								</td>
								<td id="uName"><?= $this->request->session()->read('Auth.User.name') ?></td>
								<td>
									<?php
									echo $this->Form->input('group_id', ['type' => 'hidden']);
									echo $this->Form->input('xgroup_id', ['label' => false, 'type' => 'text']);
									?>
								</td>
								<td>
									<?php
									echo $this->Form->input('event_id', ['type' => 'hidden']);
									echo $this->Form->input('xevent_id', ['label' => false, 'type' => 'text']);
									?>
								</td>
								<td><?= $this->Form->input('detail', ['label' => false]) ?></td>
								<td>
									<?php
									echo $this->Form->input('quantity', [
																		 'label' => false,
																		 'class' => 'quantity'
																		 ]);
									echo $this->Form->input('unit_id', ['type' => 'hidden']);
									echo $this->Form->input('xunit_id', ['label' => false,
																		'class' => 'thin',
																		'type' => 'text']);
									?>
								</td>
								<td id="hInfo">
								</td>
							</tr>
							<?php foreach ($histories as $history): ?>
							<tr>
								<td></td>
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
								<td></td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
					<?php
					echo $this->Form->end();
					?>
					<div class="paginator">
						<ul class="pagination centered">
						<?php
							echo $this->Paginator->prev('< ' . __('previous'));
							echo $this->Paginator->numbers();
							echo $this->Paginator->next(__('next') . ' >');
						?>
						</ul>
						<div class="pagination-counter"><?= $this->Paginator->counter() ?></div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
	
	<div id="tabs-6" class="contacts view large-12 columns">
		<h2><?= h($contact->contactname) ?></h2>
		<div class="row">
		<div class="column large-12">
		<table id="hTable" cellpadding="0" cellspacing="0">
			<thead>
				<tr>
					<th><?= $this->Paginator->sort('date') ?></th>
					<th><?= $this->Paginator->sort('User.name') ?></th>
					<th><?= $this->Paginator->sort('Group.name') ?></th>
					<th><?= $this->Paginator->sort('Event.name') ?></th>
					<th><?= $this->Paginator->sort('detail') ?></th>
					<th><?= $this->Paginator->sort('quantity') ?></th>
					<th>&nbsp;&nbsp;&nbsp;&nbsp;</th>
				</tr>
			</thead>
				<?php
				$total = 0;
				foreach ($finances as $history):
				?>
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
								$total += $history->quantity;
								echo h($this->Number->currency($history->quantity, $history->unit->name));
							}
							else{
								echo h($history->quantity);
							}
						?>
					</td>
					<td></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
			<tfoot>
				<tr>
					<td><?= __('Total') ?></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td class="r">
						<?php
						if (isset($history->unit)) {
							echo h($this->Number->currency($total, $history->unit->name));
						}
						?>
					</td>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;</th>
				</tr>
			</tfoot>
		</table>
		</div>
		</div>
	</div>

	<div id="tabs-7" class="contacts view large-10 medium-9 columns">
		<h2><?= h($contact->contactname) ?></h2>
		<div class="row">
			<div class="column large-12">
				<h3><?= __('Has access as contact persons') ?></h3>
				<ul>
				<?php
				foreach ($hasAccess['contactPersons'] as $user) {
					echo '<li>' . $user->name . '</li>';
				}
				?>
				</ul>
				<h3><?= __('Has access via groups') ?></h3>
				<ul>
				<?php
				foreach ($hasAccess['groupMembers'] as $user) {
					echo '<li>';
						echo $user->name;
						if (isset($user->_matchingData['Groups']->name)) echo ' / ' . $user->_matchingData['Groups']->name;
					echo '</li>';
				}
				?>
				</ul>
				<h3><?= __('Has access via user groups') ?></h3>
				<ul>
				<?php
				foreach ($hasAccess['usergroupMembers'] as $user) {
					echo '<li>';
						echo $user->name;
						if (isset($user->_matchingData['Usergroups']->name)) echo ' / ' . $user->_matchingData['Usergroups']->name;
					echo '</li>';
				}
				?>
				</ul>
			</div>
		</div>
	</div>

	<div id="tabs-8" class="contacts view large-10 medium-9 columns">
		<h2><?= h($contact->contactname) ?></h2>
		<div class="row">
			<div class="column large-12">
				<?php if (h($contact->email)) : ?>
					<h6 class="subheader"><?= __('Sender') ?></h6>
					<?= $this->request->session()->read('Auth.User.email') ?>
					<h6 class="subheader"><?= __('To') ?></h6>
					<?= h($contact->email) ?>
					<?php
					echo $this->Form->input('subject');
					echo $this->Form->input('message',
											['type' => 'textarea']);
					echo $this->Form->button(__('Submit'), ['id' => 'sendmail']);
					?>
				
				<?php
				else :
					echo __('We do not have the contact\'s email address, so we can not send mail');
				endif;
				?>
			</div>
		</div>
	</div>

	<div id="tabs-9" class="contacts view large-10 medium-9 columns">
        <h2><?= h($contact->contactname) ?></h2>
        <div class="row">
        <div class="column large-12">

        <!-- Új dokumentum hozzáadása -->
        <h5><?= __('Upload new documents') ?></h5>
        <?php
            echo $this->Form->create(null,
                [
                    'url' => ['controller' => 'Contacts', 'action' => 'documentSave' ],
                    'type' => 'file'
                ]);
            echo $this->Form->input('document_title');
        ?>
        <label><?= __('File:') ?></label>
        <?php
            echo $this->Form->file('uploadfile');
            echo $this->Form->hidden('contactid', ['value' => $contact->id]);
            echo "<br>";
            echo $this->Form->submit();
            echo $this->Form->end();
        ?>
        <br><br>
		<table id="hTable" cellpadding="0" cellspacing="0">
			<thead>
				<tr>
					<th>&nbsp;&nbsp;</th>
					<th><?= __('Document title') ?></th>
					<th><?= __('Uploader') ?></th>
					<th><?= __('Size') ?></th>
					<th><?= __('Created') ?></th>
					<th>&nbsp;&nbsp;</th>
				</tr>
			</thead>
            <tbody>
                <?php foreach ($contact->documents as $document): ?>
                    <tr>
                        <td>
                        <?php
                            switch($document->file_type):
                                case 'application/pdf':
                                    echo $this->Html->image('doctype_icon_pdf.png');
                                    break;
                                case 'image/jpeg':
                                    echo $this->Html->image('doctype_icon_jpg.png');
                                    break;
                                case 'image/png':
                                    echo $this->Html->image('doctype_icon_png.png');
                                    break;
                                case 'text/plain':
                                    echo $this->Html->image('doctype_icon_txt.png');
                                    break;
                                default:
                                    echo $this->Html->image('doctype_icon_unk.png');
                            endswitch;
                        ?>
                        </td>
                        <td><?php echo $document->name; ?></td>
                        <td>
                            <?php
                                foreach($uploaders as $uploader):
                                    if($document->user_id == $uploader->id):
                                        echo $uploader->name;
                                    endif;
                                endforeach;
                            ?>
                        </td>
                        <td>
                            <?php
                                echo $this->Number->toReadableSize($document->size);
                            ?>
                        </td>
                        <td><?php echo $document->created; ?></td>
                        <td><?php echo $this->Html->link(__('Download'), ['action' => 'documentGet', $document->id]); ?></td>
                    </tr>
				<?php endforeach; ?>
			</tbody>
		</table>
        </div>
	</div>

</div>
</div>
</div>
<?php
else:
	echo '<h2>' . h($contactPersons->name) . '</h2>';
	echo '<h3>' . __('Has access as contact persons') . '</h3>';
	echo '<ul>';
	foreach ($contactPersons->users as $cp) {
		echo '<li>' . $cp->realname . '</li>';
	}
	echo '</ul>';
endif;
?>