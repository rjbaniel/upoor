<?php get_header(); ?>
	
<div id="content">

	<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>

			<div class="post" id="post-<?php the_ID(); ?>">
                                <h3><?php the_title(); ?></h3>

				<?php the_content(__('Read the rest of this entry &raquo;', 'japan-style')); ?>
				
				<?php if ( comments_open() ) { ?><div class="post-info">
                                        <?php the_time('F jS,Y') ?>
					<?php the_category(', '); ?>
					<?php the_tags('| tags: ', ', ', ''); ?> |
					<?php comments_popup_link(__('No Comments', 'japan-style'), __('1 Comment', 'japan-style'), __('% Comments', 'japan-style')); ?>
				</div><?php } ?>
			</div>


		<?php endwhile; ?>

		 <?php if ( comments_open() ) comments_template('',true); ?> 

	<?php else : ?>

		<h1><?php _e('Not Found', 'japan-stlye'); ?></h1>
		<p class="center"><?php _e("Sorry, but you are looking for something that isn't here.", 'japan-style'); ?></p>

	<?php endif; ?>
	
</div>
		
<?php get_sidebar(); ?>
<?php get_footer(); ?>
		
