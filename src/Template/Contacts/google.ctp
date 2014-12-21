<?php
echo $this->Html->link('Connect', $authUrl);

$i = 0;
echo '<table>';
foreach($contacts as $contact){
	//echo $contact['gId'];
	echo '<tr>';
		echo '<td>';
			echo ++$i;
		echo '</td>';
		echo '<td>';
			if(strlen($contact['photo']) < 32){
				echo $contact['photo'];
			}
			else if($contact['photo']){
				echo '<img src="data:image/jpeg;base64,' . base64_encode($contact['photo']) . '" />';
			}
		echo '</td>';
		echo '<td>';
			echo $contact['name'];
		echo '</td>';
		echo '<td>';
			if($contact['email']){
				foreach($contact['email'] as $email){
					echo $email->address . ' ';
				}
			}
		echo '</td>';
		echo '<td>';
			if($contact['phone']){
				foreach($contact['phone'] as $phone){
					echo $phone->uri . ' ';
				}
			}
		echo '</td>';
		echo '<td>';
			if($contact['address']){
				foreach($contact['address'] as $address){
					echo $address->{'$t'};
				}
			}
		echo '</td>';
		echo '<td>';
			echo $contact['updated'];
		echo '</td>';
	echo '</tr>';
}
echo '</table>';
?>