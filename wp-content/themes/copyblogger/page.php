<?php get_header(); ?>

	<div id="content_box">
	
		<div id="content" class="page">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
			<h1><?php the_title(); ?></h1>
			<div class="entry">
								<p><?php the_content(__('Read the rest of this page &rarr;','copyblogger')); ?></p>
				
				<?php wp_link_pages(__('<p><strong>Pages:</strong> '), '</p>', 'number'); ?>
			</div>
			
			<?php endwhile; endif; ?>

           <?php if ( comments_open() ) { ?> <?php comments_template('',true); ?><?php } ?>
           
		</div>

		<?php get_sidebar(); ?>

	</div>

<?php get_footer(); ?>
