<?php // Do not delete these lines

	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))

		die (__('Please do not load this page directly. Thanks!','slt'));



	if (!empty($post->post_password)) { // if there's a password

		if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie

			?>



			<p><?php _e('This post is password protected. Enter the password to view comments.','slt'); ?></p>



			<?php

			return;

		}

	}



	/* This variable is for alternating comment background */

	$oddcomment = 'class="alt" ';

?>



<!-- You can start editing here. -->


<?php if ( have_comments() ) : ?>

	<h3 id="comments"><?php comments_number(__('No Responses','slt'), __('One Response','slt'), __('% Responses','slt') );?> <?php _e('to','slt'); ?> &#8220;<?php the_title(); ?>&#8221;</h3>


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
	<h3><?php _e('Trackbacks/Pingbacks','slt'); ?></h3>

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

		<p><?php _e('Comments are closed.','slt'); ?></p>



	<?php endif; ?>

<?php endif; ?>



<?php if ('open' == $post->comment_status) : ?>

<div id="respond">

<h3 id="respond"><?php _e('Leave a Reply','slt'); ?></h3>

<div class="cancel-comment-reply">
<?php cancel_comment_reply_link(); ?>
</div>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>

<p><?php _e('You must be','slt');?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>"><?php _e('logged in','slt');?></a> <?php _e('to post a comment.','slt');?></p>

<?php else : ?>



<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">



<?php if ( $user_ID ) : ?>



<p><?php _e('Logged in as','slt');?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="<?php _e('Log out of this account','slt');?>"><?php _e('Logout','slt');?> &raquo;</a></p>



<?php else : ?>



<input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />

<label for="author"><?php _e('Name','slt'); ?> <?php if ($req) echo "(required)"; ?></label><br /><br />



<input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />

<label for="email"><?php _e('Mail (will not be published)','slt'); ?> <?php if ($req) echo "(required)"; ?></label><br /><br />



<input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />

<label for="url"><?php _e('Website','slt'); ?></label>



<?php endif; ?>



<p><strong>XHTML:</strong> <?php _e('You can use these tags:','slt'); ?> <code><?php echo allowed_tags(); ?></code></p>



<textarea name="comment" id="comment" cols="65%" rows="10" tabindex="4"></textarea><br />

<input name="submit" type="submit" id="submit" tabindex="5" value="<?php _e('Submit Comment','slt'); ?>" />

<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />

<?php if(function_exists("comment_id_fields")) { ?>
<?php comment_id_fields(); ?>
<?php } ?>
<?php do_action('comment_form', $post->ID); ?>



</form>

</div>

<?php endif; // If registration required and not logged in ?>



<?php endif; // if you delete this the sky will fall on your head ?>



