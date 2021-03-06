<?php // Do not delete these lines. Taken from Kubrick.
	if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Hey! You\'re not supposed to be here. Go someplace else.');

        if (!empty($post->post_password)) { // if there's a password
            if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
				?>
				
				<p>This post is password protected. Enter the password to view comments.<p>
				
				<?php
				return;
            }
        }

		/* This variable is for alternating comment background */
		$oddcomment = 'alt';
?>

<a name="comments"></a>
<?php if ('open' == $post->comment_status) : ?> 
	<!-- If comments are open. -->
	<h3 class="substory_subhead"><?php comments_number(__('No Comments',TEMPLATE_DOMAIN), __('One Comment',TEMPLATE_DOMAIN), __('% Comments',TEMPLATE_DOMAIN) ); ?> <?php _e("currently posted.",TEMPLATE_DOMAIN); ?></h3>
 <?php else : // comments are closed ?>
	<!-- If comments are closed. -->
	<h3 class="substory_subhead"><?php _e("Comments are locked.",TEMPLATE_DOMAIN); ?></h3>
<?php endif; ?>



<?php if ( have_comments() ) : ?><?php if ( ! empty($comments_by_type['comment']) ) : ?>

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

        <?php endif; ?>


<?php if ('open' == $post->comment_status) : ?>
<div id="respond">
<h3 class="substory_head"><?php _e("Post a comment on this entry:",TEMPLATE_DOMAIN); ?></h3>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>

	<p><?php _e("You must be",TEMPLATE_DOMAIN); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>">
    <?php _e("logged in",TEMPLATE_DOMAIN); ?></a> <?php _e("to post a comment on this entry.",TEMPLATE_DOMAIN); ?></p>

<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
<div class="cancel-comment-reply">
<?php cancel_comment_reply_link(); ?>
</div>

<?php if ( $user_ID ) : ?>
	
		<p><?php _e("You are currently logged in as",TEMPLATE_DOMAIN); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>.
		<a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="<?php _e("Log out of this account",TEMPLATE_DOMAIN); ?>"><?php _e("Logout",TEMPLATE_DOMAIN); ?></a></p>
	
	<?php else : ?>

		<!-- comment form -->
		<p><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
		<label for="author"><?php _e("Name",TEMPLATE_DOMAIN); ?> <?php if ($req) echo "<strong>required</strong>"; ?></label></p>
		
		<p><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
		<label for="email"><?php _e("Mail (will not be published)",TEMPLATE_DOMAIN); ?> <?php if ($req) echo "<strong>required</strong>"; ?></label></p>

		<p><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
	   <label for="url"><?php _e("Website",TEMPLATE_DOMAIN); ?></label></p>
	
	<?php endif; ?>
	
		<p><textarea name="comment" id="comment" cols="100%" rows="10" tabindex="4"></textarea></p>

		<p><input name="submit" type="submit" id="submit" tabindex="5" value="<?php _e("Submit Comment",TEMPLATE_DOMAIN); ?>" />
		<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
		</p>

<?php if(function_exists("comment_id_fields")) { ?>
<?php comment_id_fields(); ?>
<?php } ?>
<?php do_action('comment_form', $post->ID); ?>

</form>
</div>
<?php endif; ?>

<?php endif; ?>
