<?php
function cbox_remove_bbp_dynamic_role_setter() {
	remove_action( 'switch_blog', 'bbp_set_current_user_default_role' );
}
add_action( 'bbp_loaded', 'cbox_remove_bbp_dynamic_role_setter', 999 );
?>
