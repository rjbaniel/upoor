<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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


<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; <?php bloginfo('charset'); ?>" />
<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats -->

<?php if(get_option('gridlock_disable_favicon') == 'false') { ?>
<link rel="shortcut icon" type="image/gif" href="<?php bloginfo('stylesheet_directory'); ?>/images/favicon.ico" />
<?php } ?>

<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" title="Gridlock Default" />

<?php if(stristr($_SERVER['HTTP_USER_AGENT'], 'MSIE 6') && get_option('gridlock_disable_ie6_warning') == 'false') { ?>
	<style type="text/css">
		#main_content { top: 157px; }
		#sidebar { top: 158px; }

	</style>
<?php } ?>


	<style type="text/css">

#masthead {
padding-top: 10px;
padding-left: 10px;
width: 760px;
height: 80px;
background: #FFF url(<?php header_image() ?>) no-repeat;
}

#content_wrap #masthead h1, #content_wrap #masthead p  {
padding: 0px !important;
margin: 0px !important;
}

#masthead h1 a, #masthead p  {
color: #<?php header_textcolor() ?> !important;
text-decoration: none;
padding: 0px !important;
margin: 0px !important;
}


	</style>

<!-- RSS Feeds -->
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />

<?php if(function_exists('delicious') && get_option('gridlock_delicious_username') != '') { ?>
<link rel="alternate" type="application/rss+xml" title="del.icio.us RSS" href="http://del.icio.us/rss/<?php get_option('gridlock_delicious_username'); ?>" />
<?php } ?>

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

<!-- Archives -->
<?php wp_get_archives('type=monthly&format=link'); ?>

<!-- sIFR Implementation -->
<?php if(get_option('gridlock_disable_sifr') == 'false') { ?>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/sifr/sifr.js"></script>

<script type="text/javascript">
<!--//--><![CDATA[//><!--
if(typeof sIFR == "function"){
  /* Now with more sIFR 3. This is inline because we need dynamic URIs to flash files */
	
	
	
}
//--><!]]>
</script>
<?php } ?>

<?php remove_action( 'wp_head', 'wp_generator' ); ?>
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>

<?php if( get_background_image() || get_theme_mod('preset_bg') ) { ?>
<style>
#content_wrap {
    background: none repeat scroll 0 0 #FFFFFF !important;
    margin: 0;
    overflow: hidden;
    padding: 0;
    width: 770px;
}
</style>
<?php } ?>

</head>

<body id="custom">
  
<?php if(stristr($_SERVER['HTTP_USER_AGENT'], 'MSIE 6') && get_option('gridlock_disable_ie6_warning') == 'false') { ?>
	
<div id="ie_warn">
<?php _e("It seems that you are using an obsolete version of Internet Explorer. It is highly recommended that you upgrade to",TEMPLATE_DOMAIN); ?>
<a href="http://www.microsoft.com/windows/ie/default.mspx" title="Internet Explorer 7"><?php _e("Internet Explorer 7",TEMPLATE_DOMAIN); ?></a> <?php _e("or",TEMPLATE_DOMAIN); ?>
<a href="http://www.mozilla.org/products/firefox/" title="Mozilla Firefox"><?php _e("Mozilla Firefox",TEMPLATE_DOMAIN); ?></a>.
</div>

<?php } ?>

<?php if(get_option('gridlock_centre_page') == 'true') { ?>
<div id="centre">
<div id="content_wrap" class="centre">
<?php } else { ?>
<div id="content_wrap">
<?php } ?>

<div id="masthead">
<h1><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
<p class="description"><?php bloginfo('description'); ?></p>
</div>



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


<div id="upper">
  <?php /*
  
    ADDING YOUR OWN LINKS TO THE HEADER
    To add your own links to the header, you will just need to copy the markup structure below.
    For example, let's say I wanted to link to Socialuxe. To do so, I'd just write this:

    <div class="nav"><a href="http://socialuxe.com" title="Eston's site">Socialuxe</a></div>
    
    This will create a link that says "Socialuxe" and points to "http://socialuxe.com/". When 
    you hover over the link, you'll get a tooltip that says "Eston's site" in most browsers.
  
  */ ?>
	
	<?php /* PHOTOS LINK */ ?>
  <?php if(get_option('gridlock_photolocation') != '') { ?>
	<div class="nav" ><a href="<?php echo(get_option('gridlock_photolocation')); ?>" title="<?php _e("photos",TEMPLATE_DOMAIN); ?>"><?php _e("photos",TEMPLATE_DOMAIN); ?></a></div>
	<?php } ?>

	<?php /* ABOUT LINK */ ?>
	<?php if(get_option('gridlock_about_slug') != '') { ?>
	<div class="nav"><a href="<?php bloginfo('url'); ?>/<?php echo(get_option('gridlock_about_slug')); ?>" title="<?php _e("about",TEMPLATE_DOMAIN); ?>"><?php _e("about",TEMPLATE_DOMAIN); ?></a></div>
	<?php } ?>


	<div class="nav_right"><a href="<?php bloginfo('rss2_url'); ?>" title="<?php _e("RSS 2.0 Feed",TEMPLATE_DOMAIN); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/feed.gif" alt="Feed Icon" title="RSS 2.0 Feed" id="feedicon" /></a></div>
</div>


<div class="wrapper">
