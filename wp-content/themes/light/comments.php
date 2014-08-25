<?php if (function_exists('comment_form_text_output')){ comment_form_text_output(); } ?><br /><br /><?php // Do not delete these lines
	if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
        if (!empty($post->post_password)) { // if there's a password
            if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
				?>
<p class="nocomments">
  <?php _e("This post is password protected. Enter the password to view comments."); ?>
<p>
  <?php
				return;
            }
        }
		/* This variable is for alternating comment background */
		$oddcomment = 'alt';
?>
<div id="commentblock">
  <!--comments area-->

<?php if ( have_comments() ) : ?>

<?php if ( ! empty($comments_by_type['comment']) ) : ?>

  <h2 id="comments">
    <?php comments_number(__('No Comment',TEMPLATE_DOMAIN), __('1 Comment so far',TEMPLATE_DOMAIN), __('% Comments so far',TEMPLATE_DOMAIN)); ?>
  </h2>


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

	<h3><?php _e('Trackbacks/Pingbacks',TEMPLATE_DOMAIN); ?></h3>

    <ol class="pinglist">
    <?php wp_list_comments('type=pings&callback=list_pings'); ?>
	</ol>

	<?php endif; ?>
    <?php endif; ?>


  <?php else : // this is displayed if there are no comments so far ?>
 <ol id="comments" class="commentlist">
  <?php if ('open' == $post->comment_status) : ?>
  <!-- If comments are open, but there are no comments. -->

  <li id="hidelist" style="display:none"></li>
  </ol>
  <h2 id="nocomment"><?php _e("No comments yet",TEMPLATE_DOMAIN); ?></h2>
  <?php else : // comments are closed ?>
  <!-- If comments are closed. -->
  <li style="display:none"></li>
  </ol>
  <p><?php _e("Comments are closed.",TEMPLATE_DOMAIN); ?></p>
  <?php endif; ?>

  <?php endif; ?>
  <div id="loading" style="display: none;"><?php _e("Posting your comment.",TEMPLATE_DOMAIN); ?></div>
  <div id="errors"></div>
  <?php if ('open' == $post-> comment_status) : ?>

  <div id="respond">
  <h2><?php _e('Leave a Reply',TEMPLATE_DOMAIN);?></h2>
  <?php if ( get_option('comment_registration') && !$user_ID ) : ?>
  <p> <?php _e('You must be',TEMPLATE_DOMAIN);?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>"><?php _e('logged in',TEMPLATE_DOMAIN);?></a> <?php _e('to post a comment.',TEMPLATE_DOMAIN);?></p>
  <?php else : ?>
  <div id="commentsform">
    <form id="commentform" action="<?php echo get_option('home'); ?>/wp-comments-post.php" method="post">

       <div class="cancel-comment-reply">
<?php cancel_comment_reply_link(); ?>
</div>

      <?php if ( $user_ID ) : ?>
      <p> <?php _e('Logged in as');?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="<?php _e('Log out of this account') ?>"> Logout &raquo; </a> </p>
      <?php else : ?>
      <p>
        <input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
        <label for="author"><small>
        <?php _e('name',TEMPLATE_DOMAIN);?>
        <?php if ($req) _e('(required)',TEMPLATE_DOMAIN); ?>
        </small></label>
      </p>
      <p>
        <input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
        <label for="email"><small>
        <?php _e('email',TEMPLATE_DOMAIN);?>
        (
        <?php _e('will not be shown',TEMPLATE_DOMAIN);?>
        )
        <?php if ($req) _e('(required)',TEMPLATE_DOMAIN); ?>
        </small></label>
      </p>
      <p>
        <input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
        <label for="url"><small>
        <?php _e('website',TEMPLATE_DOMAIN);?>
        </small></label>
      </p>
      <?php endif; ?>
      <!--<p><small><strong>XHTML:</strong> <?php _e('You can use these tags:');?> <?php echo allowed_tags(); ?></small></p>-->
      <p>
        <textarea name="comment" id="comment" cols="50" rows="10" tabindex="4"></textarea>
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
  </div>
  <?php endif; // If registration required and not logged in ?>
  <?php endif; // if you delete this the sky will fall on your head ?>
</div>
