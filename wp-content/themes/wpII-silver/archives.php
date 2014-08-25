<?php
/*
Template Name: Archives
*/
?>

<?php get_header(); ?>

<div id="content">

<?php include (TEMPLATEPATH . '/searchform.php'); ?>

<h2><?php _e('Archives by Month:', TEMPLATE_DOMAIN);?></h2>
	<ul>
		<?php wp_get_archives('type=monthly'); ?>
	</ul>

<h2><?php _e('Archives by Subject:', TEMPLATE_DOMAIN);?></h2>
	<ul>
		 <?php wp_list_categories(); ?>
	</ul>

</div>

<?php get_footer(); ?>
