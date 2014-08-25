<?php get_header(); ?>
	<div id="content" class="narrowcolumn">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post">
		<h2 id="post-<?php the_ID(); ?>"><?php the_title(); ?></h2><?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280shadow"); } ?>
			<div class="entrytext">
				<?php the_content(__('<p class="serif">Read the rest of this page &raquo;</p>', 'batavia')); ?>
	<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280shadow"); } ?>
				<?php wp_link_pages('<p><strong>'.__('Pages:').'</strong> ', '</p>', 'number'); ?>
	             	<?php edit_post_link(__('Edit this entry.', 'batavia'), '<p>', '</p>'); ?>     
			</div>
		</div>
	  <?php endwhile; ?>
      <?php if ( comments_open() ) { ?> <?php comments_template('',true); ?><?php } ?>

     <?php endif; ?>

	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
