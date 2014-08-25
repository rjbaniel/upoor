<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title><?php echo get_option('blogname'); ?> - Comments on <?php the_title(); ?></title>
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />
		<link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet" type="text/css" media="screen"/>
	</head>
	<body>
		<div id="body_pop">
			<div id="wrap">
				<div id="head_pop"><span class="htxt"><?php echo get_option('blogname'); ?> - <?php the_title(); ?></span></div>
				<div id="content_pop">
					<div class="contentbox">
						<div class="boxheading"><span>Comments</span><div class="clear"></div><div class="left"></div></div>
<?php
/* Don't remove these lines. */
add_filter('comment_text', 'popuplinks');
if ( have_posts() ) :
	while ( have_posts() ) : the_post();
?>

						<div class="postsmetadata2"><a href="<?php echo get_post_comments_feed_link($post->ID); ?>"><abbr title="Really Simple Syndication">RSS</abbr> feed for comments on this post.</a>				</div>

		<?php if ('open' == $post->ping_status) { ?>
						<div class="postsmetadata2">The <abbr title="Universal Resource Locator">URL</abbr> to TrackBack this entry is: <em><?php trackback_url() ?></em></div>
		<?php } ?>
		
		<?php
		// this line is WordPress' motor, do not delete it.
		$commenter = wp_get_current_commenter();
		extract($commenter);
		$comments = get_approved_comments($id);
		$post = get_post($id);
		if ( post_password_required($post) ) {  // and it doesn't match the cookie
		echo('<div class="pass_form">');
		echo(get_the_password_form());
		echo('</div>');
		} else { ?>
		
			<?php if ($comments) { ?>
						<div id="c_comments">
				<?php foreach ($comments as $comment) { ?>
							<div class="commentposts" id="comment-<?php comment_ID() ?>">
								<div class="comment_head">
									<div class="comment_head_text"><?php echo $comment_type; ?> by <span class="author_link"><?php comment_author_link() ?></span><br />Posted on <?php comment_date(); ?> at <?php comment_time(); ?></div>
									<div class="comment_head_img"><?php echo get_avatar( $comment, 32 ); ?></div>
									<div class="clear"></div>
								</div>
								<?php comment_text() ?>
					<?php if ($comment->comment_approved == '0') : ?>
								<div class="postsmetadata2">Your comment is awaiting approval.</div>
					<?php endif; ?>
								<?php edit_comment_link('Edit Comment', '<div class="postsmetadata2">', '</div>'); ?>
							</div>
				<?php } // end for each comment ?>
						</div>
			<?php } else { // this is displayed if there are no comments so far ?>
						<div class="postsmetadata2">No comments yet.</div>
			<?php } ?>
					</div>
					
			<?php if ('open' == $post->comment_status) { ?>
					<div class="contentbox">
						<div class="boxheading"><span>Leave a comment</span><div class="clear"></div><div class="left"></div></div>
						<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
				<?php if ( $user_ID ) : ?>
							<div class="postsmetadata">Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a></div>
				<?php else : ?>
							<div class="commentform_blockdiv">
								<input  class="c_input" type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
								<label for="author">Name <?php if ($req) echo "(required)"; ?></label>
							</div>
							<div class="commentform_blockdiv">
								<input class="c_input" type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
								<label for="email">Mail (will not be published) <?php if ($req) echo "(required)"; ?></label>
							</div>
							<div class="commentform_blockdiv">
								<input class="c_input" type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
								<label for="url">Website</label>
							</div>
				<?php endif; ?>
							<div class="allowed_tags" style="margin-bottom:2px;">Line and paragraph breaks automatic, e-mail address never displayed, <acronym title="Hypertext Markup Language">HTML</acronym> allowed: <code><?php echo allowed_tags(); ?></code></div>
							<div class="commentform_blockdiv">
								<textarea name="comment" id="comment" cols="100%" rows="10" tabindex="4" style="width:100%"></textarea>
							</div>
							<div class="commentform_blockdiv">
								<input class="c_submit" name="submit" type="submit" id="submit" tabindex="5" value="Submit Comment" />	
								<?php comment_id_fields(); ?>
							</div>
							<?php do_action('comment_form', $post->ID); ?>	
						</form>
					</div>	
			<?php } else { // comments are closed ?>
					<div class="contentbox">
						<div class="boxheading"><span>Leave a comment</span><div class="clear"></div><div class="left"></div></div>
						<div class="postsmetadata">Sorry, the comment form is closed at this time.</div>
					</div>
			<?php } ?>	
				
		<?php } // end password check ?>
					<div class="contentbox">
						<div class="closebtn"><a href="javascript:window.close()">Close this window.</a></div>
					</div>
					
<?php // if you delete this the sky will fall on your head
	endwhile; //endwhile have_posts()
else: //have_posts()
?>
					<div class="contentbox">
						<div class="boxheading"><span>Comments</span><div class="clear"></div><div class="left"></div></div>
						<div class="postsmetadata">Sorry, no posts matched your criteria.</div>
					</div>	
<?php endif; ?>	
<!-- // this is just the end of the motor - don't touch that line either :) -->
		<?php //} ?>
					<div class="contentbox">
						<div class="boxheading" style="font-size:0.9em;"><span><?php timer_stop(1); ?> Provided by <a href="http://wordpress.org/" title="Provided by WordPress, state-of-the-art semantic personal publishing platform"><strong>WordPress</strong></a></span><div class="clear"></div></div>
					</div>
		<?php // Seen at http://www.mijnkopthee.nl/log2/archive/2003/05/28/esc(18) ?>
<script type="text/javascript">
<!--
document.onkeypress = function esc(e) {
	if(typeof(e) == "undefined") { e=event; }
	if (e.keyCode == 27) { self.close(); }
}
// -->
</script>				
				</div>
			</div>
		</div>
	</body>
</html>
