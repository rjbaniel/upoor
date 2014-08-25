<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header(); ?>

	<div id="pagecontent">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
			<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
				<h2><?php the_title(); ?></h2>
				<hr>
				<div class="entry">
				<?php the_content(__('<p class="serif">Read the rest of this page &raquo;</p>', 'color-splash')); ?>

				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
			
			</div>
		</div>
		<?php endwhile; endif; ?>
		<hr>
		<?php if ( comments_open() ) { ?> <?php comments_template('',true); ?><?php } ?> 

	</div>
<?php get_footer(); ?>
