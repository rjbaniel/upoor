<?php
/**
 * @package WordPress
 * @subpackage Magazeen_Theme
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

	<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>

	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
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
	
	<script src="<?php bloginfo( 'template_directory' ); ?>/js/pngfix.js"></script>
	<script src="<?php bloginfo( 'template_directory' ); ?>/js/jquery-latest.js"></script>
	<script src="<?php bloginfo( 'template_directory' ); ?>/js/effects.core.js"></script>
	<script src="<?php bloginfo( 'template_directory' ); ?>/js/functions.js"></script>
	
	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

	<?php wp_head(); ?>

    <?php if( get_background_image() || get_theme_mod('preset_bg') ) { ?>
<style>
#latest-dock, #main-content  {
    background: transparent none !important;
    border: 0px none;
}
#wrapcontent {
  background: #fff;
  width: 940px;
  margin: 0px auto;
}
.col-580 {
    padding-left: 20px;
    width: 580px;
}
</style>
<?php } ?>

</head>
<body id="custom">

	<div id="header">
		
		<div class="container clearfix">
		
			<div id="logo">
		
				<h2><?php bloginfo( 'description' ); ?></h2>
				<h1><span></span><a href="<?php bloginfo( 'url' ); ?>" title="<?php bloginfo( 'name' ); ?>"><?php echo strtolower( get_option( 'blogname' ) ); ?></a></h1>
				
			</div><!-- End logo -->
			
			<?php include_once( TEMPLATEPATH . '/searchform-header.php' ); ?>

		</div><!-- End Container -->
		
	</div><!-- End header -->
	
	<div id="navigation">
	
		<div class="container clearfix">
	

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


			
			<a href="<?php bloginfo( 'rss2_url' ); ?>" class="rss" title="Subscribe to <?php bloginfo( 'name' ); ?> RSS"><?php _e('Subscribe', 'magazeen'); ?></a>
			
		</div><!-- End container -->
		
	</div><!-- End navigation -->
	
	<div id="latest-dock">
	
		<div class="dock-back container clearfix">
		
			<div class="latest">
				<?php _e('Check out the Latest Articles:', 'magazeen'); ?>
			</div>
		
			<ul id="dock">
				<?php
					$dock = new WP_Query();
					$dock->query( 'showposts=9' );
					while( $dock->have_posts() ) : $dock->the_post();
                    $the_post_ids = get_the_ID();
                    $check_val = get_post_meta( $post->ID, "image_value", true );
				?>

                <li>
					<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to', 'magazeen'); ?> <?php the_title_attribute(); ?>">

                  <?php if($check_val) { ?>

					<img width="69" height="54" src="<?php echo $check_val; ?>" alt="<?php the_title(); ?>" />

                          <?php } else { ?>

<img width="69" height="54" src="<?php echo custom_get_post_img ($the_post_id=$the_post_ids, $size='thumbnail'); ?>" alt="<?php the_title(); ?>" />

                            <?php }  ?>

					</a>
					<span><?php the_title(); ?></span>
				</li>


				<?php
					endwhile;
				?>
			</ul>
					
		</div><!-- End container -->
	
	</div><!-- End latest-dock -->

    <div id="wrapcontent">
