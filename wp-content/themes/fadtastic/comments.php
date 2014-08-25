<br /><br /><?php if (function_exists('comment_form_text_output')){ comment_form_text_output(); } ?><br /><br /><?php // Do not delete these lines
	if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

        if (!empty($post->post_password)) { // if there's a password
            if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
				?>
				
				<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.','fadtastic');?><p>
				
				<?php
				return;
            }
        }

		/* This variable is for alternating comment background */
		$oddcomment = 'alt';
?>

<!-- You can start editing here. -->



<?php if ('open' == $post->comment_status) : ?>
                  <div id="respond">
<h2 class="top_border" id="respond">
<?php _e('Make A Comment:','fadtatsic'); ?> ( <a href="#respond"><?php comments_number('None', '1', '%'); ?></a> <?php _e('so far','fadtastic'); ?> )</h2>
				
				<div id="comment_form">

<div class="cancel-comment-reply">
<?php cancel_comment_reply_link(); ?>
</div>


				<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
				<p><?php _e('You must be','fadtastic');?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>"><?php _e('logged in','fadtastic');?></a> <?php _e('to post a comment.','fadtastic');?></p>
				<?php else : ?>
				
				<form action="<?php echo get_option('home'); ?>/wp-comments-post.php" method="post" id="commentform">
				
				<?php if ( $user_ID ) : ?>				
				<p><?php _e('Logged in as','fadtastic');?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="<?php _e('Log out of this account','fadtastic');?>"><?php _e('Logout','fadtastic');?> &raquo;</a></p>
				
							<label for="comment">
<small><?php _e('Your Comment','fadtastic');?></small><br /><textarea name="comment" id="comment" cols="20" rows="5" tabindex="1" style="width:95%;"></textarea></label>
							<p><small><?php _e('Change comment box size: ','fadtastic'); ?><a style="cursor: pointer;" onclick="document.getElementById('comment').rows += 5;" title="Click to enlarge the comments textarea">+</a> | <a style="cursor: pointer;" onclick="document.getElementById('comment').rows -= 5;" title="Click to decrease the comments textarea">&#8211;</a><br />
							<?php _e('(<em>blockquote</em> and <em>a</em> tags work here.)','fadtastic'); ?></small></p>


					<div class="clear"></div>
					
						<input name="submit" type="submit" id="submit" tabindex="2" value="<?php _e('Submit Comment','fadtastic');?>" class="float_right" />
						<div class="clear"></div>
						<input type="hidden" class="button" name="comment_post_ID" value="<?php echo $id; ?>" />
				
				<?php else : ?>

					<div class="comment_wrapper">
						<div class="comment_content">
					
							<label for="comment"><small><?php _e('Your Comment','fadtastic');?></small><br /><textarea name="comment" id="comment" cols="20" rows="5" tabindex="1" style="width:95%;"><?php if (function_exists('quoter_comment_server')) { quoter_comment_server(); } ?></textarea></label>
					
						</div>
					</div>
					
					<div class="comment_details">				
					
						<label for="author"><small><?php _e('Name','fadtastic');?> <?php if ($req) echo "__('(required)')"; ?></small><br /><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="2" style="width:95%;" /></label>
						
						
						<label for="email"><small><?php _e('Mail','fadtastic'); ?> <?php if ($req) echo "__('(required)')"; ?> (hidden)</small><br /><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="3" style="width:95%;" /></label>
						
						<label for="url"><small><?php _e('Website','fadtastic');?></small><br /><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="4" style="width:95%;" /></label>
						
						<!--<p><small><strong>XHTML:</strong> You can use these tags: &lt;a href=&quot;&quot; title=&quot;&quot;&gt; &lt;abbr title=&quot;&quot;&gt; &lt;acronym title=&quot;&quot;&gt; &lt;b&gt; &lt;blockquote cite=&quot;&quot;&gt; &lt;code&gt; &lt;em&gt; &lt;i&gt; &lt;strike&gt; &lt;strong&gt; </small></p>-->
										
					</div>
					<div class="clear"></div>
					
					
					
						<input name="submit" class="button" type="submit" id="submit" tabindex="5" value="<?php _e('Submit Comment');?>" />
						<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
						
						<p><small><?php _e('<em>blockquote</em> and <em>a</em> tags work here.','fadtastic'); ?></small></p>
						
					
					<?php endif; ?>

<?php if(function_exists("comment_id_fields")) { ?>
<?php comment_id_fields(); ?>
<?php } ?>
<?php do_action('comment_form', $post->ID); ?>

					<div class="clear"></div>
					
				</form>
				</div>
				    </div>
				<?php endif; // If registration required and not logged in ?>
				

<?php endif; // if you delete this the sky will fall on your head ?>


<?php if ( have_comments() ) : ?><?php if ( ! empty($comments_by_type['comment']) ) : ?>
	<h2 id="comments" class="top_border"><?php comments_number(__('No Responses','fadtastic'), __('One Response','fadtastic'), __('% Responses' ,'fadtastic'));?> <?php _e('to','fadtastic');?>  &#8220;<?php the_title(); ?>&#8221;</h2>
	<p class="author"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/icon_rss.gif" alt="RSS Feed for <?php bloginfo('name'); ?>" border="0" class="vertical_align" /> <strong><?php post_comments_feed_link('Comments RSS Feed', 'file'); ?></strong></p>


<div id="post-navigator-single">
<div class="alignright"><?php if(function_exists('paginate_comments_links')) {  paginate_comments_links(); } ?></div>
</div>


<div class="commentlist">
<?php wp_list_comments('type=comment&callback=list_comments'); ?>
</div>

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


	<p><a href="#respond"><?php _e("Where's The Comment Form?",'fadtastic'); ?></a></p>
 <?php else : // this is displayed if there are no comments so far ?>

  <?php if ('open' == $post->comment_status) : ?> 
		<!-- If comments are open, but there are no comments. -->
		
	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<!-- ><p class="nocomments"><?php _e('Comments are closed.');?><p> -->
		
	<?php endif; ?>
<?php endif; ?>
