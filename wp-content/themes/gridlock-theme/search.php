<?php
/*
Template Name: Search Results
*/
?>

<?php get_header(); ?>

<div id="main_content">

	<?php if (have_posts()) : ?>

	<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. From Kubrick. ?>
	
		<h3 class="subhead"><?php _e("Search Results",TEMPLATE_DOMAIN); ?></h3>
	
	<h4 class="comment"><?php next_posts_link(__('next page',TEMPLATE_DOMAIN)); ?>  &middot;
		<?php previous_posts_link(__('previous page',TEMPLATE_DOMAIN)); ?></h4>
	
	<?php include (TEMPLATEPATH . '/searchform.php'); ?>
	
	
	 <?php while (have_posts()) : the_post(); ?>
	<div class="excerpt">
		<h3 class="substory_subhead"><?php the_time('F j Y'); ?></h3>
		<h3 class="substory_head"><a href="<?php the_permalink(); ?>" rel="bookmark">
		<?php the_title(); ?>
		</a></h2>
		
		<?php the_excerpt(); ?>
		
		<h4 class="comment"><a href="<?php the_permalink(); ?>" rel="bookmark">
		<strong><?php _e("continue reading...",TEMPLATE_DOMAIN); ?></strong></a> &raquo;
			<?php comments_popup_link(__('0 Comments',TEMPLATE_DOMAIN), __('One Comment',TEMPLATE_DOMAIN), __('% Comments',TEMPLATE_DOMAIN), '', __('Comments Locked',TEMPLATE_DOMAIN)); ?>
		</h4>
	
	</div>
	<?php endwhile; ?>
	
	<h4 class="comment"><?php next_posts_link(__('next page',TEMPLATE_DOMAIN)); ?>  &middot;
		<?php previous_posts_link(__('previous page',TEMPLATE_DOMAIN)); ?></h4>
		
	<?php else: ?>

	<p><em><?php _e("No entries were found with this query.",TEMPLATE_DOMAIN); ?></em></p>

	<?php endif; ?>
	
</div>
		

<?php get_sidebar(); ?>

<?php get_footer(); ?>
