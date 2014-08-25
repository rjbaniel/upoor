<?php get_header(); ?>

	<div id="content" class="narrowcolumn">

		<?php if (have_posts()) : ?>

		<?php $i=0; while (have_posts()) : the_post(); $i++; ?>

			<div class="post" id="post-<?php the_ID(); ?>">
                <div class="post-top">
                    <div class="post-title">
                        <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to', 'nature'); ?> <?php if ( function_exists('the_title_attribute')) the_title_attribute(); else the_title(); ?>"><?php the_title(); ?></a></h2>
						<h4><?php comments_number('0', '1', '%'); ?></h4>
                    </div>
					<h3>
						<?php _e('Posted by', 'nature'); ?> <span><?php the_author() ?></span>  |  <?php _e('Posted in', 'nature'); ?> <span><?php the_category(', ') ?></span>  |  <?php _e('Posted on', 'nature'); ?> <?php the_time('d-m-Y') ?>
					</h3>
                </div>

				<div class="entry">
					<?php if($i==1 || $i==2) : ?>
					<?php theme_google_468_ads_show(); ?>
					<?php endif; ?>
					<?php the_content('',FALSE,''); ?>
				</div>

                <div class="postmetadata">
                   <p><a href="<?php the_permalink() ?>"><?php _e('Continue Reading', 'nature'); ?></a></p>
                </div>
			</div>

		<?php endwhile; ?>

		<div class="entry">
			<?php theme_google_468_ads_show(); ?>
		</div>

		<div class="navigation">
			<?php if(!function_exists('wp_pagenavi')) : ?>
            <div class="alignleft"><?php next_posts_link(__('Previous', 'nature') ) ?></div>
            <div class="alignright"><?php previous_posts_link(__('Next', 'nature') ) ?></div>
            <?php else : wp_pagenavi(); endif; ?>
		</div>

	<?php else : ?>

		<h2 class="center"><?php _e('Not Found', 'nature'); ?></h2>
		<?php include (TEMPLATEPATH . '/searchform.php'); ?>

	<?php endif; ?>

	</div>

<?php get_footer(); ?>
