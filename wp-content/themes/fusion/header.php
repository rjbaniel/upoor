<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<?php /* Fusion/digitalnature */

  if(get_option('fusion_meta')<>'') {

   if (is_home()) {

  	$metakeywords = get_option('fusion_meta');

   } else if (is_single()) {

  	$metakeywords = "";

  	$tags = wp_get_post_tags($post->ID);

  	foreach ($tags as $tag ) {

  	  $metakeywords = $metakeywords . $tag->name . ", ";

  	}

   }

  }

?>

<html xmlns="http://www.w3.org/1999/xhtml" <?php // language_attributes('xhtml'); // -> generates invalid markup :( ?>>



<head profile="http://gmpg.org/xfn/11">

<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<?php if(isset($metakeywords) && $metakeywords<>'') { ?>

<meta name="keywords" content="<?php echo $metakeywords; ?>" />

<meta name="description" content="<?php bloginfo('description'); ?>" />

<?php } ?>



<title><?php wp_title('&laquo;', true, 'right'); ?><?php bloginfo('name'); ?></title>



<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />

<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />

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

<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/favicon.ico" />



<?php

  if(!defined("PHP_EOL")) define("PHP_EOL", strtoupper(substr(PHP_OS,0,3) == "WIN") ? "\r\n" : "\n"); 



  print '<style type="text/css" media="all">'.PHP_EOL;

  print '@import "'.get_bloginfo('stylesheet_url').'";'.PHP_EOL;



  if(get_option('fusion_sidebarpos')=='left')

    print '@import "'.get_bloginfo('template_url').'/options/leftsidebar.css";'.PHP_EOL;



  if(get_option('fusion_header')=='user') {

    if(get_option('fusion_headerimage')<>'')

       print '#page-wrap2{ background: transparent url("'.get_option('fusion_headerimage').'") no-repeat center top; }'.PHP_EOL;

    if(get_option('fusion_headerimage2')<>'')

        print '#page-wrap1{ background: transparent url("'.get_option('fusion_headerimage2').'") repeat-x center top; }'.PHP_EOL;

   }



  else if(get_option('fusion_header')=='user2') {

    print '#page-wrap2{ background: #'.get_option('fusion_headercolor').'; }'.PHP_EOL;

    print '#page-wrap1{ background: none; }'.PHP_EOL;

  }



  $usercss = get_option('fusion_css');

  if($usercss<>'') print $usercss;



  print '</style>'.PHP_EOL;

?>









<?php

$fusion_fonts = get_option('fusion_body_font');

$fusion_line_height = get_option('fusion_line_height');

$fusion_headline = get_option('fusion_headline_font');

$fusion_sidebarpos = get_option('fusion_sidebarpos');

$fusion_post_size = get_option('fusion_font_size');

$fusion_line_height = $fusion_post_size + 8; //line height auto control

$fusion_span_info = $fusion_post_size - 2; //line height auto control

$fusion_title_size = $fusion_post_size + 12; //h3.post-title font size auto control

$fusion_subtitle_size = $fusion_post_size + 5; //sub-title font size auto control

?>



<?php print "<style type=\"text/css\" media=\"all\"> "; ?>





#custom {

  font-family: <?php echo "$fusion_fonts"; ?>;

}





#custom .entry {

  line-height: <?php echo $fusion_line_height; ?>px;

}



h1, h2, h3, h4, h5, h6 {

   font-family: <?php echo "$fusion_headline"; ?> !important;

}





#custom #commentform input[type='text'], #custom #commentform textarea {

  width: 90%;

  padding: 8px;

}





#custom .entry { font-size: <?php echo $fusion_post_size; ?>; }

#custom .post h3.title, #custom .post h2.title, #custom .page h3.title, #custom .page h2.title{ font-weight: normal; font-size: <?php echo $fusion_title_size; ?>px; }



#custom .postinfo p, #custom .postmetadata { font-size: <?php echo $fusion_span_info; ?>px; }



#custom .entry h2,

#custom .entry h3,

#custom .entry h4,

#custom .entry h5,

#custom .entry h6

{ font-size: <?php echo $fusion_subtitle_size; ?>px;

  margin-top: 25px !important;

}

#custom ul#twitter_update_list li {

  padding-bottom: 15px;

}

<?php print "</style>"; ?>







<!--[if lte IE 6]>

<script type="text/javascript">

/* <![CDATA[ */

   blankimgpath = '<?php bloginfo('template_url'); ?>/images/blank.gif';

 /* ]]> */

</script>

<style type="text/css" media="screen">

  @import "<?php bloginfo('template_url'); ?>/ie6.css";

  body{ behavior:url("<?php bloginfo('template_url'); ?>/js/ie6hoverfix.htc"); }

  img{ behavior: url("<?php bloginfo('template_url'); ?>/js/ie6pngfix.htc"); }

</style>

<![endif]-->





<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

<?php if(get_option('fusion_jquery')<>'no') { ?>

 <?php wp_enqueue_script('jquery'); ?>

 <?php wp_enqueue_script('fusion',get_bloginfo('template_url').'/js/fusion.js'); ?>

<?php } ?>



<?php wp_head(); ?>



<?php if(get_option('fusion_jquery')<>'no') { ?>

<script type="text/javascript">

/* <![CDATA[ */

 jQuery(document).ready(function(){

  // body .safari class

  if (jQuery.browser.safari) jQuery('body').addClass('safari');



  // layout controls

  <?php if(get_option('fusion_controls')<>'no') { ?>

   jQuery("#layoutcontrol a").click(function() {

     switch (jQuery(this).attr("class")) {

	   case 'setFont' : setFontSize();	break;

	   case 'setLiquid'	: setPageWidth();	break;

	 }

	 return false;

    });

   // set the font size from cookie

   var font_size = jQuery.cookie('fontSize');

   if (font_size == '.70em') { jQuery('body').css("font-size",".70em"); }

   if (font_size == '.95em') { jQuery('body').css("font-size",".95em"); }

   if (font_size == '.75em') { jQuery('body').css("font-size",".75em"); }



   // set the page width from cookie

   var page_width = jQuery.cookie('pageWidth');

   if (page_width) jQuery('#page').css('width', page_width);

  <?php } ?>



  jQuery('#post-extra-content').minitabs(333, 'slide');

  //jQuery('#tabtest').minitabs(333, 'slide');



  if (document.all && !window.opera && !window.XMLHttpRequest && jQuery.browser.msie) { var isIE6 = true; }

  else { var isIE6 = false;} ;

  jQuery.browser.msie6 = isIE6;

  if (!isIE6) {

    initTooltips({

		timeout: 6000

   });

  }

  tabmenudropdowns();



  // some jquery effects...

  jQuery('#sidebar ul.nav li ul li a').mouseover(function () {

   	jQuery(this).animate({ marginLeft: "4px" }, 100 );

  });

  jQuery('#sidebar ul.nav li ul li a').mouseout(function () {

    jQuery(this).animate({ marginLeft: "0px" }, 100 );

  });

  // scroll to top

  jQuery("a#toplink").click(function(){

    jQuery('html').animate({scrollTop:0}, 'slow');

  });



  // set roles on some elements (for accessibility)

  jQuery("#tabs").attr("role","navigation");

  jQuery("#mid-content").attr("role","main");

  jQuery("#sidebar").attr("role","complementary");

  jQuery("#searchform").attr("role","search");



 });



 /* ]]> */

</script>

<?php } ?>



</head>

<body <?php if (is_home()) { ?>class="home"<?php } else { ?>class="<?php echo $post->post_name; ?>"<?php } ?> id="custom">




  <!-- page wrappers (100% width) -->

  <div id="page-wrap1">

    <div id="page-wrap2">

      <!-- page (actual site content, custom width) -->

      <div id="page"<?php if((is_page_template('page-3col.php') || (get_option('fusion_3col')=='yes')) && (!is_page_template('page-nosidebar.php')) && (!is_page_template('page-2col.php'))) { ?> class="with-sidebar2"<?php } else if(!is_page_template('page-nosidebar.php')) { ?> class="with-sidebar"<?php } ?>>



       <!-- main wrapper (side & main) -->

       <div id="main-wrap">

        <!-- mid column wrap -->

    	<div id="mid-wrap">

          <!-- sidebar wrap -->

          <div id="side-wrap">

            <!-- mid column -->

    	    <div id="mid">

              <!-- header -->

              <div id="header">

                <?php if(get_bloginfo('description')<>'') { ?><div id="topnav" class="description"> <?php bloginfo('description'); ?></div><?php } ?>





                <?php

                // logo image?

                if(get_option('fusion_logo')=='yes' && get_option('fusion_logoimage')) { ?>

                <a id="logo" href="<?php bloginfo('url'); ?>/"><img src="<?php print get_option('fusion_logoimage'); ?>" title="<?php bloginfo('name');  ?>" alt="<?php bloginfo('name');  ?>" /></a>

                <?php } else { ?>

                <h1 id="title"><a href="<?php bloginfo('url'); ?>/"><?php bloginfo('name'); ?></a></h1>

                <?php }  ?>



                <!-- top tab navigation -->

                <div id="tabs">




<?php if ( function_exists( 'wp_nav_menu' ) ) { // Added in 3.0 ?>
<ul>
<?php echo bp_wp_custom_nav_menu($get_custom_location='main-nav', $get_default_menu='revert_wp_menu_page'); ?>
</ul>
<?php } else { ?>
<ul>

                 <?php

                  if((get_option('show_on_front')<>'page') && (get_option('fusion_topnav')<>'categories')) {

                   if(is_home() && !is_paged()){ ?>

                    <li id="nav-homelink" class="current_page_item"><a href="<?php echo get_option('home'); ?>" title="<?php _e('You are Home','fusion'); ?>"><span><span><?php _e('Home','fusion'); ?></span></span></a></li>

                   <?php } else { ?>

                    <li id="nav-homelink"><a href="<?php echo get_option('home'); ?>" title="<?php _e('Click for Home','fusion'); ?>"><span><span><?php _e('Home','fusion'); ?></span></span></a></li>

                  <?php

                   }

                  } ?>

                 <?php

                   if(get_option('fusion_topnav')=='categories') { echo preg_replace('@\<li([^>]*)>\<a([^>]*)>(.*?)\<\/a>@i', '<li$1><a$2><span><span>$3</span></span></a>', wp_list_categories('show_count=0&echo=0&title_li='));  }

                   else { echo preg_replace('@\<li([^>]*)>\<a([^>]*)>(.*?)\<\/a>@i', '<li$1><a$2><span><span>$3</span></span></a>', wp_list_pages('echo=0&title_li=&')); }

                  ?>

                 </ul>
<?php } ?>





                </div>

                <!-- /top tabs -->



              </div><!-- /header -->

