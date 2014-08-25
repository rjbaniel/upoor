<?php get_header(); ?>

	<div id="content" class="widecolumn">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
				
			<h2>
				<a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
			</h2>
			<small id="thetime">
				<span style="color:white"><?php the_time(' F ') ?></span><br />
				<span><?php the_time(' j ') ?></span>
			</small>
			<div class="entry">
				<?php the_content(__('<p class="serif">Read the rest of this entry &raquo;</p>', 'color-splash')); ?>

				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
<p id="gettocategory"><?php the_category(', ') ?></p>
					<p class="metadata">

				<img src="<?php bloginfo('template_directory'); ?>/Icons/Tag1.gif" />
				<small>
				<?php the_tags(' ', ' ', ''); ?>
				</small>
				</p>
			</div>
		</div>
	<hr />
	<?php comments_template('',true); ?>

	<?php endwhile; else: ?>

		<p><?php _e('Sorry, no posts matched your criteria', 'color-splash'); ?>.</p>

<?php endif; ?>

	</div>

<?php get_footer(); ?>
