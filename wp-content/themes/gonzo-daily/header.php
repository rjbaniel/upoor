<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="bg">

<head>

	<meta http-equiv="Content-Type" content="application/xhtml+xml;charset=<?php bloginfo('charset'); ?>" />

	<title><?php if( is_search() ) { $ser = $_GET['s']; ?><?php _e('Search'); ?><?php echo " &quot;" . esc_html($ser, 1) . "&quot;"; } ?><?php wp_title(''); ?><?php if( ! is_home() ) { ?> | <?php } ?><?php echo strip_tags(html_entity_decode(get_option('blogname'),ENT_NOQUOTES,'UTF-8')); ?></title>

	<meta http-equiv="imagetoolbar" content="no" />

	

	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="all" />

	

	<!--[if lt IE 8]>

	<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('stylesheet_directory'); ?>/ie7-style.css" />

	<![endif]-->



	<!--[if IE]>

	<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('stylesheet_directory'); ?>/ie-style.css" />

	<![endif]-->



	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/print.css" type="text/css" media="print" />

	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/mobile.css" type="text/css" media="handheld" />



	<style type="text/css">

		@import url(<?php bloginfo('stylesheet_directory'); ?>/mobile.css) screen and (max-width:801px);

	</style>

	

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

	

</head>

<body id="custom">

            <div id="inwrap">

            <div id="incontent">

	<div id="header">

		<?php if (is_home() || is_page_template('archives.php') ){ ?>

		<h1><a href="<?php echo get_option('home'); ?>/"><?php echo html_entity_decode(get_option('blogname'),ENT_NOQUOTES,'UTF-8'); ?></a></h1>

		<?php } else { ?>

		<p class="title"><a href="<?php echo get_option('home'); ?>/"><?php echo html_entity_decode(get_option('blogname'),ENT_NOQUOTES,'UTF-8'); ?></a></p>

		<?php } ?>

		<div class="description"><?php bloginfo('description'); ?></div>

		<?php /*

		<ul id="navigation">

			<li><a href="/"><?php _e('Home'); ?></a></li>

			<?php wp_list_pages('title_li=&depth=1&sort_column=menu_order'); ?>

		</ul>

		*/ ?>

	</div>


    <?php if('' != get_header_image() ) { ?>
    <div id="custom-img-header">
<a href="<?php bloginfo('url'); ?>"><img style="margin-top: 20px;" class="centered" src="<?php header_image(); ?>" alt="<?php bloginfo('name'); ?>" /></a>       </div>
<?php } ?>

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
