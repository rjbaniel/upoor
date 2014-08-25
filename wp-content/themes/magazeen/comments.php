<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die (__('Please do not load this page directly. Thanks!', 'magazeen'));

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'magazeen'); ?></p>
	<?php
		return;
	}
?>

	<br />

<div id="comments" class="post-box">
					
	<div class="comment-content">
						
		<div class="comment-count">
<a href="#comments"><?php comments_number(__('0 Comments', 'magazeen'), __('1 Comment', 'magazeen'), __('% Comments', 'magazeen') );?></a>
		</div>

		<?php if ( have_comments() ) : ?>
			<ol class="commentlist clearfix">
				<?php wp_list_comments( 'callback=magazeen_comment' ); ?>
			</ol>
		<?php else : ?>
			<?php if ('open' == $post->comment_status) : ?>
				<ol class="commentlist">
					<li class="no-comments">
						<p><?php _e('It&lsquo;s quiet in here! Why not leave a <a href="#respond">response</a>?', 'magazeen'); ?></p>
					</li>
				</ol>
					<br />
			<?php else : ?>
				<p class="nocomments"><?php _e('Comments are closed.', 'magazeen'); ?></p>
			<?php endif; ?>
		<?php endif; ?>
		
	</div>
	
</div>
	
	<br />
	
	<?php echo $page ?>
	
<?php if( get_previous_comments_link() || get_next_comments_link() ) : ?>
	
<div class="navigation arial clearfix">
	<div class="alignleft"><?php previous_comments_link(); ?></div>
	<div class="alignright"><?php next_comments_link(); ?></div>
</div>

<?php endif; ?>

<?php if ('open' == $post->comment_status) : ?>

<div id="respond" <?php post_class( ); ?> style="margin-top:10px; padding:15px;">

	<div class="post-meta clearfix">
				
		<h3 class="post-title-small left">Leave a Response</h3>
		
		<p class="post-info right">
			<small><?php cancel_comment_reply_link(); ?></small>
		</p>
						
	</div><!-- End post-meta -->

	<div class="post-box">
					
		<div class="page-content">
		
			<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
			<p><?php _e('You must be', 'magazeen'); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"><?php _e('logged in', 'magazeen'); ?></a> <?php _e('to post a comment.', 'magazeen'); ?></p>
			<?php else : ?>
		
				<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
				
					<?php if ( $user_ID ) : ?>
					
						<p><?php _e('Logged in as', 'magazeen'); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('Log out of this account', 'magazeen'); ?>"><?php _e('Log out &raquo;', 'magazeen'); ?></a></p>

					<?php else : ?>
				
						<p><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="32" tabindex="1" class="input" <?php if ($req) echo "aria-required='true'"; ?> />
						<label for="author"><small><?php _e('Name', 'magazeen'); ?> <?php if ($req) echo "(required)"; ?></small></label></p>
						
						<p><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="32" tabindex="2" class="input" <?php if ($req) echo "aria-required='true'"; ?> />
						<label for="email"><small><?php _e('Mail (will not be published)', 'magazeen'); ?> <?php if ($req) echo "(required)"; ?></small></label></p>
						
						<p><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="32" tabindex="3" class="input" />
						<label for="url"><small><?php _e('Website', 'magazeen'); ?></small></label></p>
					
					<?php endif; ?>
				
					<p><textarea name="comment" id="comment" cols="" rows="10" tabindex="4" class="input" style="width:95%; display:inline;"></textarea></p>
					
					<p><input name="submit" type="submit" class="submit-comment" id="submit" tabindex="5" value="<?php _e('Submit Comment', 'magazeen'); ?>" />
					<?php comment_id_fields(); ?>
					</p>
					<?php do_action('comment_form', $post->ID); ?>
				
				</form>
				
				<br />
			
			<?php endif; // If registration required and not logged in ?>
			
		</div>
	
	</div>	
		
</div>

<?php endif; // if you delete this the sky will fall on your head ?>
