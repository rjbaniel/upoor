<?php

$wp_andreas09_ImageColour = get_option('wp_andreas09_ImageColour');

if (!$wp_andreas09_ImageColour) {

$wp_andreas09_ImageColour = 'blue';

update_option('wp_andreas09_ImageColour', $wp_andreas09_ImageColour);

}

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">



<html xmlns="http://www.w3.org/1999/xhtml">

<head profile="http://gmpg.org/xfn/11">

<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />


<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />

<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/<?php echo "" . get_option( 'wp_andreas09_ImageColour' )

 . ".css"; ?>" type="text/css" media="screen" />

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



<title><?php bloginfo('name'); ?> <?php if ( is_single() ) { ?> &raquo; <?php _e('Blog Archive','andreas09'); ?> <?php } ?> <?php wp_title(); ?></title>

<?php remove_action( 'wp_head', 'wp_generator' ); ?>
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>

</head>



<body id="custom">



<div id="container">



<div id="sitename">



<h1><a href="<?php echo get_option('home'); ?>"><?php bloginfo('name'); ?></a></h1>

<h2><?php bloginfo('description'); ?></h2>



</div>






<?php if (is_page()) { $highlight = ""; } else {$highlight = "current"; } ?>

<div id="mainmenu">


<?php if ( function_exists( 'wp_nav_menu' ) ) { // Added in 3.0 ?>
<ul class="level1" id="nav">
<?php echo bp_wp_custom_nav_menu($get_custom_location='main-nav', $get_default_menu='revert_wp_menu_page'); ?>
</ul>
<?php } else { ?>
<ul class="level1" id="nav">
<?php
if(function_exists("wp_andreas09_nav")) {
wp_andreas09_nav("sort_column=menu_order&list_tag=0&show_all_parents=1&show_root=1");
}
?>

<?php } ?>



</div>



<div id="wrap">
