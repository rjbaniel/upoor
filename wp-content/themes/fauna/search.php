<?php get_header(); ?>

	<div id="body">

		<div id="main" class="entry">
			<div class="box">
				<h2><?php _e('Search', 'fauna') ?></h2>
				<form method="get" action="<?php echo(get_option('siteurl')); ?>">
				<input name="s" type="text" class="searchbox" value="<?php echo esc_html($s, 1); ?>" />
				<input type="submit" value="<?php _e('Search', 'fauna') ?>" class="pushbutton" />
				</form>
								
			</div>

			<div class="box">
				<h2><?php _e('Search Results', 'fauna') ?></h2>
				<p><?php _e('These are the search results for your search on', 'fauna') ?> <strong>"<?php echo esc_html($s, 1); ?>"</strong>:</p>

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent link to:', 'fauna'); ?> <?php the_title(); ?>"><?php the_title(); ?></a></h3>
				<div class="search-results"><?php the_excerpt() ?></div>
				<div class="highlight">
					<?php the_permalink() ?><?php edit_post_link(__('Edit This', 'fauna'), ' &#8212; '); ?>
				</div>
			
			<?php endwhile; ?>
			</div>

			<?php if (function_exists('print_pg_navigation')) {
			print_pg_navigation('<div class="box">','</div>');
			} else { ?>
			<div class="box">
				<div class="align-left"><?php posts_nav_link('','',__('&laquo; Previous Entries', 'fauna')) ?></div>
				<div class="align-right"><?php posts_nav_link('',__('Next Entries &raquo;', 'fauna'),'') ?></div>
				<br class="clear" />
			</div>
			<?php } ?>
			
			<?php else : ?>
	
				<h2><?php _e('Not Found', 'fauna');?></h2>
				<p><?php _e('Sorry, no posts matched your criteria.', 'fauna'); ?></p>
				
			</div>
			
			<?php endif; ?>

			<hr />
			
		</div><!--//#main-->

		<?php get_sidebar(); ?>
		
	</div>

	<?php get_footer(); ?>
