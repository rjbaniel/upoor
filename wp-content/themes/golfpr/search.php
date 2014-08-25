<?php

/**
 * @package WordPress
 * @subpackage golfPR
 */

get_header(); ?>

<div id="content_wrapper">
	<div id="content_area">
		<div id="content">
	<?php if (have_posts()) : ?>
		<div class="post">
		<h1><?php _e('Search Results'); ?></h1>
</div>
		<?php while (have_posts()) : the_post(); ?>

                <div class="post">
				<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to', 'golfpr'); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a> : <small><?php the_time('Y-m-d') ?></small></h1>
					<?php the_excerpt() ?>
				<p class="postmetadata"><?php the_tags('Tags: ', ', ', '<br />'); ?> <?php _e('Posted in', 'golfpr'); ?> <?php the_category(', ') ?> | <?php edit_post_link(__('Edit', 'golfpr'), '', ' | '); ?>  <?php comments_popup_link(__('No Comments &#187;', 'golfpr'), __('1 Comment &#187;', 'golfpr'), __('% Comments &#187;', 'golfpr')); ?></p>

			</div>

		<?php endwhile; ?>
	<div class="post">	
        <div class="navigation">
			<div class="alignleft"><?php next_posts_link(__('&laquo; Older Entries', 'golfpr')) ?></div>
			<div class="alignright"><?php previous_posts_link(__('Newer Entries &raquo;', 'golfpr')) ?></div>
		</div>
</div>
	<?php else : ?>
	<div class="post">	
		<h2><?php _e('No posts found. Try a different search?', 'golfpr'); ?></h2></div>

	<?php endif; ?>

	</div>

<?php get_sidebar(); ?>

	<div class="clear"></div>
</div><br />
</div>
<?php get_footer(); ?>
