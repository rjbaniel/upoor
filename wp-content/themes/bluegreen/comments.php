<?php if (function_exists('comment_form_text_output')){ comment_form_text_output(); } ?><br /><br />
<?php // Do not delete these lines
	if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die (__('Please do not load this page directly. Thanks!', 'bluegreen'));

        if (!empty($post->post_password)) { // if there's a password
            if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
				?>
				
				<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'bluegreen');?><p>
				
				<?php
				return;
            }
        }

		/* This variable is for alternating comment background */
		$oddcomment = 'odd';
?>

<!-- You can start editing here. -->

<div class="boxcomments">

<ol id="comments" class="commentlist">

<li class="commenthead"><h2 id="comments"><?php comments_number(__('No Responses', 'bluegreen'), __('One Response', 'bluegreen'), __('% Responses', 'bluegreen') );?> <?php _e('to', 'bluegreen');?>  &#8220;<?php the_title(); ?>&#8221;</h2></li>



<div id="post-navigator-single">
<div class="alignright"><?php if(function_exists('paginate_comments_links')) {  paginate_comments_links(); } ?></div>
</div>


<?php wp_list_comments('type=comment&callback=list_comments'); ?>



<div id="post-navigator-single">
<div class="alignright"><?php if(function_exists('paginate_comments_links')) {  paginate_comments_links(); } ?></div>
</div>


 <?php if ( $post->ping_status == "open" ) : ?>
 <?php if ( ! empty($comments_by_type['pings']) ) : ?>
 <div class="entry">
	<h3><?php _e('Trackbacks/Pingbacks', 'bluegreen'); ?></h3>

    <ol class="pinglist">
    <?php wp_list_comments('type=pings&callback=list_pings'); ?>
	</ol>
    </div>
	<?php endif; ?>
    <?php endif; ?>


	</ol>


	



<?php if (comments_open()) : ?>
<div id="respond">

<div class="cancel-comment-reply">
<?php cancel_comment_reply_link(); ?>
</div>


	<?php if (get_option('comment_registration') && !$user_ID ) : ?>
		<p id="comments-blocked"><?php _e('You must be', 'bluegreen');?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=
		<?php the_permalink(); ?>"><?php _e('logged in', 'bluegreen');?></a> <?php _e('to post a comment.', 'bluegreen');?></p>
	<?php else : ?>

	<form action="<?php echo get_option('home'); ?>/wp-comments-post.php" method="post" id="commentform">

	<h3 id="respond"><?php _e('Post a Comment', 'bluegreen');?></h3>

	<?php if ($user_ID) : ?>
	
	<p>You are <?php _e('Logged in as', 'bluegreen');?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php">
		<?php echo $user_identity; ?></a>. <?php _e('To logout,', 'bluegreen');?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="<?php _e('Log out of this account', 'bluegreen'); ?>"><?php _e('click here', 'bluegreen');?></a>.
	</p>
	
<?php else : ?>	
	
		<p><label for="author"><?php _e('Name', 'bluegreen');?> <?php if ($req) _e(' (required)'); ?></label>
		<input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" /></p>
				
		<p><label for="email"><?php _e('E-mail (will not be published)', 'bluegreen');?><?php if ($req) _e(' (required)'); ?></label>
		<input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" tabindex="2" size="22" /></p>		
		
		<p><label for="url"><?php _e('Website', 'bluegreen');?></label>
		<input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" /></p>
	
	<?php endif; ?>

		<p><textarea name="comment" id="comment" cols="5" rows="10" tabindex="4"></textarea></p>

		<p><input name="submit" type="submit" id="submit" tabindex="5" value="<?php _e('Submit Comment', 'bluegreen');?>" />
		<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" /></p>
	
   <?php if(function_exists("comment_id_fields")) { ?>
<?php comment_id_fields(); ?>
<?php } ?>
<?php do_action('comment_form', $post->ID); ?>

	</form>

      </div>

<?php endif; // If registration required and not logged in ?>

<?php else : // Comments are closed ?>

<?php endif; ?>


</div>
