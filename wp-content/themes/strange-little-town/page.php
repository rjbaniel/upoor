<?php get_header(); ?>



		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div class="post" id="post-<?php the_ID(); ?>">

			<h2><?php the_title(); ?></h2>

			<?php the_content(__('<p class="serif">Read the rest of this page &raquo;</p>', 'slt')); ?>

			<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

		</div>

		<?php endwhile; endif; ?>

	<?php edit_post_link(__('Edit this entry.', 'slt'), '<p>', '</p>'); ?>

		



        </div>







<?php get_sidebar(); ?>



<?php get_footer(); ?>
