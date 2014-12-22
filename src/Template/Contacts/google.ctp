<?php
if(isset($authUrl)){
	echo $this->Html->link('Connect', $authUrl);
}

if(isset($contacts)){
	$i = 0;
	foreach($contacts as $contact){
		//echo $contact['gId'];
		echo '<div class="gContact">';
			echo '<h4>';
				echo $contact['name'];
			echo '</h4>';
			echo '<div class="fl">';
				if(strlen($contact['photo']) < 32){
					echo $contact['photo'];
				}
				else if($contact['photo']){
					echo '<img src="data:image/jpeg;base64,' . base64_encode($contact['photo']) . '" />';
				}
			echo '</div>';
			echo '<div class="fl">';
				echo '<span class="fl">';
					echo ++$i;
				echo '</span>';
				echo '<span>';
					if($contact['email']){
						foreach($contact['email'] as $email){
							echo $email->address . ' ';
						}
					}
				echo '</span>';
				echo '<span>';
					if($contact['phone']){
						foreach($contact['phone'] as $phone){
							echo $phone->uri . ' ';
						}
					}
				echo '</span>';
				echo '<span>';
					if($contact['address']){
						foreach($contact['address'] as $address){
							echo $address->{'$t'};
						}
					}
				echo '</span>';
				echo '<span>';
					echo $contact['updated'];
				echo '</span>';
			echo '</div>';
		echo '</div>';
		if($i % 3 == 0){
			echo '<hr style="lear:left;">';
		}
	}
}
?>