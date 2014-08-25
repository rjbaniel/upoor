<?php get_header(); ?>
				<div id="content">
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<div class="contentbox" id="post-<?php the_ID(); ?>">
						<div class="boxheading" style="font-size:0.9em"><span><?php _e('Posted on', 'technical-speech'); ?> <?php the_time('jS F Y') ?></span><span class="right"><?php comments_number(__('No Responses', 'technical-speech'), __('One Response', 'technical-speech'), __('% Responses', 'technical-speech') );?></span><div class="clear"></div><div class="left"></div></div>
						<div class="posts">
							<h6 class="postheading"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h6>
							<?php the_content(__('<p>Read the rest of this entry &raquo;</p>', 'technical-speech')); ?>
							<?php wp_link_pages(array('before' => '<div class="postspagination">Pages: ', 'after' => '</div>', 'next_or_number' => 'number')); ?>
							<div class="postsmetadata">
								<?php _e('Category', 'technical-speech'); ?> : <?php the_category(', ') ?>.<br />
								<?php the_tags( 'Tags: ', ', ', '.<br />'); ?>
								<?php _e('You can follow any responses to this entry through the', 'technical-speech'); ?> <?php post_comments_feed_link('RSS 2.0'); ?> <?php _e('feed', 'technical-speech'); ?>.<br />
								<?php if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) {// Both Comments and Pings are open ?>
								<?php _e('You can', 'technical-speech'); ?> <a href="#respond"><?php _e('leave a response', 'technical-speech'); ?></a>, <?php _e('or', 'technical-speech'); ?> <a href="<?php trackback_url(); ?>" rel="trackback"><?php _e('trackback', 'technical-speech'); ?></a> <?php _e('from your own site', 'technical-speech'); ?>.
								<?php } elseif (!('open' == $post-> comment_status) && ('open' == $post->ping_status)) { // Only Pings are Open ?>
								R<?php _e('esponses are currently closed, but you can', 'technical-speech'); ?> <a href="<?php trackback_url(); ?> " rel="trackback"><?php _e('trackback', 'technical-speech'); ?></a> <?php _e('from your own site', 'technical-speech'); ?>.

								<?php } elseif (('open' == $post-> comment_status) && !('open' == $post->ping_status)) {// Comments are open, Pings are not ?>
								<?php _e('You can skip to the end and leave a response. Pinging is currently not allowed', 'technical-speech'); ?>.
								<?php } elseif (!('open' == $post-> comment_status) && !('open' == $post->ping_status)) {// Neither Comments, nor Pings are open ?>
								<?php _e('Both comments and pings are currently closed', 'technical-speech'); ?>.
								<?php } edit_post_link(__('Edit this entry', 'technical-speech'),'<br />','.'); ?>
							</div>
						</div>
						<div class="postsnav"><span class="left"><?php previous_post_link('%link') ?></span><span class="right"><?php next_post_link('%link') ?></span><div class="clear"></div></div>
					</div>
					<?php comments_template('', true); ?>
					<?php endwhile; else: ?>
					<div class="contentbox">
						<div class="posts">
							<p><?php _e('Sorry, no posts matched your criteria', 'technical-speech'); ?>.</p>
						</div>
					</div>
					<?php endif; ?>
				</div>
<?php get_sidebar('block'); ?>
<?php get_sidebar('right'); ?>
<?php get_sidebar('left'); ?> 
<?php get_footer(); ?>				
