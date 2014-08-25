<?php get_header(); ?>
	<div id="body">
	
		<div id="main" class="entry">

			<div class="box">
				<h2><?php _e('Category Archive','fauna'); ?></h2>
				<p><?php _e('The following is a list of all entries from the','fauna'); ?> <?php single_cat_title('', 'display'); ?> <?php _e('category.','fauna'); ?></p>
			</div>


			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<?php if ( !in_category($noteworthy_cat) ) { ?>
				<?php include (TEMPLATEPATH . '/template-postloop.php'); ?>
				<?php } ?>
						
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
