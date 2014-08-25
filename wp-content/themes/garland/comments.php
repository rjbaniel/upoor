<?php // Do not delete these lines
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die ('Please do not load this page directly. Thanks!');
if ( post_password_required() ) {
?>
<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.'); ?></p>
<?php return; 
} ?>
<?php if (have_comments()) : ?>
<h3 id="comments"><?php comments_number(__('No Comments'), __('1 Comment'), __('% Comments'));?></h3>
<ol class="commentlist">
<?php 
if (function_exists(gtcn_basic_callback)) { 
wp_list_comments('type=comment&callback=gtcn_basic_callback&avatar_size=32');
} else {
	if (get_theme_mod('comment')) {
	wp_list_comments('type=comment&callback=custom_comment');
	} else {
	wp_list_comments('type=comment&avatar_size=32');
	}
}
?>
</ol>
<?php paginate_comments_links($args); endif; ?>
<?php $wp_query->comments_by_type = &separate_comments($comments);
     $comments_by_type = &$wp_query->comments_by_type;
     $count = count($comments_by_type['trackback']) + count($comments_by_type['pingback']);
	 if($count > 0){ 
         echo '<h3> '.$count.' Trackbacks</h3>';
?><div class="pinglist"><?php wp_list_comments('type=pings&callback=list_pings&reply_text=&style=div'); ?></div>
<?php } ?>
 <?php //else : // this is displayed if there are no comments so far ?>
       <?php if ('open' == $post->comment_status) : ?>
                <!-- If comments are open, but there are no comments. -->
        <?php else : // comments are closed ?>
                <!-- If comments are closed. -->
                <p class="nocomments"><?php _e('Comments are closed') ?>.</p>
        <?php endif; ?>
<?php //endif; ?>
<?php if ('open' == $post-> comment_status) : ?> 
<div id="respond">
<h3><?php _e("Leave a comment"); ?></h3>
<div id="cancel-comment-reply"><small><?php cancel_comment_reply_link() ?></small></div>
<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p><?php printf(__('You must be <a href="%s">logged in</a> to post a comment.'), wp_login_url( get_permalink() ) );?></p>
<?php else : ?>
<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
<?php if ( $user_ID ) : ?>
<p><?php printf(__('Logged in as %s.'), '<a href="'.get_option('siteurl').'/wp-admin/profile.php">'.$user_identity.'</a>'); ?> <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('Log out of this account') ?>"><?php _e('Log out &raquo;'); ?></a></p>
<?php else : ?>
<p><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
<label for="author"><small><?php _e('Name')?> <?php if ($req) _e('(required)'); ?></small></label></p>
<p><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
<label for="email"><small><?php _e('Mail (will not be published)') ?> <?php if ($req) _e('(required)'); ?></small></label></p>
<p><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
<label for="url"><small><?php _e('Website') ?></small></label></p>
<?php endif; ?>
<p><textarea name="comment" id="comment" cols="100%" rows="10" tabindex="4"></textarea></p> 
<!-- <p><small><strong>XHTML:</strong> <?php printf(__('You can use these tags: %s'), allowed_tags()); ?></small></p> -->
<p><input name="submit" type="submit" id="submit" tabindex="5" value="<?php esc_attr_e('Submit Comment')?>" />
<?php comment_id_fields(); ?>
<?php do_action('comment_form', $post->ID); ?>
</p>
</form>
<?php endif; // If registration required and not logged in ?> 
</div>
<?php endif; // if you delete this the sky will fall on your head ?>
