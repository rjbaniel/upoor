<?php
/*
Template Name: Full-Width
*/
?>


<?php get_header(); ?>

<div class="full-width" id="post-entry">

<?php if (have_posts()) : ?>

<?php while (have_posts()) : the_post(); ?>

<div <?php if(function_exists("post_class")) : ?><?php post_class(); ?><?php else: ?>class="page"<?php endif; ?> id="post-<?php the_ID(); ?>">

<h1 class="post-title"><?php the_title(); ?></h1>

<div class="post-content">
<?php the_content(); ?>
<?php edit_post_link(__('Edit This Page', TEMPLATE_DOMAIN), '<p>','</p>'); ?>
</div>

</div>

<?php endwhile; ?>

<?php endif; ?>

</div>


<?php get_footer(); ?>