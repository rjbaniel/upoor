<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes() ?>>
<head profile="http://gmpg.org/xfn/11">
<title><?php bloginfo('name'); if ( is_404() ) : _e(' &raquo; ', 'sandbox'); _e('Not Found', 'sandbox'); elseif ( is_home() ) : _e(' &raquo; ', 'sandbox'); bloginfo('description'); else : wp_title(); endif; ?></title>
<meta http-equiv="content-type" content="<?php bloginfo('html_type') ?>; charset=<?php bloginfo('charset') ?>" />
<meta name="description" content="<?php bloginfo('description') ?>" />
<meta name="generator" content="WordPress <?php bloginfo('version') ?>" /><!-- Please leave for stats -->

<style type="text/css" media="all"> @import url(<?php bloginfo('template_url'); ?>/css/reset.css); @import url(<?php bloginfo('template_url'); ?>/css/generic.css); </style>
<style type="text/css" media="print"> @import url(<?php bloginfo('template_url'); ?>/css/print.css); </style>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />


<!-- start theme options sync - using php to fetch theme option are deprecated and replace with style sync -->
<?php print "<style type='text/css' media='screen'>"; ?>
<?php include (TEMPLATEPATH . '/options-var.php'); include (TEMPLATEPATH . '/settings.php'); ?>
<?php print "</style>"; ?>
<!-- end theme options sync -->

<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('rss2_url') ?>" title="<?php echo esc_html(get_bloginfo('name'), 1) ?> <?php _e('Posts RSS feed', 'sandbox'); ?>" />
<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('comments_rss2_url') ?>" title="<?php echo esc_html(get_bloginfo('name'), 1) ?> <?php _e('Comments RSS feed', 'sandbox'); ?>" />

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

<?php wp_head() ?>

</head>

<body id="custom" class="<?php sandbox_body_class() ?>">



<div id="wrapper" class="hfeed">

	<div id="header">
		<h1 id="blog-title"><a href="<?php echo get_option('home') ?>/" title="<?php bloginfo('name') ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
		<div id="blog-description"><?php bloginfo('description') ?></div>
	</div><!--  #header -->

	<div id="access">
		<div class="skip-link"><a href="#content" title="<?php _e('Skip navigation to the content', 'sandbox'); ?>"><?php _e('Skip to content', 'sandbox'); ?></a></div>


<?php if ( function_exists( 'wp_nav_menu' ) ) { // Added in 3.0 ?>
<div id="menu"><ul id="nav">
<?php echo bp_wp_custom_nav_menu($get_custom_location='main-nav', $get_default_menu='revert_wp_menu_page'); ?>
</ul></div>
<?php } else { ?>
<?php sandbox_globalnav() ?>
<?php } ?>


	</div><!-- #access -->
