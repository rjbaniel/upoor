<div id="sidebar">
<div id="searchdiv">
    <form id="searchform" method="get" action="<?php bloginfo('url'); ?>">
      <input type="text" name="s" id="s" size="20"/>
      <input name="sbutt" type="submit" value="<?php _e("Find",TEMPLATE_DOMAIN); ?>" alt="Submit"  />
    </form>
  </div>
<?php if ( !function_exists('dynamic_sidebar')
        || !dynamic_sidebar() ) : ?>
 <h2><?php _e("Monthly Archives",TEMPLATE_DOMAIN); ?></h2>
  <ul>
    <?php wp_get_archives('type=monthly'); ?>
  </ul>
  <h2><?php _e('Categories',TEMPLATE_DOMAIN);?></h2>
  <ul>
    <?php wp_list_categories(); ?>
  </ul>
<h2><?php _e("Stay Updated",TEMPLATE_DOMAIN); ?></h2>
  <ul id="feed">
    <li><a href="<?php bloginfo('rss2_url'); ?>" title="<?php _e('Syndicate this site using RSS',TEMPLATE_DOMAIN); ?>"><?php _e("RSS Articles",TEMPLATE_DOMAIN); ?></a></li>
  </ul>
<?php endif; ?>
</div>
