<?php
echo '<p>';
	echo sprintf('Hi, You asked a password recovery on %s. Click on the link below to reset your password.', $baseUrl);
echo '</p>';

echo '<a href="' . $resetlink . '">';
	echo __('Click here to Reset Your Password');
echo '</a>';

echo '<p>';
	echo __('Or visit this link:');
echo '<br>';

echo '<p>';
	echo'<a href="' . $resetlink . '">' . $resetlink . '</a>';
echo '</p>';

echo '<p>';
	echo __('If you do not want to change your password just ignore this message.');
echo '</p>';
?>
