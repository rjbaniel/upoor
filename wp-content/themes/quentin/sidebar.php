<div id="menu">

<ul>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>
<li id="calendar">
	<?php get_calendar(); ?>
</li> 
<li id="search">
<form id="searchform" method="get" action="<?php bloginfo('url'); ?>/">
<input type="text" name="s" id="s" size="8" /> <input type="submit" name="submit" value="<?php _e('Search',TEMPLATE_DOMAIN); ?>" id="sub" />
</form>
</li>




<li id="categories"><?php _e('Categories:',TEMPLATE_DOMAIN); ?>
	<ul>
	<?php wp_list_categories(); ?>
	</ul>
</li>
 


<li id="archives"><?php _e('Archives:',TEMPLATE_DOMAIN); ?>
 	<ul>
	 <?php wp_get_archives('type=monthly'); ?>
 	</ul>
</li>


<?php wp_list_bookmarks(); ?>
 

<?php endif; ?>
</ul>

</div>
