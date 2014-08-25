<?php get_header(); ?>

	<div id="content_box">
		
		<div id="content" class="posts single">
			
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
			<?php include (TEMPLATEPATH . '/navigation.php'); ?>
			
			<h1><?php the_title(); ?></h1>
<p class="post_date"><?php the_time('F jS, Y') ?> | <?php the_category(', ') ?> | <?php the_tags( '&nbsp;' . __( 'Tagged','copyblogger' ) . ' ', ', ', ''); ?></p>
			<div class="entry"><?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
				<?php the_content(); ?>
				<?php wp_link_pages('<p><strong>Pages:</strong> ', '</p>', 'number'); ?>
			</div>
			
			<?php comments_template('',true); ?>
			
		<?php endwhile; else: ?>
		
			<h1><?php _e('Uh oh.','copyblogger'); ?></h1>
			<p class="post_date"><?php _e('You better <em>never</em> see this text.','copyblogger'); ?></p>
			<div class="entry">
				<p><?php _e('Sorry, no posts matched your criteria. Wanna search instead?','copyblogger'); ?></p>
				<?php include (TEMPLATEPATH . '/searchform.php'); ?>
			</div>
			
		<?php endif; ?>
		
		</div>
		
		<?php get_sidebar(); ?>
			
	</div>

<?php get_footer(); ?>
