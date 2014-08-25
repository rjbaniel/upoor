<?php
/* This code retrieves all our admin options. */
global $options;
foreach ($options as $value) {
	if (isset($value['id']) && get_option( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else if (isset($value['id'])) { $$value['id'] = get_option( $value['id'] ); }
}
?>
<?php get_header(); ?>
<div id="content" class="clearfix">
<?php get_sidebar(); ?>
<div id="left">
<?php /* Slideshow HTML */
if ($jq_slide_display == "false") { ?>
<div id="slideshow">
    <div id="slidesContainer">
<?php
 $rand_posts = get_posts('numberposts=7&orderby=rand');
 foreach( $rand_posts as $post ) : ?>
		<div class="slide">
			<h1 class="slide_header"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
			<div class="clearfix"></div>
			<p class="post_info_slide">
			<?php comments_popup_link(__('No comments', 'jq'),__('1 Comment', 'jq'),__('% Comments', 'jq'),'','Comments off'); ?> &middot;
			<?php _e('Posted', 'jq'); ?> <?php the_author_posts_link(); ?> <?php _e('in', 'jq'); ?> <?php the_category(', '); ?>
			</p>
		</div>
 <?php endforeach; ?>
    </div>
</div>
<?php } ?>
<!-- Slideshow HTML -->
<?php include (TEMPLATEPATH . "/wp-loop.php"); ?>
</div>
</div>
<?php get_footer(); ?>
