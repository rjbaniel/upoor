<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php elegant_titles(); ?></title>
<?php elegant_description(); ?>
<?php elegant_keywords(); ?>
<?php elegant_canonical(); ?>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />

<!--[if lt IE 7]>
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/ie6style.css" />
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/DD_belatedPNG_0.0.8a-min.js"></script>
	<script type="text/javascript">DD_belatedPNG.fix('img#logo, p#slogan, .nav li ul, ul#top-navigation li ul a, div#search-icon, div#header div#search-form, div#featured-slider, span.feat-overlay,  div#from-blog ul.control li img, span.project-overlay, div#main-area div.page-block h3, p#slogan-phrase, div#main-area div.page-block div.separator, div#main-area a.readmore, div#main-area a.readmore span, div#from-blog div.content div.post p.meta a.comments-number, div#footer-widget-area a.readmore, div#footer-widget-area a.readmore span, div#from-blog img#subscribe, div.widget h3.title span, h1#post-title span, div.post p.date, div.post p.meta span.comments-number a, div.reply-container, a.comment-reply-link');</script>
<![endif]-->
<!--[if IE 7]>
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/ie7style.css" />
<![endif]-->

<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<script type="text/javascript">
	document.documentElement.className = 'js';
</script>

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>

</head>
<body <?php if (is_home()) echo('id="home"');?> <?php body_class(); ?>>
	<div id="header">
		<div class="container">
			<div id="logo-highlight"></div>

			<!-- Logo -->
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php $logo = (get_option('lumin_logo') <> '') ? get_option('lumin_logo') : get_template_directory_uri().'/images/logo.png'; ?>
				<img src="<?php echo esc_attr( $logo ); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" id="logo"/></a>

			<p id="slogan"><?php echo html_entity_decode(get_option('lumin_tagline')); ?></p>

			<?php $menuClass = 'superfish nav';
			$menuID = 'top-navigation';
			$primaryNav = '';

			if (function_exists('wp_nav_menu')) {
				$primaryNav = wp_nav_menu( array( 'theme_location' => 'primary-menu', 'container' => '', 'fallback_cb' => '', 'menu_class' => $menuClass, 'menu_id' => $menuID, 'echo' => false ) );
			};
			if ($primaryNav == '') { ?>
				<ul id="<?php echo esc_attr( $menuID ); ?>" class="<?php echo esc_attr( $menuClass ); ?>">
					<?php if (get_option('lumin_home_link') == 'on') { ?>
						<li <?php if (is_front_page()) echo('class="current_page_item"') ?>><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e('Home','Lumin'); ?></a></li>
					<?php }; ?>

					<?php show_categories_menu($menuClass,false); ?>

					<?php show_page_menu($menuClass,false,false); ?>
				</ul> <!-- end ul.nav -->
			<?php }
			else echo($primaryNav); ?>

			<div id="search-icon">
				<a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/search-icon.png" alt="search" id="search"/></a>
			</div> <!-- end search-icon -->

			<div id="search-form">
				<form method="get" id="searchform1" action="<?php echo esc_url( home_url( '/' ) ); ?>/">
					<input type="text" value="<?php esc_attr_e('search this site...','Lumin'); ?>" name="s" id="searchinput" />
				</form>
			</div> <!-- end searchform -->
		</div> <!-- end header/container -->
	</div> <!-- end header -->

	<div id="main-area">
		<div class="container">