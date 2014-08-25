</div>

<div id="sidebar">

<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("160x600-almostspring-sidebar"); } ?>

<ul>

<?php if ( !function_exists('dynamic_sidebar')
        || !dynamic_sidebar() ) : ?>

   
	<li>
		<h2><?php _e('Archives', 'almost-spring'); ?></h2>
		<ul>
		<?php wp_get_archives('type=monthly'); ?>
		</ul>
	</li>
	<li>
		<h2><?php _e('Categories', 'almost-spring'); ?></h2>
		<ul>
		<?php wp_list_categories(); ?> 
		</ul>
	</li>
	<li>
		<h2><?php _e('Search', 'almost-spring'); ?></h2>
		<?php include (TEMPLATEPATH . '/searchform.php'); ?>
	</li>
	
	<?php if (function_exists('wp_theme_switcher')) { ?>
	<li>
		<h2><?php _e('Themes', 'almost-spring'); ?></h2>
		<?php wp_theme_switcher(); ?>
	</li>
	<?php } ?>

	<?php if ( is_home() ) { wp_list_bookmarks(); } ?>	
	
	<li>
		<h2><?php _e('Meta', 'almost-spring'); ?></h2>
		<ul>
			<?php wp_register(); ?>
			<li><?php wp_loginout(); ?></li>
			<li><a href="<?php bloginfo('rss2_url'); ?>" title="<?php _e('Syndicate this site using RSS 2.0', 'almost-spring'); ?>"><?php _e('<abbr title="Really Simple Syndication">RSS</abbr> 2.0', 'almost-spring'); ?></a></li>
			<li><a href="<?php bloginfo('atom_url'); ?>" title="<?php _e('Syndicate this site using Atom', 'almost-spring'); ?>"><?php _e('Atom'); ?></a></li>
			<li><a href="http://wordpress.org" title="<?php _e('Provided by WordPress, state-of-the-art semantic personal publishing platform.', 'almost-spring'); ?>">WordPress</a></li>
			<?php wp_meta(); ?>
		</ul>
	</li>
<?php endif; ?>

</ul>

</div>
