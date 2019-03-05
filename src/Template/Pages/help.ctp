<div class="sidebar-wrapper columns large-2 medium-2 hide-for-small-only">
    <nav class="side-nav">
        <ul>
            <li><?= $this->Html->link(__('List Contacts'), ['controller' => 'Contacts', 'action' => 'index']) ?></li>
            <li><?= $this->Html->link(__('New Contact'), ['controller' => 'Contacts', 'action' => 'add']) ?></li>
            <li><?= $this->Html->link(__('List Histories'), ['controller' => 'Histories', 'action' => 'index']) ?></li>
            <li><?= $this->Html->link(__('New History'), ['controller' => 'Histories', 'action' => 'add']) ?></li>
        </ul>
    </nav>
</div>

<div class="content-wrapper large-10 medium-10 small-12 columns">
    <div class="row">
        <div class="large-10 medium-9 columns">
            <h1>Bemutató viedók</h1>
            <ul>
                <li><?= $this->Html->link('Új kapcsolat felvitele', $this->Html->webroot . '/files/uj_contact_felvitele.ogv') ?> (12 MB)</li>
            </ul>

        </div>
    </div>
    <div class="row">
        <div class="large-10 medium-9 columns">
            <h1>Gyakori kérdések</h1>
            <dl>
                <dt>Hogyan tudom módosítani a kapcsolat adatait?</dt>
                <dd>
                    Ha az egérrel rámutatsz az adatra (pl a kapcsolat nevére) akkor jobb oldalon megjelenik egy kis ceruza ikon.
                    Erre kattintva az adat szerkeszthetővé válik. Ha átírtad akkor a beviteli mező mellett megjelenik egy kis pipa, a mentéshez erre kell rákattintani.
                </dd>
            </dl>

            <p>Ha bármi kérdésed van írj egy értesítést <?= $this->Html->link('rrd', ['controller' => 'Notifications', 'action' => 'add', 2]) ?>-nek!</p>
        </div>
    </div>
</div>
