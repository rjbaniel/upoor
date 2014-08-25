
<div id="sidebar_left" class="sidebar">
	
	<div id="aboutme">
		<ul>
			<li>
				<img src="<?php bloginfo('template_url') ?>/images/aboutme.gif" alt="About me" /><strong><?php _e('About','genki');?></strong><br /><?php bloginfo('description') ?>
			</li>
		</ul>
	</div>
	<div id="navcontainer">
		<ul id="navlist">
			<?php wp_list_pages('title_li=&depth=1'); ?>
		</ul>
	</div>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar_left') ) : ?>	
    <h2><?php _e('Categories','genki');?></h2>
	<ul>
    	<?php wp_list_categories('&title_li='); ?>
    </ul>    

	<br />
<?php endif; ?>
</div>
<div id="sidebar_right" class="sidebar">
	<div class="search">
		<form method="get" id="searchform" action="<?php bloginfo('url'); ?>">
		<input class="searchinput" type="text" value="<?php echo esc_html($s, 1); ?>" name="s" id="search_query" />
		<input class="searchbutton" type="submit" value="<?php _e('Find','genki'); ?>"  />
		</form>
	</div>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar_right') ) : ?>	
	<h2><?php _e('Archives','genki');?></h2>
	<ul>
		<?php wp_get_archives('type=monthly'); ?>
	</ul>
	<h2><?php _e('Links','genki'); ?></h2>
	<ul>
		<?php wp_list_bookmarks(); ?>
	</ul>
<?php endif; ?>
</div>
