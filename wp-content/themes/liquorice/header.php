<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class=" ie6"> <![endif]-->
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="ie7"> <![endif]-->
<!--[if (gt IE 7)|!(IE)]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->

<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <title><?php wp_title('|', true, 'right'); ?> <?php bloginfo('name'); ?> <?php if ( !wp_title('', true, 'left') ); { ?> | <?php bloginfo('description'); ?> <?php } ?></title>
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<link href='http://fonts.googleapis.com/css?family=Lobster&subset=latin' rel='stylesheet' type='text/css'>

    <?php print "<style>"; ?>
   <?php if( get_background_image()  ) {
     $repeat = get_theme_mod( 'background_repeat', 'repeat' );
     $position_x = get_theme_mod( 'background_position_x', 'left' );
     $position_y = get_theme_mod( 'background_position_y', 'top' );
     $attachment = get_theme_mod( 'background_attachment', 'scroll' );
     ?>

       body {
background: <?php if(get_background_color()){ ?><?php echo get_background_color(); ?><?php } else { ?>#121212<?php } ?> url(<?php if(get_background_image()){ ?><?php echo get_background_image(); ?><?php } else { ?>none<?php } ?>) <?php echo $repeat; ?> <?php echo $attachment; ?> <?php echo $position_x; ?> <?php echo $position_y; ?> !important;

       }
         #canvas {
           padding: 40px 20px;

           background: transparent url(<?php echo get_template_directory_uri(); ?>/images/bg-paper.jpg) repeat left top !important;


             -webkit-box-shadow: 0px 0px 14px #555; /* Saf3-4, iOS 4.0.2 - 4.2, Android 2.3+ */
     -moz-box-shadow: 0px 0px 14px #555; /* FF3.5 - 3.6 */
          box-shadow: 0px 0px 14px #555; /* Opera 10.5, IE9, FF4+, Chrome 6+, iOS 5 */

           }

   <?php } ?>

    <?php print "</style>"; ?>

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


	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />

<?php
	if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
    wp_head();
  ?>
</head>

<body <?php body_class(); ?> >

<div id="canvas">  
<?php $options = get_option( 'liquorice_theme_options' ); ?>

	<div id="social-icons">
		<?php if ( $options['twitterurl'] != '' ) : ?>
			<a href="<?php echo $options['twitterurl']; ?>" class="twitter"><?php _e( 'Twitter', 'liquorice' ); ?></a>
		<?php endif; ?>

		<?php if ( $options['facebookurl'] != '' ) : ?>
			<a href="<?php echo $options['facebookurl']; ?>" class="facebook"><?php _e( 'Facebook', 'liquorice' ); ?></a>
		<?php endif; ?>

		<?php if ( ! $options['hiderss'] ) : ?>
			<a href="<?php bloginfo( 'rss2_url' ); ?>" class="rss"><?php _e( 'RSS Feed', 'liquorice' ); ?></a>
		<?php endif; ?>
	</div><!-- #social-icons-->


 
    <ul class="skip">
      <li><a href=".menu">Skip to navigation</a></li>
      <li><a href="#primaryContent">Skip to main content</a></li>
      <li><a href="#secondaryContent">Skip to secondary content</a></li>
      <li><a href="#footer">Skip to footer</a></li>
    </ul>

    <div id="header-wrap">
   		<div id="header"> 
	<?php $heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'h4'; ?>
				<<?php echo $heading_tag; ?> id="site-title">
					<span>
						<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
					</span>
				</<?php echo $heading_tag; ?>>
				<div id="site-description"><?php bloginfo( 'description' ); ?></div>   
      <!--by default your pages will be displayed unless you specify your own menu content under Menu through the admin panel-->
		<div class="main-menu"><?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'container_class' => 'menu-header' ) ); ?></div>
  	 </div> <!-- end #header-->


       <?php if('' != get_header_image() ) { ?>
       <div id="custom-img-header">
<a href="<?php bloginfo('url'); ?>"><img src="<?php header_image(); ?>" alt="<?php bloginfo('name'); ?>" /></a>
         </div>
<?php } ?>

 </div> <!-- end #header-wrap-->
 

    <div id="primaryContent">

