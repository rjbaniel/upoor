<?php get_header(); ?>

	<div id="body">
	
		<div id="main" class="entry">

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				
			<div class="box">
				<?php previous_post_link(' %link |','&laquo;','yes') ?>
				<a href="<?php bloginfo('url'); ?>"><?php _e('Home', 'fauna') ?></a>
				<?php next_post_link('| %link ','&raquo;','yes') ?>
			</div>
		
			<hr />

			<?php include (TEMPLATEPATH . '/template-postloop.php'); ?>

			<?php comments_template('',true); ?>

			<?php endwhile; else: ?>
			
			<div class="box">
				<h2><?php _e('Not Found','fauna') ?></h2>
				<p><?php _e('Sorry, no posts matched your criteria.','fauna'); ?></p>
			</div>		
			
		<?php endif; ?>

		</div>

		<?php get_sidebar(); ?>

	</div>

	<?php get_footer(); ?>
