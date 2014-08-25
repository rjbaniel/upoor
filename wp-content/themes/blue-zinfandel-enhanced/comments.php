<?php if (function_exists('comment_form_text_output')){ comment_form_text_output(); } ?><br /><br /><?php // Do not delete these lines
	if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die (__('Please do not load this page directly. Thanks!','blue-zinfandel'));
        if (!empty($post->post_password)) { // if there's a password
            if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
				?>

<p class="nocomments">
  <?php _e("This post is password protected. Enter the password to view comments.",'blue-zinfandel'); ?>
<p>
  <?php
				return;
            }
        }
		/* This variable is for alternating comment background */
		$oddcomment = 'alt';
?>
<div id="commentblock">
<!--comments form -->
	<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
	<p><?php _e('You must be','blue-zinfandel');?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>"><?php _e('logged in','blue-zinfandel');?></a> <?php _e('to post a comment.','blue-zinfandel');?></p>
    <?php else : ?>
    
   <!--comments area-->
  <?php if ( have_comments() ) : ?><?php if ( ! empty($comments_by_type['comment']) ) : ?>
  <p><?php comments_number(__('No Comment','blue-zinfandel'), __('1 Comment so far','blue-zinfandel'), __('% Comments so far','blue-zinfandel')); ?></p>




  <div id="post-navigator-single">
<div class="alignright"><?php if(function_exists('paginate_comments_links')) {  paginate_comments_links(); } ?></div>
</div>

<ol id="commentlist">   
<?php wp_list_comments('type=comment&callback=list_comments'); ?>
</ol>


<div id="post-navigator-single">
<div class="alignright"><?php if(function_exists('paginate_comments_links')) {  paginate_comments_links(); } ?></div>
</div>

<?php endif; ?>


 <?php if ( $post->ping_status == "open" ) : ?>
 <?php if ( ! empty($comments_by_type['pings']) ) : ?>
 <div class="entry">
	<h3><?php _e('Trackbacks/Pingbacks','blue-zinfandel'); ?></h3>

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
  <p class="nocomments"><?php _e('Comments are closed.','blue-zinfandel');?><p>
  <?php endif; ?>
  <?php endif; ?>
  <?php if ('open' == $post-> comment_status) : ?>
  <?php endif; // If registration required and not logged in ?>
  <?php endif; // if you delete this the sky will fall on your head ?>

<div id="respond">
<div id="commentsform">
    <form action="<?php echo get_option('home'); ?>/wp-comments-post.php" method="post" id="commentform">

<div class="cancel-comment-reply">
<?php cancel_comment_reply_link(); ?>
</div>

      <?php if ( $user_ID ) : ?>

      <p><?php _e('Logged in as','blue-zinfandel');?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('Log out of this account','blue-zinfandel') ?>"> <?php _e('Logout &raquo;','blue-zinfandel'); ?> </a> </p>
      <?php else : ?>
      
      <p><?php _e('Name ','blue-zinfandel');?><?php if ($req) _e('(required)'); ?><br />
      <input type="text" name="author" id="s1" value="<?php echo $comment_author; ?>" size="30" tabindex="1" />
      </p>
      
      <p><?php _e('Email ','blue-zinfandel');?><?php if ($req) _e('(required)'); ?><br />
      <input type="text" name="email" id="s2" value="<?php echo $comment_author_email; ?>" size="30" tabindex="2" />
      </p>
      
      <p><?php _e('Website','blue-zinfandel');?><br />
      <input type="text" name="url" id="s3" value="<?php echo $comment_author_url; ?>" size="30" tabindex="3" />
      </p>
      
      <?php endif; ?>
      <!--<p>XHTML:</strong> <?php _e('You can use these tags:');?> <?php echo allowed_tags(); ?></p>-->
      <p><?php _e('Speak your mind','blue-zinfandel');?><br />
      <textarea name="comment" id="s4" cols="90" rows="10" tabindex="4"></textarea>
      </p>
      
      <p>
        <input name="submit" type="submit" id="hbutt" tabindex="5" value="<?php _e('Submit Comment','blue-zinfandel');?>" />
        <input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
      </p>

<?php if(function_exists("comment_id_fields")) { ?>
<?php comment_id_fields(); ?>
<?php } ?>
<?php do_action('comment_form', $post->ID); ?>
    </form>
  </div></div>


</div>
