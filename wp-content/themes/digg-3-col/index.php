<?php get_header(); ?>

	<div class="narrowcolumnwrapper"><div class="narrowcolumn">

		<div class="content">

			<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>

			<div class="post" id="post-<?php the_ID(); ?>">

				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>

				<div class="postinfo">
<?php _e('Posted on'); ?> <span class="postdate"><?php the_time(get_option('date_format')) ?></span> <?php _e('by'); ?> <?php the_author() ?> <?php edit_post_link(__('Edit','digg-3-col'), ' &#124; ', ''); ?>
				</div>

				<div class="entry">
<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
					<?php the_content(__('...read more','digg-3-col')); ?>
					<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
					<?php wp_link_pages('<p><strong>'.__('Pages:').'</strong> ', '</p>', 'number'); ?>

					<p class="postinfo">
<?php _e('Filed under&#58;','digg-3-col'); ?> <?php the_category(', ') ?>&nbsp; &#124; <?php the_tags( '&nbsp;&nbsp;' . __( 'Tagged under', 'digg-3-col' ) . ' ', ', ', ''); ?> &#124; <?php comments_popup_link(__('No Comments &#187;','digg-3-col'), __('1 Comment &#187;','digg-3-col'), __('% Comments &#187;','digg-3-col')); ?>
					</p>

				</div>
			</div>

<?php endwhile; ?>

<?php include (TEMPLATEPATH . '/browse.php'); ?>

<?php else : ?>

			<div class="post">

				<h2><?php _e('Not Found','digg-3-col'); ?></h2>

				<div class="entry">
<p><?php _e('Sorry, but you are looking for something that isn&#39;t here.','digg-3-col'); ?></p>
				</div>

			</div>

<?php endif; ?>

		</div><!-- End content -->

	</div></div><!-- End narrowcolumnwrapper and narrowcolumn classes -->

<?php get_footer(); ?>
