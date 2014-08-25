<!-- begin sidebar -->


<div id="menu">




<div id="nav">

<ul>
<li><?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("dixiebelle-sideads"); } ?>        </li>
<?php if ( !function_exists('dynamic_sidebar')
        || !dynamic_sidebar() ) : ?>

<?php wp_list_bookmarks(); ?>
<li id="categories"><h2><?php _e('Categories:','dixiebelle'); ?></h2>
<ul>
<?php wp_list_categories(); ?>
</ul>
</li>
<li id="archives"><h2><?php _e('Archives:','dixiebelle'); ?></h2>
<ul>
<?php wp_get_archives('type=monthly'); ?>
</ul>
</li>
<?php if (function_exists('wp_theme_switcher')) { ?>
<li><h2><?php _e('Themes','dixiebelle'); ?></h2>
<?php wp_theme_switcher('dropdown'); ?>
</li>
<?php } ?>

<?php endif; ?>
</ul>
</div>
<h5>&nbsp;</h5>

<div class="feeds"><a href="<?php bloginfo('rss2_url'); ?>" title="<?php _e('Syndicate this site using RSS','dixiebelle'); ?>"><?php _e('rss','dixiebelle'); ?></a></div><!-- feeds -->
<div class="feeds"><a href="<?php bloginfo('atom_url'); ?>" title="atom feed°"><?php _e('xml','dixiebelle'); ?></a></div>


</div>
<!-- end sidebar -->
