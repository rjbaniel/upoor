<?php if (function_exists('comment_form_text_output')){ comment_form_text_output(); } ?><br /><br />
<?php if ( !empty($post->post_password) && $_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) : ?>
<?php return; endif; ?>

<span id="comments"></span>

<?php if ( have_comments() ) : ?>

<?php if ( ! empty($comments_by_type['comment']) ) : ?>

<div id="post-navigator-single">
<div class="alignright"><?php if(function_exists('paginate_comments_links')) {  paginate_comments_links(); } ?></div>
</div>

<div id="comments" class="commentlist">
<?php wp_list_comments('type=comment&callback=list_comments'); ?>
</div>


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

<?php else : ?>

<?php if ('open' == $post->comment_status) : ?>

<?php else : ?>

<?php endif; ?>
<?php endif; ?>

<?php require( TEMPLATEPATH .'/comments-form.php'  );
