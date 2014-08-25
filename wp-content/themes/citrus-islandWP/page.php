<?php get_header(); ?>
<?php get_sidebar(); ?>
	<div id="main">

        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
	    <h1><?php the_title(); ?></h1>
		<p>
			<?php the_content(__('<p>Read the rest of this page &raquo;</p>','citrus')); ?>
			<?php wp_link_pages(__('<p><strong>Pages:</strong> ','citrus'), '</p>', 'number'); ?>
		</p>
		<?php endwhile; ?>

         <?php if ( comments_open() ) { ?> <?php comments_template('',true); ?><?php } ?>

        <?php endif; ?>
	    <?php edit_post_link(__('Edit','citrus'), '<p class="post-footer align-right">','</p>'); ?>

	</div>
<?php include (TEMPLATEPATH . '/rbar.php'); ?>
<?php get_footer(); ?>
