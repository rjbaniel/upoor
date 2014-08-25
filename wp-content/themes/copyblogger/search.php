<?php get_header(); ?>

	<div id="content_box">
	
		<div id="content" class="archive">

		<?php if (have_posts()) : ?>
	
			<h1><?php _e('Search Results for','copyblogger'); ?> &quot;<?php echo $s; ?>&quot; &darr;</h1>
	
			<?php while (have_posts()) : the_post(); ?>		
			
			<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
			<p class="post_date"><?php the_time(__('F jS, Y')) ?> &#8212; <?php the_category(', ') ?></p>
			<div class="entry">
				<?php the_content(__("Continue reading &rarr;",'copyblogger')); ?>
			</div>
			<p class="post_meta"><span class="add_comment"><?php comments_popup_link(__('No Comments','copyblogger'), __('1 Comment','copyblogger'), __('% Comments','copyblogger')); ?></span></p>
					
			<?php endwhile; ?>
			
			<?php include (TEMPLATEPATH . '/navigation.php'); ?>
		
		<?php else : ?>
	
			<h2><?php _e('Hmm, no results... try again?','copyblogger'); ?></h2>
			<p class="post_date">* * *</p>
			<div class="entry">
				<?php include (TEMPLATEPATH . '/searchform.php'); ?>
			</div>

		<?php endif; ?>
			
		</div>

		<?php get_sidebar(); ?>

	</div>

<?php get_footer(); ?>
