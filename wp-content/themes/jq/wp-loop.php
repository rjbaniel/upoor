<!-- WP Loop -->
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
<div class="headline clearfix">
<div class="date">
<?php the_time('M/y'); ?>
<p class="date-month"><?php the_time('j'); ?></p>
</div>
<h1><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
<p class="button"><div class="preview"><a href="#" class="view-excerpt"></a></div></p>
<div class="clearfix"></div>
<p class="post_info">         
<?php comments_popup_link(__('No comments', 'jq'),__('1 Comment', 'jq'),__('% Comments', 'jq'),'','Comments off'); ?> &middot; <?php _e('Posted by', 'jq'); ?> <?php the_author_posts_link(); ?></i> <?php _e('in', 'jq'); ?> <?php the_category(', '); ?>
</p>
</div>
<?php
/* This code retrieves all our admin options. */
global $options;
foreach ($options as $value) {
	if (isset($value['id']) && get_option( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else if (isset($value['id'])) { $$value['id'] = get_option( $value['id'] ); }
}
?>
<div class="excerpt">
<?php /* Post options */
if ($jq_post_display == "false") {
the_content();
if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); }
wp_link_pages();
} else {

if(function_exists('the_post_thumbnail')) {
if(get_the_post_thumbnail() != "") {
echo "<div class='alignleft'>";
the_post_thumbnail();
echo "</div>";
}
}

the_excerpt();
if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); }
} ?>

<div class="clearfix"></div>
<p class="tag_info">
<?php $tag = get_the_tags(); if (! $tag) {echo "No tags";} else {the_tags('', ' &middot; ', '');} ?>
</p>
</div>
<?php endwhile; ?>
<p class="previous-posts"><?php previous_posts_link(__('&laquo; Latest posts', 'jq')); ?></p>
<p class="next-posts"><?php next_posts_link(__('Older posts &raquo;', 'jq')); ?></p>
<?php else : ?>
<p class="not-found"><?php _e('Sorry, no posts matched your criteria.', 'jq'); ?></p>
<?php include (TEMPLATEPATH . "/searchform.php"); ?>
<?php endif; ?>
