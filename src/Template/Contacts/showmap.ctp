<?= $this->Html->css('googleMaps.css', ['block' => true]) ?>

<div class="sidebar-wrapper columns large-2 medium-2 hide-for-small-only">
    <nav class="side-nav">
        <ul>
            <li><?= $this->Html->link(__('Everybody'), ['action' => 'showmap']) ?></li>
            <li><?= $this->Html->link(__('Accessible'), ['action' => 'showmap', 'accessible']) ?></li>
            <li><?= $this->Html->link(__('Own'), ['action' => 'showmap', 'owned']) ?></li>
        </ul>
    </nav>
</div>


<div class="content-wrapper large-10 medium-10 small-12 columns">
    <div class="row">
        <h1><?= __('{0} contacts on map', count($result)) ?></h1>
    </div>

    <div id="map" class="row"></div>

    <?php
    $c = '';
    foreach ($result as $r) {
        $c .= '{
                lat:' . $r->lat . ',
                lng:' . $r->lng;
        if (isset($r->zip->zip)) {
            $c .= ',
                data:{
                    zip:' . $r->zip->zip . ',
                    city:"' . $r->zip->name . '"
                }';
        }
        $c .= '},';
    }
    ?>

    <?= $this->Html->scriptStart(['block' => true]) ?>
    var contacts = [<?= $c ?>];
    <?= $this->Html->scriptEnd() ?>
</div>

<?= $this->Html->script('sanga.map.min', ['block' => true]) ?>
<?= $this->Html->script('https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js', ['block' => true]) ?>
<?= $this->Html->script('https://maps.google.com/maps/api/js?key=AIzaSyCNmvEo-Ogi4ArqgU6oLVDy-oT_S8bMaEY&callback=initMap&language=' . $lang, ['block' => true]) ?>