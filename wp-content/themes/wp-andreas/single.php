<?php get_header(); ?>
<?php get_sidebar(); ?>

<div id="content">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div class="post">
<h2><?php the_title(); ?></h2>

<div class="contenttext">
<?php the_content(__('<p>Read more &raquo;</p>', 'wp-andreas')); ?>
</div>

<?php wp_link_pages('<p><strong>Pages:<strong> ', '</p>', 'number'); ?>
<p class="postinfo"><strong><?php _e('Posted:', 'wp-andreas'); ?></strong> <?php the_time('F jS, Y') ?> <?php _e('under', 'wp-andreas'); ?> <?php the_category(', ') ?>.<br />
<?php the_tags('Tags: ', ', ',''); ?><?php edit_post_link('[e]',' | ',''); ?></p>

<div class="navigation">
<p><span class="prevlink"><?php previous_post_link('&laquo; %link',__('Previous post', 'wp-andreas'),''); ?></span>
<span class="nextlink"><?php next_post_link('%link &raquo;',__('Next post', 'wp-andreas'),''); ?></span></p>
</div>

<?php comments_template('', true); ?>

<?php endwhile; else: ?>
<p><?php _e('No matching entries found.', 'wp-andreas'); ?></p>
<?php endif; ?>
</div>
</div>

<?php get_footer(); ?>
