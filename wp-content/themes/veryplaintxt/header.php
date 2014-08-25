<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes() ?>>
<head profile="http://gmpg.org/xfn/11">
	<title><?php bloginfo('name') ?><?php if ( is_404() ) : ?> &rsaquo; <?php _e('Page not found', 'veryplaintxt') ?><?php elseif ( is_home() ) : ?> &rsaquo; <?php bloginfo('description') ?><?php elseif ( is_category() ) : ?> &rsaquo; <?php echo single_cat_title(); ?><?php elseif ( is_date() ) : ?> &rsaquo; <?php _e('Blog archives', 'veryplaintxt') ?><?php elseif ( is_search() ) : ?> &rsaquo; <?php _e('Search results', 'veryplaintxt') ?><?php else : ?> &rsaquo; <?php the_title() ?><?php endif ?></title>
	<meta http-equiv="content-type" content="<?php bloginfo('html_type') ?>; charset=<?php bloginfo('charset') ?>" />
	<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php bloginfo('stylesheet_url'); ?>" title="veryplaintxt" />
	<link rel="stylesheet" type="text/css" media="print" href="<?php bloginfo('template_directory'); ?>/print.css" />
	<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('rss2_url') ?>" title="<?php bloginfo('name') ?> RSS feed" />
	<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('comments_rss2_url') ?>" title="<?php bloginfo('name') ?> comments RSS feed" />

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
div#wrapper {
    background: none repeat scroll 0 0 #FFFFFF;
    max-width: 55em;
    min-width: 35em;
    padding: 20px;
    width: 80%;
}
</style>
<?php } ?>
</head>

<body id="custom" class="<?php veryplaintxt_body_class() ?>">

<div id="wrapper">

	<div id="header">
		<h1 id="blog-title"><a href="<?php echo get_option('home') ?>/" title="<?php bloginfo('name') ?>"><?php bloginfo('name') ?></a></h1>
		<div id="blog-description"><?php bloginfo('description') ?></div>
	</div><!-- #header -->
	
	<div class="access"><span class="content-access"><a href="#content" title="<?php _e('Skip to content', 'veryplaintxt'); ?>"><?php _e('Skip to content', 'veryplaintxt'); ?></a></span></div>

<div id="custom-navigation">
<?php if ( function_exists( 'wp_nav_menu' ) ) { // Added in 3.0 ?>
<?php if ( has_nav_menu( 'main-nav' ) ) { ?>
<ul id="nav">
<?php echo bp_wp_custom_nav_menu($get_custom_location='main-nav', $get_default_menu='revert_wp_menu_page'); ?>
</ul>
<?php } ?>
<?php } else { ?>
<ul id="nav">
<?php wp_list_pages('title_li=&depth=1'); ?>
</ul>
<?php } ?>
</div>


<?php if('' != get_header_image() ) { ?>
<div id="custom-img-header"><a href="<?php bloginfo('url'); ?>"><img src="<?php header_image(); ?>" alt="<?php bloginfo('name'); ?>" /></a></div>
<?php } ?>
