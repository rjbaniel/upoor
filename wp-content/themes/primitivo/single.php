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
		<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
		<p class="file"><small><?php the_time(__('F jS, Y')) ?>  <?php _e("by",TEMPLATE_DOMAIN); ?> <?php the_author_posts_link() ?></small></p>

		
       <?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>

        <?php the_content(__('(more...)',TEMPLATE_DOMAIN)); ?>

        <?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>

		<p><?php _e('Posted in ',TEMPLATE_DOMAIN);?> <?php the_category(', ') ?> | <?php the_tags( '' . __( 'tagged',TEMPLATE_DOMAIN ) . ' ', ', ', ''); ?> | <?php edit_post_link(__('Edit',TEMPLATE_DOMAIN), ' | ', ''); ?> | <?php wp_link_pages(); ?>
    <?php comments_popup_link(__('0 Comments',TEMPLATE_DOMAIN), __('1 Comments',TEMPLATE_DOMAIN), __('% Comments',TEMPLATE_DOMAIN)); ?></p>
		<?php comments_template('',true); // Get wp-comments.php template ?>
<?php endwhile; else: ?><?php endif; ?>
<?php next_posts_link(__('&laquo; Previous Entries',TEMPLATE_DOMAIN)) ?> <?php previous_posts_link(__('Next Entries &raquo;',TEMPLATE_DOMAIN)) ?>
	</div>
<?php get_sidebar();?>	
<?php get_footer(); ?>
