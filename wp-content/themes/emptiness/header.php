<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes('xhtml'); ?>>

  <head>

    <title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>

    <meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

    <style type="text/css" media="screen">

      @import url( <?php bloginfo('stylesheet_url'); ?> );

    </style>

    <link rel="alternate" type="application/atom+xml" title="Atom 1.0" href="<?php bloginfo('atom_url'); ?>" />

    <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />

    <link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />

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

    <?php wp_get_archives('type=monthly&format=link'); ?>

    <?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

    <?php wp_head(); ?>

    <!-- Emptiness Theme by Qoqoa - Cliffano Subagio -->

  </head>

  <body>

    <div id="container">

      <div id="header">

        <div class="item">

          <div class="side left">

            &nbsp;

          </div>

          <div class="main">

            <h1><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>

            <?php bloginfo('description'); ?>

          </div>

          <div class="side right">

            <form method="get" action="<?php bloginfo('url'); ?>">

              <div><input type="text" value="<?php _e('search...', 'emptiness'); ?>" name="s" onclick="this.value = ''"/></div>

            </form>

          </div>

        </div>

        <div class="item">

          <div class="side left">

            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Header Left Sidebar') ) : ?><?php endif; ?>


            <div id="custom-navigation">
<?php if ( function_exists( 'wp_nav_menu' ) ) { // Added in 3.0 ?>
<?php if ( has_nav_menu( 'main-nav' ) ) { ?>
<ul id="nav">
<?php echo bp_wp_custom_nav_menu($get_custom_location='main-nav', $get_default_menu='revert_wp_menu_page'); ?>
 <li><a href="<?php bloginfo('atom_url'); ?>">Feed</a></li>

                <?php if (is_user_logged_in()) { ?>

                	<li><a href="<?php echo get_option('siteurl'); ?>/wp-admin/"><?php _e('Admin', 'emptiness'); ?></a></li>

                <?php } ?>

                <li><?php wp_loginout(); ?></li>
</ul>
<?php } ?>
<?php } else { ?>
<ul id="nav">
<?php wp_list_pages('title_li=&depth=1'); ?>
 <li><a href="<?php bloginfo('atom_url'); ?>">Feed</a></li>

                <?php if (is_user_logged_in()) { ?>

                	<li><a href="<?php echo get_option('siteurl'); ?>/wp-admin/"><?php _e('Admin', 'emptiness'); ?></a></li>

                <?php } ?>

                <li><?php wp_loginout(); ?></li>
</ul>
<?php } ?>
</div>


          </div>

          <div class="main splash">

            &nbsp;

          </div>

          <div class="side right">

            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Header Right Sidebar') ) : ?>

              <h3><?php _e('Tags', 'emptiness'); ?></h3>

              <div>

                <?php wp_tag_cloud('smallest=9&largest=14&number=25'); ?>

              </div>

              <h3><?php _e('Categories', 'emptiness'); ?></h3>

              <ul>

                <?php wp_list_categories('hierarchical=false&title_li='); ?> 

              </ul>

            <?php endif; ?>

          </div>

        </div>

      </div>
