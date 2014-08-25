<?php


// if comments are closed and is page then do nothing
if( !comments_open() && is_page() ) {

} else { ?>

<div id="comments">

	<h2><?php _e('Comments','regulus'); if ( comments_open() ) : ?><a href="#postComment" title="<?php _e('leave a comment','regulus'); ?>">&raquo;</a><?php endif; ?></h2>

	<?php

	global $usePassword;
	
	if ( $usePassword ) { ?>

		<p><?php _e('Enter your password to view comments','regulus'); ?></p>
		
 	<?php
 	
	} else if ( $comments ) {

		$commentCount = 1;

		?>





       <?php if ( ! empty($comments_by_type['comment']) ) : ?>

<div id="post-navigator-single">
<div class="alignright"><?php if(function_exists('paginate_comments_links')) {  paginate_comments_links(); } ?></div>
</div>

<dl id="comments" class="commentlist">
<?php wp_list_comments('type=comment&callback=list_comments'); ?>
</dl>


<div id="post-navigator-single">
<div class="alignright"><?php if(function_exists('paginate_comments_links')) {  paginate_comments_links(); } ?></div>
</div>

<?php endif; ?>


 <?php if ( $post->ping_status == "open" ) : ?>
 <?php if ( ! empty($comments_by_type['pings']) ) : ?>

<h3><?php _e('Trackbacks/Pingbacks',TEMPLATE_DOMAIN); ?></h3>
<dl id="pings">
<?php wp_list_comments('type=pings&callback=list_pings'); ?>
</dl>

	<?php endif; ?>
    <?php endif; ?>














	<?php } else { // If there are no comments yet

		if ( comments_open() ) {

			echo "<p>".__('no comments yet - be the first?','regulus')."</p>";
			
		} else {

			echo "<p>".__('Sorry comments are closed for this entry','regulus')."</p>";

		}
		
	} ?>
	
</div>

	<?php if ( comments_open() && !$usePassword ) { ?>
                         <div id="respond">
<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="postComment">

<div class="cancel-comment-reply">
<?php cancel_comment_reply_link(); ?>
</div>
	<input type="hidden" name="comment_post_ID" value="<?php echo $post->ID; ?>" />
	<input type="hidden" name="redirect_to" value="<?php echo esc_html($_SERVER['REQUEST_URI']); ?>" />

	<label for="comment"><?php _e('message','regulus'); ?></label><br /><textarea name="comment" id="comment" tabindex="1"></textarea>

<?php

	if ( $user_ID ) {
	
?>
		<p><?php _e('Logged in as', 'regulus');?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out of this account">Logout &raquo;</a></p>
		
<?php

	} else {
	
?>
	
		<label for="author"><?php _e('name','regulus'); ?></label><input name="author" id="author" value="<?php echo $comment_author; ?>" tabindex="2" />
		<label for="email"><?php _e('email','regulus'); ?></label><input name="email" id="email" value="<?php echo $comment_author_email; ?>" tabindex="3" />
		<label for="url"><?php _e('url','regulus'); ?></label><input name="url" id="url" value="<?php echo $comment_author_url; ?>" tabindex="4" />
		
	<?php } ?>

	<input class="button" name="submit" id="submit" type="submit" tabindex="5" value="<?php _e('say it!','regulus'); ?>" />
   <?php if(function_exists("comment_id_fields")) { ?>
<?php comment_id_fields(); ?>
<?php } ?>
<?php do_action('comment_form', $post->ID); ?>

</form>

<?php
     echo "</div>";
		}
	}
	
?>
