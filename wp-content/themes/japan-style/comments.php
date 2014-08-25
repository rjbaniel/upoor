<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die (__('Please do not load this page directly. Thanks!', 'japan-style'));

	if (!empty($post->post_password)) { // if there's a password
		if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
			?>

			<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'japan-style'); ?></p>

			<?php
			return;
		}
	}
?>

<?php if ( have_comments() ) : ?>

	<h1 class="comments-title"><?php comments_number(__('Comments (0)', 'japan-style'), __('Comments (1)', 'japan-style'), __('Comments (%)', 'japan-style') );?></h1>



	<div id="comments">

    <?php if ( ! empty($comments_by_type['comment']) ) : ?>


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
	<h3><?php _e('Trackbacks/Pingbacks', 'japan-style'); ?></h3>

    <ol class="pinglist">
    <?php wp_list_comments('type=pings&callback=list_pings'); ?>
	</ol>
    </div>
	<?php endif; ?>
    <?php endif; ?>

	</div>

<?php else : // this is displayed if there are no comments so far ?>
 
	<?php if ('open' == $post->comment_status) : ?>
		<!-- If comments are open, but there are no comments. -->
	<?php else : // comments are closed ?>
		<!-- If comments are closed. -->
	<?php endif; ?>
	
<?php endif; ?>



<?php if ('open' == $post->comment_status) : ?>
<div id="respond">
	<h1 class="comments-title"><?php _e('Leave a comment', 'japan-style'); ?></h1>
          <div class="cancel-comment-reply">
<?php cancel_comment_reply_link(); ?>
</div>
	<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
	   <p><?php _e('You must be', 'japan-style');?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>"><?php _e('logged in', 'japan-style');?></a> <?php _e('to post a comment.', 'japan-style');?></p>
	<?php else : ?>
		<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
			<?php _e('Your comment', 'japan-style'); ?>
			<p><textarea name="comment" id="comment"></textarea></p>
			
			<?php if ( $user_ID ) : ?>
                <p><?php _e('Logged in as', 'japan-style');?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="<?php _e('Log out of this account', 'japan-style');?>"><?php _e('Logout', 'japan-style');?> &raquo;</a></p>

			<?php else : ?>			
				<p><input type="text" name="author" id="author" class="text" value="<?php echo $comment_author; ?>" />
				<label for="author"><?php _e('Name', 'japan-style'); ?> <?php if ($req) echo "(required)"; ?></label></p>

				<p><input type="text" name="email" id="email" class="text" value="<?php echo $comment_author_email; ?>" />
				<label for="email"><?php _e('Mail (will not be published)', 'japan-style'); ?> <?php if ($req) echo "(required)"; ?></label></p>

				<p><input type="text" name="url" id="url" class="text" value="<?php echo $comment_author_url; ?>" />
				<label for="url"><?php _e('Website', 'japan-style'); ?></label></p>
			<?php endif; ?>
			
<?php if(function_exists("comment_id_fields")) { ?>
<?php comment_id_fields(); ?>
<?php } ?>
<?php do_action('comment_form', $post->ID); ?>
			
			<p><input name="submit" type="submit" id="submit" class="bt" value="<?php _e('Submit Comment', 'japan-style'); ?>" /><input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" /></p>

			

		</form>
      </div>
<?php endif; // If registration required and not logged in ?>

<?php endif; // if you delete this the sky will fall on your head ?>
