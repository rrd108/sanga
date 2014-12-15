<?php
//print $this->Html->script('gmap3.min.js');
//print $this->Html->script('http://maps.google.com/maps/api/js?sensor=false&amp;language=hu');
print $this->Html->script('sanga.contacts.view.js', ['block' => true]);
?>
<div id="tabs" class="row">
	<div class="actions columns large-2 medium-3">
		<h3><?= __('Actions') ?></h3>
		<ul class="side-nav">
			<li id="tabnav-1"><a href="#tabs-1">Személyi adatok</a></li>
			<li id="tabnav-2"><a href="#tabs-2"><?= __('Family') ?></a></li>
			<li id="tabnav-3"><a href="#tabs-3"><?= __('Workplace and skills') ?></a></li>
			<li id="tabnav-4"><a href="#tabs-4">Történések</a></li>
			<li id="tabnav-5"><a href="#tabs-5"><?= __('Groups') ?></a></li>
			<li id="tabnav-6"><a href="#tabs-6"><?= __('Finances') ?></a></li>
		</ul>
	</div>
	<div id="tabs-1" class="contacts view large-10 medium-9 columns">
		<?= $this->Html->link(__('Edit'), ['action' => 'edit', $contact->id], ['class' => 'tag tag-shared fr']) ?>
		<h2><?= h($contact->name) ?></h2>
		<div class="row">
			<div class="large-11 columns strings">
				<h6 class="subheader"><?= __('Name') ?></h6>
				<p>&nbsp;<?= h($contact->name) ?></p>
				<h6 class="subheader"><?= __('Contactname') ?></h6>
				<p>&nbsp;<?= h($contact->contactname) ?></p>
				<h6 class="subheader"><?= __('Contact person') ?></h6>
				<?php if (!empty($contact->users)): ?>
					<p>
					<?php
						$myContact = false;
						foreach ($contact->users as $users){
							print '&nbsp;' . h($users->name);
							if($users->id == $this->Session->read('Auth.User.id')){
								$myContact = true;
							}
						}
					?>
					</p>
				<?php endif; ?>
				<h6 class="subheader"><?= __('Address') ?></h6>
				<p>
					&nbsp;<?= $contact->has('zip') ? $this->Html->link($contact->zip->zip . ' ' . $contact->zip->name, ['controller' => 'Zips', 'action' => 'view', $contact->zip->id]) : '' ?>
					&nbsp;<?= h($contact->address) ?>
				</p>
				<h6 class="subheader"><?= __('Phone') ?></h6>
				<p>&nbsp;<?= h($contact->phone) ?></p>
				<h6 class="subheader"><?= __('Email') ?></h6>
				<p>&nbsp;<?= h($contact->email) ?></p>
				<h6 class="subheader"><?= __('Birth') ?></h6>
				<p>&nbsp;
					<?php
					if($contact->birth){
						print h($contact->birth->format('Y-m-d'));
					}
					?>
				</p>
				<h6 class="subheader"><?= __('Sex') ?></h6>
				<p>&nbsp;
					<?php
					if($contact->sex == 1){
						print __('Male');
					}
					else if($contact->sex == 2){
						print __('Female');
					}
					else{
						print __('Unknown');
					}
					?>
				</p>
				<h6 class="subheader"><?= __('Contactsource') ?></h6>
				<p>&nbsp;<?= $contact->has('contactsource') ? $this->Html->link($contact->contactsource->name, ['controller' => 'Contactsources', 'action' => 'view', $contact->contactsource->id]) : '' ?></p>
				<h6 class="subheader"><?= __('Active') ?></h6>
				<p>&nbsp;<?= $contact->active ? __('Yes') : __('No'); ?></p>
				<h6 class="subheader"><?= __('Comment') ?></h6>
				<?= $this->Text->autoParagraph(h($contact->comment)); ?>
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
		<?= $this->Html->link(__('Edit'), ['action' => 'edit', $contact->id], ['class' => 'tag tag-shared fr']) ?>
		<h2><?= h($contact->name) ?></h2>
		<div class="row">
			<div class="large-11 columns strings">
				<h6 class="subheader"><?= __('Family Id') ?></h6>
				<p><?= $this->Number->format($contact->family_id) ?></p>
				<?php
				foreach($family as $familymember){
					print $familymember->id . ' ' . $familymember->name . ' ' . $familymember->contactname . '<br>';
				}
				?>
			</div>
		</div>
	</div>
	<div id="tabs-3" class="contacts view large-10 medium-9 columns">
		<?= $this->Html->link(__('Edit'), ['action' => 'edit', $contact->id], ['class' => 'tag tag-shared fr']) ?>
		<h2><?= h($contact->name) ?></h2>
		<div class="row">
			<div class="large-11 columns strings">
				<h6 class="subheader"><?= __('Workplace') ?></h6>
				<p>&nbsp;<?= h($contact->workplace) ?></p>
				<h6 class="subheader"><?= __('Skills') ?></h6>
				<?php if (!empty($contact->skills)): ?>
					<p>
					<?php foreach ($contact->skills as $skills): ?>
						<span class="tag tag-viewable">
							<?php print h($skills->name); ?>
						</span>
					<?php endforeach; ?>
					</p>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div id="tabs-4" class="contacts view large-10 medium-9 columns">
		<?= $this->Html->link(__('Edit'), ['action' => 'edit', $contact->id], ['class' => 'tag tag-shared fr']) ?>
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
				<td><?php print $history->date->format('Y-m-d'); ?></td>
				<td>
					<?php
					if(isset($history->user->name)){
						print $history->user->name;
					}
					?>
				</td>
				<td>
					<?php
					if($history->group){
						print $history->group->name;
					}
					?>
				</td>
				<td><?= h($history->event->name) ?></td>
				<td><?= h($history->detail) ?></td>
				<td class="r">
					<?php
						if(isset($history->unit->name)){
							print h($this->Number->currency($history->quantity, $history->unit->name));
						}
						else{
							print h($history->quantity);
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
						print "\n" .
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