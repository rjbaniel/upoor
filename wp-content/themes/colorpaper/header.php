<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">

	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

	<title><?php bloginfo('name'); ?> <?php if ( is_single() ) { ?> &raquo; Blog Archive <?php } ?> <?php wp_title(); ?></title>



	

	<?php 

		ob_start(); 



		global $style, $options;

				

		if(!empty($_COOKIE['style']))

			$style = $_COOKIE['style'];

		else 

			$style = 'teal';

		



	?>

	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/styles/<?php echo $style; ?>.css" type="text/css" />

	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" />

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


    <?php remove_action( 'wp_head', 'wp_generator' ); ?>
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>

<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery-1.2.6.min.js"></script>

<?php if( get_background_image() || get_theme_mod('preset_bg') ) { ?>
<style>
#footer-back,#footer-bg,#main,#main-top {
    background: transparent none !important;
}
</style>
<?php } ?>


</head>



<body id="custom">

	<a name="top"></a>

	<div id="footer-back"><div id="footer-bg">

		<div id="main">

			<div id="main-top">

				<div id="navigationed">


                         <div id="custom-navigation">
<?php if ( function_exists( 'wp_nav_menu' ) ) { // Added in 3.0 ?>
		<ul id="navigation" class="clearfix"> 
<?php echo bp_wp_custom_nav_menu($get_custom_location='main-nav', $get_default_menu='revert_wp_menu_page'); ?>
</ul>
<?php } else { ?>
		<ul id="navigation" class="clearfix">
<li id="<?php if (is_home() || is_single()) { ?>home<?php } else { ?>page_item<?php } ?>"><a href="<?php bloginfo('url'); ?>" title="Home"><?php _e('Home'); ?></a></li>
<?php wp_list_pages('title_li=&depth=1'); ?>
</ul>
<?php } ?>
</div>





				</div>

				<div id="container">

					<div id="content-back" class="clearfix"><div id="content-bottom">

						<div id="left-col">

							<div class="clearfix">

								<div id="colors">

									<a href="<?php bloginfo('template_directory'); ?>/switcher.php?style=teal" class="color-blue">Blue</a>

									<a href="<?php bloginfo('template_directory'); ?>/switcher.php?style=orange" class="color-orange">Orange</a>

									<a href="<?php bloginfo('template_directory'); ?>/switcher.php?style=green" class="color-green">Green</a>

									<a href="<?php bloginfo('template_directory'); ?>/switcher.php?style=pink" class="color-pink">Pink</a>

									<a href="<?php bloginfo('template_directory'); ?>/switcher.php?style=purple" class="color-purple">Purple</a>

								</div>
