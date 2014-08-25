<!-- begin sidebar -->
<div id="menu">
<ul>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>

   <li>	<h2><?php _e('Pages', 'frame'); ?></h2>
				<ul>
				<?php wp_list_pages('title_li='); ?>
				</ul>   </li>


<li id="categories"><h2><?php _e('Categories:','frame'); ?></h2>
<ul>
<?php wp_list_categories(); ?>
</ul>
</li>
<li id="search">
<form id="searchform" method="get" action="<?php bloginfo('url'); ?>">
<input type="text" name="s" id="s" size="20" /> <input type="submit" value="<?php _e('Search','frame'); ?>" />
</form>
</li>
<li id="archives"><h2><?php _e('Archives:','frame'); ?></h2>
<ul>
<?php wp_get_archives('type=monthly'); ?>
</ul>
</li>
<?php if (function_exists('wp_theme_switcher')) { ?>
<li><h2><?php _e('Themes','frame'); ?></h2>
<?php wp_theme_switcher('dropdown'); ?>
</li>
<?php } ?>
<li id="meta"><h2><?php _e('Meta:','frame'); ?></h2>
<ul>
<?php wp_register(); ?>
<li><?php wp_loginout(); ?></li>
<li><a href="<?php bloginfo('rss2_url'); ?>" title="<?php _e('Syndicate this site using RSS'); ?>"><?php _e('<abbr title="Really Simple Syndication">RSS</abbr>'); ?></a></li>
<li><a href="<?php bloginfo('comments_rss2_url'); ?>" title="<?php _e('The latest comments to all posts in RSS'); ?>"><?php _e('Comments <abbr title="Really Simple Syndication">RSS</abbr>'); ?></a></li>
<li><a href="http://gmpg.org/xfn/"><abbr title="<?php _e('XHTML Friends Network');?>">XFN</abbr></a></li>
<?php wp_meta(); ?>
</ul>
</li>
<?php endif; ?>

</ul>
</div>
<!-- end sidebar -->
