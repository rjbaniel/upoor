<br /><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php if (function_exists('comment_form_text_output')){ comment_form_text_output(); } ?><br /><div class="comments">
<?php if ( !empty($post->post_password) && $_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) : ?>
<p><?php _e('Enter your password to view comments.','borderline'); ?></p>
<?php return; endif; ?>

<?php if ( comments_open() ) : ?>
<b><?php comments_number(__('No Comments','borderline'), __('1 Comment','borderline'), __('% Comments','borderline')); ?> <?php _e('so far','borderline'); ?></b>
<?php else : // If there are no comments yet ?>
<?php endif; ?>
<br /><br />
<a name="comments"></a>


<?php if ( have_comments() ) : ?>

<?php if ( ! empty($comments_by_type['comment']) ) : ?>

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
	<h3><?php _e('Trackbacks/Pingbacks','borderline'); ?></h3>

    <ol class="pinglist">
    <?php wp_list_comments('type=pings&callback=list_pings'); ?>
	</ol>
    </div>
	<?php endif; ?>
    <?php endif; ?>



<?php else : // If there are no comments yet ?>

<?php endif; ?>

<br /><br />
<div id="respond">
<a name="postcomment"></a>
<a name="respond"></a>
<?php if ( comments_open() ) : ?>
<b><?php _e('Leave a comment','borderline'); ?></b><br />

<div class="cancel-comment-reply">
<?php cancel_comment_reply_link(); ?>
</div>

<br />
<?php _e("Line and paragraph breaks automatic, e-mail address never displayed, <acronym title=\"Hypertext Markup Language\">HTML</acronym> allowed:",'borderline'); ?> <code><?php echo allowed_tags(); ?></code>

<form action="<?php echo get_option('home'); ?>/wp-comments-post.php" method="post" id="commentform">

	<p>
	  <input type="text" name="author" id="author" class="textarea" value="<?php echo $comment_author; ?>" size="15" tabindex="1" />
	   <label for="author"><?php _e('Name','borderline'); ?></label> <?php if ($req) _e('(required)'); ?>
	<input type="hidden" name="comment_post_ID" value="<?php echo $post->ID; ?>" />
	<input type="hidden" name="redirect_to" value="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" />
	</p>

	<p>
	  <input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="15" tabindex="2" />
	   <label for="email"><?php _e('E-mail','borderline'); ?></label> <?php if ($req) _e('(required)'); ?>
	</p>

	<p>
	  <input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="15" tabindex="3" />
	   <label for="url"><acronym title="<?php _e('Uniform Resource Identifier','borderline');?>">URI</acronym></label>
	</p>

	<p>
	  <label for="comment"><?php _e('Your Comment','borderline'); ?></label>
	<br />
	  <textarea name="comment" style="border: 1px solid #000;" id="comment" cols="50" rows="6" tabindex="4"></textarea>
	</p>
	<p>
	  <input name="submit" id="submit" type="submit" tabindex="5" value="<?php _e('Say It!','borderline'); ?>" />
	</p>

<?php if(function_exists("comment_id_fields")) { ?>
<?php comment_id_fields(); ?>
<?php } ?>
<?php do_action('comment_form', $post->ID); ?>

</form>

</div>

<?php else : // Comments are closed ?>

<?php endif; ?>
</div>
