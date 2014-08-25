<?php
/**
 * @package WordPress
 * @subpackage Magazeen_Theme
 */

get_header();
?>

	<div id="main-content" class="clearfix">
	
		<div class="container">
	
			<div class="col-580 left">

				<?php if (have_posts()) : ?>
				
					<div <?php post_class(); ?>>
			
						<div class="post-meta clearfix">
					
							<h3 class="post-title">
							
								 <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
								  <?php /* If this is a category archive */ if (is_category()) { ?>
					 <?php _e('Archive for the', 'magazeen'); ?> &#8216;<?php single_cat_title(); ?>&#8217; <?php _e('Category', 'magazeen'); ?>
								  <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
									<?php _e('Posts Tagged', 'magazeen'); ?> &#8216;<?php single_tag_title(); ?>&#8217;
								  <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
									<?php _e('Archive for', 'magazeen'); ?> <?php the_time('F jS, Y'); ?>
								  <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
									<?php _e('Archive for', 'magazeen'); ?> <?php the_time('F, Y'); ?>
								  <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
									<?php _e('Archive for', 'magazeen'); ?> <?php the_time('Y'); ?>
								  <?php /* If this is an author archive */ } elseif (is_author()) { ?>
									<?php _e('Author Archive', 'magazeen'); ?>
								  <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
									<?php _e('Blog Archives', 'magazeen'); ?>
								  <?php } ?>
								
							</h3>
							
							<p class="post-info right">
								<?php bloginfo( 'name' ); ?> <?php _e('Archives', 'magazeen'); ?>
							</p>
							
						</div><!-- End post-meta -->
						
						<div class="post-box">
						
							<div class="post-content">
							
								<p><?php _e("If you can't find what you are looking for, try searching for it below:", 'magazeen'); ?></p>
							
								<p><?php echo get_search_form(); ?></p>
								
								<br />
							
							</div>
							
						</div>

				 	</div>

					<?php while (have_posts()) : the_post(); ?>
					
					<div <?php post_class( ); ?>>
			
						<div class="post-meta clearfix">

							<h3 class="post-title-small left"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to', 'magazeen'); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
							
							<p class="post-info right">
								<span><?php _e('By', 'magazeen'); ?> <?php the_author_posts_link(); ?></span>
								<?php the_time( 'l F j, Y' ) ?>
							</p>
							
						</div><!-- End post-meta -->
						
					</div><!-- End archive -->
			
					<?php endwhile; ?>

						<div class="navigation clearfix">
							<div class="alignleft"><?php next_posts_link(__('&laquo; Older Entries', 'magazeen') ) ?></div>
							<div class="alignright"><?php previous_posts_link(__('Newer Entries &raquo;', 'magazeen')) ?></div>
						</div>
				
				<?php
					 else : 
				?>
				
				
	
				<?php
					endif;
				?>
				
			</div><!-- End col-580 (Left Column) -->

			<div class="col-340 right">
			
				<ul id="sidebar">
				
					<?php get_sidebar(); ?>
					
				</ul><!-- End sidebar -->   
								
			</div><!-- End col-340 (Right Column) -->
			
		</div><!-- End container -->
		
	</div><!-- End main-content -->

<?php get_footer(); ?>
