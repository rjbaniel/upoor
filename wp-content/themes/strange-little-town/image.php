<?php get_header(); ?>



	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>



		<div class="post" id="post-<?php the_ID(); ?>">

		<h2><a href="<?php echo get_permalink($post->post_parent); ?>" rev="attachment"><?php echo get_the_title($post->post_parent); ?></a> &raquo; <?php the_title(); ?></h2>

			<p><a href="<?php echo wp_get_attachment_url($post->ID); ?>"><?php echo wp_get_attachment_image( $post->ID, 'medium' ); ?></a></p>

               <?php if ( !empty($post->post_excerpt) ) the_excerpt(); // this is the "caption" ?>



			<?php the_content(__('<p class="serif">Read the rest of this entry &raquo;</p>', 'slt') ); ?>

            <div class="navigation"><p><?php posts_nav_link(); ?></p></div>



			<p>

				<?php _e('This entry was posted on', 'slt'); ?> <?php the_time('l, F jS, Y') ?> <?php _e('at', 'slt'); ?> <?php the_time() ?>

				<?php _e('and is filed under', 'slt'); ?> <?php the_category(', ') ?>.

				<?php the_taxonomies(); ?>

				<?php _e('You can follow any responses to this entry through the', 'slt'); ?> <?php post_comments_feed_link('RSS 2.0'); ?> <?php _e('feed', 'slt'); ?>.



				<?php if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) {

					// Both Comments and Pings are open ?>

					You can <a href="#respond"><?php _e('leave a response', 'slt'); ?></a>, <?php _e('or', 'slt'); ?> <a href="<?php trackback_url(); ?>" rel="trackback"><?php _e('trackback', 'slt'); ?></a> <?php _e('from your own site', 'slt'); ?>.



				<?php } elseif (!('open' == $post-> comment_status) && ('open' == $post->ping_status)) {

					// Only Pings are Open ?>

					<?php _e('Responses are currently closed, but you can', 'slt'); ?> <a href="<?php trackback_url(); ?> " rel="trackback"><?php _e('trackback', 'slt'); ?></a> <?php _e('from your own site', 'slt'); ?>.



				<?php } elseif (('open' == $post-> comment_status) && !('open' == $post->ping_status)) {

					// Comments are open, Pings are not ?>

					<?php _e('You can skip to the end and leave a response. Pinging is currently not allowed.', 'slt'); ?>



				<?php } elseif (!('open' == $post-> comment_status) && !('open' == $post->ping_status)) {

					// Neither Comments, nor Pings are open ?>

					<?php _e('Both comments and pings are currently closed', 'slt'); ?>.



				<?php } edit_post_link(__('Edit this entry.', 'slt'),'',''); ?>

			</p>



		</div><!-- .post -->



	<?php comments_template(); ?>



	<?php endwhile; else: ?>



		<p><?php _e('Sorry, no attachments matched your criteria.', 'slt'); ?></p>



<?php endif; ?>



        </div>

                    



<?php get_sidebar(); ?>





<?php get_footer(); ?>

