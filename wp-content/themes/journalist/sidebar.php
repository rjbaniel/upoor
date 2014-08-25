<div id="sidebar">
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>

<div id="pages">
<h3><?php _e('Pages', 'journalist'); ?></h3>
<ul>
    <?php wp_list_pages('title_li='); ?>
</ul>
</div>

<h3><?php _e('Search', 'journalist'); ?></h3>
<p class="searchinfo"><?php _e('search site archives', 'journalist'); ?></p>
<div id="search">
<div id="search_area">
    <form id="searchform" method="get" action="<?php bloginfo('url'); ?>">
    <div>
        <input class="searchfield" type="text" name="s" id="s" value="" />
        <input class="submit" type="submit" value="<?php _e('search', 'journalist'); ?>" />
    </div>
    </form>
</div>
</div>

<h3><?php _e('Blogroll', 'journalist'); ?></h3>
<ul>
<?php get_bookmarks('-1', '<li>', '</li>', '', 0, 'name', 0, 0, -1, 0); ?>
</ul>

<h3><?php _e('Archives', 'journalist'); ?></h3>
<ul>
<?php wp_get_archives('type=monthly'); ?>
</ul>

<h3><?php _e('Categories', 'journalist'); ?></h3>
<ul>
    <?php wp_list_categories(); ?>
</ul>	

<h3><?php _e('Meta', 'journalist'); ?></h3>
<ul>
    <li><?php // wp_register(); ?></li>
    <li><?php wp_loginout(); ?></li>
    <li><a href="feed:<?php bloginfo('rss2_url'); ?>" title="<?php _e('Syndicate this site using RSS'); ?>">Site Feed</a></li>
    <li><a href="feed:<?php bloginfo('comments_rss2_url'); ?>" title="<?php _e('The latest comments to all posts in RSS'); ?>">Comments Feed</a></li>
    <li><a href="#content" title="back to top">Back to top</a></li>
    <?php wp_meta(); ?>
</ul>
<?php endif; ?>

<?php if (function_exists('wp_theme_switcher')) { ?>
<h3><?php _e('Themes', 'journalist'); ?></h3>
<div class="themes">
<?php wp_theme_switcher(); ?>
</div>
<?php } ?>

</div>
