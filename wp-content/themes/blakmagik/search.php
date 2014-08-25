<?php get_header(); ?>

	<div id="content" class="narrowcolumn">

	<?php if (have_posts()) : ?>

		<h2 class="pagetitle"><?php _e('Search Results', 'blakmagik'); ?></h2>

	


		<?php while (have_posts()) : the_post(); ?>

            <div class="post" id="post-<?php the_ID(); ?>">
				<div class="comments"><?php comments_popup_link(__('NO COMMENTS', 'blakmagik'), __('<span> 1 </span> COMMENTS', 'blakmagik'), __('<span> % </span> COMMENTS', 'blakmagik')); ?></div>
				<div class="PostHead">

<div class="PostTime"><?php the_time('<b>j</b> M Y') ?> </div>
<h2><a title="Permanent Link to <?php the_title(); ?>" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
<small class="PostDet"><?php edit_post_link('Edit', '', ' | '); ?> <?php _e('Author:', 'blakmagik'); ?> <?php the_author() ?> | <?php _e('Filed under:', 'blakmagik'); ?> <?php the_category(', ') ?></small>
</div>



			</div>

		<?php endwhile; ?>


	<?php else : ?>

		<h2 class="pagetitle"><?php _e('No posts found. Try a different search?', 'blakmagik'); ?></h2>
		<?php include (TEMPLATEPATH . '/searchform.php'); ?>

	<?php endif; ?>

	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
