		<div class="sidebar">

		<ul>

			<?php 	/* Widgetized sidebar, if you have the plugin installed. */

					if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>

			<li>

				<?php include (TEMPLATEPATH . '/searchform.php'); ?>

			</li>



			<!-- Author information is disabled per default. Uncomment and fill in your details if you want to use it.

			<li><h2>Author</h2>

			<p>A little something about you, the author. Nothing lengthy, just an overview.</p>

			</li>

			-->



			<?php if ( is_404() || is_category() || is_day() || is_month() ||

						is_year() || is_search() || is_paged() ) {

			?> <li>



			<?php /* If this is a 404 page */ if (is_404()) { ?>

			<?php /* If this is a category archive */ } elseif (is_category()) { ?>

			<p><?php _e('You are currently browsing the archives for the', 'slt'); ?> <?php single_cat_title(''); ?> <?php _e('category', 'slt'); ?>.</p>



			<?php /* If this is a yearly archive */ } elseif (is_day()) { ?>

			<p><?php _e('You are currently browsing the', 'slt'); ?> <a href="<?php bloginfo('url'); ?>/"><?php echo bloginfo('name'); ?></a> <?php _e('blog archives', 'slt'); ?>

			for the day <?php the_time('l, F jS, Y'); ?>.</p>



			<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>

			<p><?php _e('You are currently browsing the', 'slt'); ?> <a href="<?php bloginfo('url'); ?>/"><?php echo bloginfo('name'); ?></a> <?php _e('blog archives for', 'slt'); ?> <?php the_time('F, Y'); ?>.</p>



			<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>

			<p><?php _e('You are currently browsing the', 'slt'); ?> <a href="<?php bloginfo('url'); ?>/"><?php echo bloginfo('name'); ?></a> <?php _e('blog archives for the year', 'slt'); ?> <?php the_time('Y'); ?>.</p>



			<?php /* If this is a monthly archive */ } elseif (is_search()) { ?>

			<p><?php _e('You have searched the', 'slt'); ?> <a href="<?php echo bloginfo('url'); ?>/"><?php echo bloginfo('name'); ?></a> <?php _e('blog archives for', 'slt'); ?> <strong>'<?php the_search_query(); ?>'</strong>. <?php _e('If you are unable to find anything in these search results, you can try one of these links', 'slt'); ?>.</p>



			<?php /* If this is a monthly archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>

			<p><?php _e('You are currently browsing the', 'slt'); ?> <a href="<?php echo bloginfo('url'); ?>/"><?php echo bloginfo('name'); ?></a> <?php _e('blog archives', 'slt'); ?>.</p>



			<?php } ?>



			</li> <?php }?>



			<?php wp_list_pages('title_li=<h2>Pages</h2>' ); ?>



			<li><h2><?php _e('Archives', 'slt'); ?></h2>

				<ul>

				<?php wp_get_archives('type=monthly'); ?>

				</ul>

			</li>



			<?php wp_list_categories('show_count=1&title_li=<h2>Categories</h2>'); ?>



			<?php /* If this is the frontpage */ if ( is_home() || is_page() ) { ?>

				<?php wp_list_bookmarks(); ?>



				<li>

					<h2><?php _e('Meta', 'slt'); ?></h2>

					<ul>

						<?php wp_register(); ?>

						<li><?php wp_loginout(); ?></li>

						<li><a href="http://validator.w3.org/check/referer" title="This page validates as XHTML 1.0 Transitional">Valid <abbr title="eXtensible HyperText Markup Language">XHTML</abbr></a></li>

						<li><a href="http://gmpg.org/xfn/"><abbr title="XHTML Friends Network">XFN</abbr></a></li>

						<?php wp_meta(); ?>

					</ul>

				</li>

			<?php } ?>



			<?php endif; ?>

		</ul>

        </div> 
