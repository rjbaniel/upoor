<?php get_header(); ?>
		
	<div id="content_box">

		<div id="content" class="posts">
	    	<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("cutline-top"); } ?>  
		<?php if (have_posts()) : ?>

			<?php //$post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
	
			<?php /* If this is a category archive */ if (is_category() || is_tag()) { ?>				
			<h2 class="archive_head"><?php _e('Entries Tagged as','cutline'); ?> '<?php echo single_cat_title(); ?>'</h2>

			<?php /* If this is a tag archive */ } elseif (is_tag()) { ?>		
			<h2 class="archive_head"><?php _e('Entries Tagged as','cutline'); ?> '<?php echo single_tag_title() ?>'</h2>

			<?php /* If this is a date archive */ } elseif (is_date()) { ?>
			<h2 class="archive_head"><?php _e('Entries from','cutline'); ?> <?php the_time('F jS, Y'); ?></h2>
			
			<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
			<h2 class="archive_head"><?php _e('Entries from','cutline'); ?> <?php the_time('F Y'); ?></h2>

			<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
			<h2 class="archive_head"><?php _e('Entries from','cutline'); ?> <?php the_time('Y'); ?></h2>

			<?php } ?>

			<?php while (have_posts()) : the_post(); ?>
			
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to','cutline'); ?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>
				<h4><?php the_time('F jS, Y') ?><!-- by <?php the_author() ?> --> &middot; <?php comments_popup_link(__('No Comments','cutline'), __('1 Comment','cutline'), __('% Comments','cutline') ); ?> &middot; <?php the_category(', ') ?> <?php edit_post_link(__('Edit','cutline'), ' &middot; ', ''); ?></h4>
				<div class="entry">

                <?php if(function_exists('the_post_thumbnail')) { ?><?php if(get_the_post_thumbnail() != "") { ?><div style="margin-right: 15px;" class="alignleft">
<?php the_post_thumbnail(); ?></div><?php } } ?>

					<?php the_excerpt() ?>
					<p><a href="<?php the_permalink() ?>#more-<?php the_ID(); ?>" title="<?php _e('Read the rest of this entry','cutline'); ?>"><?php _e('[Read more &rarr;]','cutline'); ?></a></p>
				</div>
				<p class="tagged"><strong><?php _e('Tags:','cutline'); ?></strong><?php the_tags('','&middot;','');?></p>
<div class="clear"></div>
			</div>
			
			<?php endwhile; ?>
			
			<?php include (TEMPLATEPATH . '/navigation.php'); ?>

		<?php else : ?>
		
			<h2 class="page_header"><?php _e("Welp, we couldn't find that...try again?",'cutline'); ?></h2>
			<div class="entry">
				<?php include (TEMPLATEPATH . '/searchform.php'); ?>
			</div>
			
		<?php endif; ?>
			
		</div>
	
		<?php get_sidebar(); ?>
		
	</div>
		
<?php get_footer(); ?>
