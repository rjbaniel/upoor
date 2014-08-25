<?php // Do not delete these lines
if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
die ('Please do not load this page directly. Thanks!');

if (!empty($post->post_password)) { // if there's a password
	if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
		?>
		
		<p class="nocomments"><?php _e("This post is password protected. Enter the password to view comments."); ?><p>
		
		<?php
		return;
	}
}

/* This variable is for alternating comment background */
$oddcomment = 'alt';
?>

<!-- You can start editing here. -->

<a name="comments" id="comments"></a>

<?php if ( have_comments() ) : ?>

<h3 class="reply"><?php comments_number(__('No Responses', 'journalist'), __('One Response', 'journalist'), __('% Responses', 'journalist') );?> <?php _e('to', 'journalist'); ?> '<?php the_title(); ?>'</h3>

<p class="comment_meta">Subscribe to comments with <?php post_comments_feed_link('RSS'); ?> 
<?php if ( pings_open() ) : ?>
	or <a href="<?php trackback_url() ?>" rel="trackback">TrackBack</a> to '<?php the_title(); ?>'.
<?php endif; ?>
</p>

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
	<h3><?php _e('Trackbacks/Pingbacks', 'journalist'); ?></h3>

    <ol class="pinglist">
    <?php wp_list_comments('type=pings&callback=list_pings'); ?>
	</ol>
    </div>
	<?php endif; ?>
    <?php endif; ?>




<?php else : // this is displayed if there are no comments so far ?>

<?php if ('open' == $post-> comment_status) : ?> 
<!-- If comments are open, but there are no comments. -->

<?php else : // comments are closed ?>
<!-- If comments are closed. -->
<p class="nocomments"><?php _e('Comments are closed.', 'journalist'); ?></p>

<?php endif; ?>
<?php endif; ?>


<?php if ('open' == $post-> comment_status) : ?>



<div id="respond">

<h3 class="reply">Leave a Reply</h3>

<div class="cancel-comment-reply">
<?php cancel_comment_reply_link(); ?>
</div>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>"><?php _e('logged in', 'journalist'); ?></a> <?php _e('to post a comment.', 'journalist'); ?></p>
<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
<div class="postinput">
<?php if ( $user_ID ) : ?>

<p><?php _e('Logged in as', 'journalist');?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="<?php _e('Log out of this account', 'journalist');?>"><?php _e('Logout', 'journalist');?> &raquo;</a></p>

<?php else : ?>
<p><input class="comment" type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
<label for="author"><small><?php _e('Name', 'journalist'); ?> <?php if ($req) _e('(required)'); ?></small></label></p>

<p><input class="comment" type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
<label for="email"><small><?php _e('Mail (will not be published)', 'journalist'); ?> <?php if ($req) _e('(required)'); ?></small></label></p>

<p><input class="comment" type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
<label for="url"><small><?php _e('Website', 'journalist'); ?></small></label></p>

<?php endif; ?>

<!--<p><small><strong>XHTML:</strong> You can use these tags: <?php echo allowed_tags(); ?></small></p>-->

<p><textarea name="comment" id="comment" cols="100%" rows="10" tabindex="4"></textarea></p>

<p><input class="submit" name="submit" type="submit" id="submit" tabindex="5" value="<?php _e('Submit Comment', 'journalist'); ?>" title="<?php _e('Please review your comment before submitting', 'journalist'); ?>" />
<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
</p>
<?php if(function_exists("comment_id_fields")) { ?>
<?php comment_id_fields(); ?>
<?php } ?>
<?php do_action('comment_form', $post->ID); ?>
</div>
</form>
</div>
<?php endif; // If registration required and not logged in ?>

<?php endif; // if you delete this the sky will fall on your head ?>
