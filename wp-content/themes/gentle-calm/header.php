<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
    "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" >
<head>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

       <title>
<?php
if (is_home()) { echo bloginfo('name'); echo (' - '); bloginfo('description');}
elseif (is_404()) { bloginfo('name'); echo ' - Oops, this is a 404 page'; }
else if ( is_search() ) { bloginfo('name'); echo (' - Search Results');}
else { bloginfo('name'); echo (' - '); wp_title(''); }
?>
</title>


	<style type="text/css" media="screen">
		@import url( <?php bloginfo('stylesheet_url'); ?> );
		/*******************************************************************
			Show link pointer images for external sites
		*******************************************************************/
		.entrybody a[href^="http:"] {
			background: transparent url("<?php bloginfo('stylesheet_directory'); ?>/images/external_link.gif") no-repeat 100% 50%;
			padding-right: 10px;
			white-space: nowrap;
				}
		.entrybody a:hover[href^="http:"] {
			background: #F3F4EC url("<?php bloginfo('stylesheet_directory'); ?>/images/external_link.gif") no-repeat 100% 50%;
		}
		/* This avoids the icon being shown on internal links.*/
		.entrybody a[href^="http://<?php echo $_SERVER['HTTP_HOST']; ?>"],
		.entrybody a[href^="http://www.<?php echo $_SERVER['HTTP_HOST']; ?>"] {
			background: inherit;
			padding-right: 0px;
		}

<?php if('' != get_header_image() ) { ?>
#header {
background: url(<?php header_image() ?>) repeat-x;
}

#header h1 a, #subtitle  {
color:#<?php header_textcolor() ?> !important;
text-decoration: none;
}
<?php } ?>

	</style>
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


    <?php remove_action( 'wp_head', 'wp_generator' ); ?>
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>

 <?php if( get_background_image() || get_theme_mod('preset_bg') ) { ?>
<style>
#container {
    background: #fff none !important;
}
</style>
<?php } ?>

</head>
<body id="home" class="log">
<!-- The header begins  -->
		<div id="header">
			<h1><a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>" ><?php bloginfo('name'); ?></a></h1>
			<div id="subtitle">
				<!-- Here's the tagline  -->
				<?php bloginfo('description'); ?>
			</div>
		</div>
                    <div id="custom">
        <div id="custom-navigation">
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
</div>  </div>

		<div id="headbar"></div>
		<!-- The header ends  -->
	<div id="container">
		<div id="maincol"><!-- The main content column begins  -->
			<div class="col">
