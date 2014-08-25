<?php /* Template Name: Homepage */
get_header();
?>
<div id="post-entry">
<div id="blog-content">

<?php include (TEMPLATEPATH . '/lib/includes/options.php'); ?>

<?php if(($tn_wpmu_dixi_layout_mode == "") || ($tn_wpmu_dixi_layout_mode == "custom homepage")) { ?>

<?php locate_template ( array('/lib/templates/custom-homepage.php'), true ); ?>

<?php } else if($tn_wpmu_dixi_layout_mode == "blog homepage") { ?>

<?php if (have_posts()) : ?>

<?php locate_template ( array('/lib/templates/headline.php'), true ); ?>

<?php while (have_posts()) : the_post(); ?>
<div <?php if(function_exists("post_class")) : ?><?php post_class(); ?><?php else: ?>class="post"<?php endif; ?> id="post-<?php the_ID(); ?>">
<h1 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
<div class="post-author"><?php _e('Posted by', TEMPLATE_DOMAIN); ?>&nbsp;<?php the_author_posts_link(); ?>&nbsp;<?php _e('on', TEMPLATE_DOMAIN); ?>&nbsp;<?php the_time('l, F jS Y') ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php edit_post_link(__('edit', TEMPLATE_DOMAIN)); ?></div>

<div class="post-content">
<?php the_content( __('.....click here to read more', TEMPLATE_DOMAIN) ); ?>
</div>

<?php locate_template ( array('/lib/templates/social.php'), false ); ?>

</div>

<?php endwhile; ?>

<?php locate_template ( array('/lib/templates/paginate.php'), true ); ?>

<?php else: ?>

<?php locate_template ( array('/lib/templates/result.php'), true ); ?>

<?php endif; ?>

<?php } ?>

</div>

<?php get_sidebar('right'); ?>

</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>