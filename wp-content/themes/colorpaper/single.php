<?php get_header(); ?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); $image = get_post_meta($post->ID, 'preview', true); ?>

			<div id="page-title">

				<div class="page-title-content clearfix">

					<?php if($image != "") : ?>

						<div class="page-title-image">

							<img src="<?php bloginfo('template_url'); ?>/preview.php?src=<?php echo $image; ?>&h=143&w=124&zc=1" alt="" />

						</div>

					<?php endif; ?>

					<div class="page-title-text">

						<h3 class="page-title"><?php the_title(); ?></h3>

						<div class="post-meta-single">

							<span class="georgia block"><?php _e('Posted in', 'colorpaper'); ?> <?php the_category(', ') ?>. <?php _e('on', 'colorpaper'); ?> <?php the_time('l, F jS, Y') ?> <?php _e('by', 'colorpaper'); ?> <?php the_author_link(); ?></span>

							<span class="tags"><?php the_tags( 'Tags: ', ', ', ''); ?></span>

						</div>

					</div>

				</div>

			</div>

		</div>

		<div class="left-content">

			<div class="post">

				<div class="post-date"><span class="month block"><?php the_time('M'); ?> </span><span class="day"><?php the_time('d'); ?> </span></div>

				<?php the_content(''); ?>

			</div>

			<?php comments_template('',true); ?>

			<?php endwhile; endif; ?>

		</div>

	</div>

	<div id="right-col">

		<?php get_sidebar(); ?>

	</div>

</div></div>

<?php get_footer(); ?>
