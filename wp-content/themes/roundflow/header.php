<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title>
<?php
if (is_home()) { echo bloginfo('name'); echo (' - '); bloginfo('description');}
elseif (is_404()) { bloginfo('name'); echo ' - Oops, this is a 404 page'; }
else if ( is_search() ) { bloginfo('name'); echo (' - Search Results');}
else { bloginfo('name'); echo (' - '); wp_title(''); }
?>
</title>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/niftyCorners.css" type="text/css" media="screen" />


<!-- start theme options sync - using php to fetch theme option are deprecated and replace with style sync -->
<?php print "<style type='text/css' media='screen'>"; ?>
<?php include (TEMPLATEPATH . '/style.php'); ?>
<?php print "</style>"; ?>
<!-- end theme options sync -->




<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
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

<?php if (get_option( 'rf_roundedcorners' ) == "" || get_option( 'rf_roundedcorners' ) == "ON") {  ?>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/niftycube.js"></script>
<script type="text/javascript">
window.onload=function(){
<?php if(is_single()) { ?>
Nifty("div#header","br top");
Nifty("div#navigation","bl tr");
Nifty("div#maincontent","tl br");
Nifty("div#comments","tr bl");
Nifty("div#bottombar","tl br");
Nifty("div#footer","tr bottom");
<?php } elseif (is_page() && wp_list_pages("child_of=".$post->ID."&echo=0")) { ?>
Nifty("div#header","br top");
Nifty("div#navigation","bl tr");
Nifty("div#childnavigation","br tl");
Nifty("div#maincontent","tr bl");
Nifty("div#bottombar","tl br");
Nifty("div#footer","tr bottom");
<?php } else { ?>
Nifty("div#header","br top");
Nifty("div#navigation","bl tr");
Nifty("div#maincontent","tl br");
Nifty("div#bottombar","tr bl");
Nifty("div#footer","tl bottom");
<?php } ?>
}
</script>
<?php } ?>

<?php remove_action( 'wp_head', 'wp_generator' ); ?>
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>


</head>
<body id="custom">
<div id="wrapper">

<div id="header"><h1><?php bloginfo('name'); ?></h1><h2><?php bloginfo('description'); ?></h2></div>


<div id="custom-navigation">
<?php if ( function_exists( 'wp_nav_menu' ) ) { // Added in 3.0 ?>
<ul id="nav">
<?php echo bp_wp_custom_nav_menu($get_custom_location='main-nav', $get_default_menu='revert_wp_menu_page'); ?>
</ul>
<?php } else { ?>
<ul id="nav">
<?php wp_list_pages('title_li=&depth=1'); ?>
</ul>
<?php } ?>
</div>


<?php if(is_page() && wp_list_pages("child_of=".$post->ID."&echo=0")) { ?>
<div id="childnavigation">
<ul>
<?php wp_list_pages("title_li=&child_of=".$post->ID."&sort_column=menu_order");?>
</ul>
</div>
<?php } ?>
