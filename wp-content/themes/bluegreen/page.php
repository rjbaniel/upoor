<?php get_header(); ?>

	<div id="content">
	<div class="entry">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post" id="post-<?php the_ID(); ?>">
		<h2><?php the_title(); ?></h2>
		
		
				<?php the_content(__('<p class="serif">Read the rest of this page &raquo;</p>', 'bluegreen')); ?>

				<?php wp_link_pages(array('before' => __('<p><strong>'.__('Pages:').'</strong> '), __('after') => '</p>', 'next_or_number' => 'number')); ?>
                   	<?php edit_post_link(__('Edit this entry.', 'bluegreen'), '<p>', '</p>'); ?>           
			</div>
		</div>
		<?php endwhile; ?>

              <?php if ( comments_open() ) { ?> <?php comments_template('',true); ?><?php } ?>

        <?php endif; ?>

	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
