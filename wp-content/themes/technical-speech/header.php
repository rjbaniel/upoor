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

		<link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet" type="text/css" media="screen"/>
		<!--[if lte IE 6]>
 		<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/ie_style.css" media="screen"/>
		<![endif]-->
		<link rel="alternate" type="application/rss+xml" title="| <?php bloginfo('name'); ?> | RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
		<link rel="alternate" type="application/atom+xml" title="| <?php bloginfo('name'); ?> | Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
		
		<?php // comments_popup_script(); ?>
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
		<div id="body">
			<div id="wrap">
				<div id="navs">


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



					<?php global $tp_date_display; ?>
					<?php global $tp_date_dispf; ?>
					<?php if($tp_date_dispf) { $df = $tp_date_dispf; }else{$df = "l, j F Y";} ?>
					<?php if ($tp_date_display != "true") : ?>
					<div class="meta">
						<?php echo date($df); ?>
					</div>
					<?php endif; ?>
		  <a href="<?php bloginfo('rss2_url'); ?>" title="Subscribe to RSS Feed" class="rss_link"><?php _e('RSS', 'technical-speech'); ?></a>
				   </div>	<div class="clear"></div>
				</div>
				<div id="header">
					<div id="headcontent">
						<?php global $tp_header_display; ?>
						<?php global $tp_large_head; ?>
						<?php if($tp_header_display == "text"){ ?>
						<div>
							<h1><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
							<h6><?php bloginfo('description'); ?></h6>
						</div>
						<?php }elseif ($tp_header_display == "image"){ ?>
							<?php if($tp_large_head != "true"){$h_img_src = "head_image.jpg";}else{$h_img_src = "head_image_large.jpg";} ?>
						<img src="<?php bloginfo('template_directory'); ?>/images/<?php echo $h_img_src; ?>" alt="Technical Speech" />
						<?php } ?>
					</div>
					<?php if ($tp_large_head != "true") : ?>
					<div id="headsearch">
						<form action="<?php bloginfo('url')?>" method="get" id="searchform">
							<input name="s" type="text" value="<?php echo esc_html($s, 1); ?>"/>
							<img src="<?php bloginfo('template_directory'); ?>/images/search_button.gif" alt="Search" />
						</form>
					</div>
					<?php endif; ?>
				</div>


<?php if('' != get_header_image() ) { ?>
<a href="<?php bloginfo('url'); ?>"><img src="<?php header_image(); ?>" alt="<?php bloginfo('name'); ?>" /></a>
<?php } ?>
