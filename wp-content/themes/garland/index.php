<?php get_header(); ?>
<?php is_tag(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div <?php post_class(); ?>>
<h2><a href="<?php echo get_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
<span class="submitted"><?php the_time(get_option('date_format')) ?> &#8212; <?php the_author() ?> <?php edit_post_link(__('Edit'), ' | ', ''); ?></span>
<div class="content">
<?php 
if ( get_theme_mod( 'show_exerpts' ) ) {
the_excerpt();
} else {
the_content(); 
} ?>
<?php wp_link_pages('<p><strong>'.__('Pages:').'</strong> ', '</p>', 'number'); ?>
</div>
<div class="meta">
<?php printf(__('Posted in %s'), get_the_category_list(', ')); ?>. <?php if (is_callable('the_tags')) the_tags(__('Tags:<span class="tags">').' ', ', ', '</span>.'); ?> <?php comments_popup_link(__('No Comments'), __('1 Comment'), __('% Comments')); ?> &#187;
</div>
</div>
<?php endwhile; endif; ?>
<div class="nextprev">
<div class="alignleft"><?php next_posts_link(__('&laquo; Older posts')) ?> <?php previous_post_link('&laquo; %link') ?></div>
<div class="alignright"><?php previous_posts_link(__('Newer posts &raquo;')) ?> <?php next_post_link('%link &raquo;') ?></div>
</div>
<?php get_footer(); ?>
