<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
	
	$options = get_option('page_options');

	if($options['feed'] && $options['feed_url']) {
		if (substr(strtoupper($options['feed_url']), 0, 7) == 'HTTP://') {
			$feed = $options['feed_url'];
		} else {
			$feed = 'http://' . $options['feed_url'];
		}
	} else {
		$feed = get_bloginfo('rss2_url');
	}
?>

<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php bloginfo('name'); ?> <?php if ( is_single() ) { ?> &raquo; Blog Archive <?php } ?> <?php wp_title(); ?></title>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" title="style"  media="screen" />
<link rel="alternate" type="application/rss+xml" title="<?php _e('RSS 2.0 - all posts', 'page'); ?>" href="<?php echo $feed; ?>" />
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


    <!--[if lte IE 6]>
         <style type="text/css">
            img, div, a, input, span{ behavior: url('<?php bloginfo('template_directory'); ?>/img/iepngfix.htc') }
        </style>
       <style type="text/css">@import url('<?php bloginfo('template_directory'); ?>/ie.css');</style>
	<![endif]-->

	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery-1.2.3.min.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.easing.min.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.lavalamp.min.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/smoothscroll.js"></script>
<script type="text/javascript">
        $(function() {
            $("#lmenu").lavaLamp({
                fx: "backout", 
                click: function(event, menuItem) {
                    return true;
                }
            });
        });
</script>
<script type="text/javascript">
	  // When the document loads do everything inside here ...
	  $(document).ready(function(){	
		// When a link is clicked
		$("a.tab").click(function () {
			// switch all tabs off
			$(".active").removeClass("active");	
			// switch this tab on
			$(this).addClass("active");
			// slide all content up
			$(".contentlist").slideUp();
			// slide this content up
			var content_show = $(this).attr("title");
			$("#"+content_show).slideDown();
		});
	  });
</script>

<?php remove_action( 'wp_head', 'wp_generator' ); ?>
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>

</head>
<body id="custom">
<div id="page">


<div id="header">
		<h1><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></h1>
		<div class="description"><?php bloginfo('description'); ?></div>



</div>




<div id="menu">

<?php if('' != get_header_image() ) { ?>
<a href="<?php bloginfo('url'); ?>"><img style="margin: 15px 0px 15px 0px;" src="<?php header_image(); ?>" alt="<?php bloginfo('name'); ?>" /></a>
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



		<div class="clear"></div>
</div>

	<div class="clear"></div>


<hr />
