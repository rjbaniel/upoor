<?php get_header(); ?>

<div id="main_content">
	
	 <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
	<h3 class="subhead"><?php the_time('j F Y'); ?></h3>

	<h2 id="headline"><a href="<?php echo get_permalink(); ?>" rel="bookmark" title="<?php _e("Permanent Link:",TEMPLATE_DOMAIN); ?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>

	<?php the_content(); ?>
	
	<?php comments_template('',true); ?>
	
	<?php endwhile; else: ?>

		<p><em><?php _e("No posts were found with this query.",TEMPLATE_DOMAIN); ?></em></p>
	
	<?php endif; ?>
		
</div>


<?php get_sidebar(); ?>

<?php get_footer(); ?>
