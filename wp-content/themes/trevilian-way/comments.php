<br /><?php if (function_exists('comment_form_text_output')){ comment_form_text_output(); } ?><br /><br /><?php // Do not delete these lines
	if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if (!empty($post->post_password)) { // if there's a password
		if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
			?>

			<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.',TEMPLATE_DOMAIN);?><p>

			<?php
			return;
		}
	}

	/* This variable is for alternating comment background */
	$oddcomment = 'alt';
	/* This variable is for comment numbering */
	$c_comment_number = 1;
	/* This variable is for alternate author styling */
	$blog_author_email_password = 'email@password.com';
?>

<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>

	<h4 id="comment-section-title"><?php comments_number(__('No Discussion Yet',TEMPLATE_DOMAIN), __('One Response',TEMPLATE_DOMAIN), __('% Responses',TEMPLATE_DOMAIN));?></h4>
	<p class="post-comments-rss"><?php _e('You can follow the comments for this article with the',TEMPLATE_DOMAIN);?> <?php post_comments_feed_link('RSS 2.0'); ?> <?php _e('feed',TEMPLATE_DOMAIN);?>.</p>
	
<?php if ( ! empty($comments_by_type['comment']) ) : ?>

<div id="post-navigator-single">
<div class="alignright"><?php if(function_exists('paginate_comments_links')) {  paginate_comments_links(); } ?></div>
</div>

<div id="comments" class="commentlist">
<?php wp_list_comments('type=comment&callback=list_comments'); ?>
</div>


<div id="post-navigator-single">
<div class="alignright"><?php if(function_exists('paginate_comments_links')) {  paginate_comments_links(); } ?></div>
</div>

<?php endif; ?>


 <?php if ( $post->ping_status == "open" ) : ?>
 <?php if ( ! empty($comments_by_type['pings']) ) : ?>
 <div class="entry">
	<h3><?php _e('Trackbacks/Pingbacks',TEMPLATE_DOMAIN); ?></h3>

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
		<p>Comments are closed.</p>

	<?php endif; ?>
	
<?php endif; ?>


<?php if ('open' == $post->comment_status) : ?>

<div id="respond">
<div id="commentform-area">

 <p><?php _e('Leave a Reply',TEMPLATE_DOMAIN);?></p>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>

<p><?php _e('You must be',TEMPLATE_DOMAIN); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"><?php _e('logged in',TEMPLATE_DOMAIN); ?></a> <?php _e('to post a comment.',TEMPLATE_DOMAIN); ?></p>

<?php else : ?>

<form action="<?php echo get_option('home'); ?>/wp-comments-post.php" method="post" id="commentform">

<div class="cancel-comment-reply">
<?php cancel_comment_reply_link(); ?>
</div>


	<?php if ( $user_ID ) : ?>

  <p><?php _e('Logged in as',TEMPLATE_DOMAIN); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('Log out of this account',TEMPLATE_DOMAIN); ?>"><?php _e('Log out &raquo;',TEMPLATE_DOMAIN); ?></a></p>


	<?php else : ?>
	
	<fieldset id="cf-identifiers">
	
		<div class="input-container">
			<label for="cf-name"><?php _e("Name*",TEMPLATE_DOMAIN); ?></label>
			<input id="cf-name" type="text" name="author" title="Name" value="<?php echo $comment_author; ?>" tabindex="1" />
		</div>
		
		<div class="input-container">
			<label for="cf-email"><?php _e("Email* (not published)",TEMPLATE_DOMAIN); ?></label>
			<input id="cf-email" type="text" name="email" title="Email" value="<?php echo $comment_author_email; ?>" tabindex="2" />
		</div>
		
		<div class="input-container">
			<label for="cf-url"><?php _e('Website',TEMPLATE_DOMAIN);?></label>
			<input id="cf-url" type="text" name="url" title="URL" value="<?php echo $comment_author_url; ?>" tabindex="3" />
		</div>
		
	</fieldset>

	<?php endif; ?>

	<fieldset id="cf-content-submit">
	
		<textarea id="comment" name="comment" cols="50" rows="10" tabindex="4"></textarea>
		<p class="post-comments-instructions"><?php _e("Required fields are marked with an asterisk (*), you may use these tags in your comment:",TEMPLATE_DOMAIN); ?> <code><?php echo allowed_tags(); ?></code></p>
		<input id="submit" name="submit" type="submit" tabindex="5" value="<?php _e('Submit Comment',TEMPLATE_DOMAIN);?>" />
		<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
		
	</fieldset>
	
  <?php if(function_exists("comment_id_fields")) { ?>
<?php comment_id_fields(); ?>
<?php } ?>
<?php do_action('comment_form', $post->ID); ?>

</form>

</div>

</div>
<?php endif; // If registration required and not logged in ?>

<?php endif; // if you delete this the sky will fall on your head ?>
