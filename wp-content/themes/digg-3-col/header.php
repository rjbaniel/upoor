<?php include("pagefunctions.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title>
<?php bloginfo('name'); ?>
<?php wp_title(); ?>
</title>
<link rel="shortcut icon" href="/favicon.ico" >
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
<?php wp_get_archives('type=monthly&format=link'); ?>
<?php //comments_popup_script(); // off by default ?>
<?php if (is_single() and ('open' == $post->comment_status) or ('comment' == $post->post_type) ) { ?>

<?php } ?>
<?php if (is_page() and ('open' == $post->comment_status)) { ?>

<?php } ?>
<style type="text/css" media="screen">
		<!-- @import url( <?php bloginfo('stylesheet_url'); ?> ); -->


<?php if('' != get_header_image() ) { ?>
#pagetitle {
 background: url(<?php header_image() ?>) no-repeat;
}
#pagetitle h1 a {
color:#<?php header_textcolor() ?> !important;
text-decoration: none;
}
<?php } ?>


		</style>
<?php remove_action( 'wp_head', 'wp_generator' ); ?>
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>
</head>
<body id="custom"><div id="container">

<div id="header">

	<div id="menu">





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

	<div id="pagetitle">
		<h1><a href="<?php bloginfo('url'); ?>/" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a></h1>
	</div>

	<div id="syndication">
		<a href="<?php bloginfo('rss2_url'); ?>" title="<?php _e('Syndicate this site using RSS','digg-3-col'); ?>" class="feed"><?php _e('Entries <abbr title="Really Simple Syndication">RSS</abbr>','digg-3-col'); ?></a> &#124; <a href="<?php bloginfo('comments_rss2_url'); ?>" title="<?php _e('Syndicate comments using RSS','digg-3-col'); ?>"><?php _e('Comments RSS','digg-3-col'); ?></a>
	</div>
	<div id="searchbox">
		<?php include (TEMPLATEPATH . '/searchform.php'); ?>
	</div>

</div>

<div class="pagewrapper"><div class="page">

<?php include (TEMPLATEPATH . '/obar.php'); ?>
