<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head profile="http://gmpg.org/xfn/11">



<title>

<?php if ( is_home() ) { ?><?php bloginfo('name'); ?>&nbsp;|&nbsp;<?php bloginfo('description'); ?><?php } ?>

<?php if ( is_search() ) { ?><?php bloginfo('name'); ?>&nbsp;|&nbsp;Search Results<?php } ?>

<?php if ( is_author() ) { ?><?php bloginfo('name'); ?>&nbsp;|&nbsp;Author Archives<?php } ?>

<?php if ( is_single() ) { ?><?php wp_title(''); ?>&nbsp;|&nbsp;<?php bloginfo('name'); ?><?php } ?>

<?php if ( is_page() ) { ?><?php bloginfo('name'); ?>&nbsp;|&nbsp;<?php wp_title(''); ?><?php } ?>

<?php if ( is_category() ) { ?><?php bloginfo('name'); ?>&nbsp;|&nbsp;Archive&nbsp;|&nbsp;<?php single_cat_title(); ?><?php } ?>

<?php if ( is_month() ) { ?><?php bloginfo('name'); ?>&nbsp;|&nbsp;Archive&nbsp;|&nbsp;<?php the_time('F'); ?><?php } ?>

<?php if (function_exists('is_tag')) { if ( is_tag() ) { ?><?php bloginfo('name'); ?>&nbsp;|&nbsp;Tag Archive&nbsp;|&nbsp;<?php  single_tag_title("", true); } } ?>

</title>



<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />



<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/reset.css" type="text/css" />

<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/960.css" type="text/css" />

<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="screen" />



<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php if ( get_option('woo_feedburner_url') <> "" ) { echo get_option('woo_feedburner_url'); } else { echo get_bloginfo_rss('rss2_url'); } ?>" />

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



<!-- Show custom logo -->

<?php if ( get_option('woo_logo') <> "" ) { ?>

<?php print "<style type=\"text/css\" media=\"all\"> "; ?>

div#logo h1 a {display: block; font-size: 0px; width: 300px; height: 40px; background: url(<?php echo get_option('woo_logo'); ?>) no-repeat !important; }

<?php print "</style>"; ?>

<?php } ?>



<!--[if lt IE 7]>

<script src="<?php bloginfo('template_directory'); ?>/includes/js/pngfix.js" type="text/javascript"></script>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/ie6.css" type="text/css" />

<![endif]-->





<?php

$woo_custom_body_font = get_option('woo_custom_body_font');

$woo_custom_headline_font = get_option('woo_custom_headline_font');

?>





<?php print "<style type=\"text/css\" media=\"all\"> "; ?>



#custom div, #custom li, #custom p, #custom p p, #custom ul#navigation li a, #custom .widget, #footer a {

  font-family: <?php echo $woo_custom_body_font; ?> !important;

}



h1, h2, h3, h4, h5, h6 {

  font-family: <?php echo $woo_custom_headline_font; ?> !important;

}

#custom .textwidget, #footer a {

  padding-top: 15px;

  font-size: 13px;

  line-height: 130%;

  color: #DDE4CE;

}

#custom #footer a {

  color: #DFDFDF;

}



#custom ul.children .entry {

   border-left: 5px solid #eee;

   padding-left: 10px;

   padding-bottom: 10px;

}



#custom ol.commentlist .entry blockquote {

	margin: 25px 50px 25px 15px !important;

	padding: 15px !important;

	background: #eee;

	border: 1px solid #ddd;

	font-weight: normal;

	font-size: 14px;

}



#custom ol.commentlist .entry .reply {

	padding-bottom: 15px !important;

	font-size: 12px;

}

#custom form p#logged, div.cancel-comment-reply {

	padding-left: 150px !important;

	font-size: 13px;

    margin: 10px 0px 10px 0px;

}

#custom div.post .entry blockquote {

	margin: 0px 15px 10px !important;

	line-height: 22px;

	font-size: 18px !important;

	padding: 8px 0px 8px 10px !important;

	font-family: Georgia, "Times New Roman", Helvetica, sans-serif !important;

	font-style: italic;

	font-weight: normal;

	border-left: 4px solid #333333;

	letter-spacing: -1px;

    background: url(images/spacer.gif);

}

#custom #logo h2 {

font-size: 28px;

}

#custom #logo a {

color: #fff;

text-decoration: none;

}

#custom #logo p {

color: #F7F7F7;

font-size: 12px;

}

#custom div#custom-img-header {

 width: 940px;

 height: 150px;

 background: #000;

 margin-top: 10px;

 overflow: hidden;

}

#custom #searchform {

  padding: 8px;

  background: #fff;

  border: 1px solid #dadada;

}

#custom #searchform #s {

  padding: 2px;

  width: 95%;

  color: #555;

  background: #fff;

  margin-bottom: 6px;

  border: 1px solid #dadada;

}





#custom ol.commentlist .meta {

	margin: 0px;

	padding: 0px;

	float: left;

	width: 130px !important;

}

#custom ol.commentlist .postbody {

	margin: 0px;

	padding-left: 30px;

	float: left;

	width: 70% !important;

}



#custom ol.commentlist li {

	float: left;

	width: 100%;

}





<?php print "</style>"; ?>















<?php wp_enqueue_script('jquery'); ?>

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

<?php wp_head(); ?>



<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/includes/js/jquery.ui.js"></script>

<script type="text/javascript">

	jQuery(document).ready(function(){

		jQuery("#sidebar_accordian").accordion({ header: "h4", autoHeight: false });

	});

</script>



</head>







<body id="custom">



	<div id="header">



		<div class="container_12">









			<div id="logo" class="grid_4 alpha">



                <?php $woo_logo = get_option('woo_logo'); if($woo_logo != "") { ?>



				<h1><a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>">&nbsp;</a></h1>



                <?php } else { ?>



                <h2><a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a></h2>

                <p><?php bloginfo('description'); ?></p>

                <?php } ?>



			</div>	<!--grid_6-->











            <?php

$twitter_status =  get_option('woo_twitter');

if( $twitter_status != "" ) { ?>

			<div id="twitter" class="grid_8 omega">

				<ul id="twitter_update_list"><li></li></ul>

			</div>	<!--grid_6-->

             <?php } ?>





			<div class="clearfix"></div>



		</div><!--container_12-->



	</div><!--header-->



	<div id="nav">

         <div id="custom-navigation">

		<div class="container_12">

         <?php if ( function_exists( 'wp_nav_menu' ) ) { // Added in 3.0 ?>

<ul id="navigation"><?php echo bp_wp_custom_nav_menu($get_custom_location='main-nav', $get_default_menu='revert_wp_menu_page'); ?></ul>
<?php } else { ?>

<ul id="navigation">



					<li><a <?php if ( is_home() ) { ?>class="current_page_item"<?php } ?> href="<?php bloginfo('url'); ?>">

							<?php _e('Home', 'blogtheme'); ?>

						</a>

					</li>

<?php wp_list_pages("title_li=&depth=0"); ?>    



				</ul>
<?php } ?>

				<!--navigation -->



		</div><!--container_12-->
            </div>


	</div><!--nav-->









	<div id="outerwrap" class="container_12">

       <?php $woo_get_header = get_header_image(); if($woo_get_header == '') { ?>

       <?php } else { ?>

      <div id="custom-img-header"><img src="<?php header_image(); ?>" alt="<?php bloginfo('name'); ?>" /></div>

      <?php } ?>

		<div id="contentwrap">



		<div id="wrap">

