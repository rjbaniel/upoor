<?php get_header(); ?>

<?php if (have_posts()) : ?><?php while (have_posts()) : the_post(); ?>

<div class="post" id="post-<?php the_ID(); ?>">

<?php the_date('','<small>','</small>'); ?>

<h3 class="storytitle"><?php the_title(); ?></h3>

<div class="meta"><?php _e('Filed under:','classic'); ?>  <?php the_category(',') ?> &#8212; <?php the_author_posts_link() ?> @ <?php the_time() ?> <?php edit_post_link(__('Edit This','classic')); ?><br /><?php the_tags(__('Tags: '), ', ', '<br />'); ?></div>


<div class="storycontent">

<?php the_content(__('(more...)','classic')); ?>

<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>

</div>

</div>

<?php endwhile; ?>

<?php comments_template('',true); ?>

<?php else: ?>

<p><?php _e('Sorry, no posts matched your criteria.','classic'); ?></p>

<?php endif; ?>


<?php posts_nav_link(' &#8212; ', __('&laquo; Previous Page','classic'), __('Next Page &raquo;','classic')); ?>

<?php get_footer(); ?>
