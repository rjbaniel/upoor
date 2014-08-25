<?php get_header(); ?>

<div id="content">
	<?php if (have_posts()) : ?>

		<h1><?php _e('Search Results:', 'japan-style'); ?> <span><?php the_search_query(); ?></span></h1>
		
		<div class="post" id="post-<?php the_ID(); ?>">
			<ul>
			<?php while (have_posts()) : the_post(); ?>

					<li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to', 'japan-style'); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a> - <?php the_time('F jS, Y') ?></li>

			<?php endwhile; ?>
			</ul>
		</div>

		<div id="pages">
			<a href="#"><?php next_posts_link(__('&larr;Older', 'japan-style')) ?></a>&nbsp;&nbsp;&nbsp;<a href="#"><?php previous_posts_link(__('Newer&rarr;', 'japan-style')) ?></a>
		</div>

	<?php else : ?>

		<h2 class="center"><?php _e('No posts found. Try a different search?', 'japan-style'); ?></h2>

	<?php endif; ?>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
