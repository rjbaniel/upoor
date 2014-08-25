<?php get_header(); ?>

	<div id="content" class="widecolumn">
				
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
		<div class="navigation">
			<div class="alignleft"><?php previous_post_link('%link ','&laquo; ','yes') ?></div>
			<div class="alignright"><?php next_post_link(' %link','&raquo;','yes') ?></div>
		</div>
	
		<div class="post">
			<h2 id="post-<?php the_ID(); ?>"><a href="<?php echo get_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link:', TEMPLATE_DOMAIN);?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>
	
			<div class="entrytext">
                <?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>

				<?php the_content(__('<p class="serif">Read the rest of this entry &raquo;</p>', TEMPLATE_DOMAIN)); ?>

				<?php wp_link_pages('<p><strong>'.__('Pages', TEMPLATE_DOMAIN).':</strong> ', '</p>', 'number'); ?>

                <?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>

				<p class="postmetadata alt">
					<small>
						<?php _e('This entry was posted', TEMPLATE_DOMAIN);?>
						<?php /* This is commented, because it requires a little adjusting sometimes.
							You'll need to download this plugin, and follow the instructions:
							http://binarybonsai.com/archives/2004/08/17/time-since-plugin/ */
							/* $entry_datetime = abs(strtotime($post->post_date) - (60*120)); echo time_since($entry_datetime); echo ' ago'; */ ?> 
						<?php _e('on', TEMPLATE_DOMAIN);?> <?php the_time(__('l, F jS, Y')) ?> <?php _e('at', TEMPLATE_DOMAIN);?> <?php the_time() ?>
						<?php _e('and is filed under', TEMPLATE_DOMAIN);?> <?php the_category(', ') ?> and<?php the_tags( '&nbsp;' . __( 'tagged', TEMPLATE_DOMAIN ) . ' ', ', ', ''); ?>.
						<?php _e('You can follow any responses to this entry through the', TEMPLATE_DOMAIN);?>  <?php post_comments_feed_link('RSS 2.0'); ?> <?php _e('feed', TEMPLATE_DOMAIN);?>.
						
						<?php if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
							// Both Comments and Pings are open ?>
							<?php _e('You can', TEMPLATE_DOMAIN);?>  <a href="#respond"><?php _e('leave a response', TEMPLATE_DOMAIN);?></a>, <?php _e('or', TEMPLATE_DOMAIN);?> <a href="<?php trackback_url(display); ?>"><?php _e("trackback",TEMPLATE_DOMAIN); ?></a> <?php _e("from your own site.",TEMPLATE_DOMAIN); ?>
						
						<?php } elseif (!('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
							// Only Pings are Open ?>
							<?php _e('Responses are currently closed, but you can', TEMPLATE_DOMAIN);?> <a href="<?php trackback_url(display); ?>"><?php _e('trackback', TEMPLATE_DOMAIN);?></a> <?php _e('from your own site.', TEMPLATE_DOMAIN);?>

						
						<?php } elseif (('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
							// Comments are open, Pings are not ?>
							<?php _e('You can skip to the end and leave a response. Pinging is currently not allowed.', TEMPLATE_DOMAIN);?>
			
						<?php } elseif (!('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
							// Neither Comments, nor Pings are open ?>
							<?php _e('Both comments and pings are currently closed.', TEMPLATE_DOMAIN);?>
						
						<?php } edit_post_link(__('Edit this entry.', TEMPLATE_DOMAIN),'',''); ?>
						
					</small>
				</p>
	
			</div>
		</div>
		
	<?php comments_template('',true); ?>
	
	<?php endwhile; else: ?>
	
		<p><?php _e('Sorry, no posts matched your criteria.', TEMPLATE_DOMAIN); ?></p>
	
<?php endif; ?>
	
	</div>

<?php get_footer(); ?>
