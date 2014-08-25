<?php get_header(); ?>

<div id="post-entry">
<div id="blog-content">

<?php if (have_posts()) : ?>

<?php locate_template ( array('/lib/templates/headline.php'), true ); ?>

<?php while (have_posts()) : the_post(); ?>

<div <?php if(function_exists("post_class")) : ?><?php post_class(); ?><?php else: ?>class="post"<?php endif; ?> id="post-<?php the_ID(); ?>">

<h1 class="post-title"><?php the_title(); ?></h1>

<div class="post-author"><!--<?php _e('Posted by', TEMPLATE_DOMAIN); ?>&nbsp;<?php the_author_posts_link(); ?>&nbsp;<?php _e('on', TEMPLATE_DOMAIN); ?>&nbsp;<?php the_time('l, F jS Y') ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--><?php edit_post_link(__('edit', TEMPLATE_DOMAIN)); ?></div>

<div class="post-content">
<?php the_content(); ?>
<?php wp_link_pages('before=<p>&after=</p>'); ?>
</div>

<?php // include (TEMPLATEPATH . '/social.php'); ?>

</div>

<?php endwhile; ?>

<?php if ( comments_open() ) { ?><?php comments_template('', true); ?><?php } ?>

<?php else: ?>

<?php locate_template ( array('/lib/templates/result.php'), true ); ?>

<?php endif; ?>


</div>

<?php get_sidebar('right'); ?>

</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>