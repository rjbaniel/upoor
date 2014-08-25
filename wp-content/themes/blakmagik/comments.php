<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die (__('Please do not load this page directly. Thanks!', 'blakmagik'));

	if (!empty($post->post_password)) { // if there's a password
		if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
			?>

			<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'blakmagik'); ?></p>

			<?php
			return;
		}
	}

	/* This variable is for alternating comment background */
	$oddcomment = 'class="alt" ';
?>

<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?><?php if ( ! empty($comments_by_type['comment']) ) : ?>
<h3 id="comments"><?php comments_number(__('No Responses', 'blakmagik'), __('One Response', 'blakmagik'), __('% Responses', 'blakmagik') );?> to &#8220;<?php the_title(); ?>&#8221;</h3>

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
	<h3><?php _e('Trackbacks/Pingbacks', 'blakmagik'); ?></h3>

    <ol class="pinglist">
    <?php wp_list_comments('type=pings&callback=list_pings'); ?>
	</ol>
    </div>
   <?php endif; ?>
   <?php endif; ?>


 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ('open' == $post->comment_status) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments"><?php _e('Comments are closed.', 'blakmagik'); ?></p>

 <?php endif; ?>

<?php endif; ?>


<?php if ('open' == $post->comment_status) : ?>
<div id="respond">
<div class="add_comment">
<h3 id="respond"><?php _e('Leave a Reply', 'blakmagik'); ?></h3>

<div class="cancel-comment-reply">
<?php cancel_comment_reply_link(); ?>
</div>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p><?php _e('You must be');?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>"><?php _e('logged in');?></a> <?php _e('to post a comment.');?></p>
<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<?php if ( $user_ID ) : ?>

<p><?php _e('Logged in as', 'blakmagik');?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="<?php _e('Log out of this account', 'blakmagik');?>"><?php _e('Logout', 'blakmagik');?> &raquo;</a></p>

<?php else : ?>
<div class="text_fields">
<p><label for="author"><small><?php _e('Name', 'blakmagik'); ?> <?php if ($req) echo "(required)"; ?></small></label><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
</p>

<p><label for="email"><small><?php _e('Mail', 'blakmagik'); ?>  <?php if ($req) echo "(required)"; ?></small></label><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
</p>

<p><label for="url"><small><?php _e('Website', 'blakmagik'); ?></small></label><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
</p>
</div>
<?php endif; ?>

<!--<p><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p>-->

<p class="text_area"><textarea name="comment" id="comment" cols="100%" rows="10" tabindex="4"></textarea></p>

<p class="submit_btn"><input name="submit" type="submit" id="submit" tabindex="5" value="<?php _e('Submit Comment', 'blakmagik'); ?>" />
<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
</p>

<?php if(function_exists("comment_id_fields")) { ?>
<?php comment_id_fields(); ?>
<?php } ?>
<?php do_action('comment_form', $post->ID); ?>

</form>
</div>
</div>

<?php endif; // If registration required and not logged in ?>

<?php endif; // if you delete this the sky will fall on your head ?>

