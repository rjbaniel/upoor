<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	
	<title><?php if (is_single() || is_page() || is_archive()) { wp_title('',true); } else { bloginfo('name'); echo(' &#8212; '); bloginfo('description'); } ?></title>
	
	<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats -->
	
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/custom.css" type="text/css" media="screen" />
	<!--[if lte IE 7]>
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/ie7.css" media="screen" />
	<![endif]-->
	<!--[if lte IE 6]>
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/ie6.css" media="screen" />
	<![endif]-->
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
	<?php if ( is_singular() ) { wp_enqueue_script( 'comment-reply' ); } ?>
	<?php wp_head(); ?>
</head>
<body id="custom" class="custom">

<div id="wrap">
<div id="container">

	<div id="masthead">
		<h1><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
		<h3><?php bloginfo('description'); ?></h3>
	</div>


     <div id="custom-navigation">
<?php if ( function_exists( 'wp_nav_menu' ) ) { // Added in 3.0 ?>
<ul id="nav">
<?php echo bp_wp_custom_nav_menu($get_custom_location='main-nav', $get_default_menu='revert_wp_menu_page'); ?>
<li class="rss"><a href="<?php bloginfo('rss2_url'); ?>">RSS</a></li>
</ul>
<?php } else { ?>
<ul id="nav">
<li class="<?php if (is_home() || is_single()) { ?>current_page_item<?php } else { ?>page_item<?php } ?>"><a href="<?php bloginfo('url'); ?>" title="Home"><?php _e('Home'); ?></a></li>
<?php wp_list_pages('title_li=&depth=1'); ?><li class="rss"><a href="<?php bloginfo('rss2_url'); ?>">RSS</a></li>
</ul>
<?php } ?>
</div>





	<div id="header_img">

<?php if('' != get_header_image() ) { ?>
<a href="<?php bloginfo('url'); ?>"><img src="<?php header_image(); ?>" alt="<?php bloginfo('name'); ?>" /></a>
<?php } ?>


		<?php /*if (is_home()) { ?>
		<img src="<?php bloginfo('template_url'); ?>/images/header_1.jpg" width="770px" height="140px" alt="<?php bloginfo('name'); ?> header image 1" title="<?php bloginfo('name'); ?> header image 1" />
		<?php } elseif (is_single()) { ?>
		<img src="<?php bloginfo('template_url'); ?>/images/header_2.jpg" width="770"px height="140px" alt="<?php bloginfo('name'); ?> header image 2" title="<?php bloginfo('name'); ?> header image 2" />
		<?php } elseif (is_page()) { ?>
		<img src="<?php bloginfo('template_url'); ?>/images/header_3.jpg" width="770px" height="140px" alt="<?php bloginfo('name'); ?> header image 3" title="<?php bloginfo('name'); ?> header image 3" />
		<?php } elseif (is_archive()) { ?>
		<img src="<?php bloginfo('template_url'); ?>/images/header_4.jpg" width="770px" height="140px" alt="<?php bloginfo('name'); ?> header image 4" title="<?php bloginfo('name'); ?> header image 4" />
		<?php } else { ?>
		<img src="<?php bloginfo('template_url'); ?>/images/header_5.jpg" width="770px" height="140px" alt="<?php bloginfo('name'); ?> header image 5" title="<?php bloginfo('name'); ?> header image 5" />
		<?php } */ ?>
	</div>
