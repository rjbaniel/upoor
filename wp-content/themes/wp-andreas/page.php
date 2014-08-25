<?php get_header(); ?>

<div id="contentwide">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<?php list_subpages_andreas01(); ?> <?php // This generates the subpage menu. If you don't want to use it, delete this line. ?>

<div class="post">
<h2><?php the_title(); ?></h2>
<?php the_content(__('<p class="serif">Read more &raquo;</p>', 'wp-andreas')); ?>
<?php wp_link_pages('<p><strong>Pages:</strong> ', '</p>', 'number'); ?>
<?php edit_post_link(__('Edit this page', 'wp-andreas'),'<p>','</p>'); ?>
<?php comments_template('',true); ?>
<?php endwhile; endif; ?>
</div>
</div>

<?php get_footer(); ?>
