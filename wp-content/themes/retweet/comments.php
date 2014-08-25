<?php // Do not delete these lines
	if (isset($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
	
	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'retweet'); ?></p> 
	<?php
		return;
	}
?>
<!-- You can start editing here. -->
<?php if ( have_comments() ) : ?>
<?php
	$trackbacks = $wpdb->get_results($wpdb->prepare("SELECT * FROM $wpdb->comments WHERE comment_post_ID = %d AND comment_approved = '1' AND (comment_type = 'pingback' OR comment_type = 'trackback') ORDER BY comment_date", $post->ID));
?>
<div class="comment_heading">
	<h3><?php comments_number(__('No Response', 'retweet'), __('One Response', 'retweet'), __('% Responses', 'retweet'));?></h3>
	<p class="tab_comment">
		<span id="commentlist" class="tab_button"><?php _e('Comments', 'retweet'); echo ('(' . (count($comments)-count($trackbacks)) . ')'); ?></span><span id="trackbackslist" class="tab_button"><?php _e('Trackbacks', 'retweet'); echo ('(' . count($trackbacks) . ')'); ?></span>
	</p>
<?php if ( ! empty($comments_by_type['comment']) ) : ?>
	<ol class="commentlist">
		<?php wp_list_comments(array ('type' => 'comment','callback' => 'custom_comments')); ?>
	</ol>
<?php endif; ?>
<?php if ( ! empty($comments_by_type['pings']) ) : ?>
	<ol class="trackbackslist">
		<?php wp_list_comments(array ('type' => 'pings')); ?>
	</ol>
<?php endif; ?>	
	<?php else : // this is displayed if there are no comments so far ?>
	<?php if ('open' == $post->comment_status) : ?>
		<!-- If comments are open, but there are no comments. -->
	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments"><?php _e('Comments are closed.', 'retweet'); ?></p>
	<?php endif; ?>
<?php endif; ?>
<?php
	// 如果用户在后台选择要显示评论分页
	if (get_option('page_comments')) {
		// 获取评论分页的 HTML
		$comment_pages = paginate_comments_links('echo=0');
		// 如果评论分页的 HTML 不为空, 显示上一页和下一页的链接
		if ($comment_pages) {
?>
<div class="navigation">
	<div class="alignleft"><?php previous_comments_link(__('&laquo; Previous', 'retweet')) ?></div>
	<div class="alignright"><?php next_comments_link(__('Next &raquo;', 'retweet')) ?></div>
	<div class="clear"></div>
</div>
<?php
		}
	}
?>
</div>
<?php if ('open' == $post->comment_status) : ?>
<div id="respond">
<h3><?php comment_form_title( __('Leave a Reply', 'retweet'), __('Leave a Reply for %s' , 'retweet') ); ?></h3>
<div id="cancel-comment-reply"> 
	<small><?php cancel_comment_reply_link() ?></small>
</div> 
<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p><?php printf(__('You must be <a href="%s">logged in</a> to post a comment.', 'retweet'), get_option('siteurl') . '/wp-login.php?redirect_to=' . urlencode(get_permalink())); ?></p>
<?php else : ?>
<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
<?php if ( $user_ID ) : ?>
<p><?php printf(__('Logged in as <a href="%1$s">%2$s</a>.', 'retweet'), get_option('siteurl') . '/wp-admin/profile.php', $user_identity); ?> <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('Log out of this account', 'retweet'); ?>"><?php _e('Log out &raquo;', 'retweet'); ?></a></p>
<?php else : ?>
	<?php if ( $comment_author != "" ) : ?>
		<script type="text/javascript">function setStyleDisplay(id, status){document.getElementById(id).style.display = status;}</script>
		<div class="form_row small">
			<?php printf(__('Welcome back <strong>%s</strong>.' , 'retweet'), $comment_author) ?>
			<span id="show_author_info"><a href="javascript:setStyleDisplay('author_info','');setStyleDisplay('show_author_info','none');setStyleDisplay('hide_author_info','');"><?php _e('Change &raquo;', 'retweet'); ?></a></span>
			<span id="hide_author_info"><a href="javascript:setStyleDisplay('author_info','none');setStyleDisplay('show_author_info','');setStyleDisplay('hide_author_info','none');"><?php _e('Close &raquo;', 'retweet'); ?></a></span>
		</div>
	<?php endif; ?>
		<div id="author_info">
			<p class="form_row">
				<input class="round" type="text" name="author" id="author" value="<?php echo $comment_author; ?>" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
				<label for="author"><small><?php _e('Name', 'retweet'); ?> <?php if ($req) _e("(required)", "retweet"); ?></small></label>
			</p>
			<p class="form_row">
				<input class="round" type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
				<label for="email"><small><?php _e('E-mail', 'retweet'); ?>(<?php _e('will not be published', 'retweet'); ?>)<?php if ($req) _e("(required)", "retweet"); ?></small></label>
			</p>
			<p class="form_row">
				<input class="round" type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" tabindex="3" />
				<label for="url"><small><?php _e('Website', 'retweet'); ?></small></label>
			</p>
		</div>
	<?php if ( $comment_author != "" ) : ?>
		<script type="text/javascript">setStyleDisplay('hide_author_info','none');setStyleDisplay('author_info','none');</script>
	<?php endif; ?>
<?php endif; ?>
<?php do_action('comment_form', $post->ID); ?>
<p><textarea name="comment" id="comment" class="round-10" cols="100%" rows="5" tabindex="4"></textarea></p>
<p><input name="submit" type="submit" id="submit" tabindex="5" value="<?php _e('Submit Comment', 'retweet'); ?>" /> (Ctrl+Enter) <?php comment_id_fields(); ?></p>
<script type="text/javascript" language="javascript">
document.getElementById("comment").onkeydown = function (moz_ev)
        {
                var ev = null;
                if (window.event){
                        ev = window.event;
                }else{
                        ev = moz_ev;
                }
                if (ev != null && ev.ctrlKey && ev.keyCode == 13)
                {
                        document.getElementById("submit").click();
                }
        }
</script>
<p class="allowed_tags round-10"><?php printf(__('<strong>XHTML:</strong> You can use these tags: <code>%s</code>', 'retweet'), allowed_tags()); ?></p>
</form>
<?php endif; // If registration required and not logged in ?>
</div>
<?php endif; // if you delete this the sky will fall on your head ?>
