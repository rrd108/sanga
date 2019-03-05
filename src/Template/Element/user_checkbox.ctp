<?php
foreach($users as $user){

    if ($this->request->params['action'] == 'add') {
        if ($this->request->session()->read('Auth.User.id') == $user->id) {
            $checked = 'checked="checked"';
            $css = 'mine';
            $disabled = '';
        } else {
            $checked = '';
            $css = 'viewable';
            $disabled = 'disabled="disabled"';
        }
    }

    echo '<span class="label '.$css.'">';
    echo '<input type="checkbox"
                id="users-ids-'.$user->id.'"
                '.$checked.'
                value="'.$user->id.'"
                '.$disabled.'
                name="users[_ids][]">';
    echo '<label for="users-ids-'.$user->id.'">'.$user->name.'</label>';
    echo '</span> ';
}
?>