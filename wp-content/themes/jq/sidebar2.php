<div id="right">
<p id="sidebar_hide"><a href="#" id="hide_s"><?php _e('Sidebar', 'jq'); ?> &rarr;</a></p>
<p id="font-resize"><a id="default" href="#">A </a><a id="larger" href="#">A+ </a><a id="largest" href="#">A++</a></p>
<!-- widget -->
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar_right') ) : ?>
<div class="widget">
<h4><a href="#" title="Toggle" class="hide_widget"><?php _e('Categories', 'jq'); ?></a></h4>
<ul>
<?php wp_list_categories('title_li=0&categorize=0'); ?>
</ul>
</div>
<div class="widget">
<h4><a href="#" title="Toggle" class="hide_widget"><?php _e('Blogroll', 'jq'); ?></a></h4>
<ul>
<?php wp_list_bookmarks('title_li=0&categorize=0'); ?>
</ul>
</div>
<div class="widget">
<h4><a href="#" title="Toggle" class="hide_widget"><?php _e('Meta', 'jq'); ?></a></h4>
<ul>
<?php wp_register(); ?>
<li><?php wp_loginout(); ?></li>
<li><a href="<?php bloginfo('rss2_url'); ?>" title="<?php _e('Syndicate this site using RSS', 'jq'); ?>"><?php _e('<abbr title="Really Simple Syndication">RSS</abbr>', 'jq'); ?></a></li>
<li><a href="<?php bloginfo('comments_rss2_url'); ?>" title="<?php _e('The latest comments to all posts in RSS', 'jq'); ?>"><?php _e('Comments <abbr title="Really Simple Syndication">RSS</abbr>', 'jq'); ?></a></li>
<?php wp_meta(); ?>
</ul>
</div>
<?php endif; // endif widget ?>     
</div>
