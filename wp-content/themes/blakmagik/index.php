<?php get_header(); ?>

	<div id="content" class="narrowcolumn">

	<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>

			<div class="post" id="post-<?php the_ID(); ?>">
				<div class="comments"><?php comments_popup_link(__('NO COMMENTS', 'blakmagik'), __('<span> 1 </span> COMMENTS', 'blakmagik'), __('<span> % </span> COMMENTS', 'blakmagik')); ?></div>
				<div class="PostHead">

<div class="PostTime"><?php the_time('<b>j</b> M Y') ?> </div>
<h2><a title="Permanent Link to <?php the_title(); ?>" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
<small class="PostDet"><?php edit_post_link('Edit', '', ' | '); ?> <?php _e('Author:', 'blakmagik'); ?> <?php the_author() ?> | <?php _e('Filed under:', 'blakmagik'); ?> <?php the_category(', ') ?></small>
</div>

				<div class="entry">
					<?php the_content(__('Read the rest of this entry &raquo;', 'blakmagik')); ?>
				</div>

			
			</div>	<p class="postmetadata">
			<span class="tags"><?php the_tags('Tags: ', ', '); ?> </span>
			</p>

		<?php endwhile; ?>

	

	<?php else : ?>

		<h2 class="center"><?php _e('Not Found', 'blakmagik'); ?></h2>
		<p class="center"><?php _e("Sorry, but you are looking for something that isn't here.", 'blakmagik'); ?></p>
		<?php include (TEMPLATEPATH . "/searchform.php"); ?>

	<?php endif; ?>
    
    

	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
