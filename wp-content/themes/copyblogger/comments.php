<?php if (function_exists('comment_form_text_output')){ comment_form_text_output(); } ?><br /><br /><?php // Do not delete these lines
	if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

        if (!empty($post->post_password)) { // if there's a password
            if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
	?>
			
		<p class="center"><?php _e("This post is password protected. Enter the password to view comments.",'copyblogger'); ?><p>
				
<?php	return; } }


	/* Function for seperating comments from track- and pingbacks. */
	function k2_comment_type_detection($commenttxt = 'Comment', $trackbacktxt = 'Trackback', $pingbacktxt = 'Pingback') {
		global $comment;
		if (preg_match('|trackback|', $comment->comment_type))
			return $trackbacktxt;
		elseif (preg_match('|pingback|', $comment->comment_type))
			return $pingbacktxt;
		else
			return $commenttxt;
	}

	$templatedir = get_bloginfo('template_directory');
	
	$comment_number = 1;
?>

<!-- You can start editing here. -->

<?php if (($comments) or ('open' == $post-> comment_status)) { ?>

<div id="comments">

<h3 class="comment_intro"><?php comments_number(__('0 comments','copyblogger'), __('1 comment so far','copyblogger'), __('% comments','copyblogger') );?> &darr;</h3>

<?php if ($comments) { ?>

<div id="post-navigator-single">
<div class="alignright"><?php if(function_exists('paginate_comments_links')) {  paginate_comments_links(); } ?></div>
</div>

<ul id="comment_list">
<?php wp_list_comments('type=comment&callback=list_comments'); ?>
</ul>

<div id="post-navigator-single">
<div class="alignright"><?php if(function_exists('paginate_comments_links')) {  paginate_comments_links(); } ?></div>
</div>



 <?php if ( $post->ping_status == "open" ) : ?>
 <?php if ( ! empty($comments_by_type['pings']) ) : ?>
 <div class="entry">
	<h3><?php _e('Trackbacks/Pingbacks','copyblogger'); ?></h3>

    <ol class="pinglist">
    <?php wp_list_comments('type=pings&callback=list_pings'); ?>
	</ol>
    </div>
	<?php endif; ?>
    <?php endif; ?>


	

		
	<?php } else { // this is displayed if there are no comments so far ?>

		<?php if ('open' == $post-> comment_status) { ?> 
		<!-- If comments are open, but there are no comments. -->
		
		<div class="entry">
			<p><?php _e('There are no comments yet...Kick things off by filling out the form below.','copyblogger');?>.</p>
		</div>

		<?php } else { // comments are closed ?>

		<!-- If comments are closed. -->

		<?php if (is_single) { // To hide comments entirely on Pages without comments ?>
		<div class="entry">
			<p><?php _e('Like gas stations in rural Texas after 10 pm, comments are closed.','copyblogger');?></p>
		</div>
		<?php } ?>
	
		<?php } ?>

	<?php } ?>

	<!-- Comment Form -->
	<?php if ('open' == $post-> comment_status) : ?>
  <div id="respond">

  <?php if ( get_option('comment_registration') && !$user_ID ) : ?>
	
<p class="unstyled"><?php _e('You must','copyblogger');?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>"><?php _e('log in','copyblogger');?></a> <?php _e('to post a comment','copyblogger');?>.</p>

	<?php else : ?>


<h3 id="respond"><?php _e('Leave a Comment','copyblogger');?></h3>

<form action="<?php echo get_option('home'); ?>/wp-comments-post.php" method="post" id="comment_form">
			
<div class="cancel-comment-reply">
<?php cancel_comment_reply_link(); ?>
</div>

<?php if ( $user_ID ) { ?>
				<p class="unstyled"><?php _e('Logged in as','copyblogger');?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('Log out of this account','copyblogger') ?>"><?php _e('Logout','copyblogger');?> &raquo;</a></p>
			<?php } ?>
			<?php if ( !$user_ID ) { ?>
				<p><input class="text_input" type="text" name="author" id="author" value="<?php echo $comment_author; ?>" tabindex="1" /><label for="author"><strong><?php _e('Name','copyblogger'); ?></strong></label></p>
				<p><input class="text_input" type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" tabindex="2" /><label for="email"><strong><?php _e('Mail','copyblogger'); ?></strong></label></p>
				<p><input class="text_input" type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" tabindex="3" /><label for="url"><strong><?php _e('Website','copyblogger');?></strong></label></p>
			<?php } ?>
				<!--<p><small><strong>XHTML:</strong> <?php _e('You can use these tags:');?> <?php echo allowed_tags(); ?></small></p>-->
			
				<p><textarea class="text_input text_area" name="comment" id="comment" rows="7" tabindex="4"></textarea></p>
			
				<?php if (function_exists('show_subscription_checkbox')) { show_subscription_checkbox(); } ?>

				<p>
					<input name="submit" class="form_submit" type="submit" id="submit" tabindex="5" value="<?php _e('Submit','copyblogger');?>" />
					<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
				</p>

			   <?php if(function_exists("comment_id_fields")) { ?>
<?php comment_id_fields(); ?>
<?php } ?>
<?php do_action('comment_form', $post->ID); ?>
	
			</form>
		<?php endif; // If registration required and not logged in ?>
            </div>
<?php endif; // if you delete this the sky will fall on your head ?>
</div> <!-- Close #comments container -->
<?php } ?>
