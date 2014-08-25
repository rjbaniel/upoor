<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head profile="http://gmpg.org/xfn/11">



	<title><?php wp_title(' '); ?> <?php if(wp_title(' ', false)) { echo '&#8211;'; } ?> <?php bloginfo('name'); ?></title>



	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />	

	<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats please -->



	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />

	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/custom.css" type="text/css" media="screen" />

	<!--[if lte IE 6]>	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/library/ie6.css" /><![endif]-->

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

	

	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>



	<?php wp_head(); ?>

    <?php if( get_background_image() || get_theme_mod('preset_bg') ) { ?>
<style>
#header {
    background: none repeat scroll 0 0 #FFFFFF;
}
</style>
<?php } ?>

</head>

<body id="custom" class="custom">

<?php 

global $options;

foreach ($options as $value) {

    if (isset($value['id']) && isset($value['std']) && get_option( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } 

      else if (isset($value['id']) && isset($value['std'])) { $$value['id'] = get_option( $value['id'] ); } 

} ?>

<div id="page" class="hfeed <?php echo $pp_layout_setup; ?>">



	<div id="header">

		<div id="branding">

			<?php if (is_home()) { ?>

			<h1 class="homelink"><a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a></h1>

			<?php } else { ?>

			<div class="homelink"><a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a></div>

			<?php } ?>

			<p class="description"><?php bloginfo('description'); ?></p>

		</div>

		

		<div id="skip"><a title="<?php _e('Skip to content', 'primepress'); ?>" href="#primary" accesskey="S"><?php _e('Skip to Content &darr;', 'primepress'); ?></a></div>

		

<div id="custom-navigation">
<?php if ( function_exists( 'wp_nav_menu' ) ) { // Added in 3.0 ?>
<ul id="nav">
<?php echo bp_wp_custom_nav_menu($get_custom_location='main-nav', $get_default_menu='revert_wp_menu_page'); ?>
</ul>
<?php } else { ?>
<ul id="nav">
<?php include (TEMPLATEPATH . '/main-menu.php'); ?>
</ul>
<?php } ?>
</div>






	</div><!--#header-->

<div id="container">

	<div id="rotating">

    <?php if('' != get_header_image() ) { ?>
<a href="<?php bloginfo('url'); ?>"><img src="<?php header_image(); ?>" alt="<?php bloginfo('name'); ?>" /></a>
<?php } ?>

		<?php //include (TEMPLATEPATH . '/header-images.php'); ?>

	</div>
