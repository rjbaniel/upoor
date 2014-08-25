<?php
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'gd_short_excerpt');
?>

<?php get_header(); ?>

	<?php if (have_posts()) : ?>
		<div id="content" class="archive">
			<h1>
				<?php if ( is_category() || is_day() || is_month() || is_year() || is_paged() || (function_exists(is_tag) && is_tag()) ) { ?>
					<?php if (is_category()) { ?>
						<?php _e('Posts In Category', 'gonzo-daily'); ?> <?php single_cat_title(''); ?>
					<?php } elseif ( function_exists(is_tag) && is_tag()) { ?>
						<?php _e('Posts Tagged', 'gonzo-daily'); ?> <?php single_tag_title(''); ?>
					<?php } elseif (is_day()) { ?>
						<?php _e('Archive For', 'gonzo-daily'); ?> <?php the_time(); ?>.
					<?php } elseif (is_month()) { ?>
						<?php _e('Archive For', 'gonzo-daily'); ?>  <?php the_time('F Y'); ?>
					<?php } elseif (is_year()) { ?>
						<?php _e('Archive For', 'gonzo-daily'); ?>  <?php the_time('Y'); ?>
					<?php } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
						<?php _e('Archive', 'gonzo-daily'); ?>
					<?php } ?>
				<?php }?>
			</h1>
			<?php while (have_posts()) : the_post(); ?>

				<div class="post list" id="post-<?php the_ID(); ?>">

					<h2><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>

					<p class="details_small">
						<?php _e('on', 'gonzo-daily'); ?> <?php the_date(); ?>
						<?php _e('by', 'gonzo-daily'); ?> <?php the_author(); ?>

						<?php _e('in', 'gonzo-daily'); ?> <?php the_category(', '); ?>,

  <?php comments_popup_link(__('Comments (0)', 'gonzo-daily'), __('Comments (1)', 'gonzo-daily'), __('Comments (%)', 'gonzo-daily')); ?>

					</p>


                     <?php if( is_date() || is_search() || is_tag() || is_author() ) { ?>

<?php if(function_exists('the_post_thumbnail')) { ?><?php if(get_the_post_thumbnail() != "") { ?><div class="alignleft">
<?php the_post_thumbnail(); ?></div><?php } } ?>
<?php the_excerpt();?>

<?php } else { ?>

<?php the_content( __('<p>Click here to read more</p>', 'gonzo-daily') ); ?>
<?php wp_link_pages('before=<p>&after=</p>'); ?>

<?php } ?>



					<p><a href="<?php the_permalink() ?>" rel="bookmark"><?php _e('Read more...', 'gonzo-daily') ;?></a></p>

				</div>
			<?php endwhile; ?>

			<div class="navigation">
				<div class="prev"><?php next_posts_link(__('&laquo; previous posts', 'gonzo-daily')) ?></div>
				<div class="next"><?php previous_posts_link(__('next posts &raquo;', 'gonzo-daily')) ?></div>
			</div>
		</div>

	<?php else : ?>

		<?php include (TEMPLATEPATH . '/not_found.php'); ?>

	<?php endif; ?>

<?php get_footer(); ?>

