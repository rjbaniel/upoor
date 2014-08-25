<?php get_header(); ?>

<?php // This is the main loop. Body content is passed in through this code. ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<h1><?php the_title(); ?></h1>


<?php the_content(); ?>
<?php wp_link_pages('before=<p>&after=</p>'); ?>


<p class="meta"><?php edit_post_link(__('Edit','fresh-bananas')); ?></p>

<?php if ( comments_open() ) { ?> <?php comments_template('',true); ?><?php } ?>


<?php endwhile; else: ?>
<p><?php _e('Sorry, no posts matched your criteria.','fresh-bananas'); ?></p> 
<?php endif; ?>

<?php get_footer(); ?>
