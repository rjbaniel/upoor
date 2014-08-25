<?php
if (!defined('SHOW_AUTHORS')) define('SHOW_AUTHORS', 'true');
if (!defined('TEMPLATE_DOMAIN')) define('TEMPLATE_DOMAIN', 'liquorice');
/** 
*
* Liquorice Theme functions
*
**/

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */

///////////////////////////////////////////////////////////////////////////
// Update Notifications Notice
///////////////////////////////////////////////////////////////////////////
if ( !function_exists( 'wdp_un_check' ) ) {
  add_action( 'admin_notices', 'wdp_un_check', 5 );
  add_action( 'network_admin_notices', 'wdp_un_check', 5 );
  function wdp_un_check() {
    if ( !class_exists( 'WPMUDEV_Update_Notifications' ) && current_user_can( 'edit_users' ) )
      echo '<div class="error fade"><p>' . __('Please install the latest version of <a href="http://premium.wpmudev.org/project/update-notifications/" title="Download Now &raquo;">our free Update Notifications plugin</a> which helps you stay up-to-date with the most stable, secure versions of WPMU DEV themes and plugins. <a href="http://premium.wpmudev.org/wpmu-dev/update-notifications-plugin-information/">More information &raquo;</a>', 'wpmudev') . '</a></p></div>';
  }
}

////////////////////////////////////////////////////////////////////////////////
// CUSTOM IMAGE HEADER
////////////////////////////////////////////////////////////////////////////////

define('HEADER_TEXTCOLOR', '');
define('HEADER_IMAGE', ''); // %s is theme dir uri
define('HEADER_IMAGE_WIDTH', 1000); //width is fixed
define('HEADER_IMAGE_HEIGHT', 200);
define('NO_HEADER_TEXT', true );

function liquorice_admin_header_style() { ?>
<style type="text/css">
#headimg { background: url(<?php header_image() ?>) no-repeat; }
#headimg { height: <?php echo HEADER_IMAGE_HEIGHT; ?>px; width: <?php echo HEADER_IMAGE_WIDTH; ?>px; }
#headimg h1, #headimg #desc { display: none; }
</style>
<?php }

add_theme_support( 'custom-header', array('admin-head-callback' => 'liquorice_admin_header_style'));


if ( ! isset( $content_width ) )
	$content_width  = '670';


/**
* Add Menu Support
**/

add_theme_support('menus');
add_theme_support('automatic-feed-links');
register_nav_menu('main', 'Main Nav');


/**
* Add custom background	
**/

add_theme_support( 'custom-background' ); 


/**
* Add editor style
**/
add_editor_style(); 


/**
* Thumbnail support
**/
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 670, 370, true ); // 670 pixels wide by ??? pixels tall, hard crop mode
// Permalink thumbnail size

if ( is_singular() ) wp_enqueue_script( "comment-reply" ); 


/**
* register_sidebar()
*
*@desc Registers the markup to display in and around a widget
*/
if ( function_exists('register_sidebar') )
{
  register_sidebar(array(
    'before_widget' => '<li id="%1$s" class="widget %2$s">',
    'after_widget' => '</li>',
    'before_title' => '',
    'after_title' => '',
  ));
}

/**
* Check to see if this page will paginate
* 
* @return boolean
*/
function will_paginate() 
{
  global $wp_query;
  
  if ( !is_singular() ) 
  {
    $max_num_pages = $wp_query->max_num_pages;
    
    if ( $max_num_pages > 1 ) 
    {
      return true;
    }
  }
  return false;
}

/**
* Load the Theme Options Page that lets users control the social media icons at the top
*/
require_once ( get_template_directory() . '/inc/theme-options.php' );



?>
