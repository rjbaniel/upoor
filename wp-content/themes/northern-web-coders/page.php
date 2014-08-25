<?php
get_header();
?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<h2><?php bloginfo('name'); ?></h2>
<div class="post">
<h3 class="storytitle" id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>
<div class="meta"><?php edit_post_link(__('Edit This',TEMPLATE_DOMAIN)); ?></div>
<div class="storycontent">
<?php the_content(__('(more...)',TEMPLATE_DOMAIN)); ?>
</div>

<!--
<?php trackback_rdf(); ?>
-->
</div>

<?php endwhile; ?>

<?php if ( comments_open() ) { ?> <?php comments_template('',true); ?><?php } ?>

<?php else: ?>

<?php endif; ?>
<div style="margin: 10px 0 10px 0"><?php posts_nav_link(' &#8212; ', __('&laquo; Previous Page',TEMPLATE_DOMAIN), __('Next Page &raquo;',TEMPLATE_DOMAIN)); ?></div>
<?php get_footer(); ?>
