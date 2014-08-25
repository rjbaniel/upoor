	<div id="sidebar">
		<ul>
<?php if ( !function_exists('dynamic_sidebar')
        || !dynamic_sidebar() ) : ?>
			<!-- Author information is disabled per default. Uncomment and fill in your details if you want to use it.
			<li><h2><?php _e('Author'); ?></h2>
			<p>A little something about you, the author. Nothing lengthy, just an overview.</p>
			</li>
			-->

		 

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

				<?php wp_list_bookmarks(); ?>

		<?php if (function_exists('wp_theme_switcher')) { ?>
			<li><h2><?php _e('Themes', TEMPLATE_DOMAIN); ?></h2>
			<?php wp_theme_switcher(); ?>
			</li>
		<?php } ?>

				<li><h2><?php _e('Meta', TEMPLATE_DOMAIN); ?></h2>
				<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>

					<li><a href="http://gmpg.org/xfn/"><abbr title="<?php _e('XHTML Friends Network');?>">XFN</abbr></a></li>

					<?php wp_meta(); ?>
				</ul>
				</li>
			
			<li>
				<?php include (TEMPLATEPATH . '/searchform.php'); ?>
			</li>			
			<?php endif; ?>
		</ul>
	</div>
