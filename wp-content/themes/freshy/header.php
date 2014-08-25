<?php //$freshy_options = get_option('freshy_options');
	global $yy_options;
	global $freshy_options;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
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


<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" title="Freshy"/>
<!--[if gte IE 7]>
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/ie7.css" type="text/css" media="screen" />
<![endif]-->
<!--[if lt IE 7]>
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/ie6.css" type="text/css" media="screen" />
<![endif]-->
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
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

<?php if( get_background_image()  || get_theme_mod('preset_bg') ) { ?>
<style>
#footer,#page,#title {
    background: transparent none !important;
}
#frame {
  background: #fff;
}


</style>
<?php } ?>

</head>
<body id="custom">

<div id="page">
	
	<!-- header -->
	<div id="header">
		<div id="title">
			<h1>
				<a href="<?php echo get_option('home'); ?>">
					<span><?php bloginfo('name'); ?></span>
				</a>
			</h1>
			<div class="description">
				<small><?php bloginfo('description'); ?></small>
			</div>
		</div>
		<div id="title_image"></div>
	</div>
	
	<!-- main div -->
	<div id="frame">

	<!-- main menu -->


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





	
	<hr style="display:none"/>
