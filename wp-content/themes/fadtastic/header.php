<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<title><?php wp_title(); ?> <?php bloginfo('name'); ?></title>
	<link href="<?php bloginfo('stylesheet_directory'); ?>/css/fadtasticdev.css" rel="stylesheet" type="text/css" />
	<link href="<?php bloginfo('stylesheet_directory'); ?>/css/fadtasticdev_menu.css" rel="stylesheet" type="text/css" />
	<link href="<?php bloginfo('stylesheet_directory'); ?>/css/fadtasticdev_forms.css" rel="stylesheet" type="text/css" />
	<link href="<?php bloginfo('stylesheet_directory'); ?>/css/fadtasticdev_print.css" rel="stylesheet" type="text/css" media="print" />
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


<style type="text/css" media="screen">
#header_effect {
background: url(<?php header_image() ?>) repeat-x !important;
}

#header_effect a {
color:#<?php header_textcolor() ?> !important;
text-decoration: none;
}



	</style>



<?php remove_action( 'wp_head', 'wp_generator' ); ?>
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>
</head>

<body id="custom">

<div id="wrapper">
	<div class="content_padding">
		
		<div id="top_menu">
			
			<?php include("searchform.php") ?>
			
			<div class="clear"></div>
			
		</div>
		
		<div id="header_effect">
			<div id="header">
					<p><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></p>
			</div>
		</div>

		<div id="navcontainer">

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



		</div>
