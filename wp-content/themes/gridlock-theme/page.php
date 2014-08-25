<?php get_header(); ?>

<div id="main_content">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); // enter the loop ?>
	
	<h3 class="subhead"><?php bloginfo('name'); ?>: <?php the_title(); ?></h3>
	
		<?php the_content(); ?>
		<?php wp_link_pages('before=<p>&after=</p>'); ?>
	<?php endwhile; ?>

    <?php if ( comments_open() ) { ?> <?php comments_template('',true); ?><?php } ?>    


    <?php else: ?>
	<p><?php _e('No posts were located with the given criteria. <a href="javascript:history.back()">Go back</a> and try again.', TEMPLATE_DOMAIN); ?></p>
	<?php endif; ?>



</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
