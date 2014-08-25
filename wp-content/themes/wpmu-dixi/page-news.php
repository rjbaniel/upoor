<?php
/*
Template Name: News
*/
?>


<?php get_header(); ?>
<div id="post-entry">
<div id="blog-content">

<?php locate_template ( array('/lib/templates/headline.php'), true ); ?>

<?php
global $more; $more = 0;
$max_num_post = get_option('posts_per_page');
$page = (get_query_var('paged')) ? get_query_var('paged') : 1; query_posts("cat=&showposts=$max_num_post&paged=$page"); while ( have_posts() ) : the_post(); ?>

<div <?php if(function_exists("post_class")) : ?><?php post_class(); ?><?php else: ?>class="post"<?php endif; ?> id="post-<?php the_ID(); ?>">

<h1 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>

<?php $postmeta_status = get_option('tn_wpmu_dixi_postmeta_status'); if ($postmeta_status != 'disable') { ?>
<div class="post-author"><?php _e('Posted by', TEMPLATE_DOMAIN); ?>&nbsp;<?php the_author_posts_link(); ?>&nbsp;<?php _e('on', TEMPLATE_DOMAIN); ?>&nbsp;<?php the_time('l, F jS Y') ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php edit_post_link(__('edit', TEMPLATE_DOMAIN)); ?></div>
<?php } ?>

<?php do_action('bp_before_post_content'); ?>
<div class="post-content">
<?php the_content(__('<p>Read the rest of this entry &raquo;</p>', 'dixi')); ?>
</div>
<?php do_action('bp_after_post_content'); ?>

<?php locate_template ( array('/lib/templates/social.php'), false ); ?>

</div>

<?php endwhile; ?>

<div id="post-navigator">
<div class="alignright"><?php previous_posts_link(__('Newer Entries &raquo;', TEMPLATE_DOMAIN)); ?></div>
<div class="alignleft"><?php next_posts_link(__('&laquo; Older Entries', TEMPLATE_DOMAIN)); ?></div>
</div>

</div>

<?php get_sidebar('right'); ?>

</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>