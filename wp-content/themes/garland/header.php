<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php wp_title(); ?> <?php bloginfo('name'); ?></title>
<?php if (!function_exists('add_theme_support')) { ?>
    <link rel="alternate" type="application/rss+xml" href="<?php bloginfo('rss2_url') ?>" title="<?php echo esc_html(get_bloginfo('name'), 1) ?> <?php _e('Posts RSS feed'); ?>" />
    <link rel="alternate" type="application/rss+xml" href="<?php bloginfo('comments_rss2_url') ?>" title="<?php echo esc_html(get_bloginfo('name'), 1) ?> <?php _e('Comments RSS feed'); ?>" />
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
<style type="text/css" media="screen">

<?php if ( get_theme_mod( 'zip' ) ) : ?>
@import "<?php bloginfo('template_url');echo'/css/reset.css'; ?>";
@import "<?php bloginfo('template_url');echo'/style.css'; ?>";
<?php else: ?>
@import "<?php bloginfo('template_url');echo'/style.php'; ?>";<?php endif; ?>

<?php if ( get_theme_mod( 'show_fluid' ) ) { echo '@import "';bloginfo('template_url');echo '/css/style-full.css";';} ?>
</style>
<?php 
if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
wp_head(); 
?>
</head>
<body id="custom" <?php if (function_exists('body_class')) {
body_class($class="sidebars");
} else {
?> class="sidebars"<?php } ?>>
<div id="navigation"></div>
<div id="wrapper">
<div id="container" class="clear-block">
<div id="header">
<div id="logo-floater">
<h1>
<?php if ( get_theme_mod('banner') ): ?> 
<a title="<?php echo bloginfo('description'); ?>" href="<?php echo get_option('home'); ?>"><img src="<?php echo get_theme_mod('banner_image'); ?>" alt="<?php bloginfo('description'); ?>" /></a>
<?php else: ?>
<a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a> <span style="font-style: italic; font-size: 60%;"><?php bloginfo('description'); ?></span>
<?php endif; ?>
</h1>
</div>
<!-- <ul class="links primary-links"> -->


<?php if ( function_exists( 'wp_nav_menu' ) ) { // Added in 3.0 ?>
<ul id="dropmenu">
<?php echo bp_wp_custom_nav_menu($get_custom_location='main-nav', $get_default_menu='revert_wp_menu_page'); ?>
<?php garland_admin_link(); ?>
</ul>
<?php } else { ?>
<ul id="dropmenu">
<?php if ( get_theme_mod( 'cat_nav' )) { wp_list_categories( 'title_li=&depth=1' ); } else {  wp_list_pages('sort_column=menu_order&title_li='); } ?>
<?php garland_admin_link(); ?>
</ul>
<?php } ?>




</div> <!-- /header -->
<?php get_sidebar(); ?>
<div id="center"><div id="squeeze"><div class="right-corner"><div class="left-corner">
<!-- begin content -->
<div class="node">
