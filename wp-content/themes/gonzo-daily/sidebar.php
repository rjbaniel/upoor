	<div id="sidebarFrame">
	<?php
if ( function_exists('dynamic_sidebar') ) {
	if ( !dynamic_sidebar('top') ) {
		include (TEMPLATEPATH . '/sidebar_top.php');
	}
	if ( !dynamic_sidebar('left') ) {
		include (TEMPLATEPATH . '/sidebar_left.php');
	}
	if ( !dynamic_sidebar('right') ) {
		include (TEMPLATEPATH . '/sidebar_right.php');
	}
} else {
	include (TEMPLATEPATH . '/sidebar_top.php');
	include (TEMPLATEPATH . '/sidebar_left.php');
	include (TEMPLATEPATH . '/sidebar_right.php');
	
}
?>
	</div>