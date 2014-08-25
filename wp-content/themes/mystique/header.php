<?php /* Mystique/digitalnature */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php //language_attributes('xhtml'); ?>>

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php mystique_title(); ?></title>

<?php mystique_meta_description(); ?>
<meta name="designer" content="digitalnature.ro" />

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

<?php wp_head(); ?>

<?php if( get_background_image() || get_theme_mod('preset_bg') ) { ?>
<style>
#page {
    background: transparent none !important;
}
</style>
<?php } ?>

</head>
<body class="<?php mystique_body_class() ?>">
 <div id="page">


  <div class="page-content header-wrapper">


    <div id="header" class="bubbleTrigger">

      <div id="site-title" class="clearfix">

        <?php mystique_logo(); ?>
        <?php if(get_bloginfo('description')): ?><p class="headline"><?php bloginfo('description'); ?></p><?php endif; ?>

        <?php do_action('mystique_header'); ?>

      </div>

      <?php mystique_navigation(); ?>

    </div>

  </div>

  <?php if('' != get_header_image() ) {
  $check_width = get_mystique_option('page_width'); ?>


  <div <?php if($check_width == 'fixed') { ?>
  style='overflow: hidden; margin:0 auto; width: 960px; height: 150px; background: url(<?php header_image(); ?>) no-repeat center;'
  <?php } else { ?>
  style='overflow: hidden; margin:0 auto; max-width:1600px; min-width:780px; height: 150px; background: url(<?php header_image(); ?>) repeat-x left;'
 <?php } ?> id="custom-img-header"></div>
 <?php } ?>

  <!-- left+right bottom shadow -->
  <div class="shadow-left page-content main-wrapper">
   <div class="shadow-right">

     <?php do_action('mystique_before_main'); ?>
