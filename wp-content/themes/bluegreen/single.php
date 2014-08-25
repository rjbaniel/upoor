<?php get_header(); ?>

<div id="content"> 

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="entry">
		<div class="post" id="post-<?php the_ID(); ?>">
			<h2><a href="<?php echo get_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link:', 'bluegreen');?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>
<br />
				<?php _e('Written on', 'bluegreen'); ?> <abbr title="<?php the_time('Y-m-d\TH:i:sO'); ?>"><?php unset($previousday); printf(__('%1$s &#8211; %2$s'), the_date('', '', '', false), get_the_time()) ?></abbr> | <?php _e('by', 'bluegreen'); ?> <?php the_author() ?>
<div class="line"></div>
<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?> 
				<?php the_content(__('<p class="serif">Read the rest of this entry &raquo;</p>', 'bluegreen')); ?>
<?php if ( function_exists('the_tags') ) { the_tags('<p>Tags: ', ', ', '</p>'); } ?>
				<?php wp_link_pages(array('before' => '<p><strong>'.__('Pages:').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

				

			</div>
		</div>

<div class="entry">
	<?php comments_template('',true); ?>
	</div>

	<?php endwhile; else: ?>
<div class="entry">
		<p><?php _e('Sorry, no posts matched your criteria.', 'bluegreen');?></p>
</div>
<?php endif; ?>

	</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
