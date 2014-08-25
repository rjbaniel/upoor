<?php get_header(); ?>

<div id="content">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div class="post" id="post-<?php the_ID(); ?>">
			<h1><?php the_title(); ?></h1>

			<?php the_content(__('<p class="serif">Read the rest of this entry &raquo;</p>', 'japan-style')); ?>

			<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
			
			<div class="post-info">
				<?php the_time('F jS, Y') ?> in
				<?php the_category(', '); ?>
				<?php the_tags('| tags: ', ', ', ''); ?>
				<?php edit_post_link(__('[Edit this entry]', 'japan-style'),'',''); ?>
			</div>
		</div>

		<?php comments_template('',true); ?>

	<?php endwhile; else: ?>

		<p><?php _e('Sorry, no posts matched your criteria.', 'japan-style'); ?></p>

	<?php endif; ?>

</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
