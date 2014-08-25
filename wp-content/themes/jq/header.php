<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php wp_title('&middot;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
<?php
/* This code retrieves all our admin options. */
global $options;
foreach ($options as $value) {
	if (isset($value['id']) && get_option( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else if (isset($value['id'])) { $$value['id'] = get_option( $value['id'] ); }
}
?>
<?php /* Style Schemes */
if ($jq_style_scheme == 'Default') { ?>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<?php } ?>
<?php
if ($jq_style_scheme == 'Serif') { ?>
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/lib/css/style_serif.css" type="text/css" media="screen" />
<?php } ?>
<?php
if ($jq_style_scheme == 'Dark') { ?>
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/lib/css/style_dark.css" type="text/css" media="screen" />
<?php } ?>
<link rel="alternate" type="application/rss+xml" title="RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<!-- favicon.ico location -->
<?php if(file_exists( WP_CONTENT_DIR . '/favicon.ico')) { //put your favicon.ico inside wp-content/ ?>
<link rel="icon" href="<?php echo WP_CONTENT_URL; ?>/favicon.ico" type="images/x-icon" />
<?php } elseif(file_exists( WP_CONTENT_DIR . '/favicon.png')) { //put your favicon.png inside wp-content/ ?>
<link rel="icon" href="<?php echo WP_CONTENT_URL; ?>/favicon.png" type="images/x-icon" />
<?php } elseif(file_exists( TEMPLATEPATH . '/favicon.ico')) { ?>
<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" type="images/x-icon" />
<?php } elseif(file_exists( TEMPLATEPATH . '/favicon.png')) { ?>
<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png" type="images/x-icon" />
<?php } ?>

<style type="text/css">
<?php /* Sidebar position */
if (!($jq_sidebar_left == "false")) { ?>
div#left {float: right; padding: 10px 0 10px 20px;} 
div#right {float: left; padding: 10px 20px 10px 0;}   
<?php } ?>
<?php /* Custom bg colour */
if ($jq_bg_color) { ?>    
body {background: <?php echo $jq_bg_color; ?>;}               
<?php } ?>
<?php /* Custom page colour */
if ($jq_page_color) { ?>    
div#content {background: <?php echo $jq_page_color; ?>;}  
div#appendix {background: <?php echo $jq_page_color; ?>;}     
<?php } ?>
</style>
<!--[if IE]>
<style type="text/css">
div.date {float:left; position:static; margin:10px 10px 0 0; padding:0;}
div.preview {margin:15px 0;}
.comment-link {background:none;}
#search-submit {margin: 10px 0 0 0; height: 28px;}
</style>
<![endif]-->
<?php if ( is_singular() ) wp_enqueue_script('comment-reply'); ?>
<!-- wp_head -->
<?php wp_head(); ?>
</head>
<body>
<div id="outline">
<div id="blog-line">
<!-- blog title and tag line -->
<h1><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a> | <?php bloginfo('description'); ?></h1>
</div>
<!-- page navigation -->
<div id="nav" class="clearfix">


<?php if ( function_exists( 'wp_nav_menu' ) ) { // Added in 3.0 ?>
<ul class="sf-menu">
<?php echo bp_wp_custom_nav_menu($get_custom_location='main-nav', $get_default_menu='revert_wp_menu_page'); ?>
</ul>
<ul id="mail_rss">
<?php /* Navigation */
if ($jq_mail_display == "false") { ?>
<li><a href="mailto:<?php bloginfo('admin_email'); ?>"><?php _e('Mail', 'jq'); ?></a></li>
<?php } ?>
<li><a href="<?php bloginfo('rss2_url'); ?>"><?php _e('RSS', 'jq'); ?></a></li>
</ul>
<?php } else { ?>
<ul class="sf-menu">
<li class="page_item <?php if ( is_home() ) { ?>current_page_item<?php } ?>"><a href="<?php bloginfo('url'); ?>"><?php _e('Home', 'jq'); ?></a></li>
<?php /* Navigation */
if ($jq_nav_display == "false") {
wp_list_pages('title_li=&depth=4&sort_column=menu_order');
} else {
wp_list_categories('depth=2&title_li=0&orderby=name&show_count=0');
} ?>
</ul>
<ul id="mail_rss">
<?php /* Navigation */
if ($jq_mail_display == "false") { ?>
<li><a href="mailto:<?php bloginfo('admin_email'); ?>"><?php _e('Mail', 'jq'); ?></a></li>
<?php } ?>
<li><a href="<?php bloginfo('rss2_url'); ?>"><?php _e('RSS', 'jq'); ?></a></li>
</ul>
<?php } ?>






</div>
<!-- ending header template -->

<?php if('' != get_header_image() ) { ?>
<a href="<?php bloginfo('url'); ?>"><img src="<?php header_image(); ?>" alt="<?php bloginfo('name'); ?>" /></a>
<?php } ?>
