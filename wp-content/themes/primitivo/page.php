<?php
get_header();
?>

	
	<div id="colOne">
	<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar(2)) : ?>
		<h2><?php _e("Recent update",TEMPLATE_DOMAIN); ?></h2>
		<ul>
			<?php wp_get_archives('postbypost', 10); ?>
		</ul>

			<div align="center"><a href="<?php bloginfo('rss2_url'); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/feed.png" border="0" alt="<?php _e("Subscribe to RSS feed",TEMPLATE_DOMAIN); ?>"/></a></div>
		<?php endif; ?>
	</div>
	<div id="colTwo">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<h2><?php the_title(); ?></h2>





        <?php the_content(__('(more...)',TEMPLATE_DOMAIN)); ?>

        <?php wp_link_pages('before=<p>&after=</p>'); ?>

		<p><?php edit_post_link(__('Edit this page',TEMPLATE_DOMAIN)); ?> </p>

	   <?php if ( comments_open() ) { ?> <?php comments_template('',true); ?><?php } ?>

<?php endwhile; else: ?>

<?php endif; ?>

	</div>
<?php get_sidebar();?>	
<?php get_footer(); ?>
