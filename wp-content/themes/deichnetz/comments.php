<?php if (function_exists('comment_form_text_output')){ comment_form_text_output(); } ?><br /><br /><?php if ( !empty($post->post_password) && $_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) : ?>
<p><?php _e('Enter your password to view comments.','deichnetz'); ?></p>
<?php return; endif; ?>

<h2 id="comments"><?php comments_number(__('No Comments','deichnetz'), __('1 Comment','deichnetz'), __('% Comments','deichnetz')); ?>
<?php if ( comments_open() ) : ?>
<a href="#postcomment" title="<?php _e("Leave a comment",'deichnetz'); ?>">&raquo;</a>
<?php endif; ?>
</h2>

<?php if ( have_comments() ) : ?><?php if ( ! empty($comments_by_type['comment']) ) : ?>

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
	<h3><?php _e('Trackbacks/Pingbacks','deichnetz'); ?></h3>

    <ol class="pinglist">
    <?php wp_list_comments('type=pings&callback=list_pings'); ?>
	</ol>
    </div>
	<?php endif; ?>
    <?php endif; ?>


<?php else : // If there are no comments yet ?>

<?php endif; ?>

<br />

<p><?php post_comments_feed_link(__('<abbr title="Really Simple Syndication">RSS</abbr> feed for comments on this post.','deichnetz')); ?>&nbsp;
<?php if ( pings_open() ) : ?>
<a href="<?php trackback_url() ?>" rel="trackback"><?php _e('TrackBack','deichnetz');?> <abbr title="<?php _e('Uniform Resource Identifier','deichnetz');?>">URI</abbr></a>
<?php endif; ?>
</p>

<?php if ( comments_open() ) : ?>
<div id="respond">
<h2 id="postcomment"><?php _e('Leave a reply','deichnetz'); ?></h2>
<br />
<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p><?php _e('You must be','deichnetz');?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>"><?php _e('logged in','deichnetz');?></a> <?php _e('to post a comment.','deichnetz');?></p>
<?php else : ?>

<form action="<?php echo get_option('home'); ?>/wp-comments-post.php" method="post" id="commentform">
<div class="cancel-comment-reply">
<?php cancel_comment_reply_link(); ?>
</div>
<?php if ( $user_ID ) : ?>

<p><?php _e('Logged in as','deichnetz');?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="<?php _e('Log out of this account','deichnetz') ?>"><?php _e('Logout','deichnetz');?> &raquo;</a></p>

<?php else : ?>

<p><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
<label for="author"><small><?php _e('Name','deichnetz');?> <?php if ($req) _e('(required)'); ?></small></label></p>

<p><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
<label for="email"><small><?php _e('E-Mail','deichnetz');?> <?php if ($req) _e('(required)'); ?></small></label></p>

<p><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
<label for="url"><small><?php _e('Url','deichnetz'); ?></small></label></p>

<?php endif; ?>

<!--<p><small><strong>XHTML:</strong> <?php _e('You can use these tags:');?> <?php echo allowed_tags(); ?></small></p>-->

<p>
<label for="Kommentar"><small><?php _e('Comment:','deichnetz'); ?></small></label>
<textarea name="comment" id="comment" cols="100%" rows="10" tabindex="4"></textarea></p>

<p><input name="submit" type="submit" id="submit" tabindex="5" value="<?php _e('Submit Comment','deichnetz');?>" />
<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
</p>

<?php if(function_exists("comment_id_fields")) { ?>
<?php comment_id_fields(); ?>
<?php } ?>
<?php do_action('comment_form', $post->ID); ?>

</form>
</div>
<?php endif; // If registration required and not logged in ?>

<?php else : // Comments are closed ?>
<p><?php _e('Sorry, the comment form is closed at this time.','deichnetz'); ?></p>
<?php endif; ?>
