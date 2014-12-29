<?php
if(isset($authUrl)){
	echo '<p>'.__('Please click the "Connect" link here to import your Google contacts. You will be redirected to Google, where you should give access to Sanga.').'</p>';
	echo $this->Html->link('Connect', $authUrl);
}
?>