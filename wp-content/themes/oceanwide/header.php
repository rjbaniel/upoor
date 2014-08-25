<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>



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

<?php include(TEMPLATEPATH . '/options.php'); ?>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />

<?php print "<style type='text/css' media='screen'>"; ?>
<?php include (TEMPLATEPATH . '/fonts.php'); ?>
<?php print "</style>"; ?>

<!--[if !IE]>deleted this if you want the indexing for archives<![endif]-->
<?php if(is_archive()) { ?><meta name="robots" content="noindex"><?php } ?>
<!--[if !IE]>seo goodies only<![endif]-->

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
<script type="text/javascript">
jQuery(document).ready(function() {
	jQuery('#header_center').cycle({
		fx:    'fade',
		speed:    3000,
		timeout:  4000,
		pause: 0
	});
});
</script>

</head>



<body id="custom">

<div id="wrap">




<div id="page">



<div id="header">




<div id="header_top"></div>
<div id="header-navigation">
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

</div>




<div id="header-custom">

<?php $show_image_rotate = "$oc_ow_image_rotate_status"; ?>
<?php if($show_image_rotate == 'yes'): ?>

<div id="header_center">
<?php include (TEMPLATEPATH . '/rotate.php'); ?>
</div>

<?php else: ?>

<div id="header_center_original">


<?php $show_header_title = "$oc_ow_titlename_status"; ?>
<?php if($show_header_title=='yes'): ?>

<?php $show_image_rotate = "$oc_ow_image_rotate_status"; ?>
<?php if($show_image_rotate=='no'): ?>
<div id="header-sitename">
<h1><a href="<?php echo get_option('home'); ?>"><?php bloginfo('name'); ?></a></h1>
<p><?php bloginfo('description'); ?></p>
</div>
<?php endif; ?>

<?php endif; ?>  

<img src="<?php header_image(); ?>" alt="this is a header image" />



</div>
<?php endif; ?>



</div>




    
</div>




<div id="header_end">

<?php $show_image_rotate = "$oc_ow_image_rotate_status"; ?>
<?php if($show_image_rotate=='yes'): ?>
<div id="header-sitetitle">
<h1><a href="<?php echo get_option('home'); ?>"><?php bloginfo('name'); ?></a></h1>
<p><?php bloginfo('description'); ?></p>
</div>
<?php endif; ?>


		<div id="menu_search_box">

			<form method="get" id="searchform" style="display:inline;" action="<?php bloginfo('url'); ?>/">

			<span>Search:&nbsp;</span>

			<input type="text" class="s" value="<?php the_search_query(); ?>" name="s" id="s" />&nbsp;

			<input type="image" src="<?php bloginfo('stylesheet_directory'); ?>/images/go.gif" value="Submit" class="sub"   />

			</form>

		</div>

	</div>



<div id="blog">

	<div id="blog_left">

		<?php get_sidebar(); ?>

	</div>

	<div id="blog_center">

