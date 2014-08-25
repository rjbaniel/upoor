<?php get_header(); ?>

	<div id="content" class="widecolumn">

  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<h3 class="cdate">
				<div id="date"><?php the_time('d') ?></div>
				<div id="mon"><?php the_time('M') ?></div>
				<div id="year"><?php the_time('Y') ?></div>
			</h3>

			<div class="post" id="post-<?php the_ID(); ?>">
			<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to','greenday');?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>
			<small><?php _e('by','greenday'); ?> <?php the_author() ?><?php the_tags( '&nbsp;' . __( 'and tagged' ,'greenday') . ' ', ', ', ''); ?></small>

			<div class="entry">

				<?php the_content(__('<p class="serif">Read the rest of this entry &raquo;</p>','greenday')); ?>

				<?php wp_link_pages('<p><strong>'.__('Pages:','greenday').'</strong> ', '</p>', 'number'); ?>

				<p class="postmetadata alt">
					<small>
						<?php _e('This entry was posted','greenday');?>
						<?php /* This is commented, because it requires a little adjusting sometimes.
							You'll need to download this plugin, and follow the instructions:
							http://binarybonsai.com/archives/2004/08/17/time-since-plugin/ */
							/* $entry_datetime = abs(strtotime($post->post_date) - (60*120)); echo time_since($entry_datetime); echo ' ago'; */ ?>
						<?php _e('on','greenday');?> <?php the_time(__('l, F jS, Y')) ?> <?php _e('at','greenday');?> <?php the_time() ?>
						<?php _e('and is filed under','greenday');?> <?php the_category(', ') ?>.
						<?php _e('You can follow any responses to this entry through the','greenday');?>  <?php post_comments_feed_link('RSS 2.0'); ?> <?php _e('feed','greenday');?>.

						<?php if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
							// Both Comments and Pings are open ?>
							<?php _e('You can','greenday');?>  <a href="#respond"><?php _e('leave a response','greenday');?></a>, <?php _e('or','greenday');?> <a href="<?php trackback_url(true); ?>" rel="trackback"><?php _e('trackback','greenday');?></a> <?php _e('from your own site','greenday');?>.

						<?php } elseif (!('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
							// Only Pings are Open ?>
							<?php _e('Responses are currently closed, but you can','greenday');?> <a href="<?php trackback_url(true); ?> " rel="trackback"><?php _e('trackback','greenday')?></a> <?php _e('from your own site','greenday');?>.

						<?php } elseif (('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
							// Comments are open, Pings are not ?>
							<?php _e('You can skip to the end and leave a response. Pinging is currently not allowed.','greenday');?>

						<?php } elseif (!('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
							// Neither Comments, nor Pings are open ?>
							<?php _e('Both comments and pings are currently closed.','greenday');?>

						<?php } edit_post_link(__('Edit this entry.','greenday'),'',''); ?>

					</small>
				</p>

			</div>
		</div><div class="navigation">
			<div class="alignleft"><?php previous_post_link('&laquo; %link') ?></div>
			<div class="alignright"><?php next_post_link('%link &raquo;') ?></div>
		</div>



	<?php comments_template('',true); ?>

	<?php endwhile; else: ?>

		<p><?php _e('Sorry, no posts matched your criteria.','greenday');?></p>

<?php endif; ?>

	</div>

<?php get_footer(); ?>
