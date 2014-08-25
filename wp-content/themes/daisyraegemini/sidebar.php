<!-- begin sidebar -->
<div id="menu">

<div id="nav">

<ul>
<li><?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("daisyraegemini-sideads"); } ?>        </li>
<?php if ( !function_exists('dynamic_sidebar')
        || !dynamic_sidebar() ) : ?>

   
	<li>
		<h2><?php _e('Archives', 'daisyrae'); ?></h2>
		<ul>
		<?php wp_get_archives('type=monthly'); ?>
		</ul>
	</li>
	<li>
		<h2><?php _e('Categories', 'daisyrae'); ?></h2>
		<ul>
		<?php wp_list_categories(); ?> 
		</ul>
	</li>
	
	<?php if (function_exists('wp_theme_switcher')) { ?>
	<li>
		<h2><?php _e('Themes', 'daisyrae'); ?></h2>
		<?php wp_theme_switcher(); ?>
	</li>
	<?php } ?>

	<?php if ( is_home() ) { wp_list_bookmarks(); } ?>	
	
	<li>
		<h2><?php _e('Meta', 'daisyrae'); ?></h2>
		<ul>
			<?php wp_register(); ?>
			<li><?php wp_loginout(); ?></li>
			<li><a href="<?php bloginfo('rss2_url'); ?>" title="<?php _e('Syndicate this site using RSS 2.0', 'daisyrae'); ?>"><?php _e('<abbr title="Really Simple Syndication">RSS</abbr> 2.0', 'daisyrae'); ?></a></li>
			<li><a href="<?php bloginfo('atom_url'); ?>" title="<?php _e('Syndicate this site using Atom', 'daisyrae'); ?>"><?php _e('Atom', 'daisyrae'); ?></a></li>
			<?php wp_meta(); ?>
		</ul>
	</li>
<?php endif; ?>

</ul>



<br />
</div>
</div>
<!-- end sidebar -->
