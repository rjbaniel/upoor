<?php get_header(); ?>

<?php // This is the main loop. Body content is passed in through this code. ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<h1><?php the_title(); ?></h1>
<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>

<?php the_content(); ?>

<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>

<p class="meta"><?php the_time(get_option('date_format')); ?>. <?php if (is_callable('the_tags')) the_tags(__('Tags: ','fresh-bananas'), ', ', '.'); ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php _e('Category: ','fresh-bananas'); ?> <?php the_category(', '); ?>.&nbsp;&nbsp;&nbsp;<a href="<?php comments_link(); ?>"><?php comments_number(); ?></a>. <?php edit_post_link(__('Edit','fresh-bananas')); ?></p>

<?php comments_template('',true); ?>

<?php endwhile; else: ?>
<p><?php _e('Sorry, no posts matched your criteria.','fresh-bananas'); ?></p> 
<?php endif; ?>

<?php get_footer(); ?>
