<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php if (wp_version()=='21') language_attributes(); ?>>

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


<?php remove_action( 'wp_head', 'wp_generator' ); ?>
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>


<style type="text/css" media="screen">
#custom-img-header {
background: #2189CC url(<?php header_image() ?>) repeat-x;
}

#custom-img-header h1 a, #custom-img-header p  {
color:#<?php header_textcolor() ?> !important;
text-decoration: none;
}

</style>



</head>

<body id="custom">

<!-- 
show static sidetab if javascript is off.
edit line 15 in footer.php for the scrolling sidetab
-->
<noscript>
<div id="sidetab" style="left:5px;position:absolute;top: 15px;">
    <ul id="navlist">
    <li><a href="<?php bloginfo('url'); ?>" title="Home"><img onMouseOver="this.style.src='contact_on.gif'" src="<?php bloginfo('template_url') ?>/images/home.gif" width="25" height="60" /></a></li>

    <li class="sidetab_alt"><a href="<?php bloginfo('rss2_url'); ?>" title="<?php _e('Subscribe to Feed','genki'); ?>"><img src="<?php bloginfo('template_url') ?>/images/blank.gif" width="25" height="25" /></a></li>
    </ul>
</div>
</noscript>

<div id="wrap">
