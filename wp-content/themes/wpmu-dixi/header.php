<!DOCTYPE html>
<!--[if lt IE 7 ]>	<html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>		<html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>		<html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>		<html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html <?php language_attributes(); ?> class="no-js"> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php include (TEMPLATEPATH . '/lib/includes/options.php'); ?>

<title>
<?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', TEMPLATE_DOMAIN ), max( $paged, $page ) );

	?>
</title>

<?php if($bp_existed == 'true') { do_action( 'bp_head' ); } ?>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />

<?php if(function_exists('font_show')) { font_show(); } ?>

<?php if($bp_existed == 'true') { ?>
<?php if ( function_exists( 'bp_sitewide_activity_feed_link' ) ) : ?>
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> | <?php _e('Site Wide Activity RSS Feed', 'buddypress' ) ?>" href="<?php bp_sitewide_activity_feed_link() ?>" />
<?php endif; ?>
<?php if ( function_exists( 'bp_member_activity_feed_link' ) && bp_is_user() ) : ?>
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> | <?php bp_displayed_user_fullname() ?> | <?php _e( 'Activity RSS Feed', 'buddypress' ) ?>" href="<?php bp_member_activity_feed_link() ?>" />
<?php endif; ?>
<?php if ( function_exists( 'bp_group_activity_feed_link' ) && bp_is_group() ) : ?>
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> | <?php bp_current_group_name() ?> | <?php _e( 'Group Activity RSS Feed', 'buddypress' ) ?>" href="<?php bp_group_activity_feed_link() ?>" />
<?php endif; ?>
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> <?php _e( 'Blog Posts RSS Feed', 'buddypress' ) ?>" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> <?php _e( 'Blog Posts Atom Feed', 'buddypress' ) ?>" href="<?php bloginfo('atom_url'); ?>" />
<?php } ?>

<!-- automatic-feed-links in functions.php -->
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />


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

<?php if($bp_existed == 'true') {  ?>
<?php if ( '1' == get_option( 'hide-loggedout-adminbar' ) && !is_user_logged_in() ) {  ?>
<?php print "<style type='text/css' media='screen'>"; ?>
body { padding-top: 0px !important;
<?php print "</style>"; ?>
<?php } } ?>


<?php if(is_home()) { ?>
<script src="<?php echo get_template_directory_uri(); ?>/lib/scripts/tabber.js" type="text/javascript"></script>
<script type="text/javascript">
/* Optional: Temporarily hide the "tabber" class so it does not "flash"
   on the page as plain HTML. After tabber runs, the class is changed
   to "tabberlive" and it will appear. */
document.write('<style type="text/css">.tabber{display:none;}<\/style>');
</script>
<?php } ?>


<?php wp_head(); ?>

<?php if($bp_existed == 'true') { ?>
<?php if( !bp_is_blog_page() && bp_current_component() || bp_is_directory() ) { ?>
<?php if ( !is_active_sidebar( 'buddypress-sidebar' ) ) : ?>
<?php print "<style type='text/css' media='all'>"; ?>
#sidebar { display: none; }
#content { margin: 0; padding: 2%; width: 96% !important; }
<?php print "</style>"; ?>
<?php else: ?>
<?php print "<style type='text/css' media='all'>"; ?>

<?php if($tn_wpmu_dixi_site_width != "") {
$new_site_width = $tn_wpmu_dixi_site_width - ( $tn_wpmu_dixi_left_sidebar_width + 60 );
?>
#content { padding: 0px 15px; width: <?php echo $new_site_width; ?>px; float:left; margin: 0px; border: 0px none; }
<?php } else {
if($tn_wpmu_dixi_left_sidebar_width != "") { $new_sidebar_width=$tn_wpmu_dixi_left_sidebar_width; } else { $new_sidebar_width = '200'; }
$new_site_width = 982 - ($new_sidebar_width + 80);
?>
#content { padding: 0px 15px; width: <?php echo $new_site_width; ?>px; float:left; margin: 0px; border: 0px none; }
<?php } ?>

#sidebar {float:right; <?php if($tn_wpmu_dixi_left_sidebar_width != "") { echo 'width:' . $tn_wpmu_dixi_left_sidebar_width . 'px;'; } ?>
table.forum {
    margin: 0 -9px;
    width: auto;
}
<?php print "</style>"; ?>
<?php endif; ?>
<?php } } ?>


<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<?php if (strstr($_SERVER['REQUEST_URI'], '/wp-signup.php')) { ?>
<?php print "<style type='text/css' media='screen'>"; ?>
#content, #post-entry {
  border-left: 0px none;
  float: left;
  padding: 0;
  width: 100% !important;
}
.mu_register { width: 92%; padding: 4%; background: #eee; border: 1px solid #ccc; }
<?php print "</style>"; ?>
<?php } ?>


<?php
$forum_root_slug = get_option('_bbp_forum_slug');
$topic_root_slug = get_option('_bbp_topic_slug');
$reply_root_slug = get_option('_bbp_reply_slug');
if( get_post_type() == 'forum' || get_post_type() == $forum_root_slug || get_post_type() == $topic_root_slug || get_post_type() == $reply_root_slug ) { ?>
<?php print "<style type='text/css' media='screen'>"; ?>

<?php if ( !is_active_sidebar( 'bbpress-sidebar' ) ) : ?>
#sidebar, #right-sidebar, .post-author { display: none; }
#custom #post-entry { width: 96% !important; padding: 2% !important; border: 0 none !important; }
#custom #blog-content { width: 100%; float:left; }
<?php else: ?>
#custom #blog-content { width: 98%; float:left; }
#container .bb-sidebar { display: inline !important; }
#sidebar { display: none !important; }
#right-sidebar, .post-author { display: none !important; }
<?php endif; ?>


.bbp-forum-info {width: 40%;}
#content fieldset.bbp-form, #container fieldset.bbp-form, #wrapper fieldset.bbp-form { border: 1px solid #ccc;
  padding: 10px 20px;
}
.bbp-forums .even, .bbp-topics .even { background: #f8f8f8; }
#container .post-content {width: 100%;}
.bbp-breadcrumb {margin: 0 0 1em 0;}
#bbp_topic_title { width: 70%; }
.bbp-reply-author {width: 30%;}
.bbp-topic-meta {font-size: 0.875em;}
.bbp-reply-author img {margin: 0 1em 0 0;}
#container .bbp-reply-content,#container .bbp-reply-author {padding: 1.4em 1em;}
.bbp-topics td {padding: 1em;}
<?php print "</style>"; ?>
<?php } else { ?>
<?php print "<style type='text/css' media='screen'>"; ?>
#container .bb-sidebar { display: none !important; }
<?php print "</style>"; ?>
<?php } ?>


<!-- start theme options sync - using php to fetch theme option are deprecated and replace with style sync -->
<?php print "<style type='text/css' media='screen'>"; ?>
<?php include (TEMPLATEPATH . '/theme-options.php'); ?>
<?php print "</style>"; ?>
<!-- end theme options sync -->

</head>


<body <?php body_class() ?> id="custom">

<div id="wrapper">
<div id="container">

<div id="top-header">
<?php
if(($tn_wpmu_dixi_header_logo_img != "")){ ?>
<a href="<?php echo home_url(); ?>">
<img src="<?php echo stripcslashes($tn_wpmu_dixi_header_logo_img); ?>" alt="<?php bloginfo('name'); ?>" />
</a>
<?php } else { ?>
<h1><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
<p><?php bloginfo('description'); ?></p>
<?php } ?>
</div>

<?php
if(($tn_wpmu_dixi_header_on == "enable") || ($tn_wpmu_dixi_header_on == "")){ ?>
<div id="custom-img-header">
<a href="<?php if($tn_wpmu_dixi_header_link != "") { echo stripslashes($tn_wpmu_dixi_header_link); } else { echo site_url(); } ?>"><img src="<?php header_image(); ?>" alt="<?php bloginfo('name'); ?>" /></a></div>
<?php } ?>



<div id="navigation">
<div id="mobile-search">
<?php get_mobile_navigation( $type='top', $nav_name='main-nav' ); ?>
</div>
<ul id="nav">
<?php echo bp_wp_custom_nav_menu($get_custom_location='main-nav', $get_default_menu='revert_wp_menu_page'); ?>
</ul>
<div class="rss-feeds"><a href="<?php bloginfo('rss2_url'); ?>"><?php _e('RSS Feed', TEMPLATE_DOMAIN); ?></a></div>
</div>
<div class="content">
	<?php if ( function_exists( 'bp_message_get_notices' ) && is_user_logged_in() ) : ?>
		<?php bp_message_get_notices(); /* Site wide notices to all users */ ?>
	<?php endif; ?>