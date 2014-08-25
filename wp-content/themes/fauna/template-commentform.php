<?php /*
	Comments Template
	This page holds the code used by comments.php for showing comments.
	It's separated out here for ease of use, because the comments.php file is already pretty cluttered.
	*/
?>
<a name="respond" id="respond"></a>
<h2><?php _e('Leave a Comment','fauna') ?></h2>

<div class="cancel-comment-reply">
<?php cancel_comment_reply_link(); ?>
</div>


<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p><?php _e('You must be','fauna');?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>"><?php _e('logged in','fauna');?></a> <?php _e('to post a comment.','fauna');?></p>
<?php else : ?>

<form action="<?php echo get_option('home'); ?>/wp-comments-post.php" method="post" id="commentform">

<?php if ( $user_ID ) : ?>
<div class="commentbox">
	<div style="height: 70px; "><br />
		<?php _e('Logged in as','fauna');?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="<?php _e('Log out of this account','fauna');?>"><?php _e('Logout','fauna');?> &raquo;</a>
	</div>
</div>
<?php else : ?>

<div class="commentbox">
	<?php if ($comment_author != "") { ?>
	<div style="height: 70px; "><br />
		<?php _e('Welcome back','fauna') ?> <strong><?php echo $comment_author; ?></strong>
		<span id="showinfo">(<a href="javascript:ShowInfo();"><?php _e('Change','fauna') ?></a>)</span>
		<span id="hideinfo" style="display:none;">(<a href="javascript:HideInfo();"><?php _e('Close','fauna') ?></a>)</span>
	</div>
	
	<div id="comment-author" style="display: none; ">

	<?php } else { ?>

	<div id="comment-author">

	<?php } ?>
		<p>
		<input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="28" tabindex="1" class="inputbox" <?php if (function_exists('show_lpt_reloadauthor')) { show_lpt_reloadauthor(); } ?> />
		<label for="author"><?php _e("Name",'fauna'); ?></label> <?php if ($req) _e('(required)'); ?>
		
		<input type="hidden" name="redirect_to" value="<?php echo esc_attr($_SERVER["REQUEST_URI"]); ?>" />
		</p>
	
		<p>
		<input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="28" tabindex="2" class="inputbox" />
		<label for="email"><?php _e("E-mail",'fauna'); ?></label> <?php if ($req) _e('(required)'); ?>
		</p>
	
		<p>
		<input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="28" tabindex="3" class="inputbox" />
		<label for="url"><?php _e("Website",'fauna'); ?></label>
		</p>
		<br />
	</div>
</div>

<?php endif; ?>
	
	<br />
	<a class="toggle" href="#formatting" onclick="toggleFormatting();" title="<?php _e('Description opens inline (right here)') ?>"><?php _e('Formatting your comment') ?></a>

	<div style="clear: both;" /></div>
	
	<div id="tags-allowed" style="display: none; "><a name="formatting" id="formatting"></a>
		<div class="close">(<a href="#formatting" onclick="toggleFormatting();" title="<?php _e('Hide this description') ?>"><?php _e('Close') ?></a>)</div>
		<h4><?php _e('Formatting Your Comment') ?></h4>
		<p><?php _e('The following <abbr title="eXtensible Hypertext Markup Language">XHTML</abbr> tags are available for use:') ?></p>
		<p><code><?php echo allowed_tags(); ?></code></p>
		<p><?php _e('URLs are automatically converted to hyperlinks.') ?></p>

		<?php if (function_exists(do_textile) || function_exists(textile)) { ?>

		<h4><?php _e('Textile') ?></h4>
		<p><?php _e('Textile is a method that uses simple symbols to quickly write rich text markup. These are the most common:') ?></p>
		<ul class="column-left">
			<li><em>_emphasis_</em></li>
			<li><strong>*strong*</strong></li>
			<li><del>-deleted text-</del></li>
			<li>!imageurl.gif!</li>
		</ul>
		<ul class="column-right">
			<li><a href="#">"link text":http://link.url</a></li>
			<li><blockquote>bq. quoted content</blockquote></li>
			<li><code>@short code snippet@</code></li>
		</ul>

		<?php } ?>
		
		<div style="clear: both; "></div>
	</div>
	
	<div id="comments-resize">
	
		<small>&uarr; <a href="#top"><?php _e('Back to Top') ?></a> |  <?php _e('Textarea:') ?> <a href="javascript:void(null)" onclick="document.getElementById('comment').rows += 5;"><?php _e('Larger') ?></a> | <a href="javascript:void(null)" onclick="document.getElementById('comment').rows -= 5;"><?php _e('Smaller') ?></a></small>
		
		<h3><label for="comment"><?php _e("Your Comment"); ?></label></h3>

	</div>
	
		<p>
		<textarea name="comment" id="comment" cols="70" rows="12" tabindex="4" <?php if (function_exists('show_lpt_reloadtext')) { show_lpt_reloadtext(); } ?>></textarea>
		</p>
		<p>
		<input name="submit" type="submit" tabindex="6" value="<?php _e("Post",'fauna'); ?>" class="pushbutton-wide" />
		<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
		</p>

   <?php if(function_exists("comment_id_fields")) { ?>
<?php comment_id_fields(); ?>
<?php } ?>
<?php do_action('comment_form', $post->ID); ?>
	</form>
	
	<?php if (function_exists('show_lpt')) { show_lpt(); } ?>

</div>

<?php endif; // If registration required and not logged in ?>
