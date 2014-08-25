<?php

// Do not delete these lines

if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))

die (__('Please do not load this page directly. Thanks!', 'blogtheme'));



if ( post_password_required() ) { ?>

<h2 id="headline"><?php _e('This post is password protected. Enter the password to view comments.', 'blogtheme'); ?></h2>

<?php

return;

}

?>



<!-- Start editing here. -->



<?php if ( have_comments() ) : ?>

<h3 class="header"><?php comments_number(__('No Comments', 'blogtheme'), __('One Comment', 'blogtheme'), __('% Comments', 'blogtheme') );?> <?php _e('on', 'blogtheme'); ?> &#8220;<?php the_title(); ?>&#8221;</h3>







	<div id="pnav">

		<div class="alignleft"><?php previous_comments_link() ?></div>

		<div class="alignright"><?php next_comments_link() ?></div>

	</div>





	<ol class="commentlist">

   <?php wp_list_comments('callback=list_comments'); ?>

	</ol>





<div id="pnav">

		<div class="alignleft"><?php previous_comments_link() ?></div>

		<div class="alignright"><?php next_comments_link() ?></div>

	</div>







	<?php else : // this is displayed if there are no comments so far ?>



		<?php if ('open' == $post->comment_status) : ?>



		<?php else : ?>

	   <!--	<p class="nocomments"><?php _e('Comments are closed.', 'blogtheme'); ?></p>     -->



	<?php endif; ?>

<?php endif; ?>





<?php if ('open' == $post->comment_status) : ?>



<div id="respond">

<h3 class="header"><?php _e('Leave Your Comment', 'blogtheme'); ?></h3>


<?php if ( get_option('comment_registration') && !$user_ID ) : ?>

<p class="right"><?php _e('You must be');?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>"><?php _e('logged in');?></a> <?php _e('to post a comment.');?></p>



<?php else : ?>



<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">







<div class="cancel-comment-reply">

<?php cancel_comment_reply_link(); ?>

</div>


<?php if ( $user_ID ) : ?>



	<p id="logged" class="right"><?php _e('Logged in as', 'blogtheme');?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="<?php _e('Log out of this account', 'blogtheme');?>"><?php _e('Logout', 'blogtheme');?> &raquo;</a></p>



<?php else : ?>

	

	<div class="textfield">

		

		<div class="textlabel"><?php _e('Name', 'blogtheme'); ?> <?php if ($req) echo "(required)"; ?></div>

		<div class="thefield"><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" class="field" /></div>

	

	</div><!--textfield-->



	<div class="textfield">

		

		<div class="textlabel"><?php _e('Email', 'blogtheme'); ?> <?php if ($req) echo "(required)"; ?></div>

		<div class="thefield"><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" class="field" /></div>

	

	</div><!--textfield-->



	<div class="textfield">

		

		<div class="textlabel"><?php _e('Website', 'blogtheme'); ?></div>

		<div class="thefield"><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" class="field" /></div>

	

	</div><!--textfield-->		



<?php endif; ?>



	<div class="textfield">

		

		<div class="textlabel"><?php _e('Message', 'blogtheme'); ?></div>

		<div class="thefield"><textarea name="comment" id="comment" cols="100%" rows="10" tabindex="4"></textarea></div>

	

	</div><!--textfield-->



	<div class="textfield">

		

		<div class="textlabel">&nbsp;</div>

		<div class="thefield"><input name="submit" type="submit" id="submit" tabindex="5" value="Submit Comment" /><input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" /></div>

	

	</div><!--textfield-->



<?php if(function_exists("comment_id_fields")) { ?>

<?php comment_id_fields(); ?>

<?php } ?>



<?php do_action('comment_form', $post->ID); ?>



</form>



<?php endif; ?>

</div>



<?php endif; ?>
