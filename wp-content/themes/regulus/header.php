<?php load_theme_textdomain('regulus'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

   <title>
<?php
if (is_home()) { echo bloginfo('name'); echo (' - '); bloginfo('description');}
elseif (is_404()) { bloginfo('name'); echo ' - Oops, this is a 404 page'; }
else if ( is_search() ) { bloginfo('name'); echo (' - Search Results');}
else { bloginfo('name'); echo (' - '); wp_title(''); }
?>
</title>
	<meta http-equiv="content-type" content="text/html; charset=<?php bloginfo('charset'); ?>" />
	<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />

	<!-- feeds -->
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


	<link href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" rel="stylesheet" />
	<link href="<?php bloginfo('template_url'); ?>/switch.css" type="text/css" rel="stylesheet" />

<?php remove_action( 'wp_head', 'wp_generator' ); ?>
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>
	
   <?php $headerImageURL = get_option( 'regulus_headerImageURL' );
	
	if ( $headerImageURL != "" ) {

		echo "<style type=\"text/css\">
		
	#header {
	
		background:url( $headerImageURL ) #fff;
		
	}
		
</style>";

	}
	


	?>
	
	<!--
	Regulus Theme Created by Ben Gillbanks @ Binary Moon (http://www.binarymoon.co.uk/)
	-->
	
</head>

<?php

	// write the body tag.
	// needs some php fanciness to set the default header graphic

	// set default
	$headerImage = get_option( 'regulus_headerImage' );
	$classExtra = "";
	
	if ( $headerImage == "" ) {
		$headerImage = "1";
	}
	
	if ( bm_getProperty( 'sidealign' ) == 1 ) {
		$classExtra = "leftAlign ";
	}
	
	$classExtra .= get_option( 'regulus_colourScheme' );
	
	if ( $headerImageURL == "" ) {
		$classExtra .= " hid_$headerImage";
	}

	echo "<body id=\"custom\" class=\"$classExtra\">";

?>


<div id="wrapper">

	<div id="header">

		<?
			$homeURL = get_option( 'regulus_homeURL' );
			if( $homeURL == "" ) {
				$homeURL = get_option('home');
			}
		?>
		<a href="<?php echo $homeURL; ?>" id="homeLink"><?php bloginfo('name'); ?></a>
		<?php if( bm_getProperty( 'heading' ) != 1 ) { ?>
		<h1><?php bloginfo('name'); ?></h1>
		<p class="site_description"><?php bloginfo('description'); ?></p>
		<?php } ?>



<?php if ( function_exists( 'wp_nav_menu' ) ) { // Added in 3.0 ?>
<ul id="nav">
<?php echo bp_wp_custom_nav_menu($get_custom_location='main-nav', $get_default_menu='revert_wp_menu_page'); ?>
</ul>
<?php } else { ?>
<ul id="nav">
<li class="<?php if (is_home() || is_single()) { ?>current_page_item<?php } else { ?>page_item<?php } ?>"><a href="<?php bloginfo('url'); ?>" title="Home">
<?php _e('Home',TEMPLATE_DOMAIN); ?></a></li>
<?php wp_list_pages('title_li=&depth=1'); ?>
</ul>
<?php } ?>


	</div>
	
	<a href="#nav" class="skipnav"><?php _e('jump to navigation','regulus'); ?></a>
	


