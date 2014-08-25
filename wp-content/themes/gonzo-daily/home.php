<?php get_header(); ?>



<?php add_filter('the_content', 'fix_content'); ?>



<?php if (have_posts()) : ?>

	<?php rewind_posts(); ?>



	<?php if (!is_paged()) : the_post(); ?>

	<div class="latest" id="post-<?php the_ID(); ?>">

        <p class="details_small">
						<?php _e('on', 'gonzo-daily'); ?> <?php the_date(); ?>
						<?php _e('by', 'gonzo-daily'); ?> <?php the_author(); ?>

						<?php _e('in', 'gonzo-daily'); ?> <?php the_category(', '); ?>,

  <?php comments_popup_link(__('Comments (0)', 'gonzo-daily'), __('Comments (1)', 'gonzo-daily'), __('Comments (%)', 'gonzo-daily')); ?>

					</p>

		<h2><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>

		<div class="post_content">

		<?php the_content(__('Read more...', 'gonzo-daily')); ?>

		</div>

	</div>

	<?php endif; ?>

	

	<?php

	remove_filter('get_the_excerpt', 'wp_trim_excerpt');

	add_filter('get_the_excerpt', 'gd_short_excerpt');

	?>





	<div id="content"<?php if (is_home() && !is_paged()) { ?> class="home"<?php } ?>>



		<?php while (have_posts()) : the_post(); ?>


		<div class="post list" id="post-<?php the_ID(); ?>">

			<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permalink: <?php the_title(); ?>"><?php the_title(); ?></a></h2>

            <p class="details_small">
						<?php _e('on', 'gonzo-daily'); ?> <?php the_date(); ?>
						<?php _e('by', 'gonzo-daily'); ?> <?php the_author(); ?>

						<?php _e('in', 'gonzo-daily'); ?> <?php the_category(', '); ?>,

  <?php comments_popup_link(__('Comments (0)', 'gonzo-daily'), __('Comments (1)', 'gonzo-daily'), __('Comments (%)', 'gonzo-daily')); ?>

					</p>

			<?php the_excerpt(); ?>

			<p><a href="<?php the_permalink() ?>" rel="bookmark"><?php _e('Read more...', 'gonzo-daily') ;?></a></p>

		</div>


		<?php endwhile; ?>

		
		<div class="navigation">

      		<div class="prev"><?php next_posts_link(__('&laquo; previous posts', 'gonzo-daily')) ?></div>
				<div class="next"><?php previous_posts_link(__('next posts &raquo;', 'gonzo-daily')) ?></div>

		</div>

		
	</div>

	<?php else : ?>

	<div id="content"<?php if (is_home() && !is_paged()) { ?> class="home"<?php } ?>>

		<?php include (TEMPLATEPATH . '/not_found.php'); ?>

	</div>

	<?php endif; ?>


<?php get_footer(); ?>

