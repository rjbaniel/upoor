<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div <?php post_class(); ?>>
<h2><?php the_title(); ?></h2>
<span class="submitted"><?php the_time(get_option('date_format')) ?> &#8212; <?php the_author() ?> <?php edit_post_link(__('Edit'), ' | ', ''); ?></span>
<div class="content">
<?php the_content(__('Read the rest of this entry &raquo;')); ?>
<?php wp_link_pages('<p><strong>'.__('Pages:').'</strong> ', '</p>', 'number'); ?>
</div>
<div class="meta">
<?php printf(__('Posted in %s'), get_the_category_list(', ')); ?>. <?php if (is_callable('the_tags')) the_tags(__('Tags:<span class="tags">').' ', ', ', '</span>.'); ?> <?php post_comments_feed_link(__('<abbr title="Really Simple Syndication">RSS</abbr> feed for comments on this post.')); ?>. <a href="<?php trackback_url(); ?>" rel="trackback"><?php _e('TrackBack <abbr title="Universal Resource Locator">URL</abbr>'); ?></a>.
</div>
</div>
<?php endwhile; endif; ?>
<?php comments_template(); ?>
<div class="nextprev">
<div class="alignleft"><?php next_posts_link(__('&laquo; Older posts')) ?> <?php previous_post_link('&laquo; %link') ?></div>
<div class="alignright"><?php previous_posts_link(__('Newer posts &raquo;')) ?> <?php next_post_link('%link &raquo;') ?></div>
</div>
<?php get_footer(); ?>
