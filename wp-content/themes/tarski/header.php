<?php

if(is_home()) {
	$homeTagStart = '<h1 id="blog-title">';
	$homeTagEnd = '</h1>';
} else {
	$homeTagStart = '<p id="blog-title">';
	$homeTagEnd = '</p>';
}

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php echo get_bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />


   <title>
<?php
if (is_home()) { echo bloginfo('name'); echo (' - '); bloginfo('description');}
elseif (is_404()) { bloginfo('name'); echo ' - Oops, this is a 404 page'; }
else if ( is_search() ) { bloginfo('name'); echo (' - Search Results');}
else { bloginfo('name'); echo (' - '); wp_title(''); }
?>
</title>

	<meta name="robots" content="all" />
		<link rel="pingback" href="<?php echo get_option('home'); ?>/xmlrpc.php" />
	<link rel="stylesheet" href="<?php echo get_bloginfo('stylesheet_url'); ?>?2" type="text/css" media="screen,projection" />
	<link rel="stylesheet" href="<?php echo get_bloginfo('template_directory'); ?>/print.css" type="text/css" media="print" />
	<?php if(get_option('tarski_style')) { ?><link rel="stylesheet" href="<?php echo get_bloginfo('template_directory'); ?>/styles/<?php echo get_option('tarski_style'); ?>" type="text/css" media="screen,projection" /><?php } ?>

<?php if (is_single()) { ?>
	<link rel="alternate" type="application/rss+xml" title="Comments feed" href="<?php the_permalink() ?>feed/" />
<?php } ?>
	<link rel="alternate" type="application/rss+xml" title="<?php echo get_bloginfo('name'); ?> feed" href="<?php echo get_bloginfo('rss2_url'); ?>" />


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
#inwrapper {
    background: none repeat scroll 0 0 #FFFFFF;
    text-align: left;
    width: 760px;
    float:left;
}
</style>
<?php } ?>
</head>

<body id="custom" class="center <?php if (is_page() || is_single() || is_404()) { echo " single"; } ?>">
<div id="wrapper">
<div id="inwrapper">
<div id="header">

	<div id="header-image">
		<?php if (is_home()) { ?><img alt="Header image" src="<?php header_image() ?>" /><?php } else { ?><a title="Return to front page" href="<?php echo get_option('home'); ?>"><img alt="Header image" src="<?php header_image() ?>" /></a><?php } ?>
	</div>

	<div id="title">
		<?php if (is_home()) { echo $homeTagStart; bloginfo('name'); echo $homeTagEnd; } else { ?><a title="<?php _e("Return to front page",TEMPLATE_DOMAIN); ?>" href="<?php echo get_option('home'); ?>"><?php echo $homeTagStart; bloginfo('name'); echo $homeTagEnd; ?></a><?php } ?>
		<?php if (get_bloginfo('description') != '') { ?><p id="tagline"><?php echo get_bloginfo('description'); ?></p><?php } ?>
	</div>

	<div id="navigation">

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


		<ul id="nav-2">
			<li><a class="feed" title="<?php _e('Subscribe to the');?> <?php bloginfo('name'); ?> feed" href="<?php echo get_bloginfo_rss('rss2_url'); ?>"><?php _e("Subscribe to feed",TEMPLATE_DOMAIN); ?></a></li>
		</ul>
	</div>

</div>

<div id="content">
