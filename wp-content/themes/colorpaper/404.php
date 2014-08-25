<?php get_header(); ?>

			<div id="page-title">

				<div class="page-title-content">

					<h3 class="page-title"><?php _e('404 - Page Not Found', 'colorpaper'); ?></h3>

					 <div class="post-meta-single">

						<div class="box">

							<p><?php include (TEMPLATEPATH . '/searchform.php'); ?></p>

							<p class="light">Search <?php bloginfo('name'); ?></p>

						</div>

					</div>

				</div>

			</div>

		</div>

		<div class="left-content">

			<div class="post">

				<h3><?php _e('404 - Page Not Found', 'colorpaper'); ?></h3>

				<h5 class="light medium"><?php _e('Something has gone horribly wrong. Please go back, or try some of the links below:', 'colorpaper'); ?></h5>

				<h2><?php _e('Archives by Date:', 'colorpaper'); ?></h2>

				<ul>

					<?php wp_get_archives('type=monthly'); ?>

				</ul>

				<h2><?php _e('Archives by Subject:', 'colorpaper'); ?></h2>

				<ul>

					 <?php wp_list_categories('title_li='); ?>

				</ul>

			</div>

		</div>

	</div>

	<div id="right-col">

		<?php get_sidebar(); ?>

	</div>

</div></div>

<?php get_footer(); ?>
