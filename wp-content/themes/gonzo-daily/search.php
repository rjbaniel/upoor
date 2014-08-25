<?php

remove_filter('get_the_excerpt', 'wp_trim_excerpt');

add_filter('get_the_excerpt', 'gd_short_excerpt');

?>

<?php get_header(); ?>

		<div id="content" class="archive">

			<h1><?php _e("Search", 'gonzo-daily'); ?> - "<?php the_search_query(); ?>"</h1>

		<?php if (have_posts()) : ?>

			<?php while (have_posts()) : the_post(); ?>

				<div class="post list" id="post-<?php the_ID(); ?>">

					<h2><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>

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

		<?php else : ?>

			<div class="post">

				<p><?php _e('Sorry, no posts matched your criteria.', 'gonzo-daily'); ?></p>

			</div>

		<?php endif; ?>



		</div>

		

<?php get_footer(); ?>

