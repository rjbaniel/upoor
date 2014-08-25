<?php


// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die (__('Please do not load this page directly. Thanks!', 'color-splash'));

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e('password required', 'color-splash'); ?></p>
	<?php
		return;
	}
?>

<!-- Start editing here. -->

<?php if ( have_comments() ) : ?>
<?php if ( ! empty($comments_by_type['comment']) ) : ?>
<h3 id="comments" style="text-align:center;"><?php comments_number(__('0 Comments', 'color-splash'), __('1 Comment', 'color-splash'), __('% Comments', 'color-splash') );?> zu &#8220;<?php the_title(); ?>&#8221;</h3>

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
	<h3><?php _e('Trackbacks/Pingbacks'); ?></h3>

    <ol class="pinglist">
    <?php wp_list_comments('type=pings&callback=list_pings'); ?>
	</ol>
    </div>
	<?php endif; ?>
    <?php endif; ?>



<!-- Navigation was there -->
 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ('open' == $post->comment_status) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments"> <?php _e('No Comments are allowed', 'color-splash'); ?></p>

	<?php endif; ?>
<?php endif; ?>


<?php if ('open' == $post->comment_status) : ?>

<div id="respond">

<h3 style="text-align:center;">
<?php comment_form_title( 'Your Comment', '' ); ?>
</h3>

<div class="cancel-comment-reply">
	<small><?php cancel_comment_reply_link(); ?></small>
</div>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p><?php _e('You must be');?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>"><?php _e('logged in', 'color-splash');?></a> <?php _e('to post a comment.', 'color-splash');?></p>
<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
		
		<?php if ( $user_ID ) : ?>

<p><?php _e('Logged in as', 'color-splash');?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="<?php _e('Log out of this account', 'color-splash');?>"><?php _e('Logout', 'color-splash');?> &raquo;</a></p>
		
		<?php else : ?>
		
		<p><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
		<label for="author"><small>Name <?php if ($req) echo "(required)"; ?></small></label></p>
		
		<p><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
		<label for="email"><small>eMail<?php if ($req) echo "(Pflichtfeld)"; ?></small></label></p>
		
		<p><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
		<label for="url"><small>Your Website</small></label></p>
		
		<?php endif; ?>
		
		<!--<p><small><strong>XHTML:</strong> You can use these tags: <?php echo allowed_tags(); ?></small></p>-->
		
		<p><textarea style="width: 90%;" name="comment" id="comment" cols="30" rows="10" tabindex="4"></textarea></p>
		
		<p><input name="submit" type="submit" id="submit" tabindex="5" value="send" />
		<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
		</p>

<?php if(function_exists("comment_id_fields")) { ?>
<?php comment_id_fields(); ?>
<?php } ?>
<?php do_action('comment_form', $post->ID); ?>
		
		</form>


<?php endif; // If registration required and not logged in ?>


<?php endif; // if you delete this the sky will fall on your head ?>
