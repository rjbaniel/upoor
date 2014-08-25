<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
 
get_header(); ?>
	<div id="content" class="narrowcolumn">

	<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>
		
			<div id="post">
				
				
				<p id="gettocomment"><?php comments_popup_link('0', '1', '%'); ?></p>
				
				
				
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to', 'color-splash'); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>


			<small id="thetime">	
			<span style="color:white"><?php the_time(' F ') ?></span><br />
			<span><?php the_time(' j ') ?></span>
			</small>

	
				
				<div class="entry">
					<?php the_content(__('read more... &raquo;', 'color-splash')); ?>
				</div>
				<p id="gettocategory"><?php the_category(', ') ?></p>
				<p class="metadata">
					
				<span class="tag"></span>
				<small>
				<?php the_tags(' ', ' ', ''); ?>
				</small>
		  			
				</p>
			</div>
		<hr />
		<?php endwhile; ?>
		<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(1) ) : else : ?>
 	  <?php _e('Add some default code here, should the user no wish to use any widget', 'color-splash'); ?>
		<?php endif; ?>
		<div class="navigation">
			<div class="alignleft"><?php next_posts_link(__('&laquo; older Entries', 'color-splash')) ?></div>
			<div class="alignright"><?php previous_posts_link(__('newer Entries &raquo;', 'color-splash')) ?></div>
		</div>

	<?php else : ?>

		<h2 class="center"><?php _e('Nothing found ', 'color-splash'); ?></h2>
		<p class="center"><?php _e('Not here anymore', 'color-splash'); ?></p>

	<?php endif; ?>

	</div>


<?php get_footer(); ?>
