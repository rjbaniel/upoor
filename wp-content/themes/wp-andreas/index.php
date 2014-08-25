<?php get_header(); ?>
<?php get_sidebar(); ?>

<div id="content">
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

<div class="post">
<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
<div class="contenttext">
<?php the_content(__('<p>Read more &raquo;</p>', 'wp-andreas')); ?>
</div>
<p class="postinfo"><strong><?php _e('Posted:', 'wp-andreas'); ?></strong> <?php the_time('F jS, Y') ?> under <?php the_category(', ') ?>.<br />
<?php the_tags('Tags: ', ', ', '<br />'); ?>
<a href="<?php comments_link(); ?>"><strong><?php _e('Comments:', 'wp-andreas'); ?></strong> <?php comments_number('none','1','%'); ?></a>
<?php edit_post_link('[e]',' | ',''); ?></p>
</div>

<?php endwhile; ?>

<div class="navigation">
<p><span class="prevlink"><?php next_posts_link(__('&laquo; Previous entries', 'wp-andreas') ) ?></span>
<span class="nextlink"><?php previous_posts_link(__('Next entries &raquo;', 'wp-andreas')) ?></span></p>
</div>

<?php else : ?>
<h2><?php _e('No results', 'wp-andreas'); ?></h2>
<p><?php _e('No matches. Please try again, or use the navigation menus to find what you search for.', 'wp-andreas'); ?></p>
<?php endif; ?>

</div>
<?php get_footer(); ?>
