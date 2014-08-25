<?php // Do not delete these lines
if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) die ('Please do not load this page directly. Thanks!');
if (!empty($post->post_password)) { // if there's a password
if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie ?>
<p class="nocomments"><?php _e("This post is password protected. Enter the password to view comments.",TEMPLATE_DOMAIN); ?><p>
<?php return;
}
}
$commentalt = '';
?>

<?php if ( have_comments() ) : ?>

		<div style="padding:20px 0px 0px 0px;"></div>
		
		<img src="<?php bloginfo('stylesheet_directory'); ?>/images/divider.gif" alt="" />

		<div style="padding:20px 0px 0px 0px;"></div>


	<h2><?php comments_number(__('No Comments yet',TEMPLATE_DOMAIN), __('1 Comment',TEMPLATE_DOMAIN), __('% Comments',TEMPLATE_DOMAIN) ); if($post->comment_status == "open") { ?> <a href="#commentform" class="more"><?php _e("Add your own",TEMPLATE_DOMAIN); ?></a><?php } ?></h2>


<?php if ( ! empty($comments_by_type['comment']) ) : ?>

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
	<h3><?php _e('Trackbacks/Pingbacks',TEMPLATE_DOMAIN); ?></h3>

    <ol class="pinglist">
    <?php wp_list_comments('type=pings&callback=list_pings'); ?>
	</ol>
    </div>
	<?php endif; ?>
    <?php endif; ?>






<?php endif; ?>



<?php if ($post->comment_status == "open") : ?>

<div id="respond">

		<div style="padding:20px 0px 0px 0px;"></div>
		
		<img src="<?php bloginfo('stylesheet_directory'); ?>/images/divider.gif" alt="" />
		
		<div style="padding:20px 0px 0px 0px;"></div>

	<h2><?php _e("Leave a Comment",TEMPLATE_DOMAIN); ?></h2>

<?php if (get_option('comment_registration') && !$user_ID) : ?>

  <p><?php _e('You must be',TEMPLATE_DOMAIN); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"><?php _e('logged in',TEMPLATE_DOMAIN); ?></a> <?php _e('to post a comment.',TEMPLATE_DOMAIN); ?></p>

<?php else : ?>

	<form action="<?php echo get_option('home'); ?>/wp-comments-post.php" method="post" id="commentform">

	<?php if ($user_ID) : ?>

<p class="info"><?php _e('Logged in as',TEMPLATE_DOMAIN); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('Log out of this account',TEMPLATE_DOMAIN); ?>"><?php _e('Log out &raquo;',TEMPLATE_DOMAIN); ?></a></p>

<?php else : ?>

			<p><label for="author"><?php _e("Name",TEMPLATE_DOMAIN); ?></label> <?php if ($req) echo "<em>Required</em>"; ?> <br /> <input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" tabindex="1" /></p>
			<p><label for="email"><?php _e("Email",TEMPLATE_DOMAIN); ?></label> <em><?php if ($req) echo "Required, "; ?>hidden</em> <br /> <input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" tabindex="2" /></p>
			<p><label for="url"><?php _e("Url",TEMPLATE_DOMAIN); ?></label><br /> <input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" tabindex="3" /></p>

<?php endif; ?>

<p><label for="comment"><?php _e("Comment",TEMPLATE_DOMAIN); ?></label><br /> <textarea name="comment" id="comment" cols="25" rows="10" tabindex="4"></textarea></p>
			<p><input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
			<input type="submit" name="submit" value="<?php _e("Submit",TEMPLATE_DOMAIN); ?>" class="button" tabindex="5" /></p>

  <?php if(function_exists("comment_id_fields")) { ?>
<?php comment_id_fields(); ?>
<?php } ?>
<?php do_action('comment_form', $post->ID); ?>

	</form>

	<p><strong><?php _e("Some HTML allowed:",TEMPLATE_DOMAIN); ?></strong><br/><?php echo allowed_tags(); ?></p>

<?php endif; // If registration required and not logged in ?>

</div>

<?php endif; // if you delete this the sky will fall on your head ?>




<?php if ($post-> comment_status == "open" && $post->ping_status == "open") { ?>
	<p><a href="<?php trackback_url(display); ?>"><?php _e("Trackback this post",TEMPLATE_DOMAIN); ?></a> &nbsp;|&nbsp; <?php post_comments_feed_link('Subscribe to comments via RSS Feed',TEMPLATE_DOMAIN); ?></p>
<?php } elseif ($post-> comment_status == "open") {?>
	<p><?php post_comments_feed_link('Subscribe to comments via RSS Feed',TEMPLATE_DOMAIN); ?></p>
<?php } elseif ($post->ping_status == "open") {?>
	<p><a href="<?php trackback_url(display); ?>"><?php _e("Trackback",TEMPLATE_DOMAIN); ?></a></p>
<?php } ?>

		<div style="padding:20px 0px 0px 0px;"></div>
		
		<img src="<?php bloginfo('stylesheet_directory'); ?>/images/divider.gif" alt="" />
		
</div> <!-- /comments -->
