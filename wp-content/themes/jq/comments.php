<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die (__('Please do not load this page directly. Thanks!', 'jq'));

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'jq'); ?></p>
	<?php
		return;
	}
?>
<!-- You can start editing here. -->
<?php if ( have_comments() ) : ?>
<h2 id="comment-header"><?php comments_number(__('No comments', 'jq'), __('1 comment', 'jq'), __('% comments', 'jq')); ?></h2>
<div id="comments_box">
<ul><?php wp_list_comments('type=all&callback=jq_comments'); ?></ul>
<?php paginate_comments_links(); ?>
</div>
 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->
		<h3><?php _e('No comments yet.', 'jq'); ?></h3>
	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<h3><?php _e('Comments are closed.', 'jq'); ?></h3>
	<?php endif; ?>
<?php endif; ?>

<!-- comment form -->
<?php if ( comments_open() ) : ?>

<div id="respond">

<h2><?php comment_form_title( __('Leave a Reply', 'jq'), __('Leave a Reply to %s', 'jq') ); ?></h2>

<div class="cancel-comment-reply">
	<?php cancel_comment_reply_link(); ?>
</div>

<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
<p>You must be <a href="<?php echo wp_login_url( get_permalink() ); ?>"><?php _e('logged in', 'jq'); ?></a> <?php _e('to post a comment.', 'jq'); ?></p>
<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<?php if ( is_user_logged_in() ) : ?>

<p><?php _e('Logged in as', 'jq'); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('Log out of this account', 'jq'); ?>"><?php _e('Log out &raquo;', 'jq'); ?></a></p>

<?php else : ?>

<label for="author"><?php _e('Name', 'jq'); ?><?php if ($req) echo "*"; ?></label>
<input type="text" name="author" id="author" class="text" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />

<label for="email"><?php _e('Mail', 'jq'); ?><?php if ($req) echo "*"; ?> (will not be published) </label>
<input type="text" name="email" id="email" class="text" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />

<label for="url"><?php _e('Website', 'jq'); ?></label>
<input type="text" name="url" id="url" class="text" value="<?php echo esc_attr($comment_author_url); ?>" size="22" tabindex="3" />


<?php endif; ?>

<!--<p><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p>-->

<label for="message"><?php _e('Your Comment', 'jq'); ?></label>
<p><textarea name="comment" id="comment" cols="58" rows="10" tabindex="4"></textarea></p>

<input name="submit" type="submit" id="submit" class="submit" tabindex="5" value="<?php _e('Submit Comment', 'jq'); ?>" />
<?php comment_id_fields(); ?>

<?php do_action('comment_form', $post->ID); ?>

</form>

<?php endif; // If registration required and not logged in ?>
</div>

<?php endif; // if you delete this the sky will fall on your head ?>
