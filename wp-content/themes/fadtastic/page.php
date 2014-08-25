<?php get_header(); ?>

		<div id="content_wrapper">
			<div id="content">
			 <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<div class="post" id="post-<?php the_ID(); ?>">
				<h1><?php the_title(); ?></h1>
					<div class="entrytext">
					
						<?php the_content(); ?>
                        <?php wp_link_pages('before=<p>&after=</p>'); ?>
                        
					</div>
				</div>
			  <?php endwhile; endif; ?>
	
				<?php if ( comments_open() ) comments_template('',true); ?>
				
			</div>
		</div>
			
	
	<?php include("sidebar.php") ?>

<?php get_footer(); ?>
