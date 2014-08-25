<?php get_header(); ?>

<?php include (TEMPLATEPATH . "/sidebar1.php"); ?>	

		<div id="content">
				
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<div class="singlepost" id="post-<?php the_ID(); ?>">
				<h1><?php the_title(); ?></h1>

				<div class="entry">
					<?php the_content(); ?>
				</div>

			</div>
	
		<?php endwhile; ?>

       <?php if ( comments_open() ) { ?> <?php comments_template('',true); ?><?php } ?>    

        <?php else: ?>

		<?php endif; ?>		

                </div>

		</div>

<?php get_sidebar(); ?>

	</div>

<?php get_footer(); ?>
