<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<?php /* Arclite/digitalnature */
  $metakeywords = array();
  if(get_option('arclite_meta')<>'') {

   if (is_home()) {

  	$metakeywords = get_option('arclite_meta');

   }

   else if(is_category()) {

    foreach((get_the_category()) as $category) { $metakeywords = $metakeywords.$category->cat_name . ','; }

   }

   else{

  	$metakeywords = "";

  	$tags = wp_get_post_tags($post->ID);

  	foreach ($tags as $tag ) { $metakeywords = $metakeywords . $tag->name . ", "; }

   }

  }

?>

<html xmlns="http://www.w3.org/1999/xhtml" <?php //language_attributes(); ?>>



<head profile="http://gmpg.org/xfn/11">

<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<?php if(($metakeywords<>'') && (!is_404())) { ?>

<meta name="keywords" content="<?php print $metakeywords; ?>" />

<meta name="description" content="<?php bloginfo('description'); ?>" />

<?php } ?>



<title>
<?php
if (is_home()) { echo bloginfo('name'); echo (' - '); bloginfo('description');}
elseif (is_404()) { bloginfo('name'); echo ' - Oops, this is a 404 page'; }
else if ( is_search() ) { bloginfo('name'); echo (' - Search Results');}
else { bloginfo('name'); echo (' - '); wp_title(''); }
?>
</title>



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

  print '<style type="text/css" media="all">'.PHP_EOL;



  if(get_option('arclite_imageless')=='yes') print '@import "'.get_bloginfo('template_url').'/style-imageless.css";'.PHP_EOL;

  else {

   print '@import "'.get_bloginfo('stylesheet_url').'";'.PHP_EOL;



   if(get_option('arclite_widgetbg')<>'')

    print '@import "'.get_bloginfo('template_url').'/options/side-'.get_option('arclite_widgetbg').'.css";'.PHP_EOL;



   if(get_option('arclite_contentbg')<>'')

    print '@import "'.get_bloginfo('template_url').'/options/content-'.get_option('arclite_contentbg').'.css";'.PHP_EOL;

   else

    print '@import "'.get_bloginfo('template_url').'/options/content-default.css";'.PHP_EOL;



  if(get_option('arclite_sidebarpos')=='left')

    print '@import "'.get_bloginfo('template_url').'/options/leftsidebar.css";'.PHP_EOL;



   if((get_option('arclite_header')=='default') || (get_option('arclite_header')==''))

    print '@import "'.get_bloginfo('template_url').'/options/header-default.css";'.PHP_EOL;



   else if(get_option('arclite_header')=='user') {

    if(get_option('arclite_headerimage')<>'')

       print '#header{ background: transparent url("'.get_option('arclite_headerimage').'") no-repeat center top; }'.PHP_EOL;

    else if(get_option('arclite_headerimage2')<>'')

        print '#header-wrap{ background: transparent url("'.get_option('arclite_headerimage2').'") repeat center top; }'.PHP_EOL;

    }

   else if(get_option('arclite_header')=='user2')

    print '#header, #header-wrap{ background: #'.get_option('arclite_headercolor').'; }'.PHP_EOL;

   else

    print '@import "'.get_bloginfo('template_url').'/options/header-'.get_option('arclite_header').'.css";'.PHP_EOL;

  }



  $usercss = get_option('arclite_css');

  if($usercss<>'') print $usercss;



  print '</style>'.PHP_EOL;

?>



<!--[if lte IE 6]>

<style type="text/css" media="screen">

@import "<?php bloginfo('template_url'); ?>/ie6.css";

</style>

<![endif]-->



<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

<?php if(get_option('arclite_jquery')<>'no') { ?>

 <?php wp_enqueue_script('jquery'); ?>

 <?php wp_enqueue_script('arclite',get_bloginfo('template_url').'/js/arclite.js'); ?>

<?php } ?>



<?php

$arc_fonts = get_option('arclite_fonts');

$arc_line_height = get_option('arclite_line_height');

$arc_headline = get_option('arclite_headline');

$arc_sidebarpos = get_option('arclite_sidebarpos');

$arc_post_size = get_option('arclite_post_font_size');
if($arc_post_size == '') { $arc_post_size = '13'; }

$arc_line_height = $arc_post_size + 8; //line height auto control

$arc_span_info = $arc_post_size - 2; //line height auto control

$arc_title_size = $arc_post_size + 12; //h3.post-title font size auto control

$arc_subtitle_size = $arc_post_size + 5; //sub-title font size auto control

?>



<?php print "<style type=\"text/css\" media=\"all\"> "; ?>



#custom {

  font-family: <?php echo "$arc_fonts"; ?>;

}



#custom .post-content p {

  line-height: <?php echo $arc_line_height; ?>px;

}



h1, h2, h3, h4, h5, h6 {

   font-family: <?php echo "$arc_headline"; ?> !important;

}

#custom #footer .widget_tag_cloud a:hover {

  background: #261C13;

  color: #fff;

  text-decoration: none;

}



<?php if($arc_sidebarpos == 'left and right') { ?>

#custom #page.with-sidebar.and-secondary .mask-main .mask-left { right:0%; }

#custom #page.with-sidebar.and-secondary .mask-main .col3 { left: -75%; }

<?php } ?>



#custom #commentform {

  width: 90%;

  padding: 0px 0px 15px 0px;

  float: left;

}



#custom #commentform input[type='text'], #custom #commentform textarea {

  width: 90%;

  border: 1px solid #dadada;

  background: #f9f9f9;

  padding: 8px;

}





#custom .post-content { font-size: <?php echo $arc_post_size; ?>; }

#custom h3.post-title { font-size: <?php echo $arc_title_size; ?>px; }



#custom span.info, #custom p.post-metadata { font-size: <?php echo $arc_span_info; ?>px; }



#custom .post-content h2,

#custom .post-content h3,

#custom .post-content h4,

#custom .post-content h5,

#custom .post-content h6

{ font-size: <?php echo $arc_subtitle_size; ?>px;

  margin-top: 25px !important;

}

#custom ul#twitter_update_list li {

  padding-bottom: 15px;

}

<?php print "</style>"; ?>





<?php if(is_home()) { ?>

<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/blogger.js"></script>

<?php } ?>



<?php wp_head(); ?>



</head>

<body id="custom"<?php if (is_home()) { ?> class="home"<?php } else { ?> class="inner"<?php } ?>>





<!--end branding-->



 <!-- page wrap -->

 <div id="page"<?php if(!is_page_template('page-nosidebar.php')) { print ' class="with-sidebar'; if((get_option('arclite_3col')=='yes') || (is_page_template('page-3col.php'))) print ' and-secondary'; print '"';  } ?>>



  <!-- header -->

  <div id="header-wrap">

   <div id="header" class="block-content">

     <div id="pagetitle">



      <?php

      // logo image?

      if(get_option('arclite_logo')=='yes' && get_option('arclite_logoimage')) { ?>

      <h1 class="logo"><a href="<?php bloginfo('url'); ?>/"><img src="<?php print get_option('arclite_logoimage'); ?>" title="<?php bloginfo('name');  ?>" alt="<?php bloginfo('name');  ?>" /></a></h1>

      <?php } else { ?>

      <h1 class="logo"><a href="<?php bloginfo('url'); ?>/"><?php bloginfo('name'); ?></a></h1>

      <?php }  ?>



      <?php if(get_bloginfo('description')<>'') { ?><h4><?php bloginfo('description'); ?></h4><?php } ?>

      <div class="clear"></div>



      <?php if(get_option('arclite_search')<>'no') { ?>

      <?php // get_search_form(); ?>

      <!-- search form -->

      <div class="search-block">

        <div class="searchform-wrap">

          <form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">

            <fieldset>

            <input type="text" name="s" id="searchbox" class="searchfield" value="<?php _e("Search","arclite"); ?>" onfocus="if(this.value == '<?php _e("Search","arclite"); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e("Search","arclite"); ?>';}" />

             <input type="submit" value="Go" class="go" />

            </fieldset>

          </form>

        </div>

      </div>

      <!-- /search form -->

      <?php } ?>



     </div>



     <!-- main navigation -->

     <div id="nav-wrap1">

      <div id="nav-wrap2">


     <?php if ( function_exists( 'wp_nav_menu' ) ) { // Added in 3.0 ?>
<ul id="nav">
<?php echo bp_wp_custom_nav_menu('main-nav', 'revert_wp_menu_page'); ?>
</ul>
<?php } else { ?>




        <ul id="nav">

         <?php

          if((get_option('show_on_front')<>'page') && (get_option('arclite_topnav')<>'categories')) {

           if(is_home() && !is_paged()){ ?>

            <li id="nav-homelink" class="current_page_item"><a class="fadeThis" href="<?php echo get_option('home'); ?>" title="<?php _e('You are Home','arclite'); ?>"><span><?php _e('Home','arclite'); ?></span></a></li>

           <?php } else { ?>

            <li id="nav-homelink"><a class="fadeThis" href="<?php echo get_option('home'); ?>" title="<?php _e('Click for Home','arclite'); ?>"><span><?php _e('Home','arclite'); ?></span></a></li>

          <?php

           }

          } ?>

         <?php

           if(get_option('arclite_topnav')=='categories') {

            echo preg_replace('@\<li([^>]*)>\<a([^>]*)>(.*?)\<\/a>@i', '<li$1><a class="fadeThis"$2><span>$3</span></a>', wp_list_categories('show_count=0&echo=0&title_li='));

            }

           else {

             echo preg_replace('@\<li([^>]*)>\<a([^>]*)>(.*?)\<\/a>@i', '<li$1><a class="fadeThis"$2><span>$3</span></a>', wp_list_pages('echo=0&orderby=name&title_li=&'));

           }

          ?>

        </ul>

        <?php } ?>

      </div>

     </div>

     <!-- /main navigation -->



   </div>

  </div>

  <!-- /header -->

