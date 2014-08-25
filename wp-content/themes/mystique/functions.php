<?php /* Mystique/digitalnature */
if (!defined('SHOW_AUTHORS')) define('SHOW_AUTHORS', 'true');
if (!defined('TEMPLATE_DOMAIN')) define('TEMPLATE_DOMAIN', 'mystique');
error_reporting(E_ALL & ~E_NOTICE);

global $wp_version;
if ($wp_version < 2.6): // disable theme front end if wp < 2.6

  function mystique_theme_error_notification(){
    global $wp_version; ?>
    <div class='error fade'><p><?php printf(__('Your site is running on %1$s. Mystique requires at least %2$s.','mystique'), 'Wordpress '.$wp_version, '<a href="http://codex.wordpress.org/Upgrading_WordPress">Wordpress 2.7</a>'); ?></p></div>
    <?php if(!is_admin()) die();
  }
  add_action('admin_notices', 'mystique_theme_error_notification');
  add_action('wp', 'mystique_theme_error_notification');

else:

  $mystique_theme_data = wp_get_theme(TEMPLATEPATH.'/style.css');
  define('THEME_NAME', $mystique_theme_data['Name']);
  define('THEME_AUTHOR', $mystique_theme_data['Author']);
  define('THEME_URI', $mystique_theme_data['URI']);
  define('THEME_VERSION', trim($mystique_theme_data['Version']));
  define('THEME_URL', get_bloginfo('template_url'));

  // end of line character
  if(!defined("PHP_EOL")) define("PHP_EOL", strtoupper(substr(PHP_OS,0,3) == "WIN") ? "\r\n" : "\n");

  if (class_exists('xili_language')):
   define('THEME_TEXTDOMAIN','mystique');
   define('THEME_LANGS_FOLDER','/lang');
  else:
   load_theme_textdomain('mystique', get_template_directory().'/lang');
  endif;

  // core files, required
  require_once(TEMPLATEPATH.'/lib/core.php');
  require_once(TEMPLATEPATH.'/lib/settings.php');

  // optional, shortcodes
  require_once(TEMPLATEPATH.'/lib/shortcodes.php');

  // optional, extensions
//  require_once(TEMPLATEPATH.'/extensions/code-highlight/code-highlight.php');
  require_once(TEMPLATEPATH.'/extensions/ip2country/ip2country.php');
  require_once(TEMPLATEPATH.'/extensions/auto-thumb/auto-thumb.php');
  require_once(TEMPLATEPATH.'/extensions/code-editing/code-editing.php');
  require_once(TEMPLATEPATH.'/extensions/featured-posts/featured-posts.php');

  if($wp_version >= 2.8) require_once(TEMPLATEPATH.'/lib/widgets.php');
  if(is_admin()) require_once(TEMPLATEPATH.'/admin/theme-settings.php');

  if(current_user_can('edit_posts')):
    require_once(TEMPLATEPATH.'/lib/editor.php');
    add_filter('mce_css', 'mystique_editor_styles');
    add_filter('mce_buttons_2', 'mystique_mcekit_editor_buttons');
    add_filter('tiny_mce_before_init', 'mystique_mcekit_editor_settings');
  endif;

  add_filter('pre_get_posts','mystique_exclude_pages_from_search');

  add_action('init', 'mystique_verify_options');
  add_action('init', 'mystique_user_functions');
  add_action('wp', 'mystique_css');
  add_action('wp', 'mystique_jquery_init');
  add_action('wp_head', 'mystique_load_stylesheets', 1);
  add_action('wp_head', 'mystique_load_scripts', 1);
  add_action('template_redirect', 'mystique_meta_redirect');

  add_action('mystique_jquery_init', 'mystique_highlight_search_query');

  if($wp_version <= 2.8) add_filter('wp_trim_excerpt', 'mystique_excerpt_more'); else add_filter('excerpt_more', 'mystique_excerpt_more');

  // set up widget areas
  if (function_exists('register_sidebar')):
      register_sidebar(array(
          'name' => __('Default sidebar','mystique'),
          'id' => 'sidebar-1',
          'description' => __("This is the default sidebar, visible on 2 or 3 column layouts. If no widgets are active, the default theme widgets will be displayed instead.","mystique"),
  		'before_widget' => '<li class="block"><div class="block-%2$s clearfix" id="instance-%1$s">',
  		'after_widget' => '</div></li>',
  		'before_title' => '<h3 class="title"><span>',
  		'after_title' => '</span></h3><div class="block-div"></div><div class="block-div-arrow"></div>'
      ));

      register_sidebar(array(
          'name' => __('Secondary sidebar','mystique'),
          'id' => 'sidebar-2',
          'description' => __("This sidebar is active only on a 3 column setup. ","mystique"),
  		'before_widget' => '<li class="block"><div class="block-%2$s clearfix" id="instance-%1$s">',
  		'after_widget' => '</div></li>',
  		'before_title' => '<h3 class="title"><span>',
  		'after_title' => '</span></h3><div class="block-div"></div><div class="block-div-arrow"></div>'
      ));

      register_sidebar(array(
          'name' => __('Footer','mystique'),
          'id' => 'footer-1',
          'description' => __("You can add between 1 and 6 widgets here (3 or 4 are optimal). They will adjust their size based on the widget count. ","mystique"),
  		'before_widget' => '<li class="block block-%2$s" id="instance-%1$s"><div class="block-content clearfix">',
  		'after_widget' => '</div></li>',
  		'before_title' => '<h4 class="title">',
  		'after_title' => '</h4>'
      ));

      register_sidebar(array(
          'name' => __('Footer (slide 2)','mystique'),
          'id' => 'footer-2',
          'description' => __("Only visible if jQuery is enabled. ","mystique"),
  		'before_widget' => '<li class="block block-%2$s" id="instance-%1$s"><div class="block-content clearfix">',
  		'after_widget' => '</div></li>',
  		'before_title' => '<h4 class="title">',
  		'after_title' => '</h4>'
      ));

      register_sidebar(array(
          'name' => __('Footer (slide 3)','mystique'),
          'id' => 'footer-3',
          'description' => __("Only visible if jQuery is enabled. ","mystique"),
  		'before_widget' => '<li class="block block-%2$s" id="instance-%1$s"><div class="block-content clearfix">',
  		'after_widget' => '</div></li>',
  		'before_title' => '<h4 class="title">',
  		'after_title' => '</h4>'
      ));

      register_sidebar(array(
          'name' => __('Footer (slide 4)','mystique'),
          'id' => 'footer-4',
          'description' => __("Only visible if jQuery is enabled. ","mystique"),
  		'before_widget' => '<li class="block block-%2$s" id="instance-%1$s"><div class="block-content clearfix">',
  		'after_widget' => '</div></li>',
  		'before_title' => '<h4 class="title">',
  		'after_title' => '</h4>'
      ));
  endif;

  // set up post thumnails
  if (function_exists('add_theme_support')):
    add_theme_support('post-thumbnails');
    $size = explode('x',get_mystique_option('post_thumb'));
    set_post_thumbnail_size($size[0],$size[1], true);
    add_image_size('featured-thumbnail', 150, 150);
  endif;

endif;


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


////////////////////////////////////////////////////////////////////////////
// browser detect
////////////////////////////////////////////////////////////////////////////
add_filter('body_class','browser_body_class');
function browser_body_class($classes) {
global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;

	if($is_lynx) $classes[] = 'lynx';
	elseif($is_gecko) $classes[] = 'gecko';
	elseif($is_opera) $classes[] = 'opera';
	elseif($is_NS4) $classes[] = 'ns4';
	elseif($is_safari) $classes[] = 'safari';
	elseif($is_chrome) $classes[] = 'chrome';
	elseif($is_IE) $classes[] = 'ie';
	else $classes[] = 'unknown';
	if($is_iphone) $classes[] = 'iphone';
	return $classes;
}

if ( function_exists( 'register_nav_menus' ) ) {
// This theme uses wp_nav_menu() in one location.
register_nav_menus( array(
'main-nav' => __( 'Main Navigation',TEMPLATE_DOMAIN )
)
);
add_theme_support( 'menus' ); // new nav menus for wp 3.0


///////////////////////////////////////////////////////////////////////////////
// remove open ul to fit the custom bp navigation.php
///////////////////////////////////////////////////////////////////////////////
function bp_wp_custom_nav_menu($get_custom_location='', $get_default_menu=''){
$options = array('theme_location' => "$get_custom_location", 'menu_id' => '', 'echo' => false, 'container' => false, 'container_id' => '', 'fallback_cb' => "$get_default_menu");
$menu = wp_nav_menu($options);
$menu_list = preg_replace( array( '#^<ul[^>]*>#', '#</ul>$#' ), '', $menu );
return $menu_list;
}

function revert_wp_menu_page() { //revert back to normal if in wp 3.0 and menu not set ?>
<?php mystique_list_pages(array('exclude' => get_mystique_option('exclude_pages'), 'sort_column' => 'menu_order')); ?>
<?php }

function revert_wp_menu_cat() { //revert back to normal if in wp 3.0 and menu not set ?>
<?php wp_list_categories('orderby=id&show_count=0&use_desc_for_title=0&title_li='); ?>
<?php }


function add_wp_menu_drop_js_script() {
wp_enqueue_script('dropmenu', get_template_directory_uri() . '/js/dropmenu.js', array('jquery'));
wp_enqueue_style('nav', get_template_directory_uri() . '/nav.css', array(), false, 'screen');
}
add_action('wp_enqueue_scripts', 'add_wp_menu_drop_js_script');
}

////////////////////////////////////////////////////////////////////////////
// wordpress preset and custom background
////////////////////////////////////////////////////////////////////////////

if ( function_exists( 'add_theme_support' ) ) {
if( !defined( 'CUSTOM_BG_DIR' ) && !defined( 'CUSTOM_BG_URL' ) ) {
$handle_path = WP_CONTENT_DIR . '/custom-bg';
$handle_url =  WP_CONTENT_URL . '/custom-bg';
} else {
$handle_path = CUSTOM_BG_DIR;
$handle_url = CUSTOM_BG_URL;
}

function new_custom_background_cb() {
global $handle_path, $handle_url;
if( get_background_image() ) {

$background = get_background_image();
$color = get_background_color();

if ( ! $background && ! $color )
return;

$style = $color ? "background-color: #$color;" : '';

if ( $background ) {
$image = " background-image: url('$background');";

$repeat = get_theme_mod( 'background_repeat', 'repeat' );
if ( ! in_array( $repeat, array( 'no-repeat', 'repeat-x', 'repeat-y', 'repeat' ) ) )
$repeat = 'repeat';
$repeat = " background-repeat: $repeat;";

$position = get_theme_mod( 'background_position_x', 'left' );
if ( ! in_array( $position, array( 'center', 'right', 'left' ) ) )
$position = 'left';
$position = " background-position: top $position;";

$attachment = get_theme_mod( 'background_attachment', 'scroll' );
if ( ! in_array( $attachment, array( 'fixed', 'scroll' ) ) )
$attachment = 'scroll';
$attachment = " background-attachment: $attachment;";

$style .= $image . $repeat . $position . $attachment;
}

} else {

$background = get_theme_mod('preset_bg');
$background_position = get_theme_mod('cbackground-position-x');
$background_repeat = get_theme_mod('cbackground-repeat');
$background_attach = get_theme_mod('cbackground-attachment');

$color = get_background_color();

if ( ! $background && ! $color )
return;

$style = $color ? "background-color: #$color;" : '';

if ( $background ) {
$image = " background-image: url('$handle_url/$background');";
$repeat = " background-repeat: $background_repeat;";
$position = " background-position: top $background_position;";
$attachment = " background-attachment: $background_attach;";
$style .= $image . $repeat . $position . $attachment;
}
}

?>
<style type="text/css">
body { <?php echo trim( $style ); ?> }
</style>
<?php
}


function preset_background_images_init() {
global $handle_path, $handle_url;
if ( $_REQUEST['save'] ) echo '<div id="message" class="updated fade"><p><strong>'. __('Background settings saved.', TEMPLATE_DOMAIN) . '</strong></p></div>';
if ( isset($_REQUEST['reset']) && $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'. __('Background settings reset.', TEMPLATE_DOMAIN) . '</strong></p></div>';
?>
<div class="wrap" id="custom-background">
<?php screen_icon(); ?>
<h2><?php _e('Preset Background'); ?></h2>
<div id="preset-bg">


<form method="post" action="">
<?php //echo get_theme_mod('preset_bg'); ?>
<?php
	if ( isset($_POST['preset_bg']) ) {
	$preset = $_POST['preset_bg'];
    $preset_position = $_POST['cbackground-position-x'];
    $preset_repeat = $_POST['cbackground-repeat'];
   $preset_attach = $_POST['cbackground-attachment'];

	set_theme_mod('preset_bg', $preset);
   set_theme_mod('cbackground-position-x', $preset_position);
    set_theme_mod('cbackground-repeat', $preset_repeat);
    set_theme_mod('cbackground-attachment', $preset_attach);
		}
?>
<?php
	if ( isset($_POST['reset']) ) {
	remove_theme_mod('preset_bg');
   remove_theme_mod('cbackground-position-x');
    remove_theme_mod('cbackground-repeat');
    remove_theme_mod('cbackground-attachment');
		}
?>

<div class="bgboxwrap">
<div class="updated below-h2" id="message">
<p>Custom Background must be empty in order for the <strong>Preset Background</strong> to work.<?php if( get_background_image() ) { ?><br />You have image uploaded in custom background, <a href="<?php echo admin_url('/themes.php?page=custom-background'); ?>">remove the uploaded background</a> first<?php } ?></p>
</div>
<strong><?php _e("Choose Image",TEMPLATE_DOMAIN); ?></strong><br />
<label><?php _e("Choose a preset background image",TEMPLATE_DOMAIN); ?></label>
</div>
<?php
if ($handle = opendir($handle_path)) {
$pattern="(\.jpg$)|(\.png$)|(\.jpeg$)|(\.gif$)|(\.bmp$)"; //valid image extensions
// List all the files
while (false !== ($file = readdir($handle))) { $i == $i++ ;
if(eregi($pattern, $file)){ ?>
<div class="bgbox">
<div class="bgrimg"><img src="<?php echo $handle_url . '/' . $file; ?>" class="img-left" alt="background<?php echo $i; ?>" /></div>
<p><input<?php if( get_theme_mod('preset_bg') == $file ) { ?> checked="checked"<?php } ?> name="preset_bg" type="radio" value="<?php echo $file; ?>" />&nbsp;&nbsp;<?php echo $file; ?></p>
</div>
<?php }
}
closedir($handle);
}
?>

<table class="form-table">
<tr valign="top">
<th scope="row"><?php _e( 'Position' ); ?></th>
<td><fieldset><legend class="screen-reader-text"><span><?php _e( 'Background Position' ); ?></span></legend>
<label>
<input name="cbackground-position-x" type="radio" value="left"<?php checked('left', get_theme_mod('cbackground-position-x', 'left')); ?> />
<?php _e('Left') ?>
</label>
<label>
<input name="cbackground-position-x" type="radio" value="center"<?php checked('center', get_theme_mod('cbackground-position-x', 'center')); ?> />
<?php _e('Center') ?>
</label>
<label>
<input name="cbackground-position-x" type="radio" value="right"<?php checked('right', get_theme_mod('cbackground-position-x', 'right')); ?> />
<?php _e('Right') ?>
</label>
</fieldset></td>
</tr>

<tr valign="top">
<th scope="row"><?php _e( 'Repeat' ); ?></th>
<td><fieldset><legend class="screen-reader-text"><span><?php _e( 'Background Repeat' ); ?></span></legend>
<label><input type="radio" name="cbackground-repeat" value="no-repeat"<?php checked('no-repeat', get_theme_mod('cbackground-repeat', 'no-repeat')); ?> /> <?php _e('No Repeat'); ?></label>
	<label><input type="radio" name="cbackground-repeat" value="repeat"<?php checked('repeat', get_theme_mod('cbackground-repeat', 'repeat')); ?> /> <?php _e('Tile'); ?></label>
	<label><input type="radio" name="cbackground-repeat" value="repeat-x"<?php checked('repeat-x', get_theme_mod('cbackground-repeat', 'repeat-x')); ?> /> <?php _e('Tile Horizontally'); ?></label>
	<label><input type="radio" name="cbackground-repeat" value="repeat-y"<?php checked('repeat-y', get_theme_mod('cbackground-repeat', 'repeat-y')); ?> /> <?php _e('Tile Vertically'); ?></label>
</fieldset></td>
</tr>

<tr valign="top">
<th scope="row"><?php _e( 'Attachment' ); ?></th>
<td><fieldset><legend class="screen-reader-text"><span><?php _e( 'Background Attachment' ); ?></span></legend>
<label>
<input name="cbackground-attachment" type="radio" value="scroll" <?php checked('scroll', get_theme_mod('cbackground-attachment', 'scroll')); ?> />
<?php _e('Scroll') ?>
</label>
<label>
<input name="cbackground-attachment" type="radio" value="fixed" <?php checked('fixed', get_theme_mod('cbackground-attachment', 'fixed')); ?> />
<?php _e('Fixed') ?>
</label>
</fieldset></td>
</tr>

</table>
         <br /><br />
<div class="bgboxwrap">
<input name="save" type="submit" class="button-primary sbutton" value="<?php echo esc_attr(__('Save Changes',TEMPLATE_DOMAIN)); ?>" />
</div>
<div class="bgboxwrap">
<input name="reset" type="submit" class="button-secondary sbutton" onclick="return confirm('Are you sure you want to reset all saved settings?. This action cannot be restore.')" value="<?php echo esc_attr(__('Reset Settings',TEMPLATE_DOMAIN)); ?>" />
</div>
</form>
</div>
</div>
<?php }

function default_background_images_css() { ?>
<style type="text/css">
#preset-bg {
  width: 98%;
  clear:both;
  float:left;
  margin: 20px 0px 30px;
}
#preset-bg label {
  font-size: 12px;
  color: #777;
}
.bgboxwrap {
  width: 100%;
  float:left;
  margin: 0px 0px 15px;
}
.bgbox {
  width: 32%;
  float:left;
  height: 150px;
}
.bgrimg {
  width: 100%;
  height: 100px;
  overflow: hidden;
}


.bgbox img {
  max-width: 90%;
  height: auto;
}


</style>
<?php }



function add_preset_bg_init() {
add_submenu_page( 'themes.php', 'Preset Background Image', 'Preset Background', 'edit_theme_options', 'preset-background', 'preset_background_images_init' );
}

// Add support for custom backgrounds
add_theme_support( 'custom-background', array('wp-head-callback' => 'new_custom_background_cb'));
add_action('admin_head','default_background_images_css');
if(is_dir($handle_path)) {
add_action('admin_menu','add_preset_bg_init');
}
} //end check



////////////////////////////////////////////////////////////////////////////////
// CUSTOM IMAGE HEADER
////////////////////////////////////////////////////////////////////////////////

define('HEADER_TEXTCOLOR', '');
define('HEADER_IMAGE', ''); // %s is theme dir uri
define('HEADER_IMAGE_WIDTH', 940); //width is fixed
define('HEADER_IMAGE_HEIGHT', 150);
define('NO_HEADER_TEXT', true );

function mystique_admin_header_style() { ?>
<style type="text/css">
#headimg { background: url(<?php header_image() ?>) no-repeat; }
#headimg { height: <?php echo HEADER_IMAGE_HEIGHT; ?>px; width: <?php echo HEADER_IMAGE_WIDTH; ?>px; }
#headimg h1, #headimg #desc { display: none; }
</style>
<?php }

add_theme_support( 'custom-header', array('admin-head-callback' => 'mystique_admin_header_style'));



?>
