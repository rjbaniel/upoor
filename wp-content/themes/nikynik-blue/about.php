<?php
/*

Template Name: About

*/
?>
<?php get_header(); ?>

<div id="content" class="narrowcolumn">
<div class="post">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<?php the_content(); ?>
<?php endwhile; endif; ?>

</div>	</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
