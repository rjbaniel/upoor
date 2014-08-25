<?php if (function_exists('comment_form_text_output')){ comment_form_text_output(); } ?><br /><br /><?php if ( !empty($post->post_password) && $_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) : ?>
<p><?php _e('Enter your password to view comments.'); ?></p>
<?php return; endif; ?>

<?php if ( have_comments() ) : ?>
<h4 id="comments"><?php _e('Comments so far:');?></h4>

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





<?php if ( comments_open() ) : ?>
<?php post_comments_feed_link(__('<abbr title="Really Simple Syndication">RSS</abbr> feed for comments on this post.',TEMPLATE_DOMAIN)); ?>
<?php endif; ?>

<?php if ( pings_open() ) : ?>
	<br /><a href="<?php trackback_url() ?>" rel="trackback"><?php _e('TrackBack',TEMPLATE_DOMAIN);?> <abbr title="<?php _e('Uniform Resource Identifier',TEMPLATE_DOMAIN);?>">URI</abbr></a>
<?php endif; ?>



<div id="respond">
<?php if ( comments_open() ) : ?>


<?php if ( get_option('comment_registration') && !$user_ID ) : ?>

<p><?php _e('You must be',TEMPLATE_DOMAIN); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"><?php _e('logged in',TEMPLATE_DOMAIN); ?></a> <?php _e('to post a comment.',TEMPLATE_DOMAIN); ?></p>

<?php else : ?>

<h2 id="postcomment"><?php _e('Share your thoughts',TEMPLATE_DOMAIN); ?></h2>

<p><?php _e("Line and paragraph breaks automatic, e-mail address never displayed, <acronym title=\"Hypertext Markup Language\">HTML</acronym> allowed:",TEMPLATE_DOMAIN); ?></p>
<code><?php echo allowed_tags(); ?></code>

<form action="<?php echo get_option('home'); ?>/wp-comments-post.php" method="post" id="commentform">
<div class="cancel-comment-reply">
<?php cancel_comment_reply_link(); ?>
</div>

<?php if ( $user_ID ) : ?>

<p><?php _e('Logged in as',TEMPLATE_DOMAIN); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('Log out of this account',TEMPLATE_DOMAIN); ?>"><?php _e('Log out &raquo;',TEMPLATE_DOMAIN); ?></a></p>

<?php else : ?>


<p>
	  <input type="text" name="author" id="textbox" class="textarea" value="<?php echo $comment_author; ?>" size="28" tabindex="1" />
	   <label for="author"><?php _e('Name',TEMPLATE_DOMAIN); ?></label> <?php if ($req) _e('(required)'); ?>
	<input type="hidden" name="comment_post_ID" value="<?php echo $post->ID; ?>" />
	<input type="hidden" name="redirect_to" value="<?php echo esc_html($_SERVER['REQUEST_URI']); ?>" />
	</p>

	<p>
	  <input type="text" name="email" id="textbox" value="<?php echo $comment_author_email; ?>" size="28" tabindex="2" />
	   <label for="email"><?php _e('E-mail',TEMPLATE_DOMAIN); ?></label> <?php if ($req) _e('(required)'); ?>
	</p>

	<p>
	  <input type="text" name="url" id="textbox" value="<?php echo $comment_author_url; ?>" size="28" tabindex="3" />
	   <label for="url"><acronym title="<?php _e('Uniform Resource Identifier',TEMPLATE_DOMAIN);?>">URI</acronym>'</label>
	</p>

    <?php endif; ?>


	<p>
	  <label for="comment"><?php _e('Your Comment',TEMPLATE_DOMAIN); ?></label>
	<br />
	  <textarea name="comment" id="textbox" cols="60" rows="8" tabindex="4"></textarea>
	</p>

	<p>
	  <input id="searchbutton" name="submit" id="submit" type="submit" tabindex="5" value="<?php _e('Say It!');?>" />
	</p>
	<?php if(function_exists("comment_id_fields")) { ?>
<?php comment_id_fields(); ?>
<?php } ?>
<?php do_action('comment_form', $post->ID); ?>
</form>
<?php _e('Sign up at');?> <a href="http://www.gravatar.com">Gravatar.com</a> <?php _e('to personalize your comments!');?>

<?php endif; ?>

<?php endif; ?>
</div>
