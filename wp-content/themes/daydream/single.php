<?php get_header(); ?>

	<div id="content">
				
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
		<div class="post" id="post-<?php the_ID(); ?>">
			<h2 class="single"><a href="<?php echo get_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link:','daydream');?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>
	
			<div class="entry">

                        	<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
				<?php the_content(__('<p class="serif">Read the rest of this entry &raquo;</p>','daydream')); ?>
	                        	<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>                           
				<?php wp_link_pages('<p><strong>'.__('Pages:').'</strong> ', '</p>', 'number'); ?>

			</div>
		</div>
		
		<p id="single" class="postmetadata">
			<small>
				<?php _e('This entry was posted','daydream'); ?>
				<?php _e('on');?> <?php the_time(get_option('date_format')) ?> <?php _e('at','daydream');?> <?php the_time() ?>
        <?php _e('and is filed under','daydream');?> <?php the_nice_category(', ', ' and '); ?>. <?php the_tags( __( 'Tagged','daydream' ) . ': ', ', ', '.'); ?>
				 
				<?php if (get_option('dd_tags_cats') == "both" && function_exists('UTW_ShowTagsForCurrentPost')) { ?>
				 
					<?php _e('Tagged with','daydream'); ?> <?php UTW_ShowTagsForCurrentPost("commalist") ?>.
				
				<?php } ?>				
				
				<?php _e('You can','daydream'); ?> <?php post_comments_feed_link('feed'); ?> <?php _e('this entry.','daydream'); ?>
				
				<?php if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
					// Both Comments and Pings are open ?>
					<?php _e('You can','daydream');?> <a href="#respond"><?php _e('leave a response','daydream');?></a>, <?php _e('or','daydream');?> <a href="<?php trackback_url(true); ?>" rel="trackback"><?php _e('trackback','daydream');?></a> <?php _e('from your own site','daydream');?>.
				
				<?php } elseif (!('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
					// Only Pings are Open ?>
					<?php _e('Responses are currently closed, but you can','daydream');?> <a href="<?php trackback_url(true); ?> " rel="trackback"><?php _e('trackback','daydream')?></a> <?php _e('from your own site','daydream');?>.
				
				<?php } elseif (('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
					// Comments are open, Pings are not ?>
					<?php _e('You can skip to the end and leave a response. Pinging is currently not allowed. ','daydream'); ?>

				<?php } elseif (!('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
					// Neither Comments, nor Pings are open ?>
					<?php _e('Both comments and pings are currently closed.','daydream'); ?>

				<?php } edit_post_link(__('Edit this entry.','daydream'),'',''); ?>
				
			</small>
		</p>
		
	<?php comments_template('',true); ?>
	
	<?php endwhile; else: ?>
	
		<p><?php _e('Sorry, no posts matched your criteria.','daydream');?></p>
	
<?php endif; ?>

	<div class="navigation">
		<div class="alignleft"><?php previous_post_link('&laquo; %link') ?></div>
		<div class="alignright"><?php next_post_link('%link &raquo;') ?></div>
	</div>
	
	</div>

<?php get_footer(); ?>
