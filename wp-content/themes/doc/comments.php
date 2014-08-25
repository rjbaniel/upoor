<?php



	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))

		die (__('Please do not load this page directly. Thanks!', 'doc'));



	if ( post_password_required() ) { ?>

		<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'doc'); ?></p>

	<?php

		return;

	}

?>



<?php if ( have_comments() ) : ?>

<h3 id="comments"><?php comments_number(__('Leave a Comment', 'doc'), __('1 Comment', 'doc'), __('% Comments', 'doc') );?> to &#8220;<?php the_title(); ?>&#8221;</h3>

<ol class="commentlist">

<?php wp_list_comments('avatar_size=65'); ?>

</ol>

<div class="navigation">

<div class="alignleft"><?php previous_comments_link(__('&larr; Older comments', 'doc')) ?></div>

<div class="alignright"><?php next_comments_link(__('Newer comments &rarr;', 'doc')) ?></div>

</div>

<?php else : // this is displayed if there are no comments so far ?>

<?php if ('open' == $post->comment_status) : ?>

<!-- If comments are open, but there are no comments. -->

<?php else : // comments are closed ?>

<!-- If comments are closed. -->

<p class="nocomments"><?php _e('Comments are closed.', 'doc'); ?></p>

<?php endif; ?>

<?php endif; ?>

<?php if ('open' == $post->comment_status) : ?>

<div id="respond">

<h3><?php comment_form_title( __('Leave a Reply', 'doc'), __('Leave a Reply to %s', 'doc') ); ?></h3>

<div class="cancel-comment-reply">

<small><?php cancel_comment_reply_link(); ?></small>

</div>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>

<p><?php _e('You must be');?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>"><?php _e('logged in');?></a> <?php _e('to post a comment.');?></p>

<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<?php if ( $user_ID ) : ?>

<p><?php _e('Logged in as', 'doc');?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="<?php _e('Log out of this account', 'doc');?>"><?php _e('Logout', 'doc');?> &raquo;</a></p>

<?php else : ?>

<p><input type="text" name="author" id="author" style="margin:0 0 5px 0;border:1px inset #fff;" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />

<label for="author"><small><?php _e('Name', 'doc'); ?> <?php if ($req) echo "(required)"; ?></small></label></p>

<p><input type="text" name="email" id="email" style="margin:0 0 5px 0;border:1px inset #fff;" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />

<label for="email"><small><?php _e('Mail (will not be published)', 'doc'); ?> <?php if ($req) echo "(required)"; ?></small></label></p>

<p><input type="text" name="url" id="url" style="margin:0 0 5px 0;border:1px inset #fff;" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />

<label for="url"><small><?php _e('Website', 'doc'); ?></small></label></p>

<?php endif; ?>

<!--<p><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p>-->

<p><textarea name="comment" id="comment" cols="50" rows="10" tabindex="4" style="margin:0 0 5px 0;border:1px inset #fff;padding:5px;"></textarea></p>

<p><input name="submit" type="submit" id="submit" tabindex="5" style="margin:0 0 5px 0;border:1px outset #fff;" value="<?php _e('Submit Comment', 'doc'); ?>" />



</p>

<?php if(function_exists("comment_id_fields")) { ?>
<?php comment_id_fields(); ?>
<?php } ?>
<?php do_action('comment_form', $post->ID); ?>

</form>

<?php endif; // If registration required and not logged in ?>

</div>

<?php endif; // if you delete this the sky will fall on your head ?>
