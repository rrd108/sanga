<?php
if(isset($contacts)){
	echo $this->Html->script('sanga.contacts.google.js', ['block' => true]);
	echo $this->element('ajax-images');
	
	echo '<h1>';
		echo __('Select contacts to import by clicking on them.');
	echo '</h1>';
	
	$i = 0;
	foreach($contacts as $contact){
		++$i;
		echo '<div class="gContact">';
			echo $this->Html->link($contact['gId'],
								   ['action' => 'google_import', $contact['gId']],
									['class' => 'dn link']);
			echo '<span class="dn gId">' . $contact['gId'] . '</span>';
			echo '<h4 class="gName">';
				echo $contact['name'];
			echo '</h4>';
			echo '<div>';
				if(strlen($contact['photo']) < 32){
					echo $this->Html->image('contacts/noimg.png', ['title' => $contact['photo']]);
				}
				else if($contact['photo']){
					echo '<img class="gimg" src="data:image/jpeg;base64,' . base64_encode($contact['photo']) . '" />';
				}
			echo '</div>';
			echo '<div class="gdata">';
				echo '<p>';
					if($contact['email']){
						foreach($contact['email'] as $email){
							if(isset($email->primary)){
								echo '<span class="gEmail">' . $email->address . '</span> ';
							}
							else{
								echo '<span class="gComment">' . $email->address . '</span> ';
							}
						}
					}
				echo '</p>';
				echo '<p>';
					if($contact['phone']){
						foreach($contact['phone'] as $iP => $phone){
							if ($iP == 0) {
								echo '<span class="gPhone">' . str_replace('tel:', '', $phone->uri) . '</span> ';
							} else {
								echo '<span class="gComment">' . str_replace('tel:', '', $phone->uri) . '</span> ';
							}
						}
					}
				echo '</p>';
				echo '<p>';
					if($contact['address']){
						foreach($contact['address'] as $iA => $address){
							if ($iA == 0) {
								echo '<span class="gAddress">' . $address->{'$t'} . '</span> ';
							} else {
								echo '<span class="gComment">' . $address->{'$t'} . '</span> ';
							}
						}
					}
				echo '</p>';
				echo '<small>';
					echo $contact['updated'];
				echo '</small>';
			echo '</div>';
		echo '</div>';
		if($i % 3 == 0){
			echo '<hr style="lear:left;">';
		}
	}
	
	//TODO: paginator
	echo '<div class="paginator cl">';
		echo '<ul class="pagination">';
			//echo '<li class="prev disabled"><a href="">&lt; előző</a></li>';
			$pages = intval($contactsTotal / $maxResults);
			for($i = 1; $i <= $pages; $i++){
				$class = ($i == $page) ? 'class="active"' : '';
				echo '<li '.$class.'>';
					echo $this->Html->link($i, ['action' => 'google', $i]);
				echo '</li>';
			}
			//echo '<li class="active"><a href="">1</a></li>';
			//echo '<li class="next"><a href="/~rrd/sanga/Contacts?page=2" rel="next">következő &gt;</a></li>';
		echo '</ul>';
		echo '<p>' . $page . ' of ' . $pages . '</p>';
	echo '</div>';
}
?>