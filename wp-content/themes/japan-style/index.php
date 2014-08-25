<?php get_header(); ?>
	
<div id="content">

	<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>

			<div class="post" id="post-<?php the_ID(); ?>">
                                <h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to',TEMPLATE_DOMAIN); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>

				<?php the_content(__('Read the rest of this entry &raquo;',TEMPLATE_DOMAIN)); ?>
				
				<div class="post-info">
                    <?php _e("Posted by",TEMPLATE_DOMAIN); ?> <?php the_author_posts_link(); ?> <?php _e("on",TEMPLATE_DOMAIN); ?> <?php the_time('F jS,Y') ?>
					<?php the_category(', '); ?>
					<?php the_tags('| tags: ', ', ', ''); ?> | 
					<?php comments_popup_link(__('No Comments',TEMPLATE_DOMAIN), __('1 Comment',TEMPLATE_DOMAIN), __('% Comments',TEMPLATE_DOMAIN)); ?>
				</div>
			</div>

			<?php // comments_template(); ?>
		<?php endwhile; ?>

		<div id="pages">
			<a href="#"><?php next_posts_link(__('&larr;Older',TEMPLATE_DOMAIN)) ?></a>&nbsp;&nbsp;&nbsp;<a href="#"><?php previous_posts_link(__('Newer&rarr;',TEMPLATE_DOMAIN)) ?></a>
		</div>

	<?php else : ?>

		<h1><?php _e('Not Found',TEMPLATE_DOMAIN); ?></h1>
		<p class="center"><?php _e("Sorry, but you are looking for something that isn't here.",TEMPLATE_DOMAIN); ?></p>

	<?php endif; ?>
	
</div>
		
<?php get_sidebar(); ?>
<?php get_footer(); ?>
		
