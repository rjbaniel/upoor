<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">


<html xmlns="http://www.w3.org/1999/xhtml">


<head profile="http://gmpg.org/xfn/11">





<title><?php bloginfo('name'); ?> <?php if ( is_single() ) { ?> &raquo; <?php _e('Blog Archive');?> <?php } ?> <?php wp_title(); ?></title>





<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />






<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />


<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />


<link rel="shortcut icon" type="image/ico" href="<?php bloginfo('template_url'); ?>/favicon.ico" />





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


<style type="text/css">
#custom-img-header { width: 100%; margin: 0 auto 20px auto; height: 150px; background: url(<?php header_image() ?>) repeat-x; }
</style>


</head>





<body id="custom">


	





<div id="container">








<div id="skip">


	<p><a href="#content" title="Skip to site content"><?php _e('Skip to content', 'cordobo'); ?></a></p>


	<p><a href="#search" title="Skip to search" accesskey="s"><?php _e('Skip to search - Accesskey = s', 'cordobo'); ?></a></p>


</div> <!-- /skip -->








<div id="header">


	<div id="header_left_bg">


		<h1><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>


	</div>


</div> <!-- /header -->








<?php /** To remove the grey bar beyond the green header, delete the following 5 lines (switch off wrapping of long lines) **/ ?>





<div id="single_post_right">


	<div id="single_post_left">


	   <div id="custom-navigation">
<?php if ( function_exists( 'wp_nav_menu' ) ) { // Added in 3.0 ?>
<ul id="nav">    
<?php echo bp_wp_custom_nav_menu($get_custom_location='main-nav', $get_default_menu='revert_wp_menu_page'); ?>
</ul>
<?php } else { ?>
<ul id="nav">
<li id="<?php if (is_home() || is_single()) { ?>home<?php } else { ?>page_item<?php } ?>"><a href="<?php bloginfo('url'); ?>" title="Home"><?php _e('Home'); ?></a></li>
<?php wp_list_pages('title_li=&depth=1'); ?>
</ul>
<?php } ?>
</div>




	</div>


</div>





<?php /** Stop deleting here **/ ?>








<div id="wrapper">


<?php if('' != get_header_image() ) { ?>
<div id="custom-img-header"></div>
<?php } ?>
