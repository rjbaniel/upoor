	<div id="sidebar">
		<ul>
			<li>
			<?php /* If this is a 404 page */ if (is_404()) { ?>
			<?php /* If this is a category archive */ } elseif (is_category()) { ?>
			<p><?php _e('You are currently browsing the archives for the', TEMPLATE_DOMAIN);?> <?php single_cat_title(''); ?> <?php _e('category.', TEMPLATE_DOMAIN);?></p>

			<?php /* If this is a yearly archive */ } elseif (is_day()) { ?>
			<p><?php _e('You are currently browsing the', TEMPLATE_DOMAIN);?> <a href="<?php bloginfo('url'); ?>/"><?php echo bloginfo('name'); ?></a> <?php _e('weblog archives', TEMPLATE_DOMAIN);?>
			<?php _e('for the day', TEMPLATE_DOMAIN);?> <?php the_time('l, F jS, Y'); ?>.</p>

			<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
			<p><?php _e('You are currently browsing the', TEMPLATE_DOMAIN);?> <a href="<?php bloginfo('url'); ?>/"><?php echo bloginfo('name'); ?></a> <?php _e('weblog archives', TEMPLATE_DOMAIN);?>
			for <?php the_time('F, Y'); ?>.</p>

			<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
			<p><?php _e('You are currently browsing the', TEMPLATE_DOMAIN);?> <a href="<?php bloginfo('url'); ?>/"><?php echo bloginfo('name'); ?></a> <?php _e('weblog archives', TEMPLATE_DOMAIN);?>
			<?php _e('for the year', TEMPLATE_DOMAIN);?> <?php the_time('Y'); ?>.</p>

			<?php /* If this is a monthly archive */ } elseif (is_search()) { ?>
			<p><?php _e('You have searched the', TEMPLATE_DOMAIN);?> <a href="<?php echo bloginfo('url'); ?>/"><?php echo bloginfo('name'); ?></a> <?php _e('weblog archives', TEMPLATE_DOMAIN);?>
			<?php _e('for', TEMPLATE_DOMAIN);?> <strong>'<?php the_search_query(); ?>'</strong>. <?php _e('If you are unable to find anything in these search results, you can try one of these links.', TEMPLATE_DOMAIN);?></p>

			<?php /* If this is a monthly archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
			<p><?php _e('You are currently browsing the', TEMPLATE_DOMAIN);?> <a href="<?php echo bloginfo('url'); ?>/"><?php echo bloginfo('name'); ?></a> <?php _e('weblog archives', TEMPLATE_DOMAIN);?>.</p>

			<?php } ?>
			</li>

			<li id="search"><h3><?php _e('Search', TEMPLATE_DOMAIN); ?></h3>
				<form id="searchform" method="get" action="<?php bloginfo('url'); ?>">
					<input type="text" name="s" id="s" size="15" />
					<input type="submit" value="<?php _e('Search', TEMPLATE_DOMAIN); ?>" />
				</form>
			</li>


	<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar() ) : else : ?>

			<!--<li>
				<?php //include (TEMPLATEPATH . '/searchform.php'); ?>
			</li>-->

			<!-- Author information is disabled per default. Uncomment and fill in your details if you want to use it.
			<li><h3>Author</h3>
			<p>A little something about you, the author. Nothing lengthy, just an overview.</p>
			</li>
			-->

			

			<li><h3><?php _e('Archives', TEMPLATE_DOMAIN);?></h3>
				<ul>
				<?php wp_get_archives('type=monthly'); ?>
				</ul>
			</li>

			<?php //wp_list_categories('optioncount=1&title_li=<h3>Categories</h3>'); ?>

			<?php /* If this is the frontpage */ if ( is_home() || is_page() ) { ?>
				<?php //wp_list_bookmarks(); ?>

				<li><h3><?php _e('Meta', TEMPLATE_DOMAIN)?></h3>
				<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<li><a href="<?php bloginfo('rss2_url'); ?>" title="<?php _e('Syndicate this site using RSS 2.0'); ?>"><?php _e('Entries <abbr title="Really Simple Syndication">RSS</abbr>'); ?></a></li>
					<li><a href="<?php bloginfo('comments_rss2_url'); ?>" title="<?php _e('The latest comments to all posts in RSS', TEMPLATE_DOMAIN); ?>"><?php _e('Comments <abbr title="Really Simple Syndication">RSS</abbr>', TEMPLATE_DOMAIN); ?></a></li>

					<?php wp_meta(); ?>
				</ul>
				</li>
			<?php } ?>
	<?php endif; ?>

		</ul>
	</div>
