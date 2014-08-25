	<div id="sidebar">
		<ul>
		<?php if ( !function_exists('dynamic_sidebar')
        || !dynamic_sidebar() ) : ?>

<?php if (function_exists('wp_theme_switcher')) { ?>
			<li><h2><?php _e('Themes', TEMPLATE_DOMAIN); ?></h2>
				<?php wp_theme_switcher(); ?>
			</li>
<?php } ?>
			
			<li>
				<?php include (TEMPLATEPATH . '/searchform.php'); ?>
			</li>

			<!-- Author information is disabled per default. Uncomment and fill in your details if you want to use it.
			<li><h2><?php // _e('Author'); ?></h2>
			<p>A little something about you, the author. Nothing lengthy, just an overview.</p>
			</li>
			-->

			<li>
			<?php /* If this is a category archive */ if (is_category()) { ?>
			<p><?php _e('You are currently browsing the archives for the', TEMPLATE_DOMAIN);?> <?php single_cat_title(''); ?> <?php _e('category.', TEMPLATE_DOMAIN);?></p>
			
			<?php /* If this is a yearly archive */ } elseif (is_day()) { ?>
			<p><?php _e('You are currently browsing the', TEMPLATE_DOMAIN);?> <a href="<?php echo get_option('siteurl'); ?>"><?php echo bloginfo('name'); ?></a> <?php _e('weblog archives', TEMPLATE_DOMAIN);?>
			<?php _e('for the day', TEMPLATE_DOMAIN);?> <?php the_time('l, F jS, Y'); ?>.</p>
			
			<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
			<p><?php _e('You are currently browsing the', TEMPLATE_DOMAIN);?> <a href="<?php echo get_option('siteurl'); ?>"><?php echo bloginfo('name'); ?></a> <?php _e('weblog archives', TEMPLATE_DOMAIN);?>
			for <?php the_time('F, Y'); ?>.</p>

      <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
			<p><?php _e('You are currently browsing the', TEMPLATE_DOMAIN);?> <a href="<?php echo get_option('siteurl'); ?>"><?php echo bloginfo('name'); ?></a> <?php _e('weblog archives', TEMPLATE_DOMAIN);?>
			<?php _e('for the year', TEMPLATE_DOMAIN);?> <?php the_time('Y'); ?>.</p>
			
		 <?php /* If this is a monthly archive */ } elseif (is_search()) { ?>
			<p><?php _e('You have searched the', TEMPLATE_DOMAIN);?> <a href="<?php echo get_option('siteurl'); ?>"><?php echo bloginfo('name'); ?></a> <?php _e('weblog archives', TEMPLATE_DOMAIN);?>
			<?php _e('for', TEMPLATE_DOMAIN);?> <strong>'<?php echo esc_html($s); ?>'</strong>.<?php _e(' If you are unable to find anything in these search results, you can try one of these links.', TEMPLATE_DOMAIN);?></p>

			<?php /* If this is a monthly archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
			<p><?php _e('You are currently browsing the', TEMPLATE_DOMAIN);?> <a href="<?php echo get_option('siteurl'); ?>"><?php echo bloginfo('name'); ?></a> <?php _e('weblog archives', TEMPLATE_DOMAIN);?>.</p>

			<?php } ?>
			</li>

			<?php wp_list_pages('title_li=<h2>' . __('Pages', TEMPLATE_DOMAIN) . '</h2>' ); ?>

			<li><h2><?php _e('Archives', TEMPLATE_DOMAIN); ?></h2>
				<ul>
				<?php wp_get_archives('type=monthly'); ?>
				</ul>
			</li>

			<li><h2><?php _e('Categories', TEMPLATE_DOMAIN); ?></h2>
				<ul>
				<?php wp_list_categories(0, '', 'name', 'asc', '', 1, 0, 1, 1, 1, 1, 0,'','','','','') ?>
				</ul>
			</li>

			<?php /* If this is the frontpage */ if ( is_home() || is_page() ) { ?>				
				<?php wp_list_bookmarks(); ?>
				
				<li><h2><?php _e('Meta', TEMPLATE_DOMAIN); ?></h2>
				<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<?php wp_meta(); ?>
				</ul>
				</li>
			<?php } ?>
<?php endif; ?>			
		</ul>
	</div>
