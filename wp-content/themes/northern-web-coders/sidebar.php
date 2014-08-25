<div id="menu">
<ul>
<?php if ( !function_exists('dynamic_sidebar')
        || !dynamic_sidebar() ) : ?>
<ul>
<li>
<?php /* If this is a category archive */ if (is_category()) { ?>
<ul>
<li id="search">
<form id="searchform" method="get" action="<?php bloginfo('url'); ?>">
<input type="text" name="s" id="s" size="20" /> <input type="submit" value="<?php _e('Search',TEMPLATE_DOMAIN); ?>" />
</form>
</li>
</ul>


<?php /* If this is a yearly archive */ } elseif (is_home()) { ?>
<ul>
<li id="search">
<form id="searchform" method="get" action="<?php bloginfo('url'); ?>">
<input type="text" name="s" id="s" size="20" /> <input type="submit" value="<?php _e('Search',TEMPLATE_DOMAIN); ?>" />
</form>
</li>
</ul>

<?php /* If this is a yearly archive */ } elseif (is_day()) { ?>
<ul>
<li id="search">
<form id="searchform" method="get" action="<?php bloginfo('url'); ?>">
<input type="text" name="s" id="s" size="20" /> <input type="submit" value="<?php _e('Search',TEMPLATE_DOMAIN); ?>" />
</form>
</li>
</ul>

<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
<ul>
<li id="search">
<form id="searchform" method="get" action="<?php bloginfo('url'); ?>">
<input type="text" name="s" id="s" size="20" /> <input type="submit" value="<?php _e('Search',TEMPLATE_DOMAIN); ?>" />
</form>
</li>
</ul>

<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
<ul>
<li id="search">
<form id="searchform" method="get" action="<?php bloginfo('url'); ?>">
<input type="text" name="s" id="s" size="20" /> <input type="submit" value="<?php _e('Search',TEMPLATE_DOMAIN); ?>" />
</form>
</li>
</ul>

<?php /* If this is a monthly archive */ } elseif (is_search()) { ?>
<ul>
<li id="search">
<form id="searchform" method="get" action="<?php bloginfo('url'); ?>">
<input type="text" name="s" id="s" size="20" /> <input type="submit" value="<?php _e('Search',TEMPLATE_DOMAIN); ?>" />
</form>
</li>
</ul>

<?php /* If this is a monthly archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
<ul>
<li id="search">
<form id="searchform" method="get" action="<?php bloginfo('url'); ?>">
<input type="text" name="s" id="s" size="20" /> <input type="submit" value="<?php _e('Search',TEMPLATE_DOMAIN); ?>" />
</form>
</li>
</ul>

<?php /* If this is a monthly archive */ } elseif (is_page()) { ?>


<?php } ?>
</li>

<?php wp_list_bookmarks(); ?>

<?php if (function_exists('wp_theme_switcher')) { ?>
<li><h2><?php _e('Themes',TEMPLATE_DOMAIN); ?></h2>
<?php wp_theme_switcher('dropdown'); ?>
</li>
<?php } ?>

<li><h2><?php _e('Archives',TEMPLATE_DOMAIN); ?></h2>
<ul>
<?php wp_get_archives('type=monthly'); ?>
</ul>
</li>

<li><h2><?php _e('Categories',TEMPLATE_DOMAIN); ?></h2>
<ul>
<?php wp_list_categories(0, '', 'name', 'asc', '', 1, 0, 1, 1, 1, 1, 0,'','','','','') ?>
</ul>
</li>


<li id="meta"><h2><?php _e('Meta:',TEMPLATE_DOMAIN); ?></h2>
<ul>
<?php wp_register(); ?>
<li><?php wp_loginout(); ?></li>
<li><a href="<?php bloginfo('rss2_url'); ?>" title="<?php _e('Syndicate this site using RSS',TEMPLATE_DOMAIN); ?>"><?php _e('<abbr title="Really Simple Syndication">RSS</abbr>'); ?></a></li>
<li><a href="<?php bloginfo('comments_rss2_url'); ?>" title="<?php _e('The latest comments to all posts in RSS',TEMPLATE_DOMAIN); ?>"><?php _e('Comments <abbr title="Really Simple Syndication">RSS</abbr>',TEMPLATE_DOMAIN); ?></a></li>
<li><a href="http://validator.w3.org/check/referer" title="<?php _e('This page validates as XHTML 1.0 Transitional',TEMPLATE_DOMAIN); ?>"><?php _e('Valid <abbr title="eXtensible HyperText Markup Language">XHTML</abbr>',TEMPLATE_DOMAIN); ?></a></li>
<li><a href="http://gmpg.org/xfn/"><abbr title="<?php _e('XHTML Friends Network',TEMPLATE_DOMAIN);?>">XFN</abbr></a></li>
<li><a href="http://wordpress.org/" title="<?php _e('Provided by WordPress, state-of-the-art semantic personal publishing platform.',TEMPLATE_DOMAIN); ?>"><abbr title="WordPress">WP</abbr></a></li>
<?php wp_meta(); ?>
</ul>
</li>
<?php endif; ?>
</ul>
</div>
<!-- end sidebar -->
