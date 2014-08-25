<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header();
?>

	<div id="content" class="widecolumn">

  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div class="post" id="post-<?php the_ID(); ?>">
			<h2><a href="<?php echo get_permalink($post->post_parent); ?>" rev="attachment"><?php echo get_the_title($post->post_parent); ?></a> &raquo; <?php the_title(); ?></h2>
			<div class="entry">
				<p class="attachment"><a href="<?php echo wp_get_attachment_url($post->ID); ?>"><?php echo wp_get_attachment_image( $post->ID, 'medium' ); ?></a></p>
				<div class="caption"><?php if ( !empty($post->post_excerpt) ) the_excerpt(); // this is the "caption" ?></div>

				<?php the_content(__('<p class="serif">Read the rest of this entry &raquo;</p>', 'color-splash')); ?>

				<div class="navigation">
					<div class="alignleft"><?php previous_image_link() ?></div>
					<div class="alignright"><?php next_image_link() ?></div>
				</div>
				<br class="clear" />

				<p class="postmetadata alt">
					<small>
						<?php _e('This entry was posted on', 'color-splash'); ?> <?php the_time('l, F jS, Y') ?> <?php _e('at', 'color-splash'); ?> <?php the_time() ?>
						<?php _e('and is filed under', 'color-splash'); ?> <?php the_category(', ') ?>.
						<?php the_taxonomies(); ?>
						<?php _e('You can follow any responses to this entry through the', 'color-splash'); ?> <?php post_comments_feed_link('RSS 2.0'); ?> feed.

						<?php if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
							// Both Comments and Pings are open ?>
							<?php _e('You can <a href="#respond">leave a response</a>, or <a href="<?php trackback_url(); ?>" rel="trackback">trackback</a> from your own site.', 'color-splash'); ?>

						<?php } elseif (!('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
							// Only Pings are Open ?>
							<?php _e('Responses are currently closed, but you can <a href="<?php trackback_url(); ?> " rel="trackback">trackback</a> from your own site.', 'color-splash'); ?>

						<?php } elseif (('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
							// Comments are open, Pings are not ?>
							<?php _e('You can skip to the end and leave a response. Pinging is currently not allowed.', 'color-splash'); ?>

						<?php } elseif (!('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
							// Neither Comments, nor Pings are open ?>
							<?php _e('Both comments and pings are currently closed.', 'color-splash'); ?>

						<?php } edit_post_link(__('Edit this entry.', 'color-splash'),'',''); ?>

					</small>
				</p>

			</div>

		</div>

	<?php comments_template('',true); ?>

	<?php endwhile; else: ?>

		<p><?php _e('Sorry, no attachments matched your criteria.', 'color-splash'); ?></p>

<?php endif; ?>

	</div>

<?php get_footer(); ?>
