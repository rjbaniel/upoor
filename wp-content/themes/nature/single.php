<?php get_header(); ?>

	<div id="content" class="narrowcolumn">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

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
					<?php theme_google_300_ads_show(); ?>
					<?php the_content(__('Read the rest of this entry &raquo;', 'nature')); ?>
					<?php theme_google_468_ads_show(); ?>
				</div>
			</div>

	<?php comments_template('',true); ?>

	<?php endwhile; else: ?>

		<p><?php _e('Sorry, no posts matched your criteria.', 'nature'); ?></p>

<?php endif; ?>

	</div>

<?php get_footer(); ?>
