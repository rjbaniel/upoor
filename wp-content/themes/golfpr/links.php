<?php

/**
 * @package WordPress
 * @subpackage golfPR
 */

/*
Template Name: Links
*/
?>

<?php get_header(); ?>

<div id="content_wrapper">
	<div id="content_area">
		<div id="content">
	<div class="post">
<h1><?php _e('Links:', 'golfpr'); ?></h1>
<ul>
<?php wp_list_bookmarks(); ?>
</ul>

</div>
	</div>

<?php get_sidebar(); ?>

	<div class="clear"></div>
</div>
</div>
<?php get_footer(); ?>
