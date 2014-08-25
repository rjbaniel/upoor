<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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

<?php global $letoprime; // Grab options from options page ?>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
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

<style type="text/css" media="screen">

	#header {

		<?php if ($letoprime->option['header_url'] && $letoprime->option['header_url'] != "") { ?>
		background: #fff url(<?php echo $letoprime->option['header_url']; ?>);
		<?php } else if ($letoprime->option['header'] && $letoprime->option['header'] != "none") { ?>
		background: #fff url(<?php bloginfo('stylesheet_directory'); ?>/header/header-<?php echo $letoprime->option['header']; ?>.jpg);
		<?php } else if ($letoprime->option['header'] == "none") { ?>
		height: 0 !important;
		margin: 0 !important;
		<?php } else { ?>
		background: #fff url(<?php bloginfo('stylesheet_directory'); ?>/header/header-cactus.jpg);
		<?php } ?>
	}
	
	
	#header h1 	{
		<?php if ($letoprime->option['header'] =="cactus") { ?>
<!--cactus header - adjust here -->	
	margin: 0;	
	font-size: 2.2em;	
	padding:20px 0 0 20px;
	text-align:left;}
	#header h1 a {color: white; text-decoration:none; }
	#header .description { color:black; text-align:left; padding-left: 20px;
	}
		<?php } else if ($letoprime->option['header'] =="mountain") { ?>
<!--mountain header - adjust here -->	
	margin: 0;	
	font-size: 1.6em;	
	padding:20px 20px 0 0;
	text-align:right;}
	#header h1 a {color: blue; text-decoration:none; }
	#header .description { color:black; text-align:right; padding-right: 20px;
	}
<!--flower header - adjust here -->
		<?php } else if ($letoprime->option['header'] =="flower") { ?>
	margin: 0;	
	font-size: 1.6em;	
	padding:20px 20px 0 0;
	text-align:right;}
	#header h1 a {color:blue; text-decoration:none; }
	#header .description { color:black; text-align:right; padding-right: 20px;
	 }
<!--leaf in light) header - adjust here -->
		<?php } else if ($letoprime->option['header'] =="leafinlight") { ?>
			margin: 0;	
	font-size: 2.0em;	
	width: 250px;
	padding:20px 0 0 25px  ;
	text-align:left; }
	#header h1 a {color: white; text-decoration:none; }
	#header .description { color:white; text-align:left; padding-left: 20px;
	 }
<!--meadow(tree) header - adjust here -->
		<?php } else if ($letoprime->option['header'] =="meadow") { ?>
			margin: 0;	
	font-size: 2.3em;	
	padding:80px 20px 0 0;
	text-align:right; }
	#header h1 a {color: white; text-decoration:none; }
	#header .description { color:white; text-align:right; padding-right: 20px;
	 }
<!--shark header - adjust here -->
		<?php } else if ($letoprime->option['header'] =="shark") { ?>
			margin: 0;
	font-size: 2.3em;	
	padding:20px 20px 0 0;
	text-align:right; }
	#header h1 a {color:white; text-decoration:none; }
	#header .description { color:white; text-align:right; padding-right: 20px;
	 }
<!--very large array header - adjust here -->
		<?php } else if ($letoprime->option['header'] =="vla") { ?>
			margin: 0;	
	font-size: 1.6em;
	font-weight:bold;	
	padding:20px 20px 0 0;
	text-align:right; }
	#header h1 a {color:#0000ff; text-decoration:none; }
	#header .description { color:white; text-align:right; padding-right: 20px;
	 }
<?php } else { ?>
	margin: 0;	
	font-size: 2.2em;	
	padding:20px 0 0 20px;
	text-align:left;}
	#header h1 a {color: white; text-decoration:none; }
	#header .description { color:black; text-align:left; padding-left: 20px;
	} <?php } ?>
 </style>
<?php if (is_single() and ('open' == $post->comment_status) or ('comment' == $post->post_type) ) { ?>
 	
<?php } ?>
<?php remove_action( 'wp_head', 'wp_generator' ); ?>
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>

</head>
<body id="custom">
<div id="page">


<div id="header">
	<div id="headerimg">
	
		<h1><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></h1>
		<div class="description"><?php bloginfo('description'); ?></div>
	</div>


<div id="custom-navigation">
<?php if ( function_exists( 'wp_nav_menu' ) ) { // Added in 3.0 ?>
<?php if ( has_nav_menu( 'main-nav' ) ) { ?>
<ul id="nav">
<?php echo bp_wp_custom_nav_menu($get_custom_location='main-nav', $get_default_menu='revert_wp_menu_page'); ?>
</ul>
<?php } ?>
<?php } else { ?>
<ul id="nav">
<?php wp_list_pages('title_li=&depth=1'); ?>
</ul>
<?php } ?>
</div>

</div>
<hr />
