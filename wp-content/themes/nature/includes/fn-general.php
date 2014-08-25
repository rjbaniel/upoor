<?php
/**
 * @package WordPress
 * @subpackage magazine_obsession
 */

/**
 * Get Meta post/pages value
 * $type = string|int
 */
function obwp_get_meta($var, $type = 'string', $count = 1)
{
	$value = stripslashes(get_option($var));
	
	if($type=='string')
	{
		return $value;
	}
	elseif($type=='int')
	{
		$value = intval($value);
		if( !is_int($value) || $value <=0 )
		{
			$value = $count;
		}
		
		return $value;
	}
	
	return NULL;
}

/**
 * Get custom field of the current page
 * $type = string|int
 */
function obwp_getcustomfield($filedname, $page_current_id = NULL)
{
	if($page_current_id==NULL)
		$page_current_id = get_page_id();

	$value = get_post_meta($page_current_id, $filedname, true);

	return $value;
}

function wp_list_pages2($args) {

	$defaults = array(
		'depth' => 0, 'show_date' => '',
		'date_format' => get_option('date_format'),
		'child_of' => 0, 'exclude' => '',
		'title_li' => __('Pages'), 'echo' => 1,
		'authors' => '', 'sort_column' => 'menu_order, post_title',
		'link_before' => '', 'link_after' => ''
	);

	$r = wp_parse_args( $args, $defaults );
	extract( $r, EXTR_SKIP );

	$output = '';
	$current_page = 0;

	// sanitize, mostly to keep spaces out
	$r['exclude'] = preg_replace('/[^0-9,]/', '', $r['exclude']);

	// Allow plugins to filter an array of excluded pages
	$r['exclude'] = implode(',', apply_filters('wp_list_pages_excludes', explode(',', $r['exclude'])));

	// Query pages.
	$r['hierarchical'] = 0;
	$pages = get_pages($r);

	if ( !empty($pages) ) {
		if ( $r['title_li'] )
			$output .= '<li class="pagenav">' . $r['title_li'] . '<ul>';

		global $wp_query;
		if ( is_page() || $wp_query->is_posts_page )
			$current_page = $wp_query->get_queried_object_id();
		$output .= walk_page_tree($pages, $r['depth'], $current_page, $r);

		if ( $r['title_li'] )
			$output .= '</ul></li>';
	}

	$output = apply_filters('wp_list_pages', $output);

	if ( $r['echo'] )
		echo $output;
	else
		return $output;
}
 
function theme_ads_show()
{
	global $shortname;
	$count = obwp_get_meta(SHORTNAME."_count_banner_125_125",'int');

	if($count>0)
	{
		for($i=1; $i<=$count; $i++)
		{
			$banner_url = obwp_get_meta(SHORTNAME.'_banner_125_125_url_'.$i);
			$banner_img = obwp_get_meta(SHORTNAME.'_banner_125_125_img_'.$i);
			$banner_title = obwp_get_meta(SHORTNAME.'_banner_125_125_title_'.$i);

			if(!empty($banner_url) && !empty($banner_img))
			{
			?><div><a href="<?php echo $banner_url; ?>" title="<?php echo $banner_title; ?>"><img src="<?php echo $banner_img; ?>" alt="<?php echo $banner_title; ?>" /></a></div><?php
			}
		}
	}
}

function theme_google_468_ads_show()
{
	$id = obwp_get_meta(SHORTNAME."_google_id");
	if(!empty($id))
	{
		echo $code = '<div class="banner"><script type="text/javascript"><!--
google_ad_client = "'.$id.'";
google_ad_width = 468;
google_ad_height = 60;
google_ad_format = "468x60_as";
google_ad_type = "text_image"; 
google_color_border = "c5c5c5";
google_color_bg = "faf7ea";
google_color_link = "f26521";
google_color_url = "f26521";
google_color_text = "000000"; 
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script></div>';
	}
}

function theme_google_300_ads_show()
{
	$id = obwp_get_meta(SHORTNAME."_google_id");
	if(!empty($id))
	{
		echo $code = '<div class="banner_left"><script type="text/javascript"><!--
google_ad_client = "'.$id.'";
google_ad_width = 300;
google_ad_height = 250;
google_ad_format = "300x250_as";
google_ad_type = "text_image"; 
google_color_border = "c5c5c5";
google_color_bg = "faf7ea";
google_color_link = "f26521";
google_color_url = "f26521";
google_color_text = "000000"; 
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script></div>';
	}
}

?>
