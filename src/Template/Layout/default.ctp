<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
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
