<?php get_header(); ?>

	<div id="content" class="narrowcolumn">

		<h2 class="center"><?php _e('Error 404 - Not Found',TEMPLATE_DOMAIN) ?></h2>

<?php _e("Looks like you're looking for something that isn't here.  Use the search box to try your search again.",TEMPLATE_DOMAIN); ?>
	<?php include (TEMPLATEPATH . '/searchform.php'); ?></div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
