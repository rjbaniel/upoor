<?php
//Custom functionality for your CBOX Child Theme.
require_once( 'engine/includes/custom.php' );

add_filter('bbp_after_get_forum_favorite_link_parse_args', changeFavoriteAfter);

add_filter('bbp_after_get_forum_subscribe_link_parse_args', changeSubscribeBefore);

function changeFavoriteAfter($r) {
	$r['after'] = '';
	return $r;
}

function changeSubscribeBefore($r) {
	$r['before'] = '';
	return $r;
}

/** Add Group to query var (added by Dan) **/
function add_group_var_filter( $vars ) {
	array_push( $vars, 'group' );
	return $vars;
}
add_filter( 'query_vars', 'add_group_var_filter');

/**
 * Set this to true to put Infinity into developer mode. Developer mode will refresh the dynamic.css on every page load.
 */
define( 'INFINITY_DEV_MODE', true );
?>
