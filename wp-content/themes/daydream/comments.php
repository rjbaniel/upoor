&nbsp;&nbsp;&nbsp;<?php if (function_exists('comment_form_text_output')){ comment_form_text_output(); } ?><br /><br /><?php // Do not delete these lines
	if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

        if (!empty($post->post_password)) { // if there's a password
            if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
				?>
				
				<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.','daydream');?><p>
				
				<?php
				return;
            }
        }

		/* This variable is for alternating comment background */
		$oddcomment = 'alt';
?>

<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>    <?php if ( ! empty($comments_by_type['comment']) ) : ?>

	<h4 id="comments">&nbsp;&nbsp;<?php comments_number(__('No Responses'), __('One Response'), __('% Responses' ));?></h4>




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
	<h3><?php _e('Trackbacks/Pingbacks','daydream'); ?></h3>

    <ol class="pinglist">
    <?php wp_list_comments('type=pings&callback=list_pings'); ?>
	</ol>
    </div>
	<?php endif; ?>
    <?php endif; ?>





	 <?php else : // this is displayed if there are no comments so far ?>
	
	
		<?php if ('open' == $post->comment_status) : ?> 
		
			<h4&nbsp;&nbsp;&nbsp;<?php _e('There are no comments on this post','daydream');?></h4>
			
		 <?php else : // comments are closed ?>
		 
			<!-- If comments are closed. -->
			<h4>&nbsp;&nbsp;<?php _e('Comments are closed.','daydream');?></h4>
			
		<?php endif; ?>
		
		
	<?php endif; ?>


<?php if ('open' == $post->comment_status) : ?>

<div id="respond">

		<div id="commentformarea" style="text-align: left;">
		
			<h3 id="respond"><?php _e('Leave a Reply','daydream');?></h3>
			
			<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
			<p class="mustbe"><?php _e('You must be','daydream');?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>"><?php _e('logged in','daydream');?></a> <?php _e('to post a comment.','daydream');?></p>
			<?php else : ?>
		
				<form action="<?php echo get_option('home'); ?>/wp-comments-post.php" method="post" id="commentform">
				   <div class="cancel-comment-reply">
<?php cancel_comment_reply_link(); ?>
</div>

				<?php if ( $user_ID ) : ?>
				
				<p><?php _e('Logged in as','daydream');?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="<?php _e('Log out of this account','daydream');?>"><?php _e('Logout','daydream');?> &raquo;</a></p>
				
				<?php else : ?>
				
			&nbsp;&nbsp;&nbsp;	<p><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
				<label for="author"><small><?php _e('Name','daydream');?> <?php if ($req) echo "__('(required)')"; ?></small></label></p>
				
				<p><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
				<label for="email"><small><?php _e('Mail (not published)','daydream');?> <?php if ($req) echo "__('(required)')"; ?></small></label></p>
				
				<p><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
				<label for="url"><small><?php _e('Website','daydream');?></small></label></p>
				
				<?php endif; ?>
				
				<!--<p><small><strong>XHTML:</strong> <?php _e('You can use these tags:');?> <?php echo allowed_tags(); ?></small></p>-->
				
				<p><textarea name="comment" id="comment" cols="50" rows="10" tabindex="4"></textarea></p>
				
				<p><input name="submit" type="submit" id="submit" tabindex="5" value="<?php _e('Submit Comment','daydream');?>" />
				<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
				</p>


<?php if(function_exists("comment_id_fields")) { ?>
<?php comment_id_fields(); ?>
<?php } ?>
<?php do_action('comment_form', $post->ID); ?>
				
				</form>

		</div>
	       </div>
	<?php endif; // If registration required and not logged in ?>

<?php endif; // if you delete this the sky will fall on your head ?>
