<?php get_header(); ?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
		<div class="post" id="post-<?php the_ID(); ?>">
	
			<h2 class="posttitle"><?php the_title(); ?></h2>
			
			<p class="postmeta"> 
			<?php the_time(get_option('date_format')) ?> <?php //_e('at'); ?> <?php //the_time() ?>
			&#183; <?php _e('Filed under',TEMPLATE_DOMAIN); ?> <?php the_category(', ') ?>
			<?php if (is_callable('the_tags')) the_tags(__('&#183 Tagged ',TEMPLATE_DOMAIN), ', '); ?>
			<?php edit_post_link(__('Edit',TEMPLATE_DOMAIN), ' &#183; ', ''); ?>
			</p>

			<div class="postentry">
            <?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
			<?php the_content(__('Read the rest of this entry &raquo;',TEMPLATE_DOMAIN)); ?>

           <?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>

			<?php wp_link_pages(); ?>
			</div>
			
		</div>
		
		<?php comments_template('',true); ?>
				
	<?php endwhile; else : ?>

		<h2><?php _e('404 Not Found',TEMPLATE_DOMAIN); ?></h2>

		<p><?php _e('Oops...! What you requested cannot be found.',TEMPLATE_DOMAIN); ?></p>

	<?php endif; ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
