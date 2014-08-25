<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php bloginfo('name'); ?> <?php if ( is_single() ) { ?> &raquo; <?php _e('Blog Archive','ml');?> <?php } ?> <?php wp_title(); ?></title>
<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats -->
<meta name="keywords" content="<?php bloginfo('description'); ?>" />
<meta name="description" content="<?php bloginfo('description'); ?>" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> <?php _e('RSS Feed','ml');?>" href="<?php bloginfo('rss2_url'); ?>" />
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
<?php
global $page_sort;
	if(get_option('mistylook_sortpages')!='')
	{
		$page_sort = 'sort_column='. get_option('mistylook_sortpages');
	}
	global $pages_to_exclude;

	if(get_option('mistylook_excludepages')!='')
	{
		$pages_to_exclude = 'exclude='. get_option('mistylook_excludepages');
	}
?>
<?php remove_action( 'wp_head', 'wp_generator' ); ?>
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>
</head>
<body id="section-index">


<div id="navigation">

<div id="custom">
<div id="custom-navigation">
<?php if ( function_exists( 'wp_nav_menu' ) ) { // Added in 3.0 ?>
<ul id="nav">
<?php echo bp_wp_custom_nav_menu($get_custom_location='main-nav', $get_default_menu='revert_wp_menu_page'); ?>

	<li class="search"><form method="get" id="searchform" action="<?php bloginfo('url'); ?>"><input type="text" class="textbox" value="<?php echo esc_html($s, 1); ?>" name="s" id="s" /><input type="submit" id="searchsubmit" value="<?php _e('Search','ml');?>" /></form></li>
</ul>
<?php } else { ?>
<ul id="nav">
	<li <?php if(is_home()){echo 'class="current_page_item"';}?>><a href="<?php bloginfo('url'); ?>/" title="<?php _e('Home','ml');?>"><?php _e('Home','ml');?></a></li>
		<?php wp_list_pages('title_li=&depth=1&'.$page_sort.'&'.$pages_to_exclude)?>
	<li class="search"><form method="get" id="searchform" action="<?php bloginfo('url'); ?>"><input type="text" class="textbox" value="<?php echo esc_html($s, 1); ?>" name="s" id="s" /><input type="submit" id="searchsubmit" value="<?php _e('Search','ml');?>" /></form></li>
</ul>
<?php } ?>
</div>   </div>



</div><!-- end id:navigation -->


<div id="container">


<div id="header">
<h1><a href="<?php bloginfo('url');?>/" title="<?php bloginfo('name');?>"><?php bloginfo('name');?></a></h1>
<p id="desc"><?php bloginfo('description');?></p>
</div><!-- end id:header -->


<div id="feedarea">
<dl>
	<dt><strong><?php _e('Feed on','ml');?></strong></dt>
	<dd><a href="<?php bloginfo('rss2_url'); ?>"><?php _e('Posts','ml');?></a></dd>
	<dd><a href="<?php bloginfo('comments_rss2_url'); ?>"><?php _e('Comments','ml');?></a></dd>
</dl>
</div><!-- end id:feedarea -->


  <div id="headerimage">
</div><!-- end id:headerimage -->
