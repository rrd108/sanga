<!DOCTYPE html>
<html>

<head class="row">
    <?php echo $this->element('head'); ?>
</head>

<body>
    <header>
        <?php echo $this->element('menu'); ?>
    </header>
    <main id="container" class="row">
        <div class="column large-12"><?= $this->Flash->render() ?></div>
        <?= $this->fetch('content') ?>
    </main>
    <footer>
    </footer>
</body>

</html>