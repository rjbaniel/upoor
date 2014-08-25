<?php get_header(); ?>

<h2><?php _e('Not Found',TEMPLATE_DOMAIN); ?></h2>

<p><?php _e('Sorry, but the page you requested cannot be found.',TEMPLATE_DOMAIN); ?></p>

<?php include (TEMPLATEPATH . "/searchform.php"); ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
