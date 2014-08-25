<?php get_header(); ?>

	<div id="content" class="widecolumn">

  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div class="navigation">
			<div class="alignleft">&nbsp;</div>
			<div class="alignright">&nbsp;</div>
		</div>
<?php $attachment_link = get_the_attachment_link($post->ID, true, array(450, 800)); // This also populates the iconsize for the next line ?>
<?php $_post = &get_post($post->ID); $classname = ($_post->iconsize[0] <= 128 ? 'small' : '') . 'attachment'; // This lets us style narrow icons specially ?>
		<div class="post" id="post-<?php the_ID(); ?>">
			<h2><a href="<?php echo get_permalink($post->post_parent); ?>" rev="attachment"><?php echo get_the_title($post->post_parent); ?></a> &raquo; <a href="<?php echo get_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link:');?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>
			<div class="entry">
				<p class="<?php echo $classname; ?>"><?php echo $attachment_link; ?><br /><?php echo basename($post->guid); ?></p>

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
		</div>



	<?php endwhile; ?>
        <?php if ( comments_open() ) { ?> <?php comments_template('',true); ?><?php } ?>

    <?php else: ?>

		<p><?php _e('Sorry, no attachments matched your criteria.','greenday');?></p>


<?php endif; ?>

	</div>

<?php get_footer(); ?>
