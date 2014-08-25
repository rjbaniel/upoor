<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php bloginfo('name'); ?> <?php if ( is_single() ) { ?> &raquo; <?php _e('Blog Archive');?> <?php } ?> <?php wp_title(); ?></title>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
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

<?php wp_get_archives('type=monthly&format=link'); ?>

<?php remove_action( 'wp_head', 'wp_generator' ); ?>
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>

<script language="javascript" src="<?php bloginfo('stylesheet_directory'); ?>/sb.js"></script>

</head>
<body id="custom">

<div id="page">
<div id="header">
<div id="toolbar-top">
<h1><a href="<?php echo get_option('home'); ?>"><?php bloginfo('name'); ?></a></h1>
		<div class="description"><?php bloginfo('description'); ?></div>
		</div>
	<div id="toolbar-left">
	</div>
		<div id="toolbar-right">
		<a href="#" class="tooltip" onClick="changeFontSize('content', 1); return false;"><?php _e('Bigger', 'batavia'); ?><span><?php _e('Bigger Font Size', 'batavia'); ?></span></a> ::
		<a href="#" class="tooltip" onClick="changeFontSize('content', 0); return false;"><?php _e('Smaller', 'batavia'); ?><span><?php _e('Smaller Font Size', 'batavia'); ?></span></a> ::
		<a href="#" class="tooltip" onClick="changeAlignment('content', 'left'); return false;"><?php _e('Left', 'batavia'); ?><span><?php _e('Left Align', 'batavia'); ?></span></a> ::
		<a href="#" class="tooltip" onClick="changeAlignment('content', 'justify'); return false;"><?php _e('Justify', 'batavia'); ?><span><?php _e('Justify Align', 'batavia'); ?></span></a> ::
		<a href="#" class="tooltip" onClick="changeAlignment('content', 'right'); return false;"><?php _e('Right', 'batavia'); ?><span><?php _e('Right Align', 'batavia'); ?></span></a> ::
		<a href="#" class="tooltip" onClick="Bookmark(window.document.location,window.document.title); return false;"><?php _e('Bookmark<span>Bookmark This Page</span>', 'batavia'); ?></a> ::
		<a href="#" class="tooltip" onClick="toPrint(); return false;"><?php _e('Print<span>Print This Page</span>', 'batavia'); ?></a>
		</div>
	</div>
<hr />

<div id="custom-navigation">
<?php if ( function_exists( 'wp_nav_menu' ) ) { // Added in 3.0 ?>
<?php if ( has_nav_menu( 'main-nav' ) ) { // Added in 3.0 ?>
<ul id="nav">
<?php echo bp_wp_custom_nav_menu($get_custom_location='main-nav', $get_default_menu='revert_wp_menu_page'); ?>
</ul>
<?php } ?>
<?php } else { ?>
<ul id="nav">
<li id="<?php if (is_home() || is_single()) { ?>home<?php } else { ?>page_item<?php } ?>"><a href="<?php bloginfo('url'); ?>" title="Home"><?php _e('Home'); ?></a></li>
<?php wp_list_pages('title_li=&depth=1'); ?>
</ul>
<?php } ?></div>
