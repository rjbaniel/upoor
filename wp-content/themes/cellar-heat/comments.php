<?php // Do not delete these lines

	if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))

		die (__('Please do not load this page directly. Thanks!', 'cellar-heat') );



	if (!empty($post->post_password)) { // if there's a password

		if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie

			?>



			<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'cellar-heat'); ?></p>



			<?php

			return;

		}

	}



	/* This variable is for alternating comment background */

	$oddcomment = 'class="alt" ';

?>



<!-- You can start editing here. -->



<?php if ( have_comments() ) : ?><?php if ( ! empty($comments_by_type['comment']) ) : ?>

	<div id="comment-list"><?php comments_number(__('No Comments', 'cellar-heat'), __('One comment', 'cellar-heat'), __('% comments', 'cellar-heat') );?> <?php _e('to...', 'cellar-heat'); ?><br /><span class="bigger">&#8220;<?php the_title(); ?>&#8221;</span></div>


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
	<h3><?php _e('Trackbacks/Pingbacks', 'cellar-heat'); ?></h3>

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

		<p class="nocomments"><?php _e('Comments are closed.', 'cellar-heat'); ?></p>



	<?php endif; ?>

<?php endif; ?>





<?php if ('open' == $post->comment_status) : ?>

<div id="respond">

<div class="cancel-comment-reply">
<?php cancel_comment_reply_link(); ?>
</div>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>

<p><?php _e('You must be');?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>"><?php _e('logged in', 'cellar-heat');?></a> <?php _e('to post a comment.', 'cellar-heat');?></p>
<?php else : ?>



<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">



<?php if ( $user_ID ) : ?>


<p><?php _e('Logged in as', 'cellar-heat');?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('Log out of this account', 'cellar-heat');?>"><?php _e('Logout', 'cellar-heat');?> &raquo;</a></p>



<?php else : ?>

<div class="comments-PII">

<p><label for="author"><?php _e('Name:', 'cellar-heat'); ?></label><br />

<input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" tabindex="1" /><br />

<span class="note"><?php if ($req) echo "required"; ?></span></p>



<p><label for="email"><?php _e('Email Address:', 'cellar-heat'); ?></label><br />

<input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" tabindex="2" /><br />

<span class="note"><?php if ($req) echo "required -"; ?> won't be displayed</span></p>



<p><label for="url"><?php _e('Website URL:', 'cellar-heat'); ?></label><br />

<input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" tabindex="3" /></p>

</div>

<?php endif; ?>



<!--<p><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p>-->

<div class="comments-PII-2">

<p><?php _e('Your Comment:', 'cellar-heat'); ?><br />

<textarea name="comment" id="comment" tabindex="4"></textarea></p>



<p><input name="submit" type="submit" id="submit" tabindex="5" value="<?php _e('Add Comment &raquo;', 'cellar-heat'); ?>" />

<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />

</p>

</div>

<?php if(function_exists("comment_id_fields")) { ?>
<?php comment_id_fields(); ?>
<?php } ?>
<?php do_action('comment_form', $post->ID); ?>



</form>

</div>

<?php endif; // If registration required and not logged in ?>



<?php endif; // if you delete this the sky will fall on your head ?>

