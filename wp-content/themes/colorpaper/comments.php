<?php // Do not delete these lines

	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))

		die (__('Please do not load this page directly. Thanks!', 'colorpaper'));



	if (!empty($post->post_password)) { // if there's a password

		if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie

			?>



			<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'colorpaper'); ?></p>



			<?php

			return;

		}

	}



	/* This variable is for alternating comment background */

	$oddcomment = ' alt ';

	global $style;

?>



<!-- You can start editing here. -->



<?php if ( have_comments() ) : ?><?php if ( ! empty($comments_by_type['comment']) ) : ?>



	<h3 id="comments" class="post">

		<?php comments_number('<span class="'.$style.'">0</span> Comments', '<span class="'.$style.'">1</span> Comment', '<span class="'.$style.'">%</span> Comments' );?>

	</h3>

	
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
	<h3><?php _e('Trackbacks/Pingbacks', 'colorpaper'); ?></h3>

    <ol class="pinglist">
    <?php wp_list_comments('type=pings&callback=list_pings'); ?>
	</ol>
    </div>
	<?php endif; ?>
    <?php endif; ?>



	<br /><br />

 <?php else : ?>

	<?php if ('open' == $post->comment_status) : ?>

	<?php else : // comments are closed ?>

		<h2 class="nocomments post"><?php _e('Comments are closed.', 'colorpaper'); ?></h2>

	<?php endif; ?>

<?php endif; ?>



<?php if ('open' == $post->comment_status) : ?>


<div id="respond">
<h3 id="respond" class="post"><?php _e('Leave a Reply', 'colorpaper'); ?></h3>

<div class="cancel-comment-reply">
<?php cancel_comment_reply_link(); ?>
</div>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>

<p><?php _e('You must be');?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>"><?php _e('logged in','colorpaper');?></a> <?php _e('to post a comment.', 'colorpaper');?></p>

<?php else : ?>



<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">



<?php if ( $user_ID ) : ?>



<p><?php _e('Logged in as', 'colorpaper');?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('Log out of this account', 'colorpaper');?>"><?php _e('Logout', 'colorpaper');?> &raquo;</a></p>


<?php else : ?>



<p><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" class="text" />

<label for="author"><small>Name <?php if ($req) echo "(required)"; ?></small></label></p>



<p><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" class="text" />

<label for="email"><small>Mail (will not be published) <?php if ($req) echo "(required)"; ?></small></label></p>



<p><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" class="text" />

<label for="url"><small>Website</small></label></p>



<?php endif; ?>



<!--<p><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p>-->



<p><textarea name="comment" id="comment" cols="100%" rows="10" tabindex="4" class="text textarea"></textarea></p>



<p><input name="submit" type="submit" id="submit" tabindex="5" value="Submit" class="btn submit btn-<?php echo $style; ?>" />

<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />

</p>

<?php if(function_exists("comment_id_fields")) { ?>
<?php comment_id_fields(); ?>
<?php } ?>
<?php do_action('comment_form', $post->ID); ?>



</form>

</div>


<?php endif; // If registration required and not logged in ?>



<?php endif; // if you delete this the sky will fall on your head ?>

