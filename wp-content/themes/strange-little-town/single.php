<?php get_header(); ?>



	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>



		<div class="post" id="post-<?php the_ID(); ?>">

			<h2><?php the_title(); ?></h2>



			<?php the_content(__('<p>Read the rest of this entry &raquo;</p>', 'slt')); ?>



			<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

			<?php the_tags( '<p>Tags: ', ', ', '</p>'); ?>



			<p>

				<?php _e('This entry was posted', 'slt'); ?>

				<?php /* This is commented, because it requires a little adjusting sometimes.

					You'll need to download this plugin, and follow the instructions:

					http://binarybonsai.com/archives/2004/08/17/time-since-plugin/ */

					/* $entry_datetime = abs(strtotime($post->post_date) - (60*120)); echo time_since($entry_datetime); echo ' ago'; */ ?>

				<?php _e('on', 'slt'); ?> <?php the_time('l, F jS, Y') ?> <?php _e('at', 'slt'); ?> <?php the_time() ?>

				<?php _e('and is filed under', 'slt'); ?> <?php the_category(', ') ?>.

				<?php _e('You can follow any responses to this entry through the', 'slt'); ?> <?php post_comments_feed_link('RSS 2.0'); ?> <?php _e('feed', 'slt'); ?>.



				<?php if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) {

					// Both Comments and Pings are open ?>

					<?php _e('You can', 'slt'); ?> <a href="#respond"><?php _e('leave a response', 'slt'); ?></a>, or <a href="<?php trackback_url(); ?>" rel="trackback"><?php _e('trackback', 'slt'); ?></a> <?php _e('from your own site', 'slt'); ?>.



				<?php } elseif (!('open' == $post-> comment_status) && ('open' == $post->ping_status)) {

					// Only Pings are Open ?>

					<?php _e('Responses are currently closed, but you can', 'slt'); ?> <a href="<?php trackback_url(); ?> " rel="trackback"><?php _e('trackback', 'slt'); ?></a> <?php _e('from your own site', 'slt'); ?>.



				<?php } elseif (('open' == $post-> comment_status) && !('open' == $post->ping_status)) {

					// Comments are open, Pings are not ?>

					<?php _e('You can skip to the end and leave a response. Pinging is currently not allowed', 'slt'); ?>.



				<?php } elseif (!('open' == $post-> comment_status) && !('open' == $post->ping_status)) {

					// Neither Comments, nor Pings are open ?>

					<?php _e('Both comments and pings are currently closed', 'slt'); ?>.



				<?php } edit_post_link(__('Edit this entry', 'slt'),'','.'); ?>

			</p>



		</div>



<?php comments_template('',true); ?>

		

            <div class="navigation"><p><?php posts_nav_link(); ?></p></div>



	<?php endwhile; else: ?>



		<p><?php _e('Sorry, no posts matched your criteria.', 'slt'); ?></p>



<?php endif; ?>



        </div>

                    



<?php get_sidebar(); ?>





<?php get_footer(); ?>

