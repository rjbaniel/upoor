<?php get_header(); ?>
<div id="page">	
<?php if (have_posts()) : ?>	
<?php while (have_posts()) : the_post(); ?>			
	<div class="page-main" id="page-<?php the_ID(); ?>">				
	<div class="page-info">					
			<h2 class="page-title"><?php the_title(); ?></h2>
		</div>
		<div class="page-content">
		<?php the_content(); ?>
		<?php wp_link_pages('<p><strong>'.__('Pages:').'</strong> ', '</p>', 'number'); ?>
		</div>
		<?php if ( comments_open() ) { ?> <?php comments_template(); ?><?php } ?>
	</div> <!--end page main-->
<?php endwhile; ?>
<?php endif; ?>
</div> <!--end page-->
<?php get_sidebar(); ?>	
<?php get_footer(); ?>
