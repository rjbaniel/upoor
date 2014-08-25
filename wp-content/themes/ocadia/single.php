<?php get_header(); ?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
		<div class="post">

			<?php the_date('m.d.y', '<h1 class="storydate">', '</h1>'); ?> 
			<h2 id="post-<?php the_ID(); ?>" class="storytitle"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent link to', TEMPLATE_DOMAIN); ?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>
			<p class="meta"><?php _e('Posted in', TEMPLATE_DOMAIN); ?> <?php the_category(', ') ?> <?php the_tags( 'tagged ', TEMPLATE_DOMAIN ); ?> <?php _e('at', TEMPLATE_DOMAIN); ?> <?php the_time(); ?> <?php _e('by', TEMPLATE_DOMAIN); ?> <?php the_author(); ?></p>
		
            <?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
			<?php the_content(__('Read the rest of this entry &raquo;', TEMPLATE_DOMAIN)); ?>
			<?php wp_link_pages(); ?>
             <?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
			<p class="feedback">
			<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent link to', TEMPLATE_DOMAIN); ?> <?php the_title(); ?>" class="permalink"><?php _e('Permalink', TEMPLATE_DOMAIN); ?></a>
			<?php edit_post_link(__('Edit', TEMPLATE_DOMAIN), ' &#183; ', ''); ?>
			</p>
		
		</div>
			
		<?php comments_template('',true); ?>
	
	<?php endwhile; else: ?>

		<h2><?php _e('Not Found', TEMPLATE_DOMAIN); ?></h2>
		<p><?php _e('Sorry, but the page you requested cannot be found.', TEMPLATE_DOMAIN); ?></p>
		<?php include (TEMPLATEPATH . "/searchform.php"); ?>

	<?php endif; ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>

