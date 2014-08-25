<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

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



<!-- start theme options sync - using php to fetch theme option are deprecated and replace with style sync -->
<?php print "<style type='text/css' media='screen'>"; ?>
<?php include (TEMPLATEPATH . '/style.php'); ?>
<?php print "</style>"; ?>
<!-- end theme options sync -->


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
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/scripts/prototype.lite.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/scripts/moo.fx.js"></script>
	<script type="text/javascript">
		window.onload = function() {		    
			scale = new fx.Scaleheader('topbar', {duration: 500});
			scale2 = new fx.Scaleheader('commentwrapper', {duration: 500});
		}
	</script>
	<?php remove_action( 'wp_head', 'wp_generator' ); ?>
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>

<?php if (get_option( 'striped_maincolor' ) != "") {
$setmaincolor=get_option( 'striped_maincolor' );
print "<style>"; ?>

#nav li.current_page_item a, #nav li.current_menu_item a, #nav li.current_page_item a:hover, #nav li.current_menu_item a:hover {
  background: #<?php echo $setmaincolor; ?>;
}

#nav li ul { background: #<?php echo $setmaincolor; ?>; }
#nav li a:hover { color: #<?php echo $setmaincolor; ?>; }
<?php print "</style>";
} ?>


</head>
<body id="custom">
<div id="bigwrapper">

         <div id="custom-navigation">
<?php if ( function_exists( 'wp_nav_menu' ) ) { // Added in 3.0 ?>
<ul id="nav">
<?php echo bp_wp_custom_nav_menu($get_custom_location='main-nav', $get_default_menu='none'); ?>
</ul>
<?php } else { ?>
<ul id="nav">
<?php wp_list_pages('title_li=&depth=1'); ?>
</ul>
<?php } ?>
</div>

    <div id="header">
	<h1><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
	            
	</div>
	<div id="topbar" onmouseover="scale.sizeup()" onmouseout="scale.sizedown(30)"><script type="text/javascript">var topbar = document.getElementById('topbar'); topbar.style.height = 30 + "px";</script>
		<div id="redline"><p>Navigation | <span class="where"><?php if ( is_search() ) { ?> Search results &raquo; <?php echo esc_html($s, 1); ?><?php } ?><?php if ( is_date() ) { ?><?php _e('Archive');?><?php wp_title(); ?><?php } ?><?php if ( is_category() ) { ?> Category <?php wp_title(); ?><?php } ?><?php if ( is_single() or is_page()) { ?><?php wp_title(''); ?><?php } ?><?php if ( is_home()) { ?><?php bloginfo('title'); ?><?php } ?></span></p></div>
		<div id="topbarmenuwrapper">
		<?php get_sidebar('topbar'); ?>
		</div>
	</div>
