<?php
/*
Template Name: Archives
*/
?>

<?php get_header(); ?>

			<div class="post">

			

	<h2><?php _e('Archives by Month',TEMPLATE_DOMAIN);?></h2>
  		<ul>
    			<?php wp_get_archives('type=monthly&show_post_count=1'); ?>
 		</ul>

	<h2><?php _e('Archives by Category',TEMPLATE_DOMAIN);?></h2>
  		<ul>
     			<?php wp_list_categories('sort_column=name&optiondates=1&optioncount=1'); ?>
  		</ul>

	<h2>All Posts</h2>
  		<ol>
    			<?php wp_get_archives('type=postbypost'); ?>
 		</ol>

			</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
