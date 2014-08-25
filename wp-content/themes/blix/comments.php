<!-- comments ................................. -->
<div id="comments">

<?php if (function_exists('comment_form_text_output')){ comment_form_text_output(); } ?>
<br /><br />

<?php // Do not delete these lines
	if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die (__('Please do not load this page directly. Thanks!', 'blix'));

        if (!empty($post->post_password)) { // if there's a password
            if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
				?>
				<p class="nocomments"><?php _e("This post is password protected. Enter the password to view comments.", 'blix'); ?><p>
				</div>
				<?php
				return;
            }
        }
		$commentalt = '';
		$commentcount = 1;
?>

<?php if ( have_comments() ) : ?>

<?php if ( ! empty($comments_by_type['comment']) ) : ?>

	<h2><?php comments_number(__('No Comments yet', 'blix'), __('1 Comment', 'blix'), __('% Comments', 'blix') ); if($post->comment_status == "open") { ?> <a href="#commentform" class="more"><?php _e('Add your own', 'blix'); ?></a><?php } ?></h2>


<div id="post-navigator-single">
<div class="alignright"><?php if(function_exists('paginate_comments_links')) {  paginate_comments_links(); } ?></div>
</div>

<ul id="comments" class="commentlist">
<?php wp_list_comments('type=comment&callback=list_comments'); ?>
</ol>


<div id="post-navigator-single">
<div class="alignright"><?php if(function_exists('paginate_comments_links')) {  paginate_comments_links(); } ?></div>
</div>

<?php endif; ?>


 <?php if ( ! empty($comments_by_type['pings']) ) : ?>
 <div class="entry">
	<h3><?php _e('Trackbacks/Pingbacks', 'blix'); ?></h3>

    <ol class="pinglist">
    <?php wp_list_comments('type=pings&callback=list_pings'); ?>
	</ol>
    </div>
	<?php endif; ?>


    	<?php endif; ?>

<?php if ($post->comment_status == "open") : ?>
<div id="respond">
	<h2><?php _e('Leave a comment', 'blix');?></h2>

     <div class="cancel-comment-reply">
<?php cancel_comment_reply_link(); ?>
</div>

	<?php if (get_option('comment_registration') && !$user_ID) : ?>
	<p><?php _e('You must be', 'blix');?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>"><?php _e('logged in', 'blix');?></a> <?php _e('to post a comment.', 'blix');?></p>

<?php else : ?>

	<form action="<?php echo get_option('home'); ?>/wp-comments-post.php" method="post" id="commentform">
		<fieldset>

	<?php if ($user_ID) : ?>

		<p class="info"><?php _e('Logged in as', 'blix');?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="<?php _e('Log out of this account', 'blix') ?>"><?php _e('Logout', 'blix');?> </a>.</p>

<?php else : ?>

			<p><label for="author"><?php _e('Name', 'blix');?></label> <input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" tabindex="1" /> <?php if ($req) echo __("<em>Required</em>"); ?></p>
			<p><label for="email"><?php _e('Email', 'blix'); ?></label> <input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" tabindex="2" /> <em><?php if ($req) echo __("Required, "); ?>hidden</em></p>
			<p><label for="url"><?php _e('Url', 'blix'); ?></label> <input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" tabindex="3" /></p>

<?php endif; ?>

			<p><label for="comment"><?php _e('Comment', 'blix'); ?></label> <textarea name="comment" id="comment" cols="45" rows="10" tabindex="4"></textarea></p>
			<p><input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
			<input type="submit" name="submit" value="<?php _e('Submit', 'blix'); ?>" class="button" tabindex="5" /></p>

	  	</fieldset>
   <?php if(function_exists("comment_id_fields")) { ?>
<?php comment_id_fields(); ?>
<?php } ?>
<?php do_action('comment_form', $post->ID); ?>

	</form>

	<p><strong><?php _e('Some HTML allowed', 'blix'); ?>:</strong><br/><?php echo allowed_tags(); ?></p>
         </div>
<?php endif; // If registration required and not logged in ?>

<?php endif; // if you delete this the sky will fall on your head ?>

<?php if ($post-> comment_status == "open" && $post->ping_status == "open") { ?>
	<p><a href="<?php trackback_url(display); ?>">Trackback this post</a> &nbsp;|&nbsp; <?php post_comments_feed_link(__('Subscribe to the comments via RSS Feed', 'blix')); ?></p>
<?php } elseif ($post-> comment_status == "open") {?>
	<p><?php post_comments_feed_link(__('Subscribe to the comments via RSS Feed', 'blix')); ?></p>
<?php } elseif ($post->ping_status == "open") {?>
	<p><a href="<?php trackback_url(display); ?>"><?php _e('Trackback this post', 'blix'); ?></a></p>
<?php } ?>

</div> <!-- /comments -->
