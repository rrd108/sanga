<div class="columns large-12">
    <h3><?= __('First 25 search results for "{0}"', h($term)) ?></h3>
    <ul>
        <?php foreach ($result as $contact) : ?>
        <li>
            <?= $this->Html->link(
                $contact['label'],
                [
                    'controller' => 'contacts',
                    'action' => 'view',
                    str_replace('c', '', $contact['value'])
                ],
                ['escape' => false]
            ) ?>
        </li>
        <?php endforeach; ?>
    </ul>
</div>