<div class="sidebar-wrapper columns large-2 medium-2 hide-for-small-only">
    <nav class="side-nav">
        <ul>
            <li><?= $this->Html->link(__('New Contacts Skill'), ['action' => 'add']) ?></li>
            <li><?= $this->Html->link(__('List Contacts'), ['controller' => 'Contacts', 'action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('New Contact'), ['controller' => 'Contacts', 'action' => 'add']) ?> </li>
            <li><?= $this->Html->link(__('List Skills'), ['controller' => 'Skills', 'action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('New Skill'), ['controller' => 'Skills', 'action' => 'add']) ?> </li>
        </ul>
    </nav>
</div>
<!-- sidebar wrapper -->

<div class="content-wrapper large-10 medium-10 small-12 columns">
    <div class="row">
        <div class="contactsSkills index large-10 medium-9 columns">
            <table cellpadding="0" cellspacing="0">
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('contact_id') ?></th>
                        <th><?= $this->Paginator->sort('skill_id') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($contactsSkills as $contactsSkill) : ?>
                    <tr>
                        <td>
                            <?= $contactsSkill->has('contact') ? $this->Html->link($contactsSkill->contact->contactname, ['controller' => 'Contacts', 'action' => 'view', $contactsSkill->contact->id]) : '' ?>
                        </td>
                        <td>
                            <?= $contactsSkill->has('skill') ? $this->Html->link($contactsSkill->skill->name, ['controller' => 'Skills', 'action' => 'view', $contactsSkill->skill->id]) : '' ?>
                        </td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $contactsSkill->contact_id]) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $contactsSkill->contact_id]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $contactsSkill->contact_id], ['confirm' => __('Are you sure you want to delete # {0}?', $contactsSkill->contact_id)]) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= $this->element('paginator') ?>
        </div>
    </div>
</div>