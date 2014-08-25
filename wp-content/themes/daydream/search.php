<?php get_header(); ?>

	<div id="content" class="sanda">

	<?php if (have_posts()) : ?>

		<h2 class="pagetitle"><?php _e('Search Results');?></h2>

		<?php while (have_posts()) : the_post(); ?>
				
			<div class="post" id="post-<?php the_ID(); ?>">
<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to','daydream');?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>
<div class="data"><?php the_time(get_option('date_format')) ?> - <?php comments_popup_link(__('No Responses','daydream'), __('One Response','daydream'), __('% Responses','daydream')); ?></div>

<div class="entry">
<?php if(function_exists('the_post_thumbnail')) { ?><?php if(get_the_post_thumbnail() != "") { ?><div class="alignleft">
<?php the_post_thumbnail(); ?></div><?php } } ?>
<?php the_excerpt(); ?>
</div>

<p class="postmetadata">
<?php _e('Categorised in','daydream'); ?> <?php the_category(', '); ?> <?php edit_post_link(__('Edit','daydream'), '&nbsp;&nbsp;|&nbsp;&nbsp;', ''); ?>
<br /><?php the_tags(__('Tags: ','daydream'), ', ', ''); ?></p>

</div>
	
		<?php endwhile; ?>
		
		<?php 
			// This young snippet fixes something too difficult to explain
			
			$numposts = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE post_status = 'publish'");
			$perpage = $wpdb->get_var("SELECT option_value FROM $wpdb->options WHERE option_name = 'posts_per_page'");

			if ($numposts > $perpage) {
		?>
				<div class="navigation">
					<div class="alignleft"><?php next_posts_link(__('&laquo; Previous Entries','daydream')) ?></div>
					<div class="alignright"><?php previous_posts_link(__('Next Entries &raquo;','daydream')) ?></div>
				</div>
		<?php
			}
		?>
	
	<?php else : ?>

		<h4><?php _e('No posts found. Try a different search?','daydream');?></h4>
		<?php include (TEMPLATEPATH . '/searchform.php'); ?>
		<div style="width: 100%; height: 40px;"></div>

	<?php endif; ?>
		
	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
