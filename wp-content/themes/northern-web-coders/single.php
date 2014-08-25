<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<?php the_date('','<h2>','</h2>'); ?>
<div class="post">
<h3 class="storytitle" id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>
<div class="meta"><?php _e("Filed under:",TEMPLATE_DOMAIN); ?> <?php the_category(',') ?> &#8212; <?php the_author_posts_link() ?> @ <?php the_time() ?> <?php edit_post_link(__('Edit This',TEMPLATE_DOMAIN)); ?> and <?php the_tags( '' . __( 'tagged',TEMPLATE_DOMAIN ) . ' ', ', ', ''); ?></div>
<div class="storycontent">

<?php if(file_exists(WP_CONTENT_DIR . '/ads-block-two.php')) include(WP_CONTENT_DIR . '/ads-block-two.php'); ?>

<?php the_content(); ?>
</div>
<div class="feedback">
<?php wp_link_pages(); ?>
<?php comments_popup_link(__('Comments (0)',TEMPLATE_DOMAIN), __('Comments (1)',TEMPLATE_DOMAIN), __('Comments (%)',TEMPLATE_DOMAIN)); ?>
</div>
<!--
<?php trackback_rdf(); ?>
-->
</div>

<?php endwhile; ?>
<?php comments_template('',true); // Get wp-comments.php template ?>
<?php else: ?>
<p><?php _e('Sorry, no posts matched your criteria.',TEMPLATE_DOMAIN); ?></p>
<?php endif; ?>
<div style="margin: 10px 0 10px 0"><?php posts_nav_link(' &#8212; ', __('&laquo; Previous Page',TEMPLATE_DOMAIN), __('Next Page &raquo;',TEMPLATE_DOMAIN)); ?></div>
<?php get_footer(); ?>
