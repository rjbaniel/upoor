</div>

<div id="sidebar">

<ul>
<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(1) ) : ?>
</ul>
</div>
<?php return; endif; ?>
	<?php wp_list_pages('title_li=<h2>' . __('Pages', TEMPLATE_DOMAIN) . '</h2>' ); ?>

	<li id="archives">
		<h2><?php _e('Archives', TEMPLATE_DOMAIN); ?></h2>
		<ul>
		<?php wp_get_archives('type=monthly'); ?>
		</ul>
	</li>
	
	<li id="categories">
		<h2><?php _e('Categories', TEMPLATE_DOMAIN); ?></h2>
		<ul>
		<?php wp_list_categories(); ?> 
		</ul>
	</li>
	
	<li id="search">
		<h2><label for="s"><?php _e('Search', TEMPLATE_DOMAIN); ?></label></h2>
		<?php include (TEMPLATEPATH . '/searchform.php'); ?>
	</li>
	
	<?php if (function_exists('wp_theme_switcher')) { ?>
	<li>
		<h2><?php _e('Themes', TEMPLATE_DOMAIN); ?></h2>
		<?php wp_theme_switcher(); ?>
		</li>
	<?php } ?>
		
	<?php if ( is_home() || is_page() ) { ?>				
	<?php wp_list_bookmarks(); ?>
	<?php } ?>
				
	<li id="meta">
		<h2><?php _e('Meta', TEMPLATE_DOMAIN); ?></h2>
		<ul>
		<?php wp_register(); ?>
		<li><?php wp_loginout(); ?></li>
		<li><a href="<?php bloginfo('rss2_url'); ?>" title="<?php _e('Syndicate this site using RSS', TEMPLATE_DOMAIN); ?>"><?php _e('Entries <abbr title="Really Simple Syndication">RSS</abbr>', TEMPLATE_DOMAIN); ?></a></li>
		<li><a href="<?php bloginfo('comments_rss2_url'); ?>" title="<?php _e('The latest comments to all posts in RSS', TEMPLATE_DOMAIN); ?>"><?php _e('Comments <abbr title="Really Simple Syndication">RSS</abbr>', TEMPLATE_DOMAIN); ?></a></li>
				<?php wp_meta(); ?>
		</ul>
	</li>
	
</ul>

</div>
