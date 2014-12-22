<?php
if(isset($authUrl)){
	echo $this->Html->link('Connect', $authUrl);
}

if(isset($contacts)){
	$i = 0;
	foreach($contacts as $contact){
		++$i;
		//echo $contact['gId'];
		echo '<div class="gContact">';
			echo '<h4>';
				echo $contact['name'];
			echo '</h4>';
			echo '<div class="gimg">';
				if(strlen($contact['photo']) < 32){
					echo $this->Html->image('contacts/noimg.png', ['title' => $contact['photo']]);
				}
				else if($contact['photo']){
					echo '<img src="data:image/jpeg;base64,' . base64_encode($contact['photo']) . '" />';
				}
			echo '</div>';
			echo '<div class="gdata">';
				echo '<p>';
					if($contact['email']){
						foreach($contact['email'] as $email){
							echo $email->address . ' ';
						}
					}
				echo '</p>';
				echo '<p>';
					if($contact['phone']){
						foreach($contact['phone'] as $phone){
							echo $phone->uri . ' ';
						}
					}
				echo '</p>';
				echo '<p>';
					if($contact['address']){
						foreach($contact['address'] as $address){
							echo $address->{'$t'};
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
}
?>