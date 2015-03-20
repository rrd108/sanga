<!DOCTYPE html>
<html>
<head>
	<?php echo $this->element('head'); ?>
</head>
<body>
	<header>
		<?php echo $this->element('menu'); ?>
	</header>
	<main id="container" class="primary-content">
		<?= $this->Flash->render() ?>
		<?= $this->fetch('content') ?>
	</main>
	<footer>
		<?php
			//debug($this->Notifications);
		?>
	</footer>
</body>
</html>
