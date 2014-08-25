<div class="comments">

<?php
	$req = get_option('require_name_email'); // Checks if fields are required
	if ( 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']) )
		die ( 'Please do not load this page directly. Thanks!' );
	if ( ! empty($post->post_password) ) :
		if ( $_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password ) :
?>
	<div class="nopassword"><?php _e('Enter the password to view comments to this post.', 'simplr') ?></div>
</div>
<?php
			return;
		endif;
	endif;
?>



<div class="comments"> 
<?php if ( have_comments() ) : ?>

<h3 id="comments"><?php comments_number(__('No Responses',TEMPLATE_DOMAIN), __('One Response',TEMPLATE_DOMAIN), __('% Responses',TEMPLATE_DOMAIN ));?> <?php _e('to',TEMPLATE_DOMAIN);?>  &#8220;<?php the_title(); ?>&#8221;</h3>

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

</div><!-- .comments -->

<div id="primary" class="sidebar">
	<ul>
		<li class="entry-meta">
			<h3><?php printf(__('<a href="%1$s" title="%2$s">Home</a> &gt; About This Post', 'simplr'), get_bloginfo('url'), esc_html(get_bloginfo('name'), 1) ) ?></h3>
			<?php printf(__('<p>This was posted by <span class="vcard"><span class="fn n">%1$s</span></span> on <abbr class="published" title="%2$sT%3$s">%4$s at %5$s</abbr>. Bookmark the <a href="%6$s" title="Permalink to %7$s" rel="bookmark">permalink</a>.</p><p>Subscribe to the <a class="rss-linK" href="%8$s" title="Comments RSS for %7$s" rel="alternate" type="application/rss+xml">RSS feed</a> for all comments on this post.</p>', 'simplr'),
			get_the_author(),
			get_the_time('Y-m-d'),
			get_the_time('H:i:sO'),
			get_the_time('l, F jS, Y', false),
			get_the_time(),
			get_permalink(),
			esc_html(get_the_title(), 'double'),
			get_post_comments_feed_link() ) ?>
		</li>
		<?php if ( !is_page() ) { ?>
		<li id="categories" class="entry-category">
			<h3><?php _e('Filed Under', 'simplr') ?></h3>
			<ul>
				<li><?php the_category('</li><li>') ?></li>
			</ul>
		</li>
		<li id="tags" class="entry-category">
			<h3><?php _e('Tagged', 'simplr') ?></h3>
			<p><?php the_tags('<span>','</span> <span>','</span>') ?></p>
		</li>
		<?php } ?>
	</ul>
</div><!-- comments.php #primary .sidebar -->

<div id="secondary" class="sidebar">

<?php if ('closed' == $post->comment_status) : ?> 
	<ul>
		<li>
			<h3><?php _e('Comments Closed', 'simplr') ?></h3>
			<p><?php _e('Sorry, but comments are closed.', 'simplr') ?></p>
		</li>
	</ul>

<?php endif; ?>


<?php if ( 'open' == $post->comment_status ) : ?>
<div id="respond">
	<ul>
		<li>
			<h3 id="respond"><?php _e('Post a Comment', 'simplr') ?></h3>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>

			<p id="mustlogin"><?php printf(__('You must be <a href="%s" title="Log in">logged in</a> to post a comment.', 'simplr'), get_option('siteurl') . '/wp-login.php?redirect_to=' . get_permalink() ) ?></p>

<?php else : ?>

			<div class="formcontainer">	

				<form id="commentform" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post">
                   <div class="cancel-comment-reply">
<?php cancel_comment_reply_link(); ?>
</div>
<?php if ( $user_ID ) : ?>

					<p id="loggedin"><?php printf(__('Logged in as <a href="%1$s" title="View your profile" class="fn">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'simplr'),
						get_option('siteurl') . '/wp-admin/profile.php',
						esc_html($user_identity, true),
						get_option('siteurl') . '/wp-login.php?action=logout&amp;redirect_to=' . get_permalink() ) ?></p>

<?php else : ?>

					<p id="comment-notes"><?php _e('Your email is <em>never</em> published nor shared.', 'simplr') ?> <?php if ($req) _e('Required fields are marked <span class="req-field">*</span>', 'simplr') ?></p>

					<div class="form-label"><label for="author"><img src="<?php bloginfo('template_directory'); ?>/images/icon-author.png" alt="<?php _e('Your name', 'simplr') ?>" /></label></div>
					<div class="form-input"><input id="author" name="author" type="text" value="<?php echo $comment_author ?>" size="30" maxlength="20" tabindex="3" /><?php if ($req) _e(' <span class="req-field">*</span>', 'simplr') ?></div>

					<div class="form-label"><label for="email"><img src="<?php bloginfo('template_directory'); ?>/images/icon-email.png" alt="<?php _e('Your email', 'simplr') ?>" /></label></div>
					<div class="form-input"><input id="email" name="email" type="text" value="<?php echo $comment_author_email ?>" size="30" maxlength="50" tabindex="4" /> <?php if ($req) _e(' <span class="req-field">*</span>', 'simplr') ?></div>

					<div class="form-label"><label for="url"><img src="<?php bloginfo('template_directory'); ?>/images/icon-url.png" alt="<?php _e('Your website', 'simplr') ?>" /></label></div>
					<div class="form-input"><input id="url" name="url" type="text" value="<?php echo $comment_author_url ?>" size="30" maxlength="50" tabindex="5" /></div>

<?php endif ?>

					<div class="form-label"><label for="comment"><img src="<?php bloginfo('template_directory'); ?>/images/icon-comment.png" alt="<?php _e('Your comment', 'simplr') ?>" /></label></div>
					<div class="form-textarea"><textarea id="comment" name="comment" cols="45" rows="8" tabindex="6"></textarea></div>

					<div class="form-submit"><input id="submit" name="submit" type="submit" value="<?php _e('Submit comment', 'simplr') ?>" tabindex="7" /><input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" /></div>


<?php if(function_exists("comment_id_fields")) { ?>
<?php comment_id_fields(); ?>
<?php } ?>
<?php do_action('comment_form', $post->ID); ?>

				</form><!-- #commentform -->
			</div><!-- .formcontainer -->

<?php endif ?>

		</li>
	</ul>
     </div>
<?php endif ?>

</div><!-- comments.php #secondary .sidebar -->
