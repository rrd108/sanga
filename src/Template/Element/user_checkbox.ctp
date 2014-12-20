<?php
//on edit there may be more than one user who is the contact person, and none of them neccessary is
//the authenticated one, so first if statement should be changed
foreach($users as $user){
	if($this->Session->read('Auth.User.id') == $user->id){
		$checked = 'checked="checked"';
		$css = 'mine';
	}
	else{
		$checked = '';
		$css = 'viewable';
	}
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