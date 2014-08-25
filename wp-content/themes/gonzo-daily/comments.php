<?php

if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) die (__('Access denied.', 'gonzo-daily'));

if (!empty($post->post_password)) 

{

	if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) { ?>



		<p class="nocomments"><?php _e('Enter your password to view comments.', 'gonzo-daily'); ?></p>

				

	<?php

		return;

	}

}

?>

<?php if ( have_comments() ) : ?>

<?php if ( ! empty($comments_by_type['comment']) ) : ?>
<h2 id="comments"><?php comments_number(__('No Comments', 'gonzo-daily'), __('1 Comment', 'gonzo-daily'), __('% Comments', 'gonzo-daily')); ?></h2>

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
	<h3><?php _e('Trackbacks/Pingbacks'); ?></h3>

    <ol class="pinglist">
    <?php wp_list_comments('type=pings&callback=list_pings'); ?>
	</ol>
    </div>
	<?php endif; ?>
    <?php endif; ?>




<?php endif; ?>

