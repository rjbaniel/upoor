<?php
// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die (__('Please do not load this page directly. Thanks!', 'technical-speech'));

	if ( post_password_required() ) { ?>
					<div class="contentbox">
						<div class="boxheading"><span><?php _e('Comments', 'technical-speech'); ?></span><div class="clear"></div><div class="left"></div></div>
						<div class="postsmetadata"><?php _e('This post is password protected. Enter the password to view comments', 'technical-speech'); ?>.</div>
					</div>
<?php return; }?>

<?php if ( have_comments() ) : ?>
<div class="contentbox">
<div class="boxheading"><span><?php _e('Comments', 'technical-speech'); ?></span><div class="clear"></div><div class="left"></div></div>
<div id="c_comments">

<?php if ( ! empty($comments_by_type['comment']) ) : ?>


<div id="post-navigator-single">
<div class="alignright"><?php if(function_exists('paginate_comments_links')) {  paginate_comments_links(); } ?></div>
</div>

<ol id="comments" class="commentlist">
<?php wp_list_comments('type=comment&callback=list_comments'); ?>
</ol>


<div id="post-navigator-single">
<div class="alignright"><?php if(function_exists('paginate_comments_links')) {  paginate_comments_links(); } ?></div>
</div>

<?php endif; ?>


 <?php if ( $post->ping_status == "open" ) : ?>
 <?php if ( ! empty($comments_by_type['pings']) ) : ?>
 <div class="entry">
	<h3><?php _e('Trackbacks/Pingbacks', 'technical-speech'); ?></h3>

    <ol class="pinglist">
    <?php wp_list_comments('type=pings&callback=list_pings'); ?>
	</ol>
    </div>
	<?php endif; ?>
    <?php endif; ?>



</div>
</div>
<?php else : // this is displayed if there are no comments so far ?>
					<div class="contentbox">
						<div class="boxheading"><span><?php _e('Comments', 'technical-speech'); ?></span><div class="clear"></div><div class="left"></div></div>
	<?php if ('open' == $post->comment_status) : ?>
		<!-- If comments are open, but there are no comments. -->
						<div class="postsmetadata"><?php _e('No comments yet', 'technical-speech'); ?>.</div>
	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
						<div class="postsmetadata"><?php _e('Comments are closed', 'technical-speech'); ?>.</div>
	<?php endif; ?>
					</div>
<?php endif; ?>

<?php if ('open' == $post->comment_status) : ?>
					<div id="respond" class="contentbox">
						<div class="boxheading"><span><?php _e('Leave a Response', 'technical-speech'); ?></span><div class="clear"></div><div class="left"></div></div>

<div class="cancel-comment-reply">
<?php cancel_comment_reply_link(); ?>
</div>


	<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
						<div class="postsmetadata"><?php _e('You must be', 'technical-speech'); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"><?php _e('logged in', 'technical-speech'); ?></a> <?php _e('to post a comment', 'technical-speech'); ?>.</div>
	<?php else : ?>
						<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
		<?php if ( $user_ID ) : ?>
							<div class="postsmetadata"><?php _e('Logged in as', 'technical-speech'); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('Log out of this account', 'technical-speech'); ?>"><?php _e('Log out &raquo;', 'technical-speech'); ?></a></div>
		<?php else : ?>
							<div class="commentform_blockdiv">
								<input  class="c_input" type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
								<label for="author"><?php _e('Name', 'technical-speech'); ?> <?php if ($req) echo "(required)"; ?></label>
							</div>
							<div class="commentform_blockdiv">
								<input class="c_input" type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
								<label for="email"><?php _e('Mail (will not be published)', 'technical-speech'); ?> <?php if ($req) echo "(required)"; ?></label>
							</div>
							<div class="commentform_blockdiv">
								<input class="c_input" type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
								<label for="url"><?php _e('Website', 'technical-speech'); ?></label>
							</div>	
		<?php endif; ?>
							<div class="allowed_tags"><strong>XHTML:</strong> <?php _e('You can use these tags', 'technical-speech'); ?>: <code><?php echo allowed_tags(); ?></code></div>
							<div class="commentform_blockdiv">
								<textarea name="comment" id="comment" cols="100%" rows="10" tabindex="4"></textarea>
							</div>
							<div class="commentform_blockdiv">
								<input class="c_submit" name="submit" type="submit" id="submit" tabindex="5" value="<?php _e('Submit Comment', 'technical-speech'); ?>" />
								<?php comment_id_fields(); ?>
							</div>
							
							<?php do_action('comment_form', $post->ID); ?>
						</form>
	<?php endif; // If registration required and not logged in ?>
					</div>
<?php endif; ?>
