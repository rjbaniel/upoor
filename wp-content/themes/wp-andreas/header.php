<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=<?php bloginfo('charset'); ?>" />
<meta name="description" content="<?php bloginfo('name'); ?> - <?php bloginfo('description'); ?>" />
<meta name="keywords" content="" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
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
<title><?php bloginfo('name'); wp_title(); ?></title>

<?php remove_action( 'wp_head', 'wp_generator' ); ?>
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>
<?php if( get_background_image() || get_theme_mod('preset_bg') ) { ?>
<style>
#wrap {
    background-color: #FFFFFF;
    color: #333333;
    margin: 0 auto;
    padding: 20px;
    width: 760px;
}
</style>
<?php } ?>
</head>

<body id="wrap">
<div id="wrap">

<div id="header">
<h1><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
<p><strong><?php bloginfo('description'); ?></strong></p>
</div>

<div id="custom-navigation"><div id="custom">
<?php if ( function_exists( 'wp_nav_menu' ) ) { // Added in 3.0 ?>
<?php if ( has_nav_menu( 'main-nav' ) ) { ?>
<ul id="nav">
<?php echo bp_wp_custom_nav_menu($get_custom_location='main-nav', $get_default_menu='revert_wp_menu_page'); ?>
</ul>
<?php } ?>
<?php } else { ?>
<ul id="nav">
<?php wp_list_pages('title_li=&depth=1'); ?>
</ul>
<?php } ?>
</div></div>


<a href="<?php bloginfo('url'); ?>"><img id="frontphoto" src="<?php header_image(); ?>" alt="<?php bloginfo('name'); ?>" /></a>

<div id="leftside">

<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Main Sidebar') ) : else : ?>

<h2 class="hide"><?php _e('Categories:', 'wp-andreas'); ?></h2>

<h2><?php _e('Categories', 'wp-andreas'); ?></h2>
<ul><?php wp_list_categories('sort_column=name&list=1&optioncount=0&hierarchical=1&children=1&hide_empty=1&feed=RSS'); ?>
</ul>

<?php endif; ?>

</div>
