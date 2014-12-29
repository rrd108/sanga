<?php
foreach($users as $user){
	/*if ($this->request->params['action'] == 'view') {
	}*/

	//if ($this->request->params['action'] == 'add') {
		if ($this->Session->read('Auth.User.id') == $user->id) {
			$checked = 'checked="checked"';
			$css = 'mine';
		} else {
			$checked = '';
			$css = 'viewable';
		}
	//}
	
	echo '<span class="tag tag-'.$css.'">';
	echo '<input type="checkbox"
				id="users-ids-'.$user->id.'"
				'.$checked.'
				value="'.$user->id.'"
				name="users[_ids][]">';
	echo '<label for="users-ids-'.$user->id.'">'.$user->name.'</label>';
	echo '</span> ';
}
?>