<?php
use Cake\Utility\Hash;

/**
 * @param $group
 * @param $userId
 * @return string
 */
function setGroupCss($group, $userId)
{
    if ($group->shared) {
        return 'viewable';
    } elseif ($group->admin_user_id == $userId) {
        return 'mine';
    } else {
        return 'shared';
    }
}
?>
<table cellpadding="0" cellspacing="0">
<thead>
    <tr>
        <th>
            <?php
            if ($settings) {
                echo $this->Html->image(
                    'settings.png',
                    [
                        'id' => 'settings',
                        'title' => _('Choose columns to display')
                    ]
                );
            }
            ?>
        </th>

        <?php
        foreach ($fields as $field) {
            $tdWidth = $field == 'Groups.name' ? 'id="groups"' : '';
            echo '<th '.$tdWidth.'>';
                if (in_array($field, ['contactname', 'legalname'])) {
                    echo $this->Paginator->sort(__($field));
                } else {
                    if (isset($fieldNames)) {
                        echo $fieldNames[$field];
                    } else {
                        echo __(ucwords($field));
                    }
                }
            echo '</th>';
        }
        ?>
    </tr>
</thead>
<tbody>
    <?php foreach ($contacts as $contact): ?>
    <tr>
        <td>
            <?php
            if (file_exists(WWW_ROOT . 'img/contacts/' . $contact->id . '.jpg')) {
                $img = $this->Html->image(
                    'contacts/' . $contact->id . '.jpg',
                    ['class' => 'fl', 'width' => 100, 'height' => 100]
                );
            } else {
                $img = $this->Html->image('contact' . $contact->sex . '.png');
            }
            echo $this->Html->link(
                $img,
                ['action' => 'view', $contact->id],
                ['escape' => false, 'title' => __('View')]
            );
            ?>
        </td>
        <?php
        foreach($fields as $field) {
            echo '<td>';
                switch ($field) {
                    case 'zip_id' :
                        echo $contact->has('zip') ? $contact->zip->zip . ' ' . $contact->zip->name : '' ;
                        break;
                    case 'Zips.zip' :
                        echo $contact->has('zip') ? $contact->zip->zip : '' ;
                        break;
                    case 'Zips.name' :
                        echo $contact->has('zip') ? $contact->zip->name : '' ;
                        break;
                    case 'workplace_zip_id' :
                        echo $contact->has('workplace_zip') ? $contact->workplace_zip->zip . ' ' . $contact->workplace_zip->name : '' ;
                        break;
                    case 'WorkplaceZips.zip' :
                        echo $contact->has('workplace_zip') ? $contact->workplace_zip->zip : '' ;
                        break;
                    case 'WorkplaceZips.name' :
                        echo $contact->has('workplace_zip') ? $contact->workplace_zip->name : '' ;
                        break;
                    case 'birth' :
                        echo isset($contact->birth) ? h($contact->birth) : '';
                        break;
                    case 'contactsource_id' :
                        echo $contact->has('contactsource') ? '<span class="tag tag-shared">' . $contact->contactsource->name . '</span>' : '' ;
                        break;
                    case 'Contactsources.name' :
                        if ($contact->has('contactsource')) {
                            if ($contact->contactsource->name) {
                                echo '<span class="tag tag-shared">' . $contact->contactsource->name . '</span>';
                            }
                        }
                        break;
                    case 'Users.name' :
                        echo implode(', ', Hash::extract($contact->users, '{n}.name'));
                        break;

                    case 'users' :
                        if (isset($contact->users)){
                            foreach($contact->users as $user){
                                $css = ($user->id == $this->request->session()->read('Auth.User.id')) ? 'mine' : 'viewable';
                                print '<span class="tag tag-'.$css.'">' . $user->name . '</span>' . "\n";
                            }
                        }
                        break;
                    case 'skills' :
                        if (isset($contact->skills)){
                            foreach($contact->skills as $skill){
                                print '<span class="tag tag-shared">' . $skill->name . '</span>' . "\n";
                            }
                        }
                        break;
                    case 'groups' :
                        if (isset($contact->groups)){
                            foreach ($contact->groups as $group){
                                $css = setGroupCss($group, $this->request->session()->read('Auth.User.id'));
                                print '<span class="tag tag-'.$css.'">' . $group->name . '</span>' . "\n";
                            }
                        }
                        break;
                    case 'Groups.name' :
                        if (isset($contact->_matchingData['Groups'])){
                            $groupNames = explode('|', $contact->_matchingData['Groups']->name);
                            foreach ($groupNames as $groupName){
                                //TODO $css = setGroupCss($groupName, $this->request->session()->read('Auth.User.id'));
                                $css = 'shared';
                                print '<span class="tag tag-'.$css.'">' . $groupName . '</span>' . "\n";
                            }
                        }
                        break;
                    case 'Histories.date' :
                        if ($contact->_matchingData['Histories']) {
                            echo $contact->_matchingData['Histories']->date;
                        }
                        break;
                    case 'Histories.detail' :
                        if ($contact->_matchingData['Histories']) {
                            echo $contact->_matchingData['Histories']->detail;
                        }
                        break;
                    case 'Histories.Events.name' :
                        if ($contact->_matchingData['Events']) {
                            echo $contact->_matchingData['Events']->name;
                        }
                        break;
                    case 'Histories.Groups.name' :
                        if ($contact->_matchingData['Groups']) {
                            echo $contact->_matchingData['Groups']->name;
                        }
                        break;
                    case 'sex' :
                        if ($contact->sex == 1) {
                            print __('Male');
                        } elseif ($contact->sex == 2) {
                            print __('Female');
                        }
                        break;
                    default :
                        echo h($contact->$field);
                }
            echo '</td>';
        }
        ?>
    </tr>
    <?php endforeach; ?>
</tbody>
</table>
<div class="paginator">
    <ul class="pagination centered">
    <?php
        echo $this->Paginator->prev('< ' . __('previous'));
        echo $this->Paginator->numbers();
        echo $this->Paginator->next(__('next') . ' >');
    ?>
    </ul>
    <div class="pagination-counter">
        <?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} records out of
     {{count}} total, starting on record {{start}}, ending on {{end}}')) ?>
     </div>
</div>
