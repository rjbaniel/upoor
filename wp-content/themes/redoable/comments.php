<hr />

<div id="comment-block">
	<?php if (function_exists('comment_form_text_output')){ comment_form_text_output(); } ?><br /><br />
<?php
	// Do not access this file directly
	if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) { die (__('Please do not load this page directly. Thanks!','redo_domain')); }

	// Password Protection
	if (!empty($post->post_password)) { if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {
?>

	<p class="nopassword"><?php _e('This post is password protected. Enter the password to view comments.','redo_domain'); ?></p>

<?php return; } } ?>

	<?php if (($comments) or ('open' == $post->comment_status)) : $shownavigation = 'yes'; ?>

	<div class="comments">

		<h4><?php printf(__('%1$s %2$s to &#8220;%3$s&#8221;','redo_domain'), '<span id="comments">' . get_comments_number() . '</span>', (1 == $post->comment_count) ? __('Response','redo_domain'): __('Responses','redo_domain'), esc_html(get_the_title(),1) ); ?></h4>

		<div class="metalinks">
			<span class="commentsrsslink"><?php post_comments_feed_link(__('Feed for this Entry','redo_domain')); ?></span>
			<?php if ('open' == $post->ping_status) { ?><span class="trackbacklink"><a href="<?php trackback_url(); ?>" title="<?php _e('Copy this URI to trackback this entry.','redo_domain'); ?>"><?php _e('Trackback Address','redo_domain'); ?></a></span><?php } ?>
		</div>

		<?php /* Seperate comments and pings */
			if ( $post->comment_count > 0 ) {
				$countComments = 0;
				$countPings    = 0;
				
				$redo_comment_list = array();
				$redo_ping_list    = array();

				foreach ($comments as $comment) {
					if ( 'comment' == get_comment_type() ) {
						$redo_comment_list[++$countComments] = $comment;
					} else {
						$redo_ping_list[++$countPings] = $comment;
					}
				}
			}
		?>

	<hr />

		<?php /* Check for comments */ if ( isset($countComments) && $countComments > 0 ) { ?>



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



         <!-- END #commentlist -->
		<?php } /* end comment check */ ?>
		
		<?php /* Check for Pings */ if ( isset($countPings) && $countPings > 0 ) { ?>
		<ol id="pinglist">

			<?php foreach ($redo_ping_list as $ping_index => $comment) { ?>

			<li id="comment-<?php comment_ID(); ?>" class="<?php redo_comment_class($ping_index); ?>">
				<?php if (function_exists('comment_favicon')) { ?><span class="favatar"><?php comment_favicon(); ?></span><?php } ?>
				<a href="#comment-<?php comment_ID() ?>" title="<?php _e('Permanent Link to this Comment','redo_domain'); ?>" class="counter"><?php echo $ping_index; ?></a>
				<span class="commentauthor"><?php comment_author_link(); ?></span>
				<small class="comment-meta">				
				<?php
					printf(__('%1$s on %2$s','redo_domain'), 
						'<span class="pingtype">' . get_redo_ping_type(__('Trackback','redo_domain'), __('Pingback','redo_domain')) . '</span>',
						sprintf('<a href="#comment-%1$s" title="%2$s">%3$s</a>',
							get_comment_ID(),	
							(function_exists('time_since')?
								sprintf(__('%s ago.','redo_domain'),
									time_since(abs(strtotime($comment->comment_date_gmt . " GMT")), time())
								):
								__('Permanent Link to this Comment','redo_domain')
							),
							sprintf(__('%1$s at %2$s','redo_domain'),
								get_comment_date(__('M jS, Y','redo_domain')),
								get_comment_time()
							)			
						)
					);
				?>				
				<?php if ($user_ID) { edit_comment_link(__('Edit','redo_domain'),'<span class="comment-edit">','</span>'); } ?>
				</small>
			</li>
			<?php } /* end foreach ping */ ?>
		</ol> <!-- END #pinglist -->
		<?php } /* end ping check */ ?>
		
		<?php /* Comments open, but empty */ if ( ($post->comment_count < 1) and ('open' == $post->comment_status) ) { ?> 
		<ol id="commentlist">
			<li id="leavecomment">
				<?php _e('No Comments','redo_domain'); ?>
			</li>
		</ol>
		<?php } ?>
		
		<?php /* Comments closed */ if (('open' != $post->comment_status) and is_single()) { ?>
			<div><?php _e('Comments are currently closed.','redo_domain'); ?></div>
		<?php } ?>

	</div> <!-- END .comments 1 -->
		
	<?php endif; ?>
	
	<?php /* Reply Form */ if ('open' == $post->comment_status) { ?>
    <div id="respond">
	<div class="comments">
		<h4 id="respond" class="reply"><?php if (isset($_GET['jal_edit_comments'])) { _e('Edit Your Comment','redo_domain'); } else { _e('Leave a Reply','redo_domain'); } ?></h4>
		
		<?php if (get_option('comment_registration') and !$user_ID) { ?>
		
			<p><?php printf(__('You must <a href="%s">login</a> to post a comment.','redo_domain'), get_option('siteurl') . '/wp-login.php?redirect_to=' . get_permalink()); ?></p>
		
		<?php } else { ?>

			<form action="<?php echo get_option('home'); ?>/wp-comments-post.php" method="post" id="commentform">
            <div class="cancel-comment-reply">
<?php cancel_comment_reply_link(); ?>
</div>

			<?php
				if ( isset($_GET['jal_edit_comments']) ) {
					$jal_comment = jal_edit_comment_init();

					if (!$jal_comment) {
						return;
					}
				} elseif ($user_ID) {
			?>
		
			<p class="comment-login"><?php printf(__('Logged in as %s.','redo_domain'), '<a href="'.get_option('siteurl').'/wp-admin/profile.php">'.$user_identity.'</a>'); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="<?php _e('Log out of this account','redo_domain'); ?>"><?php _e('Logout','redo_domain'); ?> &raquo;</a></p>
	
		<?php } elseif ('' != $comment_author) { ?>

				<p class="comment-welcomeback"><?php printf(__('Welcome back <strong>%s</strong>','redo_domain'), $comment_author); ?>
				<span id="showinfo">(<a href="javascript:ShowUtils();"><?php _e('Change','redo_domain'); ?></a>)</span>
				<span id="hideinfo">(<a href="javascript:HideUtils();"><?php _e('Close','redo_domain'); ?></a>)</span></p>

		<?php } ?>
			
			<?php if (!$user_ID) { ?>
				<div id="comment-personaldetails">
					<p><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
					<label for="author"><small><strong><?php _e('Name','redo_domain'); ?></strong> <?php if ($req) { __('(required)','redo_domain'); } ?></small></label></p>

					<p><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
					<label for="email"><small><strong><?php _e('Mail','redo_domain'); ?></strong> (<?php _e('will not be published','redo_domain'); ?>) <?php if ($req) { __('(required)','redo_domain'); } ?></small></label></p>

					<p><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
					<label for="url"><small><strong><?php _e('Website','redo_domain'); ?></strong></small></label></p>
				</div>
			<?php } ?>
				<p><textarea name="comment" id="comment" cols="100%" rows="10" tabindex="4"><?php if (function_exists('jal_edit_comment_link')) { jal_comment_content($jal_comment); }; if (function_exists('quoter_comment_server')) { quoter_comment_server(); } ?></textarea></p>
		
				<?php if (function_exists('show_subscription_checkbox')) { show_subscription_checkbox(); } ?>
				<?php if (function_exists('quoter_page')) { quoter_page(); } ?>

				<p>
					<input name="submit" type="submit" id="submit" tabindex="5" value="<?php _e('Submit','redo_domain'); ?>" />
					<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
				</p>
				
				<div class="clear"></div>

			  <?php if(function_exists("comment_id_fields")) { ?>
<?php comment_id_fields(); ?>
<?php } ?>
<?php do_action('comment_form', $post->ID); ?>

			</form>

		<?php } // If registration required and not logged in ?>
		
		<?php if ($shownavigation) { include (TEMPLATEPATH . '/navigation.php'); } ?>
	
	</div></div>  <!-- END .comments #2 -->
	<?php } // comment_status ?>

</div>
