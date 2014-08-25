<?php get_header(); ?>



	<div id="content"<?php if (is_home() && !is_paged()) { ?> class="home"<?php } ?>>


	<?php if (have_posts()) : ?>

		<?php rewind_posts(); ?>


		<?php
		remove_filter('get_the_excerpt', 'wp_trim_excerpt');
   		add_filter('get_the_excerpt', 'gd_short_excerpt');
		?>


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

			<p><a href="<?php the_permalink() ?>" rel="bookmark"><?php _e('Read more...') ;?></a></p>

		</div>


		<?php endwhile; ?>


		<?php if (is_single()) : ?>
		
		<div class="navigation">
			<span class="prev"><?php previous_post_link('%link') ?></span>
			<span class="next"><?php next_post_link('%link') ?></span>
		</div>
		
		<?php else : ?>
		
		<div class="navigation">

         	<div class="prev"><?php next_posts_link(__('&laquo; previous posts', 'gonzo-daily')) ?></div>
				<div class="next"><?php previous_posts_link(__('next posts &raquo;', 'gonzo-daily')) ?></div>

		</div>

		
		<?php endif; ?>
		
	<?php else : ?>

		<?php include (TEMPLATEPATH . '/not_found.php'); ?>

	<?php endif; ?>


	</div><?php get_footer(); ?>

