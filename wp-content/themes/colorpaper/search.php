<?php get_header(); ?>

			<div id="page-title">

				<div class="page-title-content">

					<h3 class="page-title"><?php _e('Search Results', 'colorpaper'); ?></h3>

					<div class="post-meta-single">

						<div class="box">

							<?php include (TEMPLATEPATH . '/searchform.php'); ?>

						</div>

					</div>

				</div>

			</div>

		</div>

		<div class="left-content">

			<?php if (have_posts()) : ?> 

				<?php while (have_posts()) : the_post(); ?>

				<div class="post">

					<div class="post-date"><span class="month block"><?php the_time('M'); ?> </span><span class="day"><?php the_time('d'); ?> </span></div>

					<h4><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to', 'colorpaper'); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>

					<?php the_content(''); ?>

				</div>

				<?php endwhile; ?>

			

				<h3><?php posts_nav_link(' | ',__('&laquo; Newer Posts', 'colorpaper'),  __('Older Posts &raquo;', 'colorpaper')); ?></h3>

				

			<?php else : ?>

			

				<h4><?php _e('No Posts Found. Please try searching something else.', 'colorpaper'); ?></h4>

				

				<div class="post">

					<h2><?php _e('Archives by Month:', 'colorpaper'); ?></h2>

					<ul>

						<?php wp_get_archives('type=monthly'); ?>

					</ul>

				</div>

				<div class="post">

					<h2><?php _e('Archives by Subject:', 'colorpaper'); ?></h2>

					<ul>

						 <?php wp_list_categories(); ?>

					</ul>

				</div>

				

			<?php endif; ?>

			

		</div>

	</div>

	<div id="right-col">

		<?php get_sidebar(); ?>

	</div>

</div></div>

<?php get_footer(); ?>
