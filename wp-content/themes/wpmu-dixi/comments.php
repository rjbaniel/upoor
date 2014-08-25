<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die (__('Please do not load this page directly. Thanks!', 'dixi'));

	if ( post_password_required() ) { ?>
		<h2 id="post-header"><?php _e('This post is password protected. Enter the password to view comments.', 'dixi'); ?></h2>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->
<div id="commentpost">

<?php if ( have_comments() ) : ?>

<?php if ( ! empty($comments_by_type['comment']) ) : ?>

<h4 id="comments"><span><?php comments_number(__('No Comments Yet', 'dixi'), __('1 Comment Already', 'dixi'), __('% Comments Already', 'dixi')); ?></span></h4>

<div id="post-navigator-single">
		<div class="alignleft"><?php previous_comments_link() ?></div>
		<div class="alignright"><?php next_comments_link() ?></div>
	</div>


<ol class="commentlist">
<?php wp_list_comments('type=comment'); ?>
</ol>


<div id="post-navigator-single">
<div class="alignleft"><?php previous_comments_link() ?></div>
<div class="alignright"><?php next_comments_link() ?></div>
</div>

<?php endif; ?>

<?php if ( ! empty($comments_by_type['pings']) ) : ?>
<h4><span><?php _e('Trackbacks/Pingbacks', 'dixi'); ?></span></h4>

<ol class="pinglist">
<?php wp_list_comments('type=pings&callback=list_pings'); ?>
</ol>
<?php endif; ?>

<?php else : // this is displayed if there are no comments so far ?>

<?php if ('open' == $post->comment_status) : ?>
 <!-- If comments are open, but there are no comments. -->
<?php else : // comments are closed ?>
<!-- If comments are closed. -->
<?php endif; ?>

<?php endif; ?>


<?php if ('open' == $post->comment_status) : ?>

<?php comment_form(); ?>

<?php endif; // if you delete this the sky will fall on your head ?>

</div>