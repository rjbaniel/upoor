<div id="bottombar">
<div class="column1">
<ul>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Bottom Left') ) : ?>
<li><h2><?php _e('Search');?></h2>
<form id="searchform" method="get" action="<?php bloginfo('url'); ?>">
<ul><li>
<input type="text" name="s" id="s" size="15" /> <input type="submit" value="<?php _e('Search',TEMPLATE_DOMAIN);?>" />
</li></ul>
</form>
</li>
<li><h2><?php _e('Archives',TEMPLATE_DOMAIN);?></h2>
<ul>
<?php wp_get_archives('type=monthly'); ?>
</ul>
</li>
<?php endif; ?>
</ul>
    </div>

<div class="column2">
<ul>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Bottom Right') ) : ?>
<li><h2><?php _e('Categories',TEMPLATE_DOMAIN);?></h2>
<ul>
<?php wp_list_categories('sort_column=name&optioncount=1&hierarchical=0'); ?>
</ul>
</li>
<?php wp_list_bookmarks(); ?>
<?php endif; ?>
</ul>
</div>
<div class="spacer">&nbsp;</div>
</div>
