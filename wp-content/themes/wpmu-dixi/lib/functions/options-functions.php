<?php
///////////////////////////////////////////////////////////////////////////////
// CUSTOMIZE BACKEND FOR WPMU-DIXI
///////////////////////////////////////////////////////////////////////////////
$themename = "WPMU-Dixi ";
$shortname = "tn";
$short_prefix = "wpmu_dixi_";

$tpl_dir = get_template_directory_uri();
$tpl_url = site_url();
$mywp_version = get_bloginfo('version');


if(file_exists( WP_CONTENT_DIR . '/themes/wpmu-dixi/style.css' )) {
$theme_data = wp_get_theme( 'wpmu-dixi' );
} else {
$theme_data = wp_get_theme();
}

$theme_version = $theme_data->get('Version');

if(function_exists('bp_get_root_domain')) {
$the_privacy_root = bp_get_root_domain(); } else {
$the_privacy_root = site_url();
}

if( function_exists('bp_get_root_slug')) {
$member_reg_slug = bp_get_root_slug( 'register' );
}


if ($mywp_version >= '2.3') {
$wp_dropdown_rd_admin = $wpdb->get_results("SELECT $wpdb->term_taxonomy.term_id,name,description,count FROM $wpdb->term_taxonomy LEFT JOIN $wpdb->terms ON $wpdb->term_taxonomy.term_id = $wpdb->terms.term_id WHERE taxonomy = 'category' GROUP BY $wpdb->terms.name ORDER by $wpdb->terms.name ASC");
$wp_getcat = array();
foreach ($wp_dropdown_rd_admin as $category_list) {
$wp_getcat[$category_list->term_id] = $category_list->name;
}
$category_bulk_list = array_unshift($wp_getcat, "Choose a category");
} else {
$wp_dropdown_rd_admin = get_categories('hide_empty=0&orderby=name');
$wp_getcat = array();
foreach ($wp_dropdown_rd_admin as $category_list) {
$wp_getcat[$category_list->cat_ID] = $category_list->cat_name;
}
$category_bulk_list = array_unshift($wp_getcat, "Choose a category");
}

$choose_count = array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20");
$member_reg_slug = isset($member_reg_slug)?$member_reg_slug:'';

$options = array (

      // new layout width options

    array (	"name" => __("Insert your prefered site width<br />sample: 960, 980, 1000", 'dixi'),
			"id" => $shortname . "_" . $short_prefix . "site_width",
            "inblock" => "content-layout",
            "box" => "1",
            "std" => "",
			"type" => "text"),


    array (	"name" => __("Insert your prefered left sidebar width", 'dixi'),
			"id" => $shortname . "_" . $short_prefix . "left_sidebar_width",
            "inblock" => "content-layout",
            "box" => "1",
            "std" => "",
			"type" => "text"),


     array (	"name" => __("Insert your prefered post width", 'dixi'),
			"id" => $shortname . "_" . $short_prefix . "post_width",
            "inblock" => "content-layout",
            "box" => "1",
            "std" => "",
			"type" => "text"),

    array (	"name" => __("Insert your prefered right sidebar width", 'dixi'),
			"id" => $shortname . "_" . $short_prefix . "right_sidebar_width",
            "inblock" => "content-layout",
            "box" => "1",
            "std" => "",
			"type" => "text"),
            //end


    array (	"name" => __("Choose your layout mode?", 'dixi'),
			"id" => $shortname . "_" . $short_prefix . "layout_mode",
            "inblock" => "main-layout",
            "box" => "1",
			"type" => "select",
            "std" => "custom homepage",
            "options" => array("custom homepage","blog homepage")),


    array (	"name" => __("Insert your category id that will be include in recent site article<br />sample: 2,4,6,14,55<br /><br /><em>*if empty, normal all post will be query</em>", 'dixi'),
			"id" => $shortname . "_" . $short_prefix . "featured_cat",
            "inblock" => "main-layout",
            "box" => "1",
            "std" => "",
			"type" => "text"),

   array(	"name" => __("How many posts you want to show in recent site article?:", 'dixi'),
			 "id" => $shortname . "_" . $short_prefix . "featured_cat_count",
             "inblock" => "main-layout",
            "box" => "1",
			"type" => "select",
            "std" => "",
			"options" => $choose_count),

    array(	"name" => __("Do you want to used the site intro in middle?:", 'dixi'),
			 "id" => $shortname . "_" . $short_prefix . "intro_header_on",
             "inblock" => "main-layout",
            "box" => "1",
			"type" => "select",
            "std" => "enable",
			"options" => array("enable", "disable")),



    array (	"name" => __("Used rss network in blog?:", 'dixi'),
			 "id" => $shortname . "_" . $short_prefix . "show_rss",
             "inblock" => "main-layout",
            "box" => "1",
			"type" => "select",
            "std" => "yes",
            "options" => array("yes","no")),


    array (	"name" => __("Show login panel and profiles?:", 'dixi'),
			 "id" => $shortname . "_" . $short_prefix . "show_profile",
             "inblock" => "main-layout",
            "box" => "1",
			"type" => "select",
            "std" => "yes",
            "options" => array("yes","no")),


    array(	"name" => __("Enter some information about yourself or the site (only displayed if the login panel is enabled)", 'dixi'),
			 "id" => $shortname . "_" . $short_prefix . "profile_text",
            "inblock" => "main-layout",
            "box" => "1",
            "std" => "",
			"type" => "textarea"),




    array (	"name" => __("Do you want to enable Facebook Like in Single Post", 'nelo'),
			"id" => $shortname . "_" . $short_prefix . "facebook_like_status",
            "inblock" => "post",
            "box" => "1",
			"type" => "select",
            "std" => "disable",
            "options" => array("disable", "enable")),


    array(	"name" => __("Do you want to used the social bar in posts?", 'nelo'),
			"id" => $shortname . "_" . $short_prefix . "social_status",
            "inblock" => "post",
            "box" => "1",
			"type" => "select",
            "std" => "disable",
			"options" => array("disable", "enable")),


    array(	"name" => __("Do you want to enable post author and meta info like post date etc in posts?", 'nelo'),
			"id" => $shortname . "_" . $short_prefix . "postmeta_status",
            "inblock" => "post",
            "box" => "1",
			"type" => "select",
            "std" => "enable",
			"options" => array("enable","disable")),





    array (	"name" => __("Choose your background colour?", 'dixi'),
			"id" => $shortname . "_" . $short_prefix . "bg_colour",
            "inblock" => "layout",
            "custom" => "colourpicker",
            "box" => "1",
            "std" => "",
			"type" => "text"),

    array (	"name" => __("Choose your content background colour?", 'dixi'),
			"id" => $shortname . "_" . $short_prefix . "container_colour",
            "inblock" => "layout",
            "custom" => "colourpicker",
            "box" => "1",
            "std" => "",
			"type" => "text"),

     array (	"name" => __("Choose your body <strong>line</strong> colour? *grid lines and separate lines", 'dixi'),
			"id" => $shortname. "_" . $short_prefix . "content_line_colour",
            "inblock" => "layout",
            "custom" => "colourpicker",
            "box" => "1",
            "std" => "",
			"type" => "text"),


    array (	"name" => sprintf(__("If you want to use an image as the background please upload the image here:<br /><a target=\"_blank\" href=\"%s\">upload image</a>", 'dixi'), admin_url("upload.php")),
			"id" => $shortname . "_" . $short_prefix . "bg_image",
            "inblock" => "layout",
            "box" => "1",
            "std" => "",
			"type" => "text"),



array(
"name" => __("Background Images Repeat", 'dixi'),
"id" => $shortname . "_" . $short_prefix . "bg_image_repeat",
"inblock" => "layout",
"box" => "1",
"type" => "select",
"std" => "no-repeat",
"options" => array("no-repeat","repeat","repeat-x","repeat-y")),


array(
"name" => __("Background Images Attachment", 'dixi'),
"id" => $shortname . "_" . $short_prefix . "bg_image_attachment",
"inblock" => "layout",
"box" => "1",
"type" => "select",
"std" => "fixed",
"options" => array("fixed", "scroll")),


array(
"name" => __("Background Images Horizontal Position", 'dixi'),
"id" => $shortname . "_" . $short_prefix . "bg_image_horizontal",
"inblock" => "layout",
"box" => "1",
"type" => "select",
"std" => "left",
"options" => array("left", "center", "right")),


array(
"name" => __("Background Images Vertical Position", 'dixi'),
"id" => $shortname . "_" . $short_prefix . "bg_image_vertical",
"inblock" => "layout",
"box" => "1",
"type" => "select",
"std" => "top",
"options" => array("top", "center", "bottom")),




    array(	"name" => __("Choose your global body font?", 'dixi'),
			"id" => $shortname . "_" . $short_prefix . "body_font",
            "type" => "select-preview",
            "box" => "2",
            "inblock" => "font",
            "std" => "Helvetica, Arial, sans-serif",
			"options" => array(
             "Helvetica, Arial, sans-serif",
            "Lucida Grande, Lucida Sans, sans-serif",
            "Arial, sans-serif",
											"Cantarell, arial, serif",
											"Cardo, arial, serif",
										    "Courier New, Courier, monospace",
											"Crimson Text, arial, serif",
											"Droid Sans, arial, serif",
											"Droid Serif, arial, serif",
								            "Garamond, Georgia, serif",
											"Georgia, arial, serif",
											"IM Fell DW Pica, arial, serif",
											"Josefin Sans Std Light, arial, serif",
											"Lobster, arial, serif",
											"Lucida Sans Unicode, Lucinda Grande, sans-serif",
											"Molengo, arial, serif",
											"Neuton, arial, serif",
											"Nobile, arial, serif",
											"OFL Sorts Mill Goudy TT, arial, serif",
											"Old Standard TT, arial, serif",
											"Reenie Beanie, arial, serif",
											"Tahoma, sans-serif",
											"Tangerine, arial, serif",
								            "Trebuchet MS, sans-serif",
								            "Verdana, sans-serif",
											"Vollkorn, arial, serif",
											"Yanone Kaffeesatz, arial, serif",
                                            "Just Another Hand, arial, serif",
                                            "Terminal Dosis Light, arial, serif",
                                            "Ubuntu, arial, serif"
            )
            ),

	array(	"name" => __("Choose your global headline font", 'dixi'),
			"id" => $shortname . "_" . $short_prefix . "headline_font",
            "type" => "select-preview",
            "box" => "2",
            "inblock" => "font",
            "std" => "Helvetica, Arial, sans-serif",
			"options" => array(
             "Helvetica, Arial, sans-serif",
            "Lucida Grande, Lucida Sans, sans-serif",
            "Arial, sans-serif",
											"Cantarell, arial, serif",
											"Cardo, arial, serif",
										    "Courier New, Courier, monospace",
											"Crimson Text, arial, serif",
											"Droid Sans, arial, serif",
											"Droid Serif, arial, serif",
								            "Garamond, Georgia, serif",
											"Georgia, arial, serif",
											"IM Fell DW Pica, arial, serif",
											"Josefin Sans Std Light, arial, serif",
											"Lobster, arial, serif",
											"Lucida Sans Unicode, Lucinda Grande, sans-serif",
											"Molengo, arial, serif",
											"Neuton, arial, serif",
											"Nobile, arial, serif",
											"OFL Sorts Mill Goudy TT, arial, serif",
											"Old Standard TT, arial, serif",
											"Reenie Beanie, arial, serif",
											"Tahoma, sans-serif",
											"Tangerine, arial, serif",
								            "Trebuchet MS, sans-serif",
								            "Verdana, sans-serif",
											"Vollkorn, arial, serif",
											"Yanone Kaffeesatz, arial, serif",
                                            "Just Another Hand, arial, serif",
                                            "Terminal Dosis Light, arial, serif",
                                            "Ubuntu, arial, serif"
            )
            ),

    array(	"name" => __("Choose your font size here?", 'dixi'),
			"id" => $shortname . "_" . $short_prefix . "font_size",
            "box" => "2",
            "inblock" => "font",
			"type" => "select",
            "std" => "normal",
			"options" => array("normal","small", "bigger", "largest")),


   array (	"name" => __("Change your global body font colour?", 'dixi'),
			"id" => $shortname. "_" . $short_prefix . "body_font_colour",
            "inblock" => "font",
            "custom" => "colourpicker",
            "box" => "2",
            "std" => "#1a1a1a",
			"type" => "text"),


    array (	"name" => __("Choose your prefered links colour?", 'dixi'),
            "id" => $shortname . "_" . $short_prefix . "content_link_colour",
            "inblock" => "font",
            "custom" => "colourpicker",
            "box" => "2",
            "std" => "",
			"type" => "text"),


    array (	"name" => __("Choose your prefered links <strong>hover</strong> colour?", 'dixi'),
			"id" => $shortname. "_" . $short_prefix . "content_link_hover_colour",
            "inblock" => "font",
            "custom" => "colourpicker",
            "box" => "2",
            "std" => "",
			"type" => "text"),


    array (	"name" => __("Choose your prefered <strong>post title</strong> links colour?", 'dixi'),
			"id" => $shortname. "_" . $short_prefix . "post_title_link_colour",
            "inblock" => "font",
            "custom" => "colourpicker",
            "box" => "2",
            "std" => "",
			"type" => "text"),




      array(	"name" => __("Choose your navigation font?", 'dixi'),
			"id" => $shortname . "_" . $short_prefix . "nav_font",
            "type" => "select-preview",
            "box" => "3",
            "inblock" => "nav",
            "std" => "Helvetica, Arial, sans-serif",
			"options" => array(
             "Helvetica, Arial, sans-serif",
            "Lucida Grande, Lucida Sans, sans-serif",
            "Arial, sans-serif",
											"Cantarell, arial, serif",
											"Cardo, arial, serif",
										    "Courier New, Courier, monospace",
											"Crimson Text, arial, serif",
											"Droid Sans, arial, serif",
											"Droid Serif, arial, serif",
								            "Garamond, Georgia, serif",
											"Georgia, arial, serif",
											"IM Fell DW Pica, arial, serif",
											"Josefin Sans Std Light, arial, serif",
											"Lobster, arial, serif",
											"Lucida Sans Unicode, Lucinda Grande, sans-serif",
											"Molengo, arial, serif",
											"Neuton, arial, serif",
											"Nobile, arial, serif",
											"OFL Sorts Mill Goudy TT, arial, serif",
											"Old Standard TT, arial, serif",
											"Reenie Beanie, arial, serif",
											"Tahoma, sans-serif",
											"Tangerine, arial, serif",
								            "Trebuchet MS, sans-serif",
								            "Verdana, sans-serif",
											"Vollkorn, arial, serif",
											"Yanone Kaffeesatz, arial, serif",
                                            "Just Another Hand, arial, serif",
                                            "Terminal Dosis Light, arial, serif",
                                            "Ubuntu, arial, serif"
            )
            ),


    array (	"name" => __("Choose your prefered navigation and footer colour?", 'dixi'),
            "id" => $shortname . "_" . $short_prefix . "nv_footer_colour",
            "inblock" => "nav",
            "custom" => "colourpicker",
            "box" => "3",
            "std" => "",
			"type" => "text"),


    array (	"name" => __("Choose your prefered navigation hover background colour?", 'dixi'),
			"id" => $shortname . "_" . $short_prefix . "nv_bg_hover_colour",
            "inblock" => "nav",
            "custom" => "colourpicker",
            "box" => "3",
            "std" => "",
			"type" => "text"),


   array (	"name" => __("Choose your prefered navigation dropdown background colour?", 'dixi'),
			"id" => $shortname . "_" . $short_prefix . "nv_dropdown_bg_colour",
            "inblock" => "nav",
            "custom" => "colourpicker",
            "box" => "3",
            "std" => "",
			"type" => "text"),

   array (	"name" => __("Choose your prefered navigation dropdown <strong>hover</strong> background colour?", 'dixi'),
			"id" => $shortname . "_" . $short_prefix . "nv_dropdown_bg_hover_colour",
            "inblock" => "nav",
            "custom" => "colourpicker",
            "box" => "3",
            "std" => "",
			"type" => "text"),

   array (	"name" => __("Choose your prefered navigation dropdown <strong>separate line</strong> colour?", 'dixi'),
			"id" => $shortname . "_" . $short_prefix . "nv_dropdown_line_colour",
            "inblock" => "nav",
            "custom" => "colourpicker",
            "box" => "3",
            "std" => "",
			"type" => "text"),


   array (	"name" => __("Choose your prefered navigation link text colour?", 'dixi'),
			"id" => $shortname . "_" . $short_prefix . "nv_link_colour",
            "inblock" => "nav",
            "custom" => "colourpicker",
            "box" => "3",
            "std" => "",
			"type" => "text"),


   array (	"name" => __("Choose your prefered navigation link text hover colour?", 'dixi'),
			"id" => $shortname . "_" . $short_prefix . "nv_link_hover_colour",
            "inblock" => "nav",
            "custom" => "colourpicker",
            "box" => "3",
            "std" => "",
			"type" => "text"),




    array (	"name" => sprintf(__("If you want to use an logo image in header:<br />upload your logo <a target=\"_blank\" href=\"%s\">here</a> and copy paste the full image url<br /><br /><em>*this will replace the site title text with logo image</em>", 'dixi'), admin_url("upload.php")),
			"id" => $shortname . "_" . $short_prefix . "header_logo_img",
            "inblock" => "custom-header",
            "box" => "3",
            "std" => "",
			"type" => "text"),


    array(	"name" => __("Do you want to used the custom image header *default: enable", 'dixi'),
            "id" => $shortname . "_" . $short_prefix . "header_on",
            "box" => "3",
            "inblock" => "custom-header",
			"type" => "select",
            "std" => "enable",
			"options" => array("enable","disable")),


    array (	"name" => __("Insert your desired custom header height?", 'dixi'),
            "id" => $shortname . "_" . $short_prefix . "image_height",
            "inblock" => "custom-header",
            "box" => "3",
            "std" => "150",
			"type" => "text"),


    array(	"name" => __("Enter a link for your custom image header<br />*default: link to homepage", 'dixi'),
			"id" => $shortname . "_" . $short_prefix . "header_link",
            "box" => "3",
            "inblock" => "custom-header",
			"type" => "text",
            "std" => "",
            ),

    array(	"name" => __("Featured Video Embed Code *optional", 'dixi'),
            "id" => $shortname . "_" . $short_prefix . "featured_vid",
            "inblock" => "vid",
            "box" => "2",
            "std" => "",
			"type" => "textarea"),



   ////feed one//////

    array(	"name" => __("<strong>Insert the first rss feed name here</strong>", 'dixi'),
			"id" => $shortname . "_" . $short_prefix . "rss_one",
            "inblock" => "rssnetwork",
            "box" => "3",
            "std" => "",
			"type" => "text"),

    array(	"name" => __("Insert the first feed url you'd like to display here: (etc: http://sitename/feed or feedburner feed url)", 'dixi'),
            "id" => $shortname . "_" . $short_prefix . "rss_one_url",
            "inblock" => "rssnetwork",
            "box" => "3",
            "std" => "",
			"type" => "text"),


    array(	"name" => __("How many post feeds to show?", 'dixi'),
            "id" => $shortname . "_" . $short_prefix . "rss_one_sum",
            "box" => "3",
            "inblock" => "rssnetwork",
       		"type" => "select",
            "std" => "3",
			"options" => array("3", "4", "5", "6", "7", "8", "9", "10")),


    array(	"name" => __("How many word count to pull from your feeds?", 'dixi'),
            "id" => $shortname . "_" . $short_prefix . "rss_one_wordcount",
            "inblock" => "rssnetwork",
            "box" => "3",
            "std" => "150",
			"type" => "text"),



   ////feed two//////

    array(	"name" => __("<br /><strong>Insert the second feed name here</strong>", 'dixi'),
			"id" => $shortname . "_" . $short_prefix . "rss_two",
            "inblock" => "rssnetwork",
            "box" => "3",
            "std" => "",
			"type" => "text"),

    array(	"name" => __("Insert the second feed url you'd like to display here: (etc: http://sitename/feed or feedburner feed url)", 'dixi'),
            "id" => $shortname . "_" . $short_prefix . "rss_two_url",
            "inblock" => "rssnetwork",
            "box" => "3",
            "std" => "",
			"type" => "text"),


    array(	"name" => __("How many post feeds to show?", 'dixi'),
            "id" => $shortname . "_" . $short_prefix . "rss_two_sum",
            "box" => "3",
            "inblock" => "rssnetwork",
       		"type" => "select",
            "std" => "3",
			"options" => array("3", "4", "5", "6", "7", "8", "9", "10")),


    array(	"name" => __("How many word count to pull from your feeds?", 'dixi'),
            "id" => $shortname . "_" . $short_prefix . "rss_two_wordcount",
            "inblock" => "rssnetwork",
            "box" => "3",
            "std" => "150",
			"type" => "text"),



////feed third//////

    array(	"name" => __("<br /><strong>Insert the third feed name here</strong>", 'dixi'),
			"id" => $shortname . "_" . $short_prefix . "rss_three",
            "inblock" => "rssnetwork",
            "box" => "3",
            "std" => "",
			"type" => "text"),

    array(	"name" => __("Insert the third feed url you'd like to display here: (etc: http://sitename/feed or feedburner feed url)", 'dixi'),
            "id" => $shortname . "_" . $short_prefix . "rss_three_url",
            "inblock" => "rssnetwork",
            "box" => "3",
            "std" => "",
			"type" => "text"),


    array(	"name" => __("How many post feeds to show?", 'dixi'),
            "id" => $shortname . "_" . $short_prefix . "rss_three_sum",
            "box" => "3",
            "inblock" => "rssnetwork",
       		"type" => "select",
            "std" => "3",
			"options" => array("3", "4", "5", "6", "7", "8", "9", "10")),


    array(	"name" => __("How many word count to pull from your feeds?", 'dixi'),
            "id" => $shortname . "_" . $short_prefix . "rss_three_wordcount",
            "inblock" => "rssnetwork",
            "box" => "3",
            "std" => "150",
			"type" => "text"),


////feed fourth//////

    array(	"name" => __("<br /><strong>Insert the fourth feed name here</strong>", 'dixi'),
			"id" => $shortname . "_" . $short_prefix . "rss_four",
            "inblock" => "rssnetwork",
            "box" => "3",
            "std" => "",
			"type" => "text"),

    array(	"name" => __("Insert the fourth feed url you'd like to display here: (etc: http://sitename/feed or feedburner feed url)", 'dixi'),
            "id" => $shortname . "_" . $short_prefix . "rss_four_url",
            "inblock" => "rssnetwork",
            "box" => "3",
            "std" => "",
			"type" => "text"),


    array(	"name" => __("How many post feeds to show?", 'dixi'),
            "id" => $shortname . "_" . $short_prefix . "rss_four_sum",
            "box" => "3",
            "inblock" => "rssnetwork",
       		"type" => "select",
            "std" => "3",
			"options" => array("3", "4", "5", "6", "7", "8", "9", "10")),


    array(	"name" => __("How many word count to pull from your feeds?", 'dixi'),
            "id" => $shortname . "_" . $short_prefix . "rss_four_wordcount",
            "inblock" => "rssnetwork",
            "box" => "3",
            "std" => "150",
			"type" => "text"),

////feed fifth//////

    array(	"name" => __("<br /><strong>Insert the fifth feed name here</strong>", 'dixi'),
			"id" => $shortname . "_" . $short_prefix . "rss_five",
            "inblock" => "rssnetwork",
            "box" => "3",
            "std" => "",
			"type" => "text"),

    array(	"name" => __("Insert the fifth feed url you'd like to display here: (etc: http://sitename/feed or feedburner feed url)", 'dixi'),
            "id" => $shortname . "_" . $short_prefix . "rss_five_url",
            "inblock" => "rssnetwork",
            "box" => "3",
            "std" => "",
			"type" => "text"),


    array(	"name" => __("How many post feeds to show?", 'dixi'),
            "id" => $shortname . "_" . $short_prefix . "rss_five_sum",
            "box" => "3",
            "inblock" => "rssnetwork",
       		"type" => "select",
            "std" => "3",
			"options" => array("3", "4", "5", "6", "7", "8", "9", "10")),


    array(	"name" => __("How many word count to pull from your feeds?", 'dixi'),
            "id" => $shortname . "_" . $short_prefix . "rss_five_wordcount",
            "inblock" => "rssnetwork",
            "box" => "3",
            "std" => "150",
			"type" => "text"),


/////////////end rss//////////////////

array(
"name" => __("Do you want to enable <strong>privacy</strong> on all members profile for not logged in user<br /><em>* only logged in user can view members profile and members directory. 'disable' by default</em>", TEMPLATE_DOMAIN),
"id" => $shortname . "_" . $short_prefix . "privacy_status",
"box"=> "1",
"header-title" => __("Global Privacy Setting", TEMPLATE_DOMAIN),
"inblock" => "buddypress",
"type" => "select",
"std" => "disable",
"options" => array("disable","enable")),

array(
"name" => __("if you enable the <strong>privacy</strong> on all members profile for none logged in user, insert the full url link they will be redirect to for non logged in users<br /><em>*optional - leave empty for default<br />default are buddypress register link<br /> " . site_url() . '/' . $member_reg_slug . '/' . "</em>", TEMPLATE_DOMAIN),
"id" => $shortname . "_" . $short_prefix . "privacy_redirect",
"box"=> "1",
"inblock" => "buddypress",
"type" => "text",
"std" => "",
),

array(
"name" => __("Do you want to enable <strong>friend only privacy</strong> for user profile<br /><em>* only friend can view friend profile. network/super admin were exclude from this condition. 'disable' by default</em>", TEMPLATE_DOMAIN),
"id" => $shortname . "_" . $short_prefix . "friend_privacy_status",
"header-title" => __("Users Privacy Setting", TEMPLATE_DOMAIN),
"box"=> "1",
"inblock" => "buddypress",
"type" => "select",
"std" => "disable",
"options" => array("disable","enable")),

array(
"name" => __("if you enable the <strong>friend privacy</strong> for user profile, insert the full url link they will be redirect when viewing a none friend user<br /><em>*optional - leave empty for default<br />default are buddypress homepage link<br /> " . site_url() . '/' . "</em>", TEMPLATE_DOMAIN),
"id" => $shortname . "_" . $short_prefix . "friend_privacy_redirect",
"box"=> "1",
"inblock" => "buddypress",
"type" => "text",
"std" => "",
),


array(
"name" => __("Do you want to allowed only <strong>admin and moderators</strong> to create group? <em>* if yes, normal users cannot create group and can only join groups created by admin and moderators. 'no' by default</em>", TEMPLATE_DOMAIN),
"id" => $shortname . "_" . $short_prefix . "create_group_status",
"header-title" => __("Groups Privacy Setting", TEMPLATE_DOMAIN),
"box"=> "1",
"inblock" => "buddypress",
"type" => "select",
"std" => "no",
"options" => array("no","yes")),

array(
"name" => __("if you enable for the only <strong>admins and editors</strong> to create group, insert the full url link they will be redirect to for non admins and editors users when they click <strong>create group</strong> button<br /><em>*optional - leave empty for default<br />default are buddypress root domain<br /> " . $the_privacy_root . '/' . "</em>", TEMPLATE_DOMAIN),
"id" => $shortname . "_" . $short_prefix . "create_group_redirect",
"box"=> "1",
"inblock" => "buddypress",
"type" => "text",
"std" => "",
),

array(
"name" => __("Do you want to enable facebook like it in Activity Stream",TEMPLATE_DOMAIN),
"description" => __("you can enable facebook like in stream but this is a bandwith hog features 'disable' by default", TEMPLATE_DOMAIN),
"id" => $shortname . "_" . $short_prefix . "stream_facebook_like_status",
"inblock" => "buddypress",
"type" => "select",
"box" => "1",
"std" => "disable",
"options" => array("disable","enable"))

);










function mytheme_wpmu_dixi_admin() {
global $themename, $shortname, $options, $short_prefix, $bp_existed;
if ( isset($_REQUEST['saved']) && $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename. __(' settings saved.', 'dixi') . '</strong></p></div>';
if ( isset($_REQUEST['reset']) && $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename. __(' settings reset.', 'dixi') . '</strong></p></div>';
?>



<div class="wrap" id="wrap-admin">
<div id="content-admin">
<?php screen_icon('tools'); echo "<h2>" . $themename . __( ' Theme Options', TEMPLATE_DOMAIN ) . "</h2>"; ?>
<br />


<div class="admin-content">
<form method="post" id="option-mz-form">


<?php
if ($values['box'] = '1') { ?>

<div class="admin-layer">


<?php
if( is_multisite() ) {

if( is_main_site() ) {

  $bg_color = 'multisite_adminbar_bg_color';
  $bg_hover_color = 'multisite_adminbar_hover_bg_color'; ?>

<div class="option-box" id="bp-setting">
<h4><?php _e('Adminbar Settings', TEMPLATE_DOMAIN); ?></h4>

<div id="<?php echo $bg_color; ?>" class="pwrap">
<p><?php _e( 'Choose your adminbar background color', TEMPLATE_DOMAIN ); ?></p>
<div class="input-option">
<p><input class="ops-colour color {pickerPosition:'top',styleElement:'pick 88',required:false,hash:true}" name="<?php echo $bg_color; ?>" id="colorpickerField88" type="text" value="<?php if ( get_site_option( $bg_color ) != "") { echo get_site_option( $bg_color ); } ?>" />
<br />
<input class="pick" id="pick 88">
</p>
</div>
</div>

<?php if($bp_existed == 'true'): ?>

<div id="<?php echo $bg_hover_color; ?>" class="pwrap">
<p><?php _e( 'Choose your adminbar background hover color', TEMPLATE_DOMAIN ); ?></p>
<div class="input-option">
<p><input class="ops-colour color {pickerPosition:'top',styleElement:'pick 89',required:false,hash:true}" name="<?php echo $bg_hover_color; ?>" id="colorpickerField89" type="text" value="<?php if ( get_site_option( $bg_hover_color ) != "") { echo get_site_option( $bg_hover_color ); } ?>" />
<br />
<input class="pick" id="pick 89">
</p>
</div>
</div>

<?php endif; ?>

    </div>

<?php } } else {

  $bg_color = $shortname . "_" . $short_prefix . 'adminbar_bg_color';
  $bg_hover_color = $shortname . "_" . $short_prefix . 'adminbar_hover_bg_color'; ?>

  <div class="option-box" id="bp-setting">
<h4><?php _e('Adminbar Settings', TEMPLATE_DOMAIN); ?></h4>
<div id="<?php echo $bg_color; ?>" class="tab-option">
<div class="description"><?php _e( 'Choose your adminbar background color', TEMPLATE_DOMAIN ); ?><br /><span></span></div>
<div class="input-option"><p><input class="color {required:false,hash:true}" name="<?php echo $bg_color; ?>" id="colorpickerField88" type="text" value="<?php if ( get_option( $bg_color ) != "" ) { echo get_option( $bg_color ); } ?>" /></p></div>
</div>
                                 <?php if($bp_existed == 'true'): ?>
<div id="<?php echo $bg_hover_color; ?>" class="tab-option">
<div class="description"><?php _e( 'Choose your adminbar background hover color', TEMPLATE_DOMAIN ); ?><br /><span></span></div>
<div class="input-option"><p><input class="color {required:false,hash:true}" name="<?php echo $bg_hover_color; ?>" id="colorpickerField89" type="text" value="<?php if ( get_option( $bg_hover_color ) != ""  ) { echo get_option( $bg_hover_color ); } ?>" /></p></div>
</div>
   <?php endif; ?>
         </div>
<?php } ?>




<div class="option-box" id="main-layout-setting">
<h4><?php _e('Blog Layout Settings', 'dixi'); ?></h4>
<?php foreach ($options as $value) {

if (isset($value['inblock']) && isset($value['type']) && isset($value['custom']) && ($value['inblock'] == "content-layout") && ($value['type'] == "text") && ($value['custom'] == "colourpicker")) { ?>

<div class="pwrap">
<?php $i == $i++ ; ?>
<p><?php echo $value['name']; ?>:</p>
<p><input class="ops-colour color {pickerPosition:'top',styleElement:'pick <?php echo $i; ?>',required:false,hash:true}" name="<?php echo $value['id']; ?>" id="colorpickerField<?php echo $i; ?>" type="text" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" />
<br />
<input class="pick" id="pick <?php echo $i; ?>">
</p></div>

<?php } elseif (($value['inblock'] == "content-layout") && ($value['type'] == "text")) { ?>

<div class="pwrap">
<p><?php echo $value['name']; ?>:</p>
<p><input name="<?php echo $value['id']; ?>" class="ops-text" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" /></p></div>

<?php } elseif (($value['inblock'] == "content-layout") && ($value['type'] == "select")) { ?>

<div class="pwrap">
<p><?php echo $value['name']; ?>:</p>
<p><select name="<?php echo $value['id']; ?>" class="ops-select" id="<?php echo $value['id']; ?>">
<?php foreach ($value['options'] as $option) { ?>
<option<?php if ( get_option( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option>
<?php } ?>
</select>
</p></div>

<?php } elseif (($value['inblock'] == "content-layout") && ($value['type'] == "textarea")) { ?>

<div class="pwrap">
<p><?php echo $value['name']; ?>:</p>
<?php $valuex = $value['id'];
$valuey = stripslashes($valuex);
$video_code = get_option($valuey);
?>
<p><textarea class="ops-area" name="<?php echo $valuey; ?>" cols="40%" rows="8" /><?php if ( get_option($valuey) != "") { echo stripslashes($video_code); } else { echo $value['std']; } ?></textarea>
</p></div>
<?php }
}
?>
</div>





<div class="option-box" id="main-setting">
<h4><?php _e('Blog Main Settings', 'dixi'); ?></h4>
<?php foreach ($options as $value) {

if (isset($value['inblock']) && isset($value['type']) && isset($value['custom']) && ($value['inblock'] == "main-layout") && ($value['type'] == "text") && ($value['custom'] == "colourpicker")) { ?>

<div class="pwrap">
<?php $i == $i++ ; ?>
<p><?php echo $value['name']; ?>:</p>
<p><input class="ops-colour color {pickerPosition:'top',styleElement:'pick <?php echo $i; ?>',required:false,hash:true}" name="<?php echo $value['id']; ?>" id="colorpickerField<?php echo $i; ?>" type="text" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" />
<br />
<input class="pick" id="pick <?php echo $i; ?>">
</p></div>

<?php } elseif (($value['inblock'] == "main-layout") && ($value['type'] == "text")) { ?>

<div class="pwrap">
<p><?php echo $value['name']; ?>:</p>
<p><input name="<?php echo $value['id']; ?>" class="ops-text" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" /></p></div>

<?php } elseif (($value['inblock'] == "main-layout") && ($value['type'] == "select")) { ?>

<div class="pwrap">
<p><?php echo $value['name']; ?>:</p>
<p><select name="<?php echo $value['id']; ?>" class="ops-select" id="<?php echo $value['id']; ?>">
<?php foreach ($value['options'] as $option) { ?>
<option<?php if ( get_option( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option>
<?php } ?>
</select>
</p></div>

<?php } elseif (($value['inblock'] == "main-layout") && ($value['type'] == "textarea")) { ?>

<div class="pwrap">
<p><?php echo $value['name']; ?>:</p>
<?php $valuex = $value['id'];
$valuey = stripslashes($valuex);
$video_code = get_option($valuey);
?>
<p><textarea class="ops-area" name="<?php echo $valuey; ?>" cols="40%" rows="8" /><?php if ( get_option($valuey) != "") { echo stripslashes($video_code); } else { echo $value['std']; } ?></textarea>
</p></div>
<?php }
}
?>
</div>



<?php if($bp_existed == 'true') { ?>

<div class="option-box" id="bp-setting">
<h4><?php _e('BuddyPress Settings', TEMPLATE_DOMAIN); ?></h4>
<?php foreach ($options as $value) {

if (($value['inblock'] == "buddypress") && ($value['type'] == "colorpicker")) { ?>

<div class="pwrap">
<?php $i == $i++ ; ?>
<p><?php echo $value['name']; ?>:</p>
<p><input class="ops-colour color {pickerPosition:'top',styleElement:'pick <?php echo $i; ?>',required:false,hash:true}" name="<?php echo $value['id']; ?>" id="colorpickerField<?php echo $i; ?>" type="text" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" />
<br />
<input class="pick" id="pick <?php echo $i; ?>">
</p></div>

<?php } elseif (($value['inblock'] == "buddypress") && ($value['type'] == "text")) { ?>

<div class="pwrap">
<p><?php echo $value['name']; ?>:</p>
<p><input name="<?php echo $value['id']; ?>" class="ops-text" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" /></p></div>

<?php } elseif (($value['inblock'] == "buddypress") && ($value['type'] == "select")) { ?>

<div class="pwrap">
<p><?php echo $value['name']; ?>:</p>
<p><select name="<?php echo $value['id']; ?>" class="ops-select" id="<?php echo $value['id']; ?>">
<?php foreach ($value['options'] as $option) { ?>
<option<?php if ( get_option( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option>
<?php } ?>
</select>
</p></div>

<?php } elseif (($value['inblock'] == "buddypress") && ($value['type'] == "textarea")) { ?>

<div class="pwrap">
<p><?php echo $value['name']; ?>:</p>
<?php $valuex = $value['id'];
$valuey = stripslashes($valuex);
$video_code = get_option($valuey);
?>
<p><textarea class="ops-area" name="<?php echo $valuey; ?>" cols="40%" rows="8" /><?php if ( get_option($valuey) != "") { echo stripslashes($video_code); } else { echo $value['std']; } ?></textarea>
</p></div>
<?php }
}
?>
</div>

<?php } ?>


<div class="option-box">
<h4><?php _e('Blog Post Settings', 'dixi'); ?></h4>
<?php foreach ($options as $value) {

if (($value['inblock'] == "post") && ($value['type'] == "text")) { ?>

<div class="pwrap">
<p><?php echo $value['name']; ?>:</p>
<p><input name="<?php echo $value['id']; ?>" class="ops-text" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" /></p></div>

<?php } elseif (($value['inblock'] == "post") && ($value['type'] == "select")) { ?>

<div class="pwrap">
<p><?php echo $value['name']; ?>:</p>
<p><select name="<?php echo $value['id']; ?>" class="ops-select" id="<?php echo $value['id']; ?>">
<?php foreach ($value['options'] as $option) { ?>
<option<?php if ( get_option( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option>
<?php } ?>
</select>
</p></div>

<?php } elseif (($value['inblock'] == "post") && ($value['type'] == "textarea")) { ?>

<div class="pwrap">
<p><?php echo $value['name']; ?>:</p>
<?php $valuex = $value['id'];
$valuey = stripslashes($valuex);
$video_code = get_option($valuey);
?>
<p><textarea class="ops-area" name="<?php echo $valuey; ?>" cols="40%" rows="8" /><?php if ( get_option($valuey) != "") { echo stripslashes($video_code); } else { echo $value['std']; } ?></textarea>
</p></div>
<?php }
}
?>
</div>

<div class="option-box">
<h4><?php _e('Blog Layout Settings', 'dixi'); ?></h4>
<?php
$i = isset($i)?$i:0;
foreach ($options as $value) {

if (isset($value['inblock']) && isset($value['type']) && isset($value['custom']) && ($value['inblock'] == "layout") && ($value['type'] == "text") && ($value['custom'] == "colourpicker")) { ?>

<div class="pwrap">
<?php $i == $i++ ; ?>
<p><?php echo $value['name']; ?>:</p>
<p><input class="ops-colour color {pickerPosition:'top',styleElement:'pick <?php echo $i; ?>',required:false,hash:true}" name="<?php echo $value['id']; ?>" id="colorpickerField<?php echo $i; ?>" type="text" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" />
<br />
<input class="pick" id="pick <?php echo $i; ?>">
</p></div>

<?php } elseif (($value['inblock'] == "layout") && ($value['type'] == "text")) { ?>

<div class="pwrap">
<p><?php echo $value['name']; ?>:</p>
<p><input name="<?php echo $value['id']; ?>" class="ops-text" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" /></p></div>

<?php } elseif (($value['inblock'] == "layout") && ($value['type'] == "select")) { ?>

<div class="pwrap">
<p><?php echo $value['name']; ?>:</p>
<p><select name="<?php echo $value['id']; ?>" class="ops-select" id="<?php echo $value['id']; ?>">
<?php foreach ($value['options'] as $option) { ?>
<option<?php if ( get_option( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option>
<?php } ?>
</select>
</p></div>

<?php } elseif (($value['inblock'] == "layout") && ($value['type'] == "textarea")) { ?>

<div class="pwrap">
<p><?php echo $value['name']; ?>:</p>
<?php $valuex = $value['id'];
$valuey = stripslashes($valuex);
$video_code = get_option($valuey);
?>
<p><textarea class="ops-area" name="<?php echo $valuey; ?>" cols="40%" rows="8" /><?php if ( get_option($valuey) != "") { echo stripslashes($video_code); } else { echo $value['std']; } ?></textarea>
</p></div>
<?php }
}
?>
</div>

</div>
<?php } ?>




<?php

if ($values['box'] = '2') { ?>

<div class="admin-layer">

<div class="option-box">
<h4><?php _e('Blog Fonts Settings', 'dixi'); ?></h4>
<?php foreach ($options as $value) {
if (($value['inblock'] == "font") && ($value['type'] == "text") && ($value['custom'] == "colourpicker")) { ?>

<div class="pwrap">
<?php $i == $i++ ; ?>
<p><?php echo $value['name']; ?>:</p>
<p><input class="ops-colour color {pickerPosition:'top',styleElement:'pick <?php echo $i; ?>',required:false,hash:true}" name="<?php echo $value['id']; ?>" id="colorpickerField<?php echo $i; ?>" type="text" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" />
<br />
<input class="pick" id="pick <?php echo $i; ?>">
</p></div>

<?php } elseif (($value['inblock'] == "font") && ($value['type'] == "text") && ($value['custom'] == "colourpicker")) { ?>

<div class="pwrap">
<p><?php echo $value['name']; ?>:</p>
<p><input name="<?php echo $value['id']; ?>" class="ops-colour" id="vtrColorPicker" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" /></p></div>

<?php } elseif (($value['inblock'] == "font") && ($value['type'] == "text")) { ?>

<div class="pwrap">
<p><?php echo $value['name']; ?>:</p>
<p><input name="<?php echo $value['id']; ?>" class="ops-text" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" /></p></div>

<?php } elseif (($value['inblock'] == "font") && ($value['type'] == "select")) { ?>

<div class="pwrap">
<p><?php echo $value['name']; ?>:</p>
<p><select name="<?php echo $value['id']; ?>" class="ops-select" id="<?php echo $value['id']; ?>">
<?php foreach ($value['options'] as $option) { ?>
<option<?php if ( get_option( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option>
<?php } ?>
</select>
</p></div>


<?php } elseif (($value['inblock'] == "font") && ($value['type'] == "select-preview") ) { // setting ?>


<div class="pwrap">
<p><?php echo $value['name']; ?>:</p>
<p><select name="<?php echo $value['id']; ?>" class="ops-select" id="<?php echo $value['id']; ?>">
<?php foreach ($value['options'] as $option) { ?>
<option style="font-family:<?php echo $option; ?>;" <?php if ( get_option( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option>
<?php } ?>
</select>
</p></div>


<?php } elseif (($value['inblock'] == "font") && ($value['type'] == "textarea")) { ?>

<div class="pwrap">
<p><?php echo $value['name']; ?>:</p>
<?php $valuex = $value['id'];
$valuey = stripslashes($valuex);
$video_code = get_option($valuey);
?>
<p><textarea class="ops-area" name="<?php echo $valuey; ?>" cols="40%" rows="8" /><?php if ( get_option($valuey) != "") { echo stripslashes($video_code); } else { echo $value['std']; } ?></textarea>
</p></div>
<?php }
}
?>
</div>



<div class="option-box">
<h4><?php _e('Navigation &amp; Footer Colour Settings', 'dixi'); ?></h4>
<?php foreach ($options as $value) {

if (($value['inblock'] == "nav") && ($value['type'] == "text") && ($value['custom'] == "colourpicker")) { ?>

<div class="pwrap">
<?php $i == $i++ ; ?>
<p><?php echo $value['name']; ?>:</p>
<p><input class="ops-colour color {pickerPosition:'top',styleElement:'pick <?php echo $i; ?>',required:false,hash:true}" name="<?php echo $value['id']; ?>" id="colorpickerField<?php echo $i; ?>" type="text" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" />
<br />
<input class="pick" id="pick <?php echo $i; ?>">
</p></div>

<?php } elseif (($value['inblock'] == "nav") && ($value['type'] == "text")) { ?>

<div class="pwrap">
<p><?php echo $value['name']; ?>:</p>
<p><input name="<?php echo $value['id']; ?>" class="ops-text" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" /></p></div>

<?php } elseif (($value['inblock'] == "nav") && ($value['type'] == "select")) { ?>

<div class="pwrap">
<p><?php echo $value['name']; ?>:</p>
<p><select name="<?php echo $value['id']; ?>" class="ops-select" id="<?php echo $value['id']; ?>">
<?php foreach ($value['options'] as $option) { ?>
<option<?php if ( get_option( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option>
<?php } ?>
</select>
</p></div>


<?php } elseif (($value['inblock'] == "nav") && ($value['type'] == "select-preview") ) { // setting ?>


<div class="pwrap">
<p><?php echo $value['name']; ?>:</p>
<p><select name="<?php echo $value['id']; ?>" class="ops-select" id="<?php echo $value['id']; ?>">
<?php foreach ($value['options'] as $option) { ?>
<option style="font-family:<?php echo $option; ?>;" <?php if ( get_option( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option>
<?php } ?>
</select>
</p></div>


<?php } elseif (($value['inblock'] == "nav") && ($value['type'] == "textarea")) { ?>

<div class="pwrap">
<p><?php echo $value['name']; ?>:</p>
<?php $valuex = $value['id'];
$valuey = stripslashes($valuex);
$video_code = get_option($valuey);
?>
<p><textarea class="ops-area" name="<?php echo $valuey; ?>" cols="40%" rows="8" /><?php if ( get_option($valuey) != "") { echo stripslashes($video_code); } else { echo $value['std']; } ?></textarea>
</p></div>
<?php }
}
?>
</div>



<div class="option-box">
<h4><?php _e('Header Settings', 'dixi'); ?></h4>
<?php foreach ($options as $value) {

if (($value['inblock'] == "custom-header") && ($value['type'] == "text")) { ?>

<div class="pwrap">
<p><?php echo $value['name']; ?>:</p>
<p><input name="<?php echo $value['id']; ?>" class="ops-text" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" /></p></div>

<?php } elseif (($value['inblock'] == "custom-header") && ($value['type'] == "select")) { ?>

<div class="pwrap">
<p><?php echo $value['name']; ?>:</p>
<p><select name="<?php echo $value['id']; ?>" class="ops-select" id="<?php echo $value['id']; ?>">
<?php foreach ($value['options'] as $option) { ?>
<option<?php if ( get_option( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option>
<?php } ?>
</select>
</p></div>

<?php } elseif (($value['inblock'] == "custom-header") && ($value['type'] == "textarea")) { ?>

<div class="pwrap">
<p><?php echo $value['name']; ?>:</p>
<?php $valuex = $value['id'];
$valuey = stripslashes($valuex);
$video_code = get_option($valuey);
?>
<p><textarea class="ops-area" name="<?php echo $valuey; ?>" cols="40%" rows="8" /><?php if ( get_option($valuey) != "") { echo stripslashes($video_code); } else { echo $value['std']; } ?></textarea>
</p></div>
<?php }
}
?>
</div>

<div class="option-box">
<h4><?php _e('Video Settings', 'dixi'); ?></h4>
<?php foreach ($options as $value) {

if (($value['inblock'] == "vid") && ($value['type'] == "text") && ($value['custom'] == "colourpicker")) { ?>

<div class="pwrap">
<?php $i == $i++ ; ?>
<p><?php echo $value['name']; ?>:</p>
<p><input class="ops-colour color {pickerPosition:'top',styleElement:'pick <?php echo $i; ?>',required:false,hash:true}" name="<?php echo $value['id']; ?>" id="colorpickerField<?php echo $i; ?>" type="text" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" />
<br />
<input class="pick" id="pick <?php echo $i; ?>">
</p></div>

<?php } elseif (($value['inblock'] == "vid") && ($value['type'] == "text")) { ?>

<div class="pwrap">
<p><?php echo $value['name']; ?>:</p>
<p><input name="<?php echo $value['id']; ?>" class="ops-text" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" /></p></div>

<?php } elseif (($value['inblock'] == "vid") && ($value['type'] == "select")) { ?>

<div class="pwrap">
<p><?php echo $value['name']; ?>:</p>
<p><select name="<?php echo $value['id']; ?>" class="ops-select" id="<?php echo $value['id']; ?>">
<?php foreach ($value['options'] as $option) { ?>
<option<?php if ( get_option( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option>
<?php } ?>
</select>
</p></div>

<?php } elseif (($value['inblock'] == "vid") && ($value['type'] == "textarea")) { ?>

<div class="pwrap">
<p><?php echo $value['name']; ?>:</p>
<?php $valuex = $value['id'];
$valuey = stripslashes($valuex);
$video_code = get_option($valuey);
?>
<p><textarea class="ops-area" name="<?php echo $valuey; ?>" cols="40%" rows="8" /><?php if ( get_option($valuey) != "") { echo stripslashes($video_code); } else { echo $value['std']; } ?></textarea>
</p></div>
<?php }
}
?>
</div>

</div><!-- admin-layer -->
<?php } ?>





<?php

if ($values['box'] = '3') { ?>

<div class="admin-layer">

<div class="option-box">
<h4><?php _e('RSS Networks Settings', 'dixi'); ?></h4>
<?php foreach ($options as $value) {

if (isset($value['inblock']) && isset($value['type']) && isset($value['custom']) && ($value['inblock'] == "rssnetwork") && ($value['type'] == "text") && ($value['custom'] == "colourpicker")) { ?>

<div class="pwrap">
<?php $i == $i++ ; ?>
<p><?php echo $value['name']; ?>:</p>
<p><input class="ops-colour color {pickerPosition:'top',styleElement:'pick <?php echo $i; ?>',required:false,hash:true}" name="<?php echo $value['id']; ?>" id="colorpickerField<?php echo $i; ?>" type="text" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" />
<br />
<input class="pick" id="pick <?php echo $i; ?>">
</p></div>

<?php } elseif (($value['inblock'] == "rssnetwork") && ($value['type'] == "text")) { ?>

<div class="pwrap">
<p><?php echo $value['name']; ?>:</p>
<p><input name="<?php echo $value['id']; ?>" class="ops-text" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" /></p></div>

<?php } elseif (($value['inblock'] == "rssnetwork") && ($value['type'] == "select")) { ?>

<div class="pwrap">
<p><?php echo $value['name']; ?>:</p>
<p><select name="<?php echo $value['id']; ?>" class="ops-select" id="<?php echo $value['id']; ?>">
<?php foreach ($value['options'] as $option) { ?>
<option<?php if ( get_option( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option>
<?php } ?>
</select>
</p></div>

<?php } elseif (($value['inblock'] == "rssnetwork") && ($value['type'] == "textarea")) { ?>

<div class="pwrap">
<p><?php echo $value['name']; ?>:</p>
<?php $valuex = $value['id'];
$valuey = stripslashes($valuex);
$video_code = get_option($valuey);
?>
<p><textarea class="ops-area" name="<?php echo $valuey; ?>" cols="40%" rows="8" /><?php if ( get_option($valuey) != "") { echo stripslashes($video_code); } else { echo $value['std']; } ?></textarea>
</p></div>
<?php }
}
?>
</div>

</div><!-- admin-layer -->

<?php } ?>

<p class="submit">
<input name="save" type="submit" style="font-size: 16px !important; padding: 0.25em 2em; height: 32px;" class="button-primary" value="<?php echo esc_attr(__('Save Options', TEMPLATE_DOMAIN)); ?>" />
<input type="hidden" name="action" value="save" />
</p>
</form>

<form id="reset-options" method="post">
<p class="submit">
<strong><?php _e("By hitting this reset button, all saved options will be reset and restore to default",TEMPLATE_DOMAIN); ?></strong>&nbsp;&nbsp;
<input name="reset" type="submit" class="button-secondary" onclick="return confirm('Are you sure you want to reset all saved settings?. This action cannot be restore.')" value="<?php echo esc_attr(__('Reset Options', TEMPLATE_DOMAIN)); ?>" />
<input type="hidden" name="action" value="reset" />
</p>
</form>

</div>
</div>
</div>

<?php }

function mytheme_add_wpmu_dixi_admin() {
global $themename, $shortname, $options;
if ( isset($_GET['page']) && $_GET['page'] == "functions.php" ) {
if ( isset($_REQUEST['action']) && 'save' == $_REQUEST['action'] ) {

         if( is_multisite()):

$post_bg_color = $_POST[ 'multisite_adminbar_bg_color' ];
$post_hover_bg_color = $_POST[ 'multisite_adminbar_hover_bg_color' ];

update_site_option('multisite_adminbar_bg_color', $post_bg_color );
update_site_option('multisite_adminbar_hover_bg_color', $post_hover_bg_color );

if( isset( $_REQUEST[ 'multisite_adminbar_bg_color' ] ) ) {
update_site_option('multisite_adminbar_bg_color', $post_bg_color );
} else {
delete_site_option('multisite_adminbar_bg_color' );
}

if( isset( $_REQUEST[ 'multisite_adminbar_hover_bg_color' ] ) ) {
update_site_option('multisite_adminbar_hover_bg_color', $post_hover_bg_color );
} else {
delete_site_option('multisite_adminbar_hover_bg_color' );
}

  else:

$post_bg_color = $_POST[ 'tn_wpmu_dixi_adminbar_bg_color' ];
$post_hover_bg_color = $_POST[ 'tn_wpmu_dixi_adminbar_hover_bg_color' ];

update_option('tn_wpmu_dixi_adminbar_bg_color', $post_bg_color );
update_option('tn_wpmu_dixi_adminbar_hover_bg_color', $post_hover_bg_color );

if( isset( $_REQUEST[ 'tn_wpmu_dixi_adminbar_bg_color' ] ) ) {
update_option('tn_wpmu_dixi_adminbar_bg_color', $post_bg_color );
} else {
delete_option('tn_wpmu_dixi_adminbar_bg_color' );
}

if( isset( $_REQUEST[ 'tn_wpmu_dixi_adminbar_hover_bg_color' ] ) ) {
update_option('tn_wpmu_dixi_adminbar_hover_bg_color', $post_hover_bg_color );
} else {
delete_option('tn_wpmu_dixi_adminbar_hover_bg_color' );
}

endif;


foreach ($options as $value) {
update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }
foreach ($options as $value) {
if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } }
header("Location: themes.php?page=functions.php&saved=true");
die;
} else if( isset($_REQUEST['action']) && 'reset' == $_REQUEST['action'] ) {

            if( is_multisite()) {
  delete_site_option('multisite_adminbar_bg_color');
  delete_site_option('multisite_adminbar_hover_bg_color');
  } else {
  delete_option('tn_wpmu_dixi_adminbar_bg_color');
  delete_option('tn_wpmu_dixi_adminbar_hover_bg_color');
  }

foreach ($options as $value) {
delete_option( $value['id'] ); }
header("Location: themes.php?page=functions.php&reset=true");
die;
} else if( isset($_REQUEST['action']) && 'upload' == $_REQUEST['action'] ) {
header("Location: themes.php?page=functions.php&upload=ok");
die;
}
}
add_theme_page($themename. __('Options',TEMPLATE_DOMAIN), __('Theme Options',TEMPLATE_DOMAIN), 'edit_theme_options', 'functions.php', 'mytheme_wpmu_dixi_admin');
}

add_action('admin_menu', 'mytheme_add_wpmu_dixi_admin');




$options1 = array (

    array (	"name" => __("Your homepage intro title", 'dixi'),
			"id" => $shortname . "_" . $short_prefix . "intro_header",
            "inblock" => "home-box1",
            "box" => "1",
            "std" => "",
			"type" => "text"),


    array (	"name" => __("Your homepage box left text", 'dixi'),
			"id" => $shortname . "_" . $short_prefix . "intro_header_text",
            "inblock" => "home-box1",
            "box" => "1",
            "std" => "",
			"type" => "textarea"),

);


function wpmu_dixi_intro() { ?>
<?php
global $themename, $shortname, $options1;
if ( isset($_REQUEST['saved']) && $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename. __(' settings saved.', 'dixi') . '</strong></p></div>';
if ( isset($_REQUEST['reset']) && $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename. __(' settings reset.', 'dixi') . '</strong></p></div>';
?>


<div id="wrap-admin">
<div id="content-admin">

<div id="top-content-admin">
<h5><?php _e('Site Intro Settings', 'dixi'); ?></h5>
<p><?php _e("If you wish to display an introduction to your site on the frontpage please enter it below - this is confined to 'homepage' mode.", 'dixi'); ?></p>
</div>


<form method="post" id="option-mz-form">


<?php

if ($values['box'] = '1') { ?>


<div class="option-box">
<h4><?php _e('Homepage Intro Settings', 'dixi'); ?></h4>
<?php foreach ($options1 as $value) {

if (($value['inblock'] == "home-box1") && ($value['type'] == "text") && (isset($value['custom']) && $value['custom'] == "colourpicker")) { ?>

<div class="pwrap">
<p><?php echo $value['name']; ?>:</p>
<p><input name="<?php echo $value['id']; ?>" class="ops-colour" id="vtrColorPicker" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" /></p></div>

<?php } elseif (($value['inblock'] == "home-box1") && ($value['type'] == "text")) { ?>

<div class="pwrap">
<p><?php echo $value['name']; ?>:</p>
<p><input name="<?php echo $value['id']; ?>" class="ops-text" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" /></p></div>

<?php } elseif (($value['inblock'] == "home-box1") && ($value['type'] == "select")) { ?>

<div class="pwrap">
<p><?php echo $value['name']; ?>:</p>
<p><select name="<?php echo $value['id']; ?>" class="ops-select" id="<?php echo $value['id']; ?>">
<?php foreach ($value['options'] as $option1) { ?>
<option<?php if ( get_option( $value['id'] ) == $option1) { echo ' selected="selected"'; } elseif ($option1 == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option1; ?></option>
<?php } ?>
</select>
</p></div>

<?php } elseif (($value['inblock'] == "home-box1") && ($value['type'] == "textarea")) { ?>

<div class="pwrap">
<p><?php echo $value['name']; ?>:</p>
<?php $valuex = $value['id'];
$valuey = stripslashes($valuex);
$video_code = get_option($valuey);
?>
<p>
<script type='text/javascript'>
quicktagsL10n = {
quickLinks: "(Quick Links)",
wordLookup: "Enter a word to look up:",
dictionaryLookup: "Dictionary lookup",
lookup: "lookup",
closeAllOpenTags: "Close all open tags",
closeTags: "close tags",
enterURL: "Enter the URL",
enterImageURL: "Enter the URL of the image",
enterImageDescription: "Enter a description of the image"
}
</script>
<script type="text/javascript">edToolbar()</script>
</p>
<p><textarea class="ops-area" id="ops-com" name="<?php echo $valuey; ?>" cols="40%" rows="8" /><?php if ( get_option($valuey) != "") { echo stripslashes($video_code); } else { echo $value['std']; } ?></textarea>
</p><script type="text/javascript">var edCanvas = document.getElementById('ops-com');</script> </div>
<?php }
}
?>
</div>


<?php } ?>

<p class="submit">
<input name="save" type="submit" class="button-primary" value="<?php echo esc_attr(__('Save Options', 'dixi')); ?>" />
<input type="hidden" name="action" value="save" />
</p>
</form>


<form id="reset-options" method="post">
<p class="submit">
<strong><?php _e("By hitting this reset button, all saved options will be reset and restore to default",TEMPLATE_DOMAIN); ?></strong><br />
<input name="reset" type="submit" class="button-secondary" value="<?php echo esc_attr(__('Reset Options', 'dixi')); ?>" />
<input type="hidden" name="action" value="reset" /></p>
</form>

</div>
</div>



<?php }

function wpmu_dixi_add_intro() {
global $themename, $shortname, $options1;
if ( isset($_GET['page']) && $_GET['page'] == "site-intro.php" ) {
if ( isset($_REQUEST['action']) && 'save' == $_REQUEST['action'] ) {
foreach ($options1 as $value) {
update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }
foreach ($options1 as $value) {
if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } }
header("Location: themes.php?page=site-intro.php&saved=true");
die;
} else if( isset($_REQUEST['action']) && 'reset' == $_REQUEST['action'] ) {
foreach ($options1 as $value) {
delete_option( $value['id'] ); }
header("Location: themes.php?page=site-intro.php&reset=true");
die;
}
}
add_theme_page(_g (__('Site Intro', 'dixi')),  _g (__('Site Intro', 'dixi')),  'edit_theme_options', 'site-intro.php', 'wpmu_dixi_intro');
}
add_action('admin_menu', 'wpmu_dixi_add_intro');



?>