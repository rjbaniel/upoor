<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>



	<head profile="http://gmpg.org/xfn/11">

		

		<title>

			<?php if (is_home()) { echo bloginfo('name');

			} elseif (is_404()) {

			echo '404 Not Found';

			} elseif (is_category()) {

			echo 'Category:'; wp_title('');

			} elseif (is_search()) {

			echo 'Search Results';

			} elseif ( is_day() || is_month() || is_year() ) {

			echo 'Archives:'; wp_title('');

			} else {

			echo wp_title('');

			}

			?>

		</title>



	    <meta http-equiv="content-type" content="<?php bloginfo('html_type') ?>; charset=<?php bloginfo('charset') ?>" />

		<meta name="description" content="<?php bloginfo('description') ?>" />

		<?php if(is_search()) { ?>

		<meta name="robots" content="noindex, nofollow" /> 

	    <?php }?>

	

		<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="screen" />

		<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> <?php _e('RSS Feed', 'slt'); ?>" href="<?php bloginfo('rss2_url'); ?>" />

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

       <?php if( get_background_image() || get_theme_mod('preset_bg') ) { ?>
<style>
#inmain {
    background: #C5628E none;
    float: left;
    width: 800px;
}
#sitemeta {
  width: 96%;
  padding: 0 2%;
}
#footer {
    background: transparent none !important;
    clear: both;
    color: #FFFFFF;
    height: 100px !important;
    margin-bottom: 0;
    width: 100%;
}
#footerimg {
  display: none;
}
</style>
<?php } ?>

	</head>

	

<?php remove_action( 'wp_head', 'wp_generator' ); ?>
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>



	<body id="custom">

    

    <div id="main">

    	        <div id="inmain">

        <div id="topnavi">

        <!-- Menu -->



			   <div id="custom-navigation">
<?php if ( function_exists( 'wp_nav_menu' ) ) { // Added in 3.0 ?>
<ul id="menu">
<?php echo bp_wp_custom_nav_menu($get_custom_location='main-nav', $get_default_menu='revert_wp_menu_page'); ?>
</ul>
<?php } else { ?>
<ul id="menu">
<?php wp_list_pages('title_li=&depth=1'); ?>
</ul>
<?php } ?>
</div>

		  

        

        	<div id="rightnavi">

        		<a href="<?php bloginfo('rss2_url'); ?>">RSS <img src="<?php bloginfo('template_directory'); ?>/img/rss.png" /></a>

        	</div>

        

        </div>

        

		<div id="sitemeta" class="wrapper">

			<h1><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></h1>

			<p id="description"><?php bloginfo('description'); ?></p>

        </div>


<?php if('' != get_header_image() ) { ?>
<a href="<?php bloginfo('url'); ?>"><img style="margin: 5px 0px 0px 0px;" src="<?php header_image(); ?>" alt="<?php bloginfo('name'); ?>" /></a>
<?php } ?>


		<div class="wrapper">

                

        	<div id="content">
