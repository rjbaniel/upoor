<!-- begin sidebar -->
<div id="sidebar">
<h4>&nbsp;</h4>
<div id="sidemenu">
<ul>

<li><?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("deichnetz-160"); } ?></li>


<?php if ( !function_exists('dynamic_sidebar')
        || !dynamic_sidebar() ) : ?>

<?php wp_list_bookmarks(); ?>
<li id="categories"><h2><?php _e('Categories:', 'deichnetz'); ?></h2>
<ul>
<?php wp_list_categories(); ?>
</ul>
</li>
<li id="archives"><h2><?php _e('Archives:', 'deichnetz'); ?></h2>
<ul>
<?php wp_get_archives('type=monthly'); ?>
</ul>
</li>
<?php if (function_exists('wp_theme_switcher')) { ?>
<li><h2><?php _e('Themes', 'deichnetz'); ?></h2>
<?php wp_theme_switcher('dropdown'); ?>
</li>
<?php } ?>

<?php endif; ?>
</ul>
</div>
<h5>&nbsp;</h5>

<div class="feeds"><a href="<?php bloginfo('rss2_url'); ?>" title="<?php _e('Syndicate this site using RSS'); ?>">rss</a></div><!-- feeds -->
<div class="feeds"><a href="<?php bloginfo('atom_url'); ?>" title="atom feed°">xml</a></div>


</div>
<!-- end sidebar -->
