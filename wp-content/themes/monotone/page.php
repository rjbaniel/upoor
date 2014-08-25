<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div class="image">
		<div class="nav prev"><?php next_post_link('%link','&lsaquo;') ?></div>
		<?php the_image(); ?>
		<div class="nav next"><?php if(is_home()) $wp_query->is_single = 1; previous_post_link('%link','&rsaquo;'); if(is_home()) $wp_query->is_single = 0; ?></div>
	</div>
	<?php partial('post'); ?>	
<?php endwhile; else : ?>
	<h2 class="center"><?php _e('Not Found', 'monotone'); ?></h2>
	<p class="center"><?php _e("Sorry, but you are looking for something that isn't here.", 'monotone'); ?></p>
	<?php include (TEMPLATEPATH . "/searchform.php"); ?>
<?php endif; ?>
<?php get_footer(); ?>
