<?php get_header(); ?>
<table class="content_table columns" cellspacing="0">
	<tbody class="content_tbody">
		<tr class="content_tr">
<td id="content" class="content_td column round-left">
	<div class="wrapper">
		<div class="section">
		<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>
			<div class="entry" id="post-<?php the_ID(); ?>">
				<h2 class="posttitle"><?php the_title(); ?></h2>
				<p class="postmeta"><span class="author"><?php _e('Author : ', 'retweet') ?><?php the_author_posts_link(); ?></span><span class="comment"><?php comments_popup_link(__('No comments', 'retweet'), __('1 Comment', 'retweet'), __('% Comments', 'retweet')); ?></span><?php edit_post_link(__('Edit' ,'retweet') , '<span class="edit">', '</span>'); ?></p>
				<div class="post"><?php the_content(__('More &raquo;' ,'retweet')) ?></div>
				<?php wp_link_pages(array('before' => __('<p><strong>Pages:</strong>' ,'retweet'), 'after' => '</p>', 'next_or_number' => 'number')); ?>
				<?php the_tags('<p class="tag"> Tags : ', ', ', '</p>'); ?>
				<?php include (TEMPLATEPATH . '/bookmarklet.php'); ?>
			</div>
			<div class="comment_meta">
				<small>
				<?php _e('This entry was posted on', 'retweet') ?><?php the_time(__('F jS, Y', 'retweet')) ?><?php _e(' at ', 'retweet') ?><?php the_time() ?><?php _e('.', 'retweet') ?>
				<?php _e('You can follow any responses to this entry through the ', 'retweet') ?>
				<?php post_comments_feed_link('RSS 2.0'); ?><?php _e('.', 'retweet') ?>
				<?php if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
							// Both Comments and Pings are open ?>
				<?php _e('You can ', 'retweet') ?><a href="#respond"><?php _e('Leave a response', 'retweet') ?></a><?php _e(', or ', 'retweet') ?><a href="<?php trackback_url(); ?>" rel="trackback"><?php _e('Trackback', 'retweet') ?></a><?php _e('.', 'retweet') ?>
						<?php } elseif (!('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
							// Only Pings are Open ?>
				<?php _e('Responses are currently closed, but you can ', 'retweet') ?><a href="<?php trackback_url(); ?> " rel="trackback"><?php _e('Trackback.', 'retweet') ?></a><?php _e('.', 'retweet') ?>
						<?php } elseif (('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
							// Comments are open, Pings are not ?>
				<?php _e('You can ', 'retweet') ?><a href="#respond"><?php _e('Leave a response', 'retweet') ?></a><?php _e('.', 'retweet') ?>
						<?php } elseif (!('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
							// Neither Comments, nor Pings are open ?>
				<?php _e('Both comments and pings are currently closed. ', 'retweet') ?>
				<?php }  ?>
				</small>
			</div>
			<div class="post_navigation">
				<div class="floatleft"><?php next_post_link('&laquo; %link') ?></div>
				<div class="floatright"><?php previous_post_link('%link &raquo;') ?></div>
				<div class="clear"></div>
			</div>
			<div id="comments"><?php comments_template('', true); ?></div>
			<?php endwhile; else: ?>
			<div class="entry" id="404">
				<h2 class="posttitle"><a href="javascript:history.back();" title="<?php _e('Not Found', 'retweet') ?>" rel="bookmark"><?php _e('Not Found', 'retweet') ?></a></h2>
				<div class="post"><?php _e('Sorry, but you are searching for something that is not here.', 'retweet') ?></div>
			</div>
		<?php endif; ?>
		</div>
	</div>
</td>
<td id="side_base" class="content_td column round-right">
	<?php get_sidebar(); ?>
</td>
		</tr>
	</tbody>
</table>
<?php get_footer(); ?>
