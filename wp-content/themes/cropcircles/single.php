<?php get_header(); ?>

	<div id="content" class="widecolumn">
				
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
		<div class="navigation">
			<div class="alignleft"><?php previous_post_link(' %link','«','yes') ?></div>
			<div class="alignright"><?php next_post_link(' %link ','»','yes') ?></div>
		</div>
	
		<div class="post">
			<h2 id="post-<?php the_ID(); ?>"><a href="<?php echo get_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link:','cropcircles');?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>
	
			<div class="entrytext">

				<?php the_content(); ?>

				<?php wp_link_pages(__('<p><strong>Pages:</strong> '), '</p>', 'number'); ?>
	

				<p class="postmetadata graybox">
					<small>
						<?php _e('This entry was posted','cropcircles');?>
						<?php /* This is uncommented, because it requires a little adjusting sometimes.
							You'll need to download this plugin, and follow the instructions:
							http://binarybonsai.com/archives/2004/08/17/time-since-plugin/ */
							/* $entry_datetime = abs(strtotime($post->post_date) - (60*120)); echo time_since($entry_datetime); echo ' ago'; */ ?> 
						<?php _e('on','cropcircles');?> <?php the_time(__('l, F jS, Y')) ?> <?php _e('at','cropcircles');?> <?php the_time() ?>
						<?php _e('and is filed under','cropcircles');?> <?php the_category(', ') ?>. <?php the_tags( '&nbsp;' . __( 'Tagged','cropcircles' ) . ' ', ', ', ''); ?>
						<?php _e('You can follow any responses to this entry through the','cropcircles'); ?> <a href="<?php bloginfo_rss('comments_rss2_url'); ?>"><?php _e('RSS 2.0','cropcircles'); ?></a>
						<?php _e('feed','cropcircles'); ?>.
						
						<?php if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
							// Both Comments and Pings are open ?>
							<?php _e('You can','cropcircles');?> <a href="#respond"><?php _e('leave a response','cropcircles');?></a>, <?php _e('or','cropcircles');?> <a href="<?php trackback_url(display); ?>"><?php _e('trackback','cropcircles'); ?></a> <?php _e('from your own site','cropcircles'); ?>.
						
						<?php } elseif (!('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
							// Only Pings are Open ?>
							<?php _e('Responses are currently closed, but you can','cropcircles');?> <a href="<?php trackback_url(display); ?>"><?php _e('trackback','cropcircles');?></a> <?php _e('from your own site.','cropcircles');?>

							<?php _e('Both comments and pings are currently closed.','cropcircles');?>
						
						<?php } elseif (('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
							// Comments are open, Pings are not ?>
        <?php _e('You can skip to the end and leave a response. Pinging is currently not allowed.','cropcircles');?>
			
						<?php } elseif (!('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
							// Neither Comments, nor Pings are open ?>
							<?php _e('Both comments and pings are currently closed.','cropcircles');?>
						
						<?php } edit_post_link(__('Edit this entry.','cropcircles'),'',''); ?>
						
					</small>
				</p>
	
			</div>
		</div>
		
	<?php comments_template('',true); ?>
	
	<?php endwhile; else: ?>
	
		<p><?php _e('Sorry, no posts matched your criteria.','cropcircles'); ?></p>
	
<?php endif; ?>
	
	</div>

<?php get_footer(); ?>
