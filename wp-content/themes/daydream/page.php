<?php get_header(); ?>

	<div id="content" class="narrowcolumn">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post" id="post-<?php the_ID(); ?>">
		<h2 class="single"><?php the_title(); ?></h2>
			<div class="entry">
				<?php the_content(__('<p class="serif">Read the rest of this page &raquo;</p>','daydream')); ?>
	
				<?php wp_link_pages('<p><strong>'.__('Pages:','daydream').'</strong> ', '</p>', 'number'); ?>
	
			</div>
		</div>
	  <?php endwhile; endif; ?>
	<h4><?php edit_post_link(__('Edit this entry.','daydream'), '<p>', '</p>'); ?></h4>

     <?php if ( comments_open() ) { ?> <?php comments_template('',true); ?><?php } ?>     

	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
