<?php get_header(); ?>

<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336x280-almostspring-top"); } ?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<h2 id="post-<?php the_ID(); ?>"><?php the_title(); ?></h2>

	
			
		<?php the_content(__('Read the rest of this page &raquo;', 'almost-spring')); ?>

	
		<?php wp_link_pages(); ?>
		
		<?php edit_post_link(__('Edit', 'almost-spring'), '<p>', '</p>'); ?>
	
	<?php if ( comments_open() ) { ?> <?php comments_template('',true); ?><?php } ?>
    
<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336x280-almostspring-bottom"); } ?>
	<?php endwhile; endif; ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
