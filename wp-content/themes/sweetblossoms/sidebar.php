
<!-- subcontent ................................. -->
<div id="side">

<br /><br />

<?php if (is_home() || is_page() || is_single() || is_page("archives") || is_archive() || is_search()) { ?>
	
	<center>
	<form action="<?php bloginfo('url'); ?>/" method="get">
			<input class="search" value="<?php echo esc_html($s, 1); ?>" name="s" id="s" />
			<div style="padding:3px 0px 0px 0px;"></div>
			<input class="search" type="submit" value="   <?php _e("Search",TEMPLATE_DOMAIN); ?>   " id="searchbutton" name="searchbutton" />
	</form>
	</center>

	<h3><em><?php _e("Pages",TEMPLATE_DOMAIN); ?></em></h3>

	<ul>
		<li<?php if (is_home()) echo " class=\"selected\""; ?>><a href="<?php bloginfo('url'); ?>"><?php _e("Home",TEMPLATE_DOMAIN); ?></a></li>
		<?php
		$pages = BX_get_pages();
		if ($pages) {
			foreach ($pages as $page) {
				$page_id = $page->ID;
   				$page_title = $page->post_title;
   				$page_name = $page->post_name;
   				if ($page_name == "archives") {
   					(is_page($page_id) || is_archive() || is_search() || is_single())?$selected = ' class="selected"':$selected='';
   					echo "<li".$selected."><a href=\"".get_page_link($page_id)."\">Archives</a></li>\n";
   				}
   				elseif($page_name == "about") {
   					(is_page($page_id))?$selected = ' class="selected"':$selected='';
   					echo "<li".$selected."><a href=\"".get_page_link($page_id)."\">About</a></li>\n";
   				}
   				elseif ($page_name == "contact") {
   					(is_page($page_id))?$selected = ' class="selected"':$selected='';
   					echo "<li".$selected."><a href=\"".get_page_link($page_id)."\">Contact</a></li>\n";
   				}
   				elseif ($page_name == "about_short") {/*ignore*/}
           	 	else {
            		(is_page($page_id))?$selected = ' class="selected"':$selected='';
            		echo "<li".$selected."><a href=\"".get_page_link($page_id)."\">$page_title</a></li>\n";
            	}
    		}
    	}
		?>
	</ul>

	<h3><em><?php _e("Categories",TEMPLATE_DOMAIN); ?></em></h3>

	<ul class="categories">
	<?php wp_list_categories('sort_column=name'); ?> 
	</ul>

<?php if(!is_single()) { ?>

	<h3><em><?php _e("Links",TEMPLATE_DOMAIN); ?></em></h3>

	<ul class="links">
	<?php get_bookmarks('-1', '<li>', '</li>', '', 0, 'name', 0, 0, -1, 0); ?>
	</ul>

	<h3><em><?php _e("Meta",TEMPLATE_DOMAIN); ?></em></h3>

	<ul class="meta">
	<li><?php wp_loginout(); ?></li>
	<li><a href="<?php bloginfo_rss('rss2_url'); ?> "><?php _e("Entries (RSS)",TEMPLATE_DOMAIN); ?></a></li>
	<li><a href="<?php bloginfo_rss('comments_rss2_url'); ?> "><?php _e("Comments (RSS)",TEMPLATE_DOMAIN); ?></a></li>
	</ul>
	
<?php } ?>

<?php } ?>


<?php if (is_single() || is_page() || is_home()) { ?>

	<h3><em><?php _e("Calendar",TEMPLATE_DOMAIN); ?></em></h3>

	<?php get_calendar() ?>

	<h3><em><?php _e("Most Recent Posts",TEMPLATE_DOMAIN); ?></em></h3>

	<ul class="posts">
	<?php BX_get_recent_posts($p,10); ?>
	</ul>

<?php } ?>


<?php if (is_page("archives") || is_archive() || is_search()) { ?>

	<h3><em><?php _e("Calendar",TEMPLATE_DOMAIN); ?></em></h3>

	<?php get_calendar() ?>

	<?php if (!is_page("archives")) { ?>

		<h3><em><?php _e("Posts by Month",TEMPLATE_DOMAIN); ?></em></h3>

		<ul class="months">
		<?php wp_get_archives('monthly','','','<li>','</li>',''); ?>
		</ul>

	<?php } ?>

	<h3><em><?php _e("Posts by Category",TEMPLATE_DOMAIN); ?></em></h3>

	<ul class="categories">
	<?php wp_list_categories('sort_column=name&hide_empty=0'); ?> 
	</ul>

<?php } ?>


</div> <!-- /subcontent -->
