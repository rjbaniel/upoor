<!-- begin sidebar -->
<div id="navcol"><?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("20090linkunitnocolor"); } ?>
<?php if ( !function_exists('dynamic_sidebar')
        || !dynamic_sidebar() ) : ?>

		<h2><?php _e('Links','gentle-calm');?></h2>
		<ul>
			<li><a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>" ><?php _e('Home','gentle-calm'); ?></a></li>
			<li><a href="<?php bloginfo('rss2_url'); ?>" title="<?php _e('Syndicate this site using RSS','gentle-calm'); ?>"><?php _e('<abbr title="Really Simple Syndication">RSS</abbr>','gentle-calm'); ?></a></li>
		</ul>
		<h2><?php _e('Archives','gentle-calm'); ?></h2>
		<ul>
			<?php wp_get_archives('type=monthly'); ?>
		</ul>
		
		<h2><?php _e('Categories','gentle-calm'); ?></h2>
		<ul>
			<?php wp_list_categories(0, '', 'name', 'asc', '', 1, 0, 1, 1, 1, 1, 0,'','','','','') ?>
		</ul>
		<ul id="linkslist">
		<?php wp_list_pages('title_li=<h2>' . __('Pages','gentle-calm') . '</h2>' ); ?>
		<?php wp_list_bookmarks(); ?>
		</ul>		
		<?php
			if (function_exists('wp_theme_switcher')){
				echo "<h2>";
				_e("Themes",'gentle-calm');
				echo "</h2>";
				wp_theme_switcher('');
			}		
		?>
<?php endif; ?>
	</div>
<!-- end sidebar -->
