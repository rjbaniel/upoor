<?php get_header(); ?>

	<?php if (have_posts()) : ?>
		
		<?php while (have_posts()) : the_post(); ?>
				
			<div class="entry" id="post-<?php the_ID(); ?>">
<div class="date" title="posted at <?php the_time('g:i a'); ?>"><span class="day"><?php the_time('j') ?></span><br /><span class="month"><?php the_time('F') ?></span><br /><span class="year"><?php the_time('Y') ?></span></div>
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to', TEMPLATE_DOMAIN);?> <?php the_title(); ?>"><?php the_title(); ?></a><span class="comments"><?php comments_popup_link('0', '1', '%'); ?></span></h2>

		<div align="center">	</div>		<?php the_content(__('Read the rest of this entry &raquo;', TEMPLATE_DOMAIN)); ?> <div align="center">	</div>

		<p class="entrymeta"><?php _e("Posted under",TEMPLATE_DOMAIN); ?> <?php the_category(', '); ?> <?php the_tags(__('Tags: ',TEMPLATE_DOMAIN), ', ', ''); ?><?php edit_post_link(__('Edit this entry', TEMPLATE_DOMAIN), '. ', ''); ?> </p>
			</div>

		<?php endwhile; ?>

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link(__('&laquo; Previous Entries', TEMPLATE_DOMAIN)) ?></div>
			<div class="alignright"><?php previous_posts_link(__('Next Entries &raquo;', TEMPLATE_DOMAIN)) ?></div>
<br style="clear: all;" />
		</div>
		
	<?php else : ?>

		<h2 class="center"><?php _e('Not Found', TEMPLATE_DOMAIN);?></h2>
		<p class="center"><?php _e("Sorry, but you are looking for something that isn't here.", TEMPLATE_DOMAIN);?></p>
		<?php include (TEMPLATEPATH . "/searchform.php"); ?>

	<?php endif; ?>

	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
