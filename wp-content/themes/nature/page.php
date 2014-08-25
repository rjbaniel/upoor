<?php get_header(); ?>

	<div id="content" class="narrowcolumn">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post-page" id="post-<?php the_ID(); ?>">
		<h2 class="page_title"><?php the_title(); ?></h2>
			<div class="entry entry_page">
				<?php the_content(__('<p class="serif">Read the rest of this page &raquo;</p>', 'nature')); ?>

				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

				<?php edit_post_link(__('Edit this entry.', 'nature'), '<br /><p>', '</p>'); ?>
			</div>
		</div>
		<?php endwhile; endif; ?>
	</div>

<?php get_footer(); ?>
