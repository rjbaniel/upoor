
<!-- begin sidebar -->
<div id="menu">

<ul style="margin-top:50px;"><?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("20090linkunitnocolor"); } ?>
<?php if ( !function_exists('dynamic_sidebar')
        || !dynamic_sidebar() ) : ?>


 <li id="categories"><?php _e('Categories:','deep-blue'); ?>
	<ul>
	<?php wp_list_categories(); ?>
	</ul>
 </li>
 <li id="search">
   <label for="s"><?php _e('Search:','deep-blue'); ?></label>
   <form id="searchform" method="get" action="<?php bloginfo('url'); ?>">
	<div>
		<input type="text" name="s" id="s" size="15" /><br />
		<input type="submit" name="submit" value="<?php _e('Search','deep-blue'); ?>" />
	</div>
	</form>
 </li>
 <li id="archives"><?php _e('Archives:','deep-blue'); ?>
 	<ul>
	 <?php wp_get_archives('type=monthly'); ?>
 	</ul>
 </li>
 <li id="meta"><?php _e('Meta:','deep-blue'); ?>
 	<ul>
		<li><?php wp_register(); ?></li>
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
