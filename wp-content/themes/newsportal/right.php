
  <div id="right_side">
  <?php if ( !function_exists('dynamic_sidebar')
        || !dynamic_sidebar(2) ) : ?>

<div class="block block-node">
<h3><?php _e('Blogroll',TEMPLATE_DOMAIN); ?></h3>
<ul>
<?php get_bookmarks(-1, '<li>', '</li>', ' - '); ?>
</ul>
</div>



<div class="block block-node">
<h3><?php _e('Recent Posts',TEMPLATE_DOMAIN); ?></h3>
<ul>
<?php wp_get_archives('postbypost', 10); ?>
</ul>
</div>
	 
	 	 


	 
	  <div class="block block-node">
		


<h3>Search</h3>

<ul>

<li>

<form method="get" id="searchform" action="<?php bloginfo('url'); ?>">

<input type="text" size="10" value="<?php echo esc_html($s, 1); ?>" name="s" id="s" /><input type="submit" id="sidebarsubmit" value="<?php _e('Search',TEMPLATE_DOMAIN);?>" />

 </form>

</li> 

</ul> 


     </div>
 
 <?php endif; ?>
 
  </div>
