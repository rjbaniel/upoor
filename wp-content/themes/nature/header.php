<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php bloginfo('name'); ?> <?php if ( is_single() ) { ?> &raquo; Blog Archive <?php } ?> <?php wp_title(); ?></title>

<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats -->

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
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
<!--[if IE]>
<link rel="stylesheet" href="<?=bloginfo('template_url')?>/style-ie.css" type="text/css" media="screen" />
<script type="text/javascript">
	var png_blank = "<?=bloginfo('template_url')?>/images/transparent.gif";
</script>
<![endif]-->

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<!-- Main Menu -->
	<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.min.1.2.6.js"></script>
	<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jqueryslidemenu/jqueryslidemenu.js"></script>
	<!-- /Main Menu -->

<?php wp_head(); ?>

</head>

<body id="custom">

<div id="header">
	<div id="header_inner">
		<div id="menu">
			<!--<div id="header_link">
				<p><a href="<?php echo get_option('home'); ?>/">&nbsp;</a></p>
			</div>-->
			<div id="menu_items">
				<div id="mainmenu">



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
		</div>
		<div id="header_title">
			<h1>
				<a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a>
                <span class="description"><?php bloginfo('description'); ?>&nbsp;</span>
			</h1>
		</div>
		<div id="main_search">
			<form method="get" id="searchform_top" action="<?php bloginfo('url'); ?>/">
				<div>
					<input type="text" value="<?php _e('Type your search here...', 'nature'); ?>" name="s" id="searchform_top_text" onclick="this.value='';" />
					<input type="image" src="<?php bloginfo('template_url')?>/images/button_go.gif" id="gosearch" />
				</div>
			</form>
		</div>
		<div id="header_rss">
			<a href="<?php bloginfo('rss2_url'); ?>" title="Rss"><img src="<?php bloginfo('template_url')?>/images/button_rss.png" alt="<?php bloginfo('name'); ?> Rss" /></a>
		</div>
	</div>
</div>

<div id="page">

<div id="body">
	<div id="body_top">
		<div id="body_left">
			<div id="body_left_content">
