<!DOCTYPE html>
<html>

<head>
    <?php echo $this->element('head'); ?>
</head>

<body>
    <header>
        <?php echo $this->element('menu'); ?>
    </header>
    <main id="container" class="row align-center">
        <?php if ($this->request->getSession()->read('Flash')) : ?>
        <div class="column large-12 small-12"><?= $this->Flash->render() ?></div>
        <?php endif; ?>
        <?= $this->fetch('content') ?>
    </main>
    <footer></footer>
    <?= $this->fetch('script') ?>
</body>
</html>