</div>
<div id="sidebar-1" class="sidebar">
<ul>


	 <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(1) ) : else : ?>

	<?php wp_list_pages('title_li=<h2>' . __('Pages',TEMPLATE_DOMAIN) . '</h2>' ); ?>
	
	<li>
		<h2><?php _e('Archives',TEMPLATE_DOMAIN); ?></h2>
		<ul>
		<?php wp_get_archives('type=monthly'); ?>
		</ul>
	</li>
	
	<li>
		<h2><?php _e('Categories',TEMPLATE_DOMAIN); ?></h2>
		<ul>
		<?php wp_list_categories(); ?> 
		</ul>
	</li>

	<?php endif; ?>

</ul>
</div>
<div id="sidebar-2" class="sidebar">


<ul>
 <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(2) ) : else : ?>
	<li>
	<h2><?php _e('About',TEMPLATE_DOMAIN); ?></h2>
	<p><?php bloginfo('description'); ?></p>
	</li>

      <li>
		<h2><?php _e('Links',TEMPLATE_DOMAIN); ?></h2>
<?php get_bookmarks('-1', '<li>', '</li>', '', 0, 'name', 0, 0, -1, 0); ?>
</li>

      <li>
		<h2><?php _e('Search',TEMPLATE_DOMAIN); ?></h2>
		<?php include (TEMPLATEPATH . '/searchform.php'); ?>
	</li>
	<?php endif; ?>
</ul>
</div>

<div id="sidebar-3" class="sidebar">
<ul>
 <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(3) ) : else : ?>
	<li>
	<h2><?php _e('Meta',TEMPLATE_DOMAIN); ?></h2>
		<ul>
			<?php wp_register(); ?>
			<li><?php wp_loginout(); ?></li>
			<li><a href="<?php bloginfo('rss2_url'); ?>" title="<?php _e('Syndicate this site using RSS 2.0',TEMPLATE_DOMAIN); ?>"><?php _e('Entries <abbr title="Really Simple Syndication">RSS</abbr>',TEMPLATE_DOMAIN); ?></a></li>
			<li><a href="<?php bloginfo('comments_rss2_url'); ?>" title="<?php _e('The latest comments to all posts in RSS',TEMPLATE_DOMAIN); ?>"><?php _e('Comments <abbr title="Really Simple Syndication">RSS</abbr>',TEMPLATE_DOMAIN); ?></a></li>
			<?php wp_meta(); ?>
		</ul>
	</li>
	<?php endif; ?>
	<li>
	<h2><?php _e('Credits',TEMPLATE_DOMAIN); ?></h2>
	<p>
    &copy; <?php echo gmdate(__('Y')); ?>  <?php bloginfo('name'); ?>
    <?php if( SHOW_AUTHORS != 'false') { ?><br />Theme: Fjords by <a href="http://www.peterandrej.com/wordpress/" rel="designer">Peterandrej</a><br />
    <?php } ?>
    <?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
<?php _e('Hosted by',TEMPLATE_DOMAIN); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?>
	</li>
</ul>
</div>

