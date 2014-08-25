<?php get_header(); ?>

	<div id="content" class="widecolumn">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	
		<div class="post" id="post-<?php the_ID(); ?>">
			
				<div class="PostHead">

<div class="PostTime"><?php the_time('<b>j</b> M Y') ?> </div>
<h2><?php the_title(); ?></h2>
<small class="PostDet"><?php edit_post_link(__('Edit', 'blakmagik'), '', ' | '); ?> <?php _e('Author:', 'blakmagik'); ?> <?php the_author() ?> | <?php _e('Filed under:', 'blakmagik'); ?> <?php the_category(', ') ?></small>

</div>

			<div class="entry">

				<?php the_content(__('<p class="serif">Read the rest of this entry &raquo;</p>', 'blakmagik')); ?>

				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
				<?php the_tags( '<p>Tags: ', ', ', '</p>'); ?>

				<p class="postmetadata alt">
					<small>
						This entry was posted
						<?php /* This is commented, because it requires a little adjusting sometimes.
							You'll need to download this plugin, and follow the instructions:
							http://binarybonsai.com/archives/2004/08/17/time-since-plugin/ */
							/* $entry_datetime = abs(strtotime($post->post_date) - (60*120)); echo time_since($entry_datetime); echo ' ago'; */ ?>
						<?php _e('on', 'blakmagik'); ?> <?php the_time('l, F jS, Y') ?> at <?php the_time() ?>
						<?php _e('and is filed under', 'blakmagik'); ?> <?php the_category(', ') ?>.
						<?php _e('You can follow any responses to this entry through the', 'blakmagik'); ?> <?php post_comments_feed_link('RSS 2.0'); ?> feed.

						<?php if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
							// Both Comments and Pings are open ?>
							You can <a href="#respond"><?php _e('leave a response', 'blakmagik'); ?></a>, or <a href="<?php trackback_url(); ?>" rel="trackback">trackback</a> from your own site.

						<?php } elseif (!('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
							// Only Pings are Open ?>
							<?php _e('Responses are currently closed, but you can', 'blakmagik'); ?> <a href="<?php trackback_url(); ?> " rel="trackback"><?php _e('trackback', 'blakmagik'); ?></a> <?php _e('from your own site.', 'blakmagik'); ?>

						<?php } elseif (('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
							// Comments are open, Pings are not ?>
							<?php _e('You can skip to the end and leave a response. Pinging is currently not allowed.', 'blakmagik'); ?>

						<?php } elseif (!('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
							// Neither Comments, nor Pings are open ?>
							<?php _e('Both comments and pings are currently closed.', 'blakmagik'); ?>

						<?php } edit_post_link(__('Edit this entry', 'blakmagik'),'','.'); ?>

					</small>
				</p>

			</div>
            	<div class="CommWidth"><?php comments_template('', true); ?></div>
		</div>



	<?php endwhile; else: ?>

		<p><?php _e('Sorry, no posts matched your criteria.', 'blakmagik'); ?></p>

<?php endif; ?>

	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
