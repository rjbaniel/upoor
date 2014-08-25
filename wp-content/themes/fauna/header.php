<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php wp_title(); ?> <?php bloginfo('name'); ?></title>

	
	<!-- Feeds -->
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> Comments RSS 2.0" href="<?php bloginfo('comments_rss2_url'); ?>" />

	<?php if (is_category()) { ?>
	<!-- Category Feed -->
	<?php if ( have_posts() ) : the_post(); ?>
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> <?php echo($post->cat_name) ?> RSS 2.0" href="<? echo get_category_rss_link(0, $cat, $post->cat_name); ?>" />
	<?php endif; rewind_posts(); ?>
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

	<?php remove_action( 'wp_head', 'wp_generator' ); ?>
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>
	
	<!-- Stylesheet -->
	<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('stylesheet_url'); ?>" />
	<link rel="stylesheet" type="text/css" media="screen" title="Fauna" href="<?php bloginfo('stylesheet_directory'); ?>/fauna-default.css" />
	
	<!-- JavaScripts -->
	<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/meta/scripts.js"></script>

	<?php /* Custom Fauna Code */
	function noteworthy_link($id, $link = FALSE, $separator = '/', $nicename = FALSE){
    $chain = '';
		$parent = &get_category($id);
    if ($nicename) {
        $name = $parent->category_nicename;
    } else {
        $name = $parent->cat_name;
    }
    if ($parent->category_parent) $chain .= get_category_parents($parent->category_parent, $link, $separator, $nicename);
    if ($link) {
        $chain .= '<a href="' . get_category_link($parent->cat_ID) . '" title="' . sprintf(__("View all posts in %s"), $parent->cat_name) . '">'."&hearts;".'</a>' . $separator;
    } else {
        $chain .= $name.$separator;
    }
    return $chain;
	}
	?>
</head>

<? // Sections ?>
<? if (is_home()) { ?>
<body class="bg" id="index">
<? } else { ?>
<body class="bg">
<? } ?>

<a id="top"></a>

<div id="wrapper">

       <div id="dheader">
	<h1><a href="<?php echo get_option('home'); ?>" title="<?php bloginfo('name'); ?> <?php _e('Home'); ?>"><?php bloginfo('name'); ?></a></h1>
	<div id="menu">
               <div id="custom">
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

        <div id="searchbox">
		<fieldset>
			<legend><label for="s"><?php _e('Search') ?></label></legend>
			<form id="searchform" method="get" action="<?php bloginfo('url'); ?>">
				<input name="s" type="text" class="inputbox" id="s" value="<?php echo esc_html($s, 1); ?>" />
				<input type="submit" value="Search" class="pushbutton" />
			</form>
		</fieldset>
	</div>
    
	</div>
           </div>

	


	<div id="header"><a href="<?php echo get_option('home'); ?>"><img src="<?php header_image() ?>" width="780" height="200" alt="Homepage logo" /></a></div>

<hr />
