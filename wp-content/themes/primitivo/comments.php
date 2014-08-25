<?php if (function_exists('comment_form_text_output')){ comment_form_text_output(); } ?><br /><?php if ( !empty($post->post_password) && $_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) : ?>
<p>
  <?php _e('Enter your password to view comments.'); ?>
</p>
<?php return; endif; ?>

<?php if ( have_comments() ) : ?>

<h4 class="reply">
  <?php comments_number(__('No Responses'), __('One Response'), __('% Responses' ));?> <?php _e('to');?>  '
  <?php the_title(); ?>
  '</h4>

<p class="comment_meta">Subscribe to comments with
  <?php post_comments_feed_link(__('<abbr title="Really Simple Syndication">RSS</abbr>')); ?>
  <?php if ( pings_open() ) : ?>
  or <a href="<?php trackback_url() ?>" rel="trackback">
  <?php _e('TrackBack');?>
  </a> to '
  <?php the_title(); ?>
  '. 
  <?php endif; ?>
</p>


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





<?php else : // this is displayed if there are no comments so far ?>
<?php if ('open' == $post-> comment_status) : ?>
<!-- If comments are open, but there are no comments. -->
<?php else : // comments are closed ?>
<!-- If comments are closed. -->
<p class="nocomments"><?php _e('Comments are closed.',TEMPLATE_DOMAIN);?><p>
<?php endif; ?>
<?php endif; ?>
<?php if ( comments_open() ) : ?>
<div id="respond">
<h4 id="postcomment">
  <?php _e('Leave a reply',TEMPLATE_DOMAIN); ?>
</h4>
<?php if ( get_option('comment_registration') && !$user_ID ) : ?>

<p><?php _e('You must be',TEMPLATE_DOMAIN); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"><?php _e('logged in',TEMPLATE_DOMAIN); ?></a> <?php _e('to post a comment.',TEMPLATE_DOMAIN); ?></p>

<?php else : ?>

<form action="<?php echo get_option('home'); ?>/wp-comments-post.php" method="post" id="commentform">
<div class="cancel-comment-reply">
<?php cancel_comment_reply_link(); ?>
</div>

  <?php if ( $user_ID ) : ?>

 <p><?php _e('Logged in as',TEMPLATE_DOMAIN); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('Log out of this account',TEMPLATE_DOMAIN); ?>"><?php _e('Log out &raquo;',TEMPLATE_DOMAIN); ?></a></p>

  <?php else : ?>

  <p>
    <input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
    <label for="author"><small><?php _e('Name',TEMPLATE_DOMAIN);?> <?php if ($req) _e('(required)'); ?>
    </small></label>
  </p>
  <p>
    <input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
    <label for="email"><small><?php _e("Mail (will not be published)",TEMPLATE_DOMAIN); ?>
    <?php if ($req) _e('(required)'); ?>
    </small></label>
  </p>
  <p>
    <input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
    <label for="url"><small><?php _e('Website',TEMPLATE_DOMAIN);?></small></label>
  </p>
  <?php endif; ?>
  <!--<p><small><strong>XHTML:</strong> <?php _e('You can use these tags:');?> <?php echo allowed_tags(); ?></small></p>-->
  <br />
  <p> 
    <textarea name="comment" id="comment" cols="50%" rows="6" tabindex="4"></textarea>
  </p>
  <p>
    <input name="submit" type="submit" id="submit" tabindex="5" value="<?php _e('Submit Comment',TEMPLATE_DOMAIN);?>" />
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
<p>
  <?php _e('Sorry, the comment form is closed at this time.',TEMPLATE_DOMAIN); ?>
</p>
<?php endif; ?>
