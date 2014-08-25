<?php
/*
Template Name: Archives
*/
?>

<?php get_header(); ?>

<div id="main_content">

	<?php if (have_posts()) : ?>

	<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. From Kubrick. ?>
	
	<?php /* If this is a category archive */ if (is_category()) { ?>
		<h3 class="subhead"><?php bloginfo('name'); ?> <?php _e('Archives:',TEMPLATE_DOMAIN); ?> <?php echo single_cat_title(); ?></h3>

	<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		<h3 class="subhead"><?php bloginfo('name'); ?> <?php _e('Archives:',TEMPLATE_DOMAIN); ?> <?php the_time('F Y'); ?></h2>
	
	<?php /* If this is a search */ } elseif (is_search()) { ?>
		<h3 class="subhead"><?php _e('Search Results for',TEMPLATE_DOMAIN); ?> <?php echo($_GET['s']); ?></h3>
	
	<?php } // end dynamic header ?>
	
	<h4 class="comment"><?php next_posts_link(__('next page',TEMPLATE_DOMAIN)); ?>  &middot;
		<?php previous_posts_link(__('previous page',TEMPLATE_DOMAIN)); ?></h4>
	
	<?php include (TEMPLATEPATH . '/searchform.php'); ?>
	
	
	 <?php while (have_posts()) : the_post(); ?>
	<div class="excerpt">
		<h3 class="substory_subhead"><?php the_time('j F Y'); ?></h3>
		<h3 class="substory_head"><a href="<?php the_permalink(); ?>" rel="bookmark">
		<?php the_title(); ?>
		</a></h3>
		


<?php if( is_date() || is_search() || is_tag() || is_author() ) { ?>

<?php if(function_exists('the_post_thumbnail')) { ?><?php if(get_the_post_thumbnail() != "") { ?><div class="alignleft">
<?php the_post_thumbnail(); ?></div><?php } } ?>
<?php the_excerpt();?>
<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
<?php } else { ?>

<?php the_content( __('continue reading...',TEMPLATE_DOMAIN) ); ?>
<?php wp_link_pages('before=<p>&after=</p>'); ?>
<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
<?php } ?>



		<h4 class="comment">
		<?php comments_popup_link(__('0 Comments',TEMPLATE_DOMAIN), __('One Comment',TEMPLATE_DOMAIN), __('% Comments',TEMPLATE_DOMAIN), '', __('Comments Locked',TEMPLATE_DOMAIN)); ?>
		</h4>

	</div>
	<?php endwhile; ?>
	
	<h4 class="comment"><?php next_posts_link(__('next page',TEMPLATE_DOMAIN));  ?>  &middot;
		<?php previous_posts_link(__('previous page',TEMPLATE_DOMAIN)); ?></h4>
		
	<?php else: ?>
	
	<p><em><?php _e('No posts were found with this query.',TEMPLATE_DOMAIN); ?></em></p>

	<?php endif; ?>
	
</div>
		

<?php get_sidebar(); ?>

<?php get_footer(); ?>
