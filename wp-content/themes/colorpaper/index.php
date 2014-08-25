<?php get_header(); ?>



<div id="featured">
<div class="featured-content">
<?php query_posts('showposts=1'); if (have_posts()) : while (have_posts()) : the_post(); ?>
<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to', 'colorpaper'); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
<?php the_excerpt(''); ?>

<div class="post-meta">

<a href="<?php the_permalink() ?>#more-<?php the_ID(); ?>" rel="bookmark" title="Read More of <?php the_title_attribute(); ?>" class="btn btn-orange"><?php _e('Read More', 'colorpaper'); ?></a> <?php comments_popup_link(__('0 Comments', 'colorpaper'), __('1 Comment', 'colorpaper'), __('% Comments', 'colorpaper')); ?> &nbsp; | &nbsp;  <?php _e('Posted by', 'colorpaper'); ?> <span class="orange weight-normal"><?php the_author_link(); ?></span>

</div>

<?php endwhile; endif; ?>

</div>

</div>


</div>

<div class="left-content">

<?php

// Fixes for post offset

add_filter('post_limits', 'my_post_limit');

global $myOffset;

$myOffset = 1;

								
$temp = $wp_query; $wp_query= null; $wp_query = new WP_Query();

$wp_query->query('offset=1'.'&paged='.$paged);

								
while ($wp_query->have_posts()) : $wp_query->the_post();

?>

							

<div class="post">

<div class="post-date"><span class="month block"><?php the_time('M'); ?> </span><span class="day"><?php the_time('d'); ?> </span></div>

<h4><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to', 'colorpaper'); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>

<?php the_content(''); ?>

<div class="post-meta">

<a href="<?php the_permalink() ?>#more-<?php the_ID(); ?>" rel="bookmark" title="<?php _e('Read More of', 'colorpaper'); ?> <?php the_title_attribute(); ?>" class="btn btn-<?php echo $style; ?>"><?php _e('Read More', 'colorpaper'); ?></a> <?php comments_popup_link(__('0 Comments', 'colorpaper'), __('1 Comment', 'colorpaper'), __('% Comments', 'colorpaper')); ?> &nbsp; | &nbsp;  <?php _e('Posted by', 'colorpaper'); ?> <span class="<?php echo $style; ?> weight-normal"><?php the_author_link(); ?></span>

</div>

</div>

									

<?php endwhile;  ?>

								

<div class="clearfix pagination bluegray">

<?php next_posts_link(__('Previous Page', 'colorpaper')) ?>
<span class="extralarge"><?php echo $paged; ?> of <?php echo total_pages(); ?></span> <?php previous_posts_link(__('Next Page', 'colorpaper')) ?>

</div>


<?php /* Fixes for post offset */ $wp_query = null; $wp_query = $temp; remove_filter('post_limits', 'my_post_limit'); ?>

</div>

</div>

<div id="right-col">

<?php get_sidebar(); ?>

</div>

</div>

</div>

<?php get_footer(); ?>
