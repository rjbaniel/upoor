<!-- begin sidebar -->

<ul>
<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar() ) : else : ?>

<li><h2><?php _e('Recent Posts',TEMPLATE_DOMAIN);?></h2>
<ul><?php wp_get_archives('type=postbypost&limit=10'); ?></ul></li>

<?php wp_list_bookmarks(); ?>


<li><h2><?php _e('Categories',TEMPLATE_DOMAIN);?></h2>
<ul><?php wp_list_categories(); ?></ul></li>



<li><h2><?php _e('Archives',TEMPLATE_DOMAIN);?></h2>
<ul><?php wp_get_archives('type=monthly'); ?></ul></li>


<li><h2><?php _e('Meta',TEMPLATE_DOMAIN);?></h2>
<ul>
<?php wp_register(); ?>
<li><?php wp_loginout(); ?></li>
<li><a href="feed:<?php bloginfo('rss2_url'); ?>" title="<?php _e('Syndicate this site using RSS'); ?>"><?php _e('<abbr title="Really Simple Syndication">RSS</abbr>'); ?></a></li>
<li><a href="feed:<?php bloginfo('comments_rss2_url'); ?>" title="<?php _e('The latest comments to all posts in RSS'); ?>"><?php _e('Comments <abbr title="Really Simple Syndication">RSS</abbr>'); ?></a></li>

<li><a href="http://gmpg.org/xfn/"><abbr title="<?php _e('XHTML Friends Network');?>">XFN</abbr></a></li>

<?php wp_meta(); ?>
</ul></li>

<li><h2><?php _e('Search',TEMPLATE_DOMAIN);?></h2>
<ul><li>
<form id="searchform" method="get" action="<?php bloginfo('url'); ?>">
<input type="text" name="s" id="s" size="15" /><br />
<input type="submit" value="<?php _e('Search',TEMPLATE_DOMAIN); ?>" />
</form></li></ul></li>
<?php endif; ?>

</ul>

<!-- end sidebar -->
