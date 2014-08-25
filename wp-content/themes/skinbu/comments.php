<?php // Do not delete these lines

if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))

die (__('Please do not load this page directly. Thanks!', 'skinbu'));

if ( post_password_required() ) {

echo __('<h2>Post protected, you need a password</h2>', 'skinbu');

return;

}

$oddcomment = 'alt ';



?>




<?php if ( have_comments() ) : ?>

<h1 style="margin-top:25px;"><?php _e('Comments', 'skinbu'); ?></h1>

<div id="comments">

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
	<h3><?php _e('Trackbacks/Pingbacks'); ?></h3>

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

			<h2><?php _e('Comments are closed.', 'skinbu'); ?></h2>

				<?php endif; ?>



<?php endif; ?>

<?php if ('open' == $post->comment_status) : ?>

<div id="respond">

<div class="cancel-comment-reply">
<?php cancel_comment_reply_link(); ?>
</div>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>

<h2><?php _e('You must be', 'skinbu');?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>"><?php _e('logged in', 'skinbu');?></a> <?php _e('to post a comment.', 'skinbu');?></h2>

<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<?php if ( $user_ID ) : ?>

<h2>
<?php _e('Logged in as', 'skinbu');?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="<?php _e('Log out of this account', 'skinbu');?>"><?php _e('Logout', 'skinbu');?> &raquo;</a>
</h2>

			<h1><?php _e('Leave a comment', 'skinbu'); ?></h1>

					<textarea name="comment" id="comment" tabindex="4" style="height: 140px; width: 694px"></textarea><br />

<?php else : ?>

			<h1><?php _e('Leave a comment', 'skinbu'); ?></h1>

					<label for="author"><?php _e('Name', 'skinbu'); ?></label><br /><input type="text" class="input" name="author" id="author" size="30" value="<?php echo $comment_author; ?>"  tabindex="1" /><br />

					<label for="email"><?php _e('Email', 'skinbu'); ?></label><br /><input type="text" class="input" name="email" id="email" size="30" value="<?php echo $comment_email; ?>"  tabindex="2" /><br />

					<label for="url"><?php _e('Website', 'skinbu'); ?></label><br /><input type="text" class="input" name="url" id="url" size="30" value="<?php echo $comment_url; ?>"  tabindex="3" /><br />

					<textarea name="comment" id="comment" tabindex="4" style="height: 140px; width: 360px"></textarea><br />

				<?php endif; ?>					

					<input name="submit" type="submit" id="submit" tabindex="5" value="" />

					<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />


<?php if(function_exists("comment_id_fields")) { ?>
<?php comment_id_fields(); ?>
<?php } ?>
<?php do_action('comment_form', $post->ID); ?>



</form>



<?php endif; // If registration required and not logged in ?>

</div>

<?php endif; // if you delete this the sky will fall on your head ?>

