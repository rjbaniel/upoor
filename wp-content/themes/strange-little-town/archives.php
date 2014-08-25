<?php
/*
Template Name: Archives
*/
?>

<?php get_header(); ?>

<?php include (TEMPLATEPATH . '/searchform.php'); ?>

	<h2><?php _e('Archives by Month:', 'slt'); ?></h2>
	<ul>
		<?php wp_get_archives('type=monthly'); ?>
	</ul>

	<h2><?php _e('Archives by Subject:', 'slt'); ?></h2>
	<ul>
		 <?php wp_list_categories(); ?>
	</ul>

<?php get_footer(); ?>
