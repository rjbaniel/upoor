<?php get_header(); ?>



	<div id="content">



	<?php if (have_posts()) : ?>



		<h2 class="pagetitle"><?php _e('Search Results', 'bluegreen');?></h2>



		<?php while (have_posts()) : the_post(); ?>



			<div class="entry">

				<h3 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to', 'bluegreen');?> <?php the_title(); ?>"><?php the_title(); ?></a></h3>

				<small><?php the_time('l, F jS, Y') ?></small>

<br /><br /><?php the_content_feed('', TRUE, '', 50); ?><br /><br />

				<p class="postmetadata"><?php _e('Posted in ', 'bluegreen');?> <?php the_category(', ') ?> | <?php edit_post_link(__('Edit', 'bluegreen'), '', ' | '); ?>  <?php comments_popup_link(__('No Comments &#187;', 'bluegreen'), __('1 Comment &#187;', 'bluegreen'), __('% Comments &#187;', 'bluegreen')); ?></p>

			</div>



		<?php endwhile; ?>



		<div class="navigation">

			<div class="alignleft"><?php next_posts_link(__('&laquo; Previous Entries', 'bluegreen')) ?></div>

			<div class="alignright"><?php previous_posts_link(__('Next Entries &raquo;', 'bluegreen')) ?></div>

		</div>



	<?php else : ?>

	<div class="entry">

		<h2 class="center"><?php _e('No posts found. Try a different search?', 'bluegreen'); ?></h2>



</div>

	<?php endif; ?>



	</div>



<?php get_sidebar(); ?>



<?php get_footer(); ?>
