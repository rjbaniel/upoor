<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header(); ?>

	<div id="content" class="narrowcolumn">

	<?php if (have_posts()) : ?>

		<h2 class="pagetitle"><?php _e('Found:', 'color-splash'); ?></h2>
<hr/>

		<?php while (have_posts()) : the_post(); ?>
	
	
	
	<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
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
					
				<img src="<?php bloginfo('template_directory'); ?>/Icons/Tag1.gif" />
				<small>
				<?php the_tags(' ', ' ', ''); ?>
				</small>
				</p>
			</div>
		<hr />
		<?php endwhile; ?>

		<div class="navigation">
			<div class="navileft"><?php next_posts_link(__('&laquo; older Entries', 'color-splash')) ?></div>
			<div class="naviright"><?php previous_posts_link(__('newer Entries &raquo;', 'color-splash')) ?></div>
		</div>

	<?php else : ?>

		<h2 style="text-align:center;"><?php _e('Nothing Found ', 'color-splash'); ?></h2>

	<?php endif; ?>

	</div>


<?php get_footer(); ?>
