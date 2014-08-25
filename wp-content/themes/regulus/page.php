<?php get_header(); ?>

	<div id="content">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<h2><?php
		// get the page id
		global $id;
		$bm_pageID = $id;
		the_title(); ?></h2>

		<?php the_content(); ?>

		<?php wp_link_pages('<p><strong>'.__('Pages:','regulus').'</strong> ', '</p>', __('number','regulus')); ?>

	<?php endwhile; endif;

   if ( comments_open() ) { ?> <?php comments_template('',true); ?><?php }

	?>
	 
	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
