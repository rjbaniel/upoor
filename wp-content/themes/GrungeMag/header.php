<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php elegant_titles(); ?></title>
<?php elegant_description(); ?>
<?php elegant_keywords(); ?>
<?php elegant_canonical(); ?>
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<!--[if IE 7]>
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/iestyle.css" />
	<![endif]-->
	<!--[if lt IE 7]>
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/ie6style.css" />
	<![endif]-->

	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div id="header">
		<div style="width: 950px; margin: auto;">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php $logo = (get_option('grungemag_logo') <> '') ? get_option('grungemag_logo') : get_template_directory_uri().'/images/logo.gif'; ?>
				<img src="<?php echo esc_attr( $logo ); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" class="logo"/></a>

			<?php if (get_option('grungemag_468_header_enable') == 'on') { ?>
				<div style="float: right; margin-top: 27px;">
					<?php if(get_option('grungemag_468_header_adsense') <> '') echo(get_option('grungemag_468_header_adsense'));
					else { ?>
						<a href="<?php echo esc_url(get_option('grungemag_468_header_url')); ?>" class="foursixeight_link"><img src="<?php echo esc_attr(get_option('grungemag_468_header_image')); ?>" style="border: none;" alt="advertisement" /></a>
					<?php } ?>
				</div>
			<?php } ?>
		</div>
		<div style="clear: both;"></div>

		<!--Begin Pages Navigation Bar-->
		<div id="pages">
			<?php $menuClass = 'nav superfish';
			$menuID = 'nav2';
			$primaryNav = '';
			if (function_exists('wp_nav_menu')) {
				$primaryNav = wp_nav_menu( array( 'theme_location' => 'primary-menu', 'container' => '', 'fallback_cb' => '', 'menu_class' => $menuClass, 'menu_id' => $menuID, 'echo' => false ) );
			};
			if ($primaryNav == '') { ?>
				<ul id="<?php echo esc_attr( $menuID ); ?>" class="<?php echo esc_attr( $menuClass ); ?>">
					<?php if (get_option('grungemag_swap_navbar') == 'false') { ?>
						<?php if (get_option('grungemag_home_link') == 'on') { ?>
							<li class="page_item<?php if (is_front_page()) echo(' current_page_item') ?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e('Home','GrungeMag'); ?></a></li>
						<?php }; ?>
						<?php show_page_menu($menuClass,false,false); ?>
					<?php } else { ?>
						<?php show_categories_menu($menuClass,false); ?>
					<?php } ?>
				</ul> <!-- end ul#nav -->
			<?php }
			else echo($primaryNav); ?>

		</div>
		<!--End Pages Navigation Bar-->
		<!--Begin Categories Navigation Bar-->
		<div id="categories">
			<?php $menuClass = 'nav superfish';
			$secondaryNav = '';
			if (function_exists('wp_nav_menu')) {
				$secondaryNav = wp_nav_menu( array( 'theme_location' => 'secondary-menu', 'container' => '', 'fallback_cb' => '', 'menu_class' => $menuClass, 'echo' => false ) );
			};
			if ($secondaryNav == '') { ?>
				<ul class="<?php echo esc_attr( $menuClass ); ?>">
					<?php if(get_option('grungemag_swap_navbar') == 'false') { ?>
						<?php show_categories_menu($menuClass,false); ?>
					<?php } else { ?>
						<?php if (get_option('grungemag_home_link') == 'on') { ?>
							<li class="page_item<?php if (is_front_page()) echo(' current_page_item') ?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e('Home','GrungeMag'); ?></a></li>
						<?php }; ?>
						<?php show_page_menu($menuClass,false,false); ?>
					<?php } ?>
				</ul> <!-- end ul.nav -->
			<?php }
			else echo($secondaryNav); ?>
		</div>
		<!--End category navigation-->
	</div>

	<div id="wrapper2">