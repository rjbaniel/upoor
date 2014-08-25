	<div id="sidebar1" class="sidecol">
	
	<ul>
<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(1) ) : else : ?>
<li>
	<h2><?php _e('Latest Posts',TEMPLATE_DOMAIN); ?></h2>
	<ul><?php wp_get_archives("type=postbypost&limit=6")?></ul>
</li>
<li>
    <h2><?php _e('Feed on',TEMPLATE_DOMAIN);?></h2>
    <ul>
      <li class="feed"><a title="<?php _e('RSS Feed of Posts',TEMPLATE_DOMAIN);?>" href="<?php bloginfo('rss2_url'); ?>"><?php _e("Posts RSS",TEMPLATE_DOMAIN); ?></a></li>
      <li class="feed"><a title="<?php _e('RSS Feed of Comments',TEMPLATE_DOMAIN);?>" href="<?php bloginfo('comments_rss2_url'); ?>"><?php _e("Comments RSS",TEMPLATE_DOMAIN); ?></a></li>
    </ul>
  </li>
<li>
  <h2><?php _e('Search',TEMPLATE_DOMAIN); ?></h2>
	<form id="searchform" method="get" action="<?php bloginfo('url')?>/">
		<input type="text" name="s" id="s" class="textbox" value="<?php echo esc_html($s, 1); ?>" />
		<input id="btnSearch" type="submit" name="submit" value="<?php _e('Go',TEMPLATE_DOMAIN); ?>" />
	</form>
  </li>  
<?php wp_list_bookmarks(); ?>      
<?php endif; ?>
</ul>
</div>

<div id="sidebar2" class="sidecol">

<ul>
<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(2) ) : else : ?>
  <li>
    <h2>
      <?php _e('Categories',TEMPLATE_DOMAIN); ?>
    </h2>
    <ul>
      <?php wp_list_categories('optioncount=1&hierarchical=1');    ?>
    </ul>
  </li>
  <li>
    <h2>
      <?php _e('Monthly',TEMPLATE_DOMAIN); ?>
    </h2>
    <ul>
      <?php wp_get_archives('type=monthly&show_post_count=true'); ?>
    </ul>
  </li>
  <li>
    <h2><?php _e('Pages',TEMPLATE_DOMAIN); ?></h2>
    <ul>
      <?php wp_list_pages('title_li=' ); ?>
    </ul>
  </li>
	<li>
      <h2><?php _e('Meta',TEMPLATE_DOMAIN);?></h2>
		<ul>
			<?php wp_register(); ?>
			<li><?php wp_loginout(); ?></li>

			<li><a href="http://gmpg.org/xfn/"><abbr title="<?php _e('XHTML Friends Network');?>">XFN</abbr></a></li>

			<?php wp_meta(); ?>
		</ul>			
   </li>
    <?php endif; ?>
</ul>
</div>
<div style="clear:both;"></div>
