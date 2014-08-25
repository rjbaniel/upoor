<?php get_header(); ?>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<div class="entry" id="post-<?php the_ID(); ?>">

		<h2><?php the_title(); ?></h2>
			<div align="center">	</div>	<?php the_content(__('<p class="serif">Read the rest of this page &raquo;</p>', TEMPLATE_DOMAIN)); ?><div align="center">	</div>
	
				<?php wp_link_pages('<p><strong>'.__('Pages', TEMPLATE_DOMAIN).':</strong> ', '</p>', 'number'); ?>

  <?php endwhile; endif; ?>
	<?php edit_post_link(__('Edit this entry.', TEMPLATE_DOMAIN), '<p>', '</p>'); ?>
	
			</div>
	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
