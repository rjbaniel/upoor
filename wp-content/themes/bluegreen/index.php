<?php get_header(); ?>

	<div id="content">

	<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>
<div class="entry">
			<div id="post-<?php the_ID(); ?>">
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to', 'bluegreen');?> <?php the_title(); ?>"><?php the_title(); ?></a></h2><br />
				<?php _e('Written on', 'bluegreen'); ?> <abbr title="<?php the_time('Y-m-d\TH:i:sO'); ?>"><?php unset($previousday); printf(__('%1$s &#8211; %2$s'), the_date('', '', '', false), get_the_time()) ?></abbr> | <?php _e('by', 'bluegreen'); ?> <?php the_author() ?>
<div class="line"></div>

                 <?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?> 

					<?php the_content(__('Read the rest of this entry &raquo;', 'bluegreen')); ?>
<?php if ( function_exists('the_tags') ) { the_tags('<p>Tags: ', ', ', '</p>'); } ?>

				<p class="postmetadata"><?php _e('Posted in ');?> <?php the_category(', ') ?> | <?php edit_post_link(__('Edit', 'bluegreen'), '', ' | '); ?>  <?php comments_popup_link(__('No Comments &#187;', 'bluegreen'), __('1 Comment &#187;', 'bluegreen'), __('% Comments &#187;', 'bluegreen')); ?></p>
				</div></div>

		<?php endwhile; ?>

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link(__('&laquo; Previous Entries', 'bluegreen')) ?></div>
			<div class="alignright"><?php previous_posts_link(__('Next Entries &raquo;', 'bluegreen')) ?></div>
		</div>

	<?php else : ?>
<div class="entry">
		<h2><?php _e('Not Found', 'bluegreen');?></h2>
		<?php _e("Sorry, but you are looking for something that isn't here.", 'bluegreen');?>'
</div>

	<?php endif; ?>

	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
