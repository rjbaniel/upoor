<?php
if ( function_exists('register_sidebar') ) {
register_sidebar(array('name' => 'Bottom Left'));
register_sidebar(array('name' => 'Bottom Right')); }

if (!defined('SHOW_AUTHORS')) define('SHOW_AUTHORS', 'true');
if (!defined('TEMPLATE_DOMAIN')) define('TEMPLATE_DOMAIN','roundflow');
////////////////////////////////////////////////////////////////////////////////
// load text domain
////////////////////////////////////////////////////////////////////////////////
function init_localization( $locale ) {
return "en_EN";
}
// Uncomment add_filter below to test your localization, make sure to enter the right language code.
// add_filter('locale','init_localization');

load_theme_textdomain( TEMPLATE_DOMAIN, TEMPLATEPATH . '/languages/' );

////////////////////////////////////////////////////////////////////////////////
// new thumbnail code for wp 2.9+
////////////////////////////////////////////////////////////////////////////////
if ( function_exists( 'add_theme_support' ) ) { // Added in 2.9
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 120, 120, true ); // Normal post thumbnails
	add_image_size( 'single-post-thumbnail', 400, 9999 ); // Permalink thumbnail size
}
///////////////////////////////////////////////////////////////////////////
// Update Notifications Notice
///////////////////////////////////////////////////////////////////////////
if ( !function_exists( 'wdp_un_check' ) ) {
  add_action( 'admin_notices', 'wdp_un_check', 5 );
  add_action( 'network_admin_notices', 'wdp_un_check', 5 );
  function wdp_un_check() {
    if ( !class_exists( 'WPMUDEV_Update_Notifications' ) && current_user_can( 'edit_users' ) )
      echo '<div class="error fade"><p>' . __('Please install the latest version of <a href="http://premium.wpmudev.org/project/update-notifications/" title="Download Now

&raquo;">our free Update Notifications plugin</a> which helps you stay up-to-date with the most stable, secure versions of WPMU DEV themes and plugins. <a

href="http://premium.wpmudev.org/wpmu-dev/update-notifications-plugin-information/">More information &raquo;</a>', 'wpmudev') . '</a></p></div>';
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
<li class="<?php if (is_home()) { ?>home<?php } else { ?>page_item<?php } ?>">
<a href="<?php bloginfo('url'); ?>" title="<?php _e("Home",TEMPLATE_DOMAIN); ?>"><?php _e('Home',TEMPLATE_DOMAIN); ?></a></li>
<?php wp_list_pages('title_li=&depth=0'); ?>
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
// wp 2.7 wp_list_comment
////////////////////////////////////////////////////////////////////////////////

function list_comments($comment, $args, $depth) {
$GLOBALS['comment'] = $comment; ?>

<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
<div class="comment">
<p class="commentinfo"><?php if (function_exists('avatar_display_comments')) { ?>
<?php avatar_display_comments(get_comment_author_email(),'48',''); ?>
<?php } else { ?>
<?php if (function_exists('get_avatar')) { echo get_avatar( get_comment_author_email() , 48 ); } ?>
<?php } ?>&nbsp;&nbsp; <?php comment_author_link() ?> - <?php comment_date() ?> @ <a href="#comment-<?php comment_ID() ?>"><?php comment_time() ?></a>&nbsp;&nbsp;<?php edit_comment_link('e','',''); ?>&nbsp;&nbsp;<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></p>
<?php comment_text() ?>
</div>
<?php

}

////////////////////////////////////////////////////////////////////////////////
// wp 2.7 wp_list_ping
////////////////////////////////////////////////////////////////////////////////

function list_pings($comment, $args, $depth) {
$GLOBALS['comment'] = $comment; ?>
<li id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?>
<?php }

add_filter('get_comments_number', 'comment_count', 0);

function comment_count( $count ) {
global $id;
$comments_by_split = get_comments('post_id=' . $id);
$comments_by_type = &separate_comments($comments_by_split);
return count($comments_by_type['comment']);
}


////////////////////////////////////////////////////////////////////////////////
// CUSTOM IMAGE HEADER
////////////////////////////////////////////////////////////////////////////////

define('HEADER_TEXTCOLOR', '#FFF');
define('HEADER_IMAGE', ''); // %s is theme dir uri
define('HEADER_IMAGE_WIDTH', 1000); //width is fixed
define('HEADER_IMAGE_HEIGHT', 150);

function roundflow_admin_header_style() { ?>
<style type="text/css">
#headimg { background: url(<?php header_image() ?>) no-repeat; }
#headimg { height: <?php echo HEADER_IMAGE_HEIGHT; ?>px; width: <?php echo HEADER_IMAGE_WIDTH; ?>px; }
</style>
<?php }

add_theme_support( 'custom-header', array('admin-head-callback' => 'roundflow_admin_header_style'));

function header_custom_style() { ?>
<?php if('' != get_header_image() ) { ?>
<style type="text/css">
#header { background: url(<?php header_image() ?>) repeat !important; }
#header h1 , #header h2 { color: #<?php header_textcolor() ?> !important; text-decoration: none; }
</style>
<?php } ?>
<?php }

add_action('wp_head', 'header_custom_style');


function widget_rf_search() { ?>
<li id="search" class="widget widget_search">
<h2 class="widgettitle">Search</h2>
<form id="searchform" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<ul><li>
<input type="text" name="s" id="s" size="15" /> <input type="submit" value="<?php _e('Search');?>" />
</li></ul>
</form>
</li>
<?php }

if ( function_exists('wp_register_sidebar_widget') ) {
wp_register_sidebar_widget('rf_search_1', __('Search'), 'widget_rf_search'); }

function rf_add_admin() {

	if ( isset($_GET['page']) && $_GET['page'] == basename(__FILE__) ) {
	
	    // save settings
		if ( isset($_REQUEST['action']) && 'save' == $_REQUEST['action'] ) {


// -------------
// ROUND 1
// -------------


// GENERAL
update_option( 'rf_sitewidth', $_REQUEST[ 'rf_sitewidth' ] );
update_option( 'rf_sitewidthtype', $_REQUEST[ 'rf_sitewidthtype' ] );
update_option( 'rf_font', $_REQUEST[ 'rf_font' ] );
update_option( 'rf_bgcolor', $_REQUEST[ 'rf_bgcolor' ] );
update_option( 'rf_roundedcorners', $_REQUEST[ 'rf_roundedcorners' ] );
update_option( 'rf_topbottompadding', $_REQUEST[ 'rf_topbottompadding' ] );

// HEADER
update_option( 'rf_headerbgcolor', $_REQUEST[ 'rf_headerbgcolor' ] );
update_option( 'rf_sitetitlecolor', $_REQUEST[ 'rf_sitetitlecolor' ] );
update_option( 'rf_taglinecolor', $_REQUEST[ 'rf_taglinecolor' ] );

// NAVIGATION
update_option( 'rf_navbgcolor', $_REQUEST[ 'rf_navbgcolor' ] );
update_option( 'rf_navlinkcolor', $_REQUEST[ 'rf_navlinkcolor' ] );
update_option( 'rf_navlinkhovercolor', $_REQUEST[ 'rf_navlinkhovercolor' ] );


// CHILD PAGE NAVIGATION
update_option( 'rf_childnavbgcolor', $_REQUEST[ 'rf_childnavbgcolor' ] );
update_option( 'rf_childnavlinkcolor', $_REQUEST[ 'rf_childnavlinkcolor' ] );
update_option( 'rf_childnavlinkhovercolor', $_REQUEST[ 'rf_childnavlinkhovercolor' ] );

// MAIN CONTENT
update_option( 'rf_mainbgcolor', $_REQUEST[ 'rf_mainbgcolor' ] );
update_option( 'rf_maintextcolor', $_REQUEST[ 'rf_maintextcolor' ] );
update_option( 'rf_maintextlinkcolor', $_REQUEST[ 'rf_maintextlinkcolor' ] );
update_option( 'rf_maintextlinkhovercolor', $_REQUEST[ 'rf_maintextlinkhovercolor' ] );
update_option( 'rf_mainposttitlecolor', $_REQUEST[ 'rf_mainposttitlecolor' ] );
update_option( 'rf_mainposttitlehovercolor', $_REQUEST[ 'rf_mainposttitlehovercolor' ] );
update_option( 'rf_mainpostinfocolor', $_REQUEST[ 'rf_mainpostinfocolor' ] );
update_option( 'rf_mainpostinfolinkcolor', $_REQUEST[ 'rf_mainpostinfolinkcolor' ] );
update_option( 'rf_mainpostinfolinkhovercolor', $_REQUEST[ 'rf_mainpostinfolinkhovercolor' ] );
update_option( 'rf_mainbordercolor', $_REQUEST[ 'rf_mainbordercolor' ] );
update_option( 'rf_mainheadercolor', $_REQUEST[ 'rf_mainheadercolor' ] );

// COMMENTS
update_option( 'rf_commentsbgcolor', $_REQUEST[ 'rf_commentsbgcolor' ] );
update_option( 'rf_commentstextcolor', $_REQUEST[ 'rf_commentstextcolor' ] );
update_option( 'rf_commentslinkcolor', $_REQUEST[ 'rf_commentslinkcolor' ] );
update_option( 'rf_commentslinkhovercolor', $_REQUEST[ 'rf_commentslinkhovercolor' ] );
update_option( 'rf_commentsinfotextcolor', $_REQUEST[ 'rf_commentsinfotextcolor' ] );
update_option( 'rf_commentsinfolinkcolor', $_REQUEST[ 'rf_commentsinfolinkcolor' ] );
update_option( 'rf_commentsinfolinkhovercolor', $_REQUEST[ 'rf_commentsinfolinkhovercolor' ] );
update_option( 'rf_commentsbordercolor', $_REQUEST[ 'rf_commentsbordercolor' ] );

// BOTTOMBAR
update_option( 'rf_bottombgcolor', $_REQUEST[ 'rf_bottombgcolor' ] );
update_option( 'rf_bottomtitlecolor', $_REQUEST[ 'rf_bottomtitlecolor' ] );
update_option( 'rf_bottomtextcolor', $_REQUEST[ 'rf_bottomtextcolor' ] );
update_option( 'rf_bottomlinkcolor', $_REQUEST[ 'rf_bottomlinkcolor' ] );
update_option( 'rf_bottomlinkhovercolor', $_REQUEST[ 'rf_bottomlinkhovercolor' ] );
update_option( 'rf_bottombordercolor', $_REQUEST[ 'rf_bottombordercolor' ] );

// FOOTER
update_option( 'rf_footerbgcolor', $_REQUEST[ 'rf_footerbgcolor' ] );
update_option( 'rf_footertextcolor', $_REQUEST[ 'rf_footertextcolor' ] );
update_option( 'rf_footerlinkcolor', $_REQUEST[ 'rf_footerlinkcolor' ] );
update_option( 'rf_footerlinkhovercolor', $_REQUEST[ 'rf_footerlinkhovercolor' ] );


// -------------
// ROUND 2
// -------------


// GENERAL
if( isset( $_REQUEST[ 'rf_sitewidth' ] ) ) { update_option( 'rf_sitewidth', $_REQUEST[ 'rf_sitewidth' ]  ); } else { delete_option( 'rf_sitewidth' ); }
if( isset( $_REQUEST[ 'rf_sitewidthtype' ] ) ) { update_option( 'rf_sitewidthtype', $_REQUEST[ 'rf_sitewidthtype' ]  ); } else { delete_option( 'rf_sitewidthtype' ); }
if( isset( $_REQUEST[ 'rf_font' ] ) ) { update_option( 'rf_font', $_REQUEST[ 'rf_font' ]  ); } else { delete_option( 'rf_font' ); }
if( isset( $_REQUEST[ 'rf_bgcolor' ] ) ) { update_option( 'rf_bgcolor', $_REQUEST[ 'rf_bgcolor' ]  ); } else { delete_option( 'rf_bgcolor' ); }
if( isset( $_REQUEST[ 'rf_roundedcorners' ] ) ) { update_option( 'rf_roundedcorners', $_REQUEST[ 'rf_roundedcorners' ]  ); } else { delete_option( 'rf_roundedcorners' ); }
if( isset( $_REQUEST[ 'rf_topbottompadding' ] ) ) { update_option( 'rf_topbottompadding', $_REQUEST[ 'rf_topbottompadding' ]  ); } else { delete_option( 'rf_topbottompadding' ); }

// HEADER
if( isset( $_REQUEST[ 'rf_headerbgcolor' ] ) ) { update_option( 'rf_headerbgcolor', $_REQUEST[ 'rf_headerbgcolor' ]  ); } else { delete_option( 'rf_headerbgcolor' ); }
if( isset( $_REQUEST[ 'rf_sitetitlecolor' ] ) ) { update_option( 'rf_sitetitlecolor', $_REQUEST[ 'rf_sitetitlecolor' ]  ); } else { delete_option( 'rf_sitetitlecolor' ); }
if( isset( $_REQUEST[ 'rf_taglinecolor' ] ) ) { update_option( 'rf_taglinecolor', $_REQUEST[ 'rf_taglinecolor' ]  ); } else { delete_option( 'rf_taglinecolor' ); }

// NAVIGATION
if( isset( $_REQUEST[ 'rf_navbgcolor' ] ) ) { update_option( 'rf_navbgcolor', $_REQUEST[ 'rf_navbgcolor' ]  ); } else { delete_option( 'rf_navbgcolor' ); }
if( isset( $_REQUEST[ 'rf_navlinkcolor' ] ) ) { update_option( 'rf_navlinkcolor', $_REQUEST[ 'rf_navlinkcolor' ]  ); } else { delete_option( 'rf_navlinkcolor' ); }
if( isset( $_REQUEST[ 'rf_navlinkhovercolor' ] ) ) { update_option( 'rf_navlinkhovercolor', $_REQUEST[ 'rf_navlinkhovercolor' ]  ); } else { delete_option( 'rf_navlinkhovercolor' ); }

// CHILD PAGE NAVIGATION
if( isset( $_REQUEST[ 'rf_childnavbgcolor' ] ) ) { update_option( 'rf_childnavbgcolor', $_REQUEST[ 'rf_childnavbgcolor' ]  ); } else { delete_option( 'rf_childnavbgcolor' ); }
if( isset( $_REQUEST[ 'rf_childnavlinkcolor' ] ) ) { update_option( 'rf_childnavlinkcolor', $_REQUEST[ 'rf_childnavlinkcolor' ]  ); } else { delete_option( 'rf_childnavlinkcolor' ); }
if( isset( $_REQUEST[ 'rf_childnavlinkhovercolor' ] ) ) { update_option( 'rf_childnavlinkhovercolor', $_REQUEST[ 'rf_childnavlinkhovercolor' ]  ); } else { delete_option( 'rf_childnavlinkhovercolor' ); }

// MAIN CONTENT
if( isset( $_REQUEST[ 'rf_mainbgcolor' ] ) ) { update_option( 'rf_mainbgcolor', $_REQUEST[ 'rf_mainbgcolor' ]  ); } else { delete_option( 'rf_mainbgcolor' ); }
if( isset( $_REQUEST[ 'rf_maintextcolor' ] ) ) { update_option( 'rf_maintextcolor', $_REQUEST[ 'rf_maintextcolor' ]  ); } else { delete_option( 'rf_maintextcolor' ); }
if( isset( $_REQUEST[ 'rf_maintextlinkcolor' ] ) ) { update_option( 'rf_maintextlinkcolor', $_REQUEST[ 'rf_maintextlinkcolor' ]  ); } else { delete_option( 'rf_maintextlinkcolor' ); }
if( isset( $_REQUEST[ 'rf_maintextlinkhovercolor' ] ) ) { update_option( 'rf_maintextlinkhovercolor', $_REQUEST[ 'rf_maintextlinkhovercolor' ]  ); } else { delete_option( 'rf_maintextlinkhovercolor' ); }
if( isset( $_REQUEST[ 'rf_mainposttitlecolor' ] ) ) { update_option( 'rf_mainposttitlecolor', $_REQUEST[ 'rf_mainposttitlecolor' ]  ); } else { delete_option( 'rf_mainposttitlecolor' ); }
if( isset( $_REQUEST[ 'rf_mainposttitlehovercolor' ] ) ) { update_option( 'rf_mainposttitlehovercolor', $_REQUEST[ 'rf_mainposttitlehovercolor' ]  ); } else { delete_option( 'rf_mainposttitlehovercolor' ); }
if( isset( $_REQUEST[ 'rf_mainpostinfocolor' ] ) ) { update_option( 'rf_mainpostinfocolor', $_REQUEST[ 'rf_mainpostinfocolor' ]  ); } else { delete_option( 'rf_mainpostinfocolor' ); }
if( isset( $_REQUEST[ 'rf_mainpostinfolinkcolor' ] ) ) { update_option( 'rf_mainpostinfolinkcolor', $_REQUEST[ 'rf_mainpostinfolinkcolor' ]  ); } else { delete_option( 'rf_mainpostinfolinkcolor' ); }
if( isset( $_REQUEST[ 'rf_mainpostinfolinkhovercolor' ] ) ) { update_option( 'rf_mainpostinfolinkhovercolor', $_REQUEST[ 'rf_mainpostinfolinkhovercolor' ]  ); } else { delete_option( 'rf_mainpostinfolinkhovercolor' ); }
if( isset( $_REQUEST[ 'rf_mainbordercolor' ] ) ) { update_option( 'rf_mainbordercolor', $_REQUEST[ 'rf_mainbordercolor' ]  ); } else { delete_option( 'rf_mainbordercolor' ); }
if( isset( $_REQUEST[ 'rf_mainheadercolor' ] ) ) { update_option( 'rf_mainheadercolor', $_REQUEST[ 'rf_mainheadercolor' ]  ); } else { delete_option( 'rf_mainheadercolor' ); }

// COMMENTS
if( isset( $_REQUEST[ 'rf_commentsbgcolor' ] ) ) { update_option( 'rf_commentsbgcolor', $_REQUEST[ 'rf_commentsbgcolor' ]  ); } else { delete_option( 'rf_commentsbgcolor' ); }
if( isset( $_REQUEST[ 'rf_commentstextcolor' ] ) ) { update_option( 'rf_commentstextcolor', $_REQUEST[ 'rf_commentstextcolor' ]  ); } else { delete_option( 'rf_commentstextcolor' ); }
if( isset( $_REQUEST[ 'rf_commentslinkcolor' ] ) ) { update_option( 'rf_commentslinkcolor', $_REQUEST[ 'rf_commentslinkcolor' ]  ); } else { delete_option( 'rf_commentslinkcolor' ); }
if( isset( $_REQUEST[ 'rf_commentslinkhovercolor' ] ) ) { update_option( 'rf_commentslinkhovercolor', $_REQUEST[ 'rf_commentslinkhovercolor' ]  ); } else { delete_option( 'rf_commentslinkhovercolor' ); }
if( isset( $_REQUEST[ 'rf_commentsinfotextcolor' ] ) ) { update_option( 'rf_commentsinfotextcolor', $_REQUEST[ 'rf_commentsinfotextcolor' ]  ); } else { delete_option( 'rf_commentsinfotextcolor' ); }
if( isset( $_REQUEST[ 'rf_commentsinfolinkcolor' ] ) ) { update_option( 'rf_commentsinfolinkcolor', $_REQUEST[ 'rf_commentsinfolinkcolor' ]  ); } else { delete_option( 'rf_commentsinfolinkcolor' ); }
if( isset( $_REQUEST[ 'rf_commentsinfolinkhovercolor' ] ) ) { update_option( 'rf_commentsinfolinkhovercolor', $_REQUEST[ 'rf_commentsinfolinkhovercolor' ]  ); } else { delete_option( 'rf_commentsinfolinkhovercolor' ); }
if( isset( $_REQUEST[ 'rf_commentsbordercolor' ] ) ) { update_option( 'rf_commentsbordercolor', $_REQUEST[ 'rf_commentsbordercolor' ]  ); } else { delete_option( 'rf_commentsbordercolor' ); }

// BOTTOMBAR
if( isset( $_REQUEST[ 'rf_bottombgcolor' ] ) ) { update_option( 'rf_bottombgcolor', $_REQUEST[ 'rf_bottombgcolor' ]  ); } else { delete_option( 'rf_bottombgcolor' ); }
if( isset( $_REQUEST[ 'rf_bottomtitlecolor' ] ) ) { update_option( 'rf_bottomtitlecolor', $_REQUEST[ 'rf_bottomtitlecolor' ]  ); } else { delete_option( 'rf_bottomtitlecolor' ); }
if( isset( $_REQUEST[ 'rf_bottomtextcolor' ] ) ) { update_option( 'rf_bottomtextcolor', $_REQUEST[ 'rf_bottomtextcolor' ]  ); } else { delete_option( 'rf_bottomtextcolor' ); }
if( isset( $_REQUEST[ 'rf_bottomlinkcolor' ] ) ) { update_option( 'rf_bottomlinkcolor', $_REQUEST[ 'rf_bottomlinkcolor' ]  ); } else { delete_option( 'rf_bottomlinkcolor' ); }
if( isset( $_REQUEST[ 'rf_bottomlinkhovercolor' ] ) ) { update_option( 'rf_bottomlinkhovercolor', $_REQUEST[ 'rf_bottomlinkhovercolor' ]  ); } else { delete_option( 'rf_bottomlinkhovercolor' ); }
if( isset( $_REQUEST[ 'rf_bottombordercolor' ] ) ) { update_option( 'rf_bottombordercolor', $_REQUEST[ 'rf_bottombordercolor' ]  ); } else { delete_option( 'rf_bottombordercolor' ); }

// FOOTER
if( isset( $_REQUEST[ 'rf_footerbgcolor' ] ) ) { update_option( 'rf_footerbgcolor', $_REQUEST[ 'rf_footerbgcolor' ]  ); } else { delete_option( 'rf_footerbgcolor' ); }
if( isset( $_REQUEST[ 'rf_footertextcolor' ] ) ) { update_option( 'rf_footertextcolor', $_REQUEST[ 'rf_footertextcolor' ]  ); } else { delete_option( 'rf_footertextcolor' ); }
if( isset( $_REQUEST[ 'rf_footerlinkcolor' ] ) ) { update_option( 'rf_footerlinkcolor', $_REQUEST[ 'rf_footerlinkcolor' ]  ); } else { delete_option( 'rf_footerlinkcolor' ); }
if( isset( $_REQUEST[ 'rf_footerlinkhovercolor' ] ) ) { update_option( 'rf_footerlinkhovercolor', $_REQUEST[ 'rf_footerlinkhovercolor' ]  ); } else { delete_option( 'rf_footerlinkhovercolor' ); }

			// goto theme edit page
			header("Location: themes.php?page=functions.php&saved=true");
			die;

  		// reset settings
		} else if( 'reset' == $_REQUEST['action'] ) {


// -------------
// ROUND 3
// -------------

// GENERAL
delete_option( 'rf_sitewidth' );
delete_option( 'rf_sitewidthtype' );
delete_option( 'rf_font' );
delete_option( 'rf_bgcolor' );
delete_option( 'rf_roundedcorners' );
delete_option( 'rf_topbottompadding' );

// HEADER
delete_option( 'rf_headerbgcolor' );
delete_option( 'rf_sitetitlecolor' );
delete_option( 'rf_taglinecolor' );

// NAVIGATION
delete_option( 'rf_navbgcolor' );
delete_option( 'rf_navlinkcolor' );
delete_option( 'rf_navlinkhovercolor' );


// CHILD PAGE NAVIGATION
delete_option( 'rf_childnavbgcolor' );
delete_option( 'rf_childnavlinkcolor' );
delete_option( 'rf_childnavlinkhovercolor' );

// MAIN CONTENT
delete_option( 'rf_mainbgcolor' );
delete_option( 'rf_maintextcolor' );
delete_option( 'rf_maintextlinkcolor' );
delete_option( 'rf_maintextlinkhovercolor' );
delete_option( 'rf_mainposttitlecolor' );
delete_option( 'rf_mainposttitlehovercolor' );
delete_option( 'rf_mainpostinfocolor' );
delete_option( 'rf_mainpostinfolinkcolor' );
delete_option( 'rf_mainpostinfolinkhovercolor' );
delete_option( 'rf_mainbordercolor' );
delete_option( 'rf_mainheadercolor' );

// COMMENTS
delete_option( 'rf_commentsbgcolor' );
delete_option( 'rf_commentstextcolor' );
delete_option( 'rf_commentslinkcolor' );
delete_option( 'rf_commentslinkhovercolor' );
delete_option( 'rf_commentsinfotextcolor' );
delete_option( 'rf_commentsinfolinkcolor' );
delete_option( 'rf_commentsinfolinkhovercolor' );
delete_option( 'rf_commentsbordercolor' );

// BOTTOMBAR
delete_option( 'rf_bottombgcolor' );
delete_option( 'rf_bottomtitlecolor' );
delete_option( 'rf_bottomtextcolor' );
delete_option( 'rf_bottomlinkcolor' );
delete_option( 'rf_bottomlinkhovercolor' );
delete_option( 'rf_bottombordercolor' );

// FOOTER
delete_option( 'rf_footerbgcolor' );
delete_option( 'rf_footertextcolor' );
delete_option( 'rf_footerlinkcolor' );
delete_option( 'rf_footerlinkhovercolor' );

			// goto theme edit page
			header("Location: themes.php?page=functions.php&reset=true");
			die;

		}
	}

    add_theme_page("RoundFlow Options", "Theme Options", 'edit_theme_options', basename(__FILE__), 'rf_admin');

}

function rf_admin() {

	if ( isset($_REQUEST['saved']) && $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>StripedPlus settings saved.</strong></p></div>';
	if ( isset($_REQUEST['reset']) && $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>StripedPlus settings reset.</strong></p></div>';
	
?>
<div id="ColourMod"><!--

	ColourMod Plug-N-Play v2.1
	DHTML Dynamic Color Picker/Selector
	© 2005 ColourMod.com
	Design/Programming By Stephen Hallgren (www.teevio.net)
	Produced By The Noah Institute (www.noahinstitute.org)
	
-->

<div id="cmDefault">
	<div id="cmColorContainer" class="cmColorContainer"></div>
	<div id="cmSatValBg" class="cmSatValBg"></div>
	<div id="cmDefaultMiniOverlay" class="cmDefaultMiniOverlay"></div>
	<div id="cmSatValContainer">
		<div id="cmBlueDot" class="cmBlueDot"></div>
	</div>
	<div id="cmHueContainer">
		<div id="cmBlueArrow" class="cmBlueArrow"></div>
	</div>
	<div id="cmClose">
		<input type="text" name="cmHex" id="cmHex" value="FFFFFF" maxlength="6" size="9" /> <a href="http://www.colourmod.com" id="cmCloseButton" ><img src="<?php bloginfo('template_directory'); ?>/colourmod/images/close.gif" border="0" alt="Close ColourMod" /></a>
	</div>
	<div style="display:none">
		<input type="text" name="cmHue" id="cmHue" value="0" maxlength="3" />
	</div>
	<a href="http://www.colourmod.com" target="_blank" title="ColourMod - Dynamic Color Picker" class="cmLink">&copy; ColourMod.com</a>
</div></div>
<div class="wrap">
<h2>RoundFlow</h2>

<form method="post">

<fieldset class="options">
<legend>RoundFlow Settings</legend>

<p>This theme is made by <a href="http://theundersigned.net">the undersigned</a>, please contact me or write in <a href="http://webdesignbook.net/forum/viewforum.php?id=21">my forum</a>, if you find any bugs.</p>

<table width="100%" cellspacing="2" cellpadding="5" class="editform" >


<tr><th><br /><h3>General settings</h3></th><td>&nbsp;</td></tr>

<tr valign="top"> 
<th scope="row">Site width:</th> 
<td><input name="rf_sitewidth" type="text" value="<?php if ( get_option( 'rf_sitewidth' ) != "") { echo get_option( 'rf_sitewidth' ); } else { echo "70"; } ?>" />
<select name="rf_sitewidthtype" width="40px">	
<option value='%'  <?php if (get_option( 'rf_sitewidthtype' ) == "%") { echo "selected='selected'"; } ?>>%</option>
<option value='px'  <?php if (get_option( 'rf_sitewidthtype' ) == "px") { echo "selected='selected'"; } ?>>px</option>
</select>
</td> 
</tr>

<tr valign="top"> 
<th scope="row">Site font:</th> 
<td>
<select name="rf_font">	
<option value="'Lucida Grande', Verdana, Arial, Sans-Serif"  <?php if (get_option( 'rf_font' ) == "\'Lucida Grande\', Verdana, Arial, Sans-Serif") { echo "selected='selected'"; } ?>>'Lucida Grande', Verdana, Arial, Sans-Serif</option>
<option value="Georgia, 'Times New Roman', Times, serif"  <?php if (get_option( 'rf_font' ) == "Georgia, \'Times New Roman\', Times, serif") { echo "selected='selected'"; } ?>>Georgia, 'Times New Roman', Times, serif</option>
<option value="Arial, Helvetica, 'sans-serif'"  <?php if (get_option( 'rf_font' ) == "Arial, Helvetica, \'sans-serif\'") { echo "selected='selected'"; } ?>>Arial, Helvetica, 'sans-serif'</option>
<option value="'Courier New', Courier, Monaco, monospace"  <?php if (get_option( 'rf_font' ) == "\'Courier New\', Courier, Monaco, monospace") { echo "selected='selected'"; } ?>>'Courier New', Courier, Monaco, monospace</option>
<option value="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"  <?php if (get_option( 'rf_font' ) == "Helvetica, Geneva, Arial, SunSans-Regular, sans-serif") { echo "selected='selected'"; } ?>>Helvetica, Geneva, Arial, SunSans-Regular, sans-serif</option>
<option value="'Trebuchet MS', Geneva, Arial, Helvetica, SunSans-Regular, sans-serif"  <?php if (get_option( 'rf_font' ) == "\'Trebuchet MS\', Geneva, Arial, Helvetica, SunSans-Regular, sans-serif") { echo "selected='selected'"; } ?>>'Trebuchet MS', Geneva, Arial, Helvetica, SunSans-Regular, sans-serif</option>
<option value="Verdana, Arial, Helvetica, sans-serif"  <?php if (get_option( 'rf_font' ) == "Verdana, Arial, Helvetica, sans-serif") { echo "selected='selected'"; } ?>>Verdana, Arial, Helvetica, sans-serif</option>
</select>
</td> 
</tr>

<tr valign="top"> 
<th scope="row">Background color:</th> 
<td>
<div id="pickbgcolor" class="rfpickcolor"><a href="javascript:;" onmousedown="pickcolor( '#pickbgcolor', 'backgroundColor', false, 'rf_bgcolor', this)">&nbsp;</a></div>
#<input name="rf_bgcolor" maxlenght="6" id="rf_bgcolor" type="text" value="<?php if ( get_option( 'rf_bgcolor' ) != "") { echo get_option( 'rf_bgcolor' ); } else { echo "222"; } ?>" onkeyup="changecss('#pickbgcolor', 'backgroundColor', this.value, 'hex', false, '');" />
</td> 
</tr>

<tr valign="top"> 
<th scope="row">Rounded corners:</th> 
<td>
<select name="rf_roundedcorners">	
<option value="ON"  <?php if (get_option( 'rf_roundedcorners' ) == "ON") { echo "selected='selected'"; } ?>>ON</option>
<option value="OFF"  <?php if (get_option( 'rf_roundedcorners' ) == "OFF") { echo "selected='selected'"; } ?>>OFF</option>
</select>
</td> 
</tr>

<tr valign="top"> 
<th scope="row">Top and bottom padding:</th> 
<td>
<input name="rf_topbottompadding" maxlenght="6" id="rf_topbottompadding" type="text" value="<?php if ( get_option( 'rf_topbottompadding' ) != "" || get_option( 'rf_topbottompadding' ) != "0" ) { echo get_option( 'rf_topbottompadding' ); } else { echo "40"; } ?>" />px
</td> 
</tr>

<tr><th><br /><h3>Header settings</h3></th><td>&nbsp;</td></tr>

<tr valign="top"> 
<th scope="row">Background color:</th> 
<td>
<div id="pickheaderbgcolor" class="rfpickcolor"><a href="javascript:;" onmousedown="pickcolor( '#pickheaderbgcolor', 'backgroundColor', false, 'rf_headerbgcolor', this)">&nbsp;</a></div>
#<input name="rf_headerbgcolor" maxlenght="6" id="rf_headerbgcolor" type="text" value="<?php if ( get_option( 'rf_headerbgcolor' ) != "") { echo get_option( 'rf_headerbgcolor' ); } else { echo "DD8822"; } ?>" onkeyup="changecss('#pickheaderbgcolor', 'backgroundColor', this.value, 'hex', false, '');" />
</td> 
</tr>

<tr valign="top"> 
<th scope="row">Site title color:</th>
<td>
<div id="picksitetitlecolor" class="rfpickcolor"><a href="javascript:;" onmousedown="pickcolor( '#picksitetitlecolor', 'backgroundColor', false, 'rf_sitetitlecolor', this)">&nbsp;</a></div>
#<input name="rf_sitetitlecolor" maxlenght="6" id="rf_sitetitlecolor" type="text" value="<?php if ( get_option( 'rf_sitetitlecolor' ) != "") { echo get_option( 'rf_sitetitlecolor' ); } else { echo "FFFFFF"; } ?>" onkeyup="changecss('#picksitetitlecolor', 'backgroundColor', this.value, 'hex', false, '');" />
</td>
</tr>

<tr valign="top"> 
<th scope="row">Tagline color:</th> 
<td>
<div id="picktaglinecolor" class="rfpickcolor"><a href="javascript:;" onmousedown="pickcolor( '#picktaglinecolor', 'backgroundColor', false, 'rf_taglinecolor', this)">&nbsp;</a></div>
#<input name="rf_taglinecolor" maxlenght="6" id="rf_taglinecolor" type="text" value="<?php if ( get_option( 'rf_taglinecolor' ) != "") { echo get_option( 'rf_taglinecolor' ); } else { echo "FFFFFF"; } ?>" onkeyup="changecss('#picktaglinecolor', 'backgroundColor', this.value, 'hex', false, '');" />
</td>
</tr>

<tr><th><br /><h3>Navigation settings</h3></th><td>&nbsp;</td></tr>

<tr valign="top"> 
<th scope="row">Background color:</th>
<td>
<div id="picknavbgcolor" class="rfpickcolor"><a href="javascript:;" onmousedown="pickcolor( '#picknavbgcolor', 'backgroundColor', false, 'rf_navbgcolor', this, 0, 0)">&nbsp;</a></div>
#<input name="rf_navbgcolor" maxlenght="6" id="rf_navbgcolor" type="text" value="<?php if ( get_option( 'rf_navbgcolor' ) != "") { echo get_option( 'rf_navbgcolor' ); } else { echo "88CC22"; } ?>" onkeyup="changecss('#picknavbgcolor', 'backgroundColor', this.value, 'hex', false, '');" />
</td> 
</tr>

<tr valign="top"> 
<th scope="row">Link color:</th>
<td>
<div id="picknavlinkcolor" class="rfpickcolor"><a href="javascript:;" onmousedown="pickcolor( '#picknavlinkcolor', 'backgroundColor', false, 'rf_navlinkcolor', this, 0, 0)">&nbsp;</a></div>
#<input name="rf_navlinkcolor" maxlenght="6" id="rf_navlinkcolor" type="text" value="<?php if ( get_option( 'rf_navlinkcolor' ) != "") { echo get_option( 'rf_navlinkcolor' ); } else { echo "FFFFFF"; } ?>" onkeyup="changecss('#picknavlinkcolor', 'backgroundColor', this.value, 'hex', false, '');" />
</td> 
</tr>

<tr valign="top"> 
<th scope="row">Link hover color:</th>
<td>
<div id="picknavlinkhovercolor" class="rfpickcolor"><a href="javascript:;" onmousedown="pickcolor( '#picknavlinkhovercolor', 'backgroundColor', false, 'rf_navlinkhovercolor', this, 0, 0)">&nbsp;</a></div>
#<input name="rf_navlinkhovercolor" maxlenght="6" id="rf_navlinkhovercolor" type="text" value="<?php if ( get_option( 'rf_navlinkhovercolor' ) != "") { echo get_option( 'rf_navlinkhovercolor' ); } else { echo "FFFFFF"; } ?>" onkeyup="changecss('#picknavlinkhovercolor', 'backgroundColor', this.value, 'hex', false, '');" />
</td> 
</tr>

<tr><th><br /><h3>Child navigation settings</h3></th><td>&nbsp;</td></tr>

<tr valign="top"> 
<th scope="row">Background color:</th>
<td>
<div id="pickchildnavbgcolor" class="rfpickcolor"><a href="javascript:;" onmousedown="pickcolor( '#pickchildnavbgcolor', 'backgroundColor', false, 'rf_childnavbgcolor', this, 0, 0)">&nbsp;</a></div>
#<input name="rf_childnavbgcolor" maxlenght="6" id="rf_childnavbgcolor" type="text" value="<?php if ( get_option( 'rf_childnavbgcolor' ) != "") { echo get_option( 'rf_childnavbgcolor' ); } else { echo "2288CC"; } ?>" onkeyup="changecss('#pickchildnavbgcolor', 'backgroundColor', this.value, 'hex', false, '');" />
</td> 
</tr>

<tr valign="top"> 
<th scope="row">Link color:</th>
<td>
<div id="pickchildnavlinkcolor" class="rfpickcolor"><a href="javascript:;" onmousedown="pickcolor( '#pickchildnavlinkcolor', 'backgroundColor', false, 'rf_childnavlinkcolor', this, 0, 0)">&nbsp;</a></div>
#<input name="rf_childnavlinkcolor" maxlenght="6" id="rf_childnavlinkcolor" type="text" value="<?php if ( get_option( 'rf_childnavlinkcolor' ) != "") { echo get_option( 'rf_childnavlinkcolor' ); } else { echo "FFFFFF"; } ?>" onkeyup="changecss('#pickchildnavlinkcolor', 'backgroundColor', this.value, 'hex', false, '');" />
</td> 
</tr>

<tr valign="top"> 
<th scope="row">Link hover color:</th>
<td>
<div id="pickchildnavlinkhovercolor" class="rfpickcolor"><a href="javascript:;" onmousedown="pickcolor( '#pickchildnavlinkhovercolor', 'backgroundColor', false, 'rf_childnavlinkhovercolor', this, 0, 0)">&nbsp;</a></div>
#<input name="rf_childnavlinkhovercolor" maxlenght="6" id="rf_childnavlinkhovercolor" type="text" value="<?php if ( get_option( 'rf_childnavlinkhovercolor' ) != "") { echo get_option( 'rf_childnavlinkhovercolor' ); } else { echo "FFFFFF"; } ?>" onkeyup="changecss('#pickchildnavlinkhovercolor', 'backgroundColor', this.value, 'hex', false, '');" />
</td> 
</tr>

<tr><th><br /><h3>Main content settings</h3></th><td>&nbsp;</td></tr>

<tr valign="top"> 
<th scope="row">Background color:</th>
<td>
<div id="pickmainbgcolor" class="rfpickcolor"><a href="javascript:;" onmousedown="pickcolor( '#pickmainbgcolor', 'backgroundColor', false, 'rf_mainbgcolor', this, 0, 0)">&nbsp;</a></div>
#<input name="rf_mainbgcolor" maxlenght="6" id="rf_mainbgcolor" type="text" value="<?php if ( get_option( 'rf_mainbgcolor' ) != "") { echo get_option( 'rf_mainbgcolor' ); } else { echo "EEEEEE"; } ?>" onkeyup="changecss('#pickmainbgcolor', 'backgroundColor', this.value, 'hex', false, '');" />
</td> 
</tr>

<tr valign="top"> 
<th scope="row">Text color:</th>
<td>
<div id="pickmaintextcolor" class="rfpickcolor"><a href="javascript:;" onmousedown="pickcolor( '#pickmaintextcolor', 'backgroundColor', false, 'rf_maintextcolor', this, 0, 0)">&nbsp;</a></div>
#<input name="rf_maintextcolor" maxlenght="6" id="rf_maintextcolor" type="text" value="<?php if ( get_option( 'rf_maintextcolor' ) != "") { echo get_option( 'rf_maintextcolor' ); } else { echo "333333"; } ?>" onkeyup="changecss('#pickmaintextcolor', 'backgroundColor', this.value, 'hex', false, '');" />
</td> 
</tr>

<tr valign="top"> 
<th scope="row">Text link color:</th>
<td>
<div id="pickmaintextlinkcolor" class="rfpickcolor"><a href="javascript:;" onmousedown="pickcolor( '#pickmaintextlinkcolor', 'backgroundColor', false, 'rf_maintextlinkcolor', this, 0, 0)">&nbsp;</a></div>
#<input name="rf_maintextlinkcolor" maxlenght="6" id="rf_maintextlinkcolor" type="text" value="<?php if ( get_option( 'rf_maintextlinkcolor' ) != "") { echo get_option( 'rf_maintextlinkcolor' ); } else { echo "2288CC"; } ?>" onkeyup="changecss('#pickmaintextlinkcolor', 'backgroundColor', this.value, 'hex', false, '');" />
</td> 
</tr>

<tr valign="top"> 
<th scope="row">Text link hover color:</th>
<td>
<div id="pickmaintextlinkhovercolor" class="rfpickcolor"><a href="javascript:;" onmousedown="pickcolor( '#pickmaintextlinkhovercolor', 'backgroundColor', false, 'rf_maintextlinkhovercolor', this, 0, 0)">&nbsp;</a></div>

#<input name="rf_maintextlinkhovercolor" maxlenght="6" id="rf_maintextlinkhovercolor" type="text" value="<?php if ( get_option( 'rf_maintextlinkhovercolor' ) != "") { echo get_option( 'rf_maintextlinkhovercolor' ); } else { echo "2288CC"; } ?>" onkeyup="changecss('#pickmaintextlinkhovercolor', 'backgroundColor', this.value, 'hex', false, '');" />
</td> 
</tr>

<tr valign="top"> 
<th scope="row">Post title color:</th>
<td>
<div id="pickmainposttitlecolor" class="rfpickcolor"><a href="javascript:;" onmousedown="pickcolor( '#pickmainposttitlecolor', 'backgroundColor', false, 'rf_mainposttitlecolor', this, 0, 0)">&nbsp;</a></div>
#<input name="rf_mainposttitlecolor" maxlenght="6" id="rf_mainposttitlecolor" type="text" value="<?php if ( get_option( 'rf_mainposttitlecolor' ) != "") { echo get_option( 'rf_mainposttitlecolor' ); } else { echo "333333"; } ?>" onkeyup="changecss('#pickmainposttitlecolor', 'backgroundColor', this.value, 'hex', false, '');" />
</td> 
</tr>

<tr valign="top"> 
<th scope="row">Post title hover color:</th>
<td>
<div id="pickmainposttitlehovercolor" class="rfpickcolor"><a href="javascript:;" onmousedown="pickcolor( '#pickmainposttitlehovercolor', 'backgroundColor', false, 'rf_mainposttitlehovercolor', this, 0, 0)">&nbsp;</a></div>
#<input name="rf_mainposttitlehovercolor" maxlenght="6" id="rf_mainposttitlehovercolor" type="text" value="<?php if ( get_option( 'rf_mainposttitlehovercolor' ) != "") { echo get_option( 'rf_mainposttitlehovercolor' ); } else { echo "2288CC"; } ?>" onkeyup="changecss('#pickmainposttitlehovercolor', 'backgroundColor', this.value, 'hex', false, '');" />
</td> 
</tr>

<tr valign="top"> 
<th scope="row">Post info text color:</th>
<td>
<div id="pickmainpostinfocolor" class="rfpickcolor"><a href="javascript:;" onmousedown="pickcolor( '#pickmainpostinfocolor', 'backgroundColor', false, 'rf_mainpostinfocolor', this, 0, 0)">&nbsp;</a></div>
#<input name="rf_mainpostinfocolor" maxlenght="6" id="rf_mainpostinfocolor" type="text" value="<?php if ( get_option( 'rf_mainpostinfocolor' ) != "") { echo get_option( 'rf_mainpostinfocolor' ); } else { echo "AAAAAA"; } ?>" onkeyup="changecss('#pickmainpostinfocolor', 'backgroundColor', this.value, 'hex', false, '');" />
</td> 
</tr>

<tr valign="top"> 
<th scope="row">Post info link color:</th>
<td>
<div id="pickmainpostinfolinkcolor" class="rfpickcolor"><a href="javascript:;" onmousedown="pickcolor( '#pickmainpostinfolinkcolor', 'backgroundColor', false, 'rf_mainpostinfolinkcolor', this, 0, 0)">&nbsp;</a></div>
#<input name="rf_mainpostinfolinkcolor" maxlenght="6" id="rf_mainpostinfolinkcolor" type="text" value="<?php if ( get_option( 'rf_mainpostinfolinkcolor' ) != "") { echo get_option( 'rf_mainpostinfolinkcolor' ); } else { echo "AAAAAA"; } ?>" onkeyup="changecss('#pickmainpostinfolinkcolor', 'backgroundColor', this.value, 'hex', false, '');" />
</td> 
</tr>


<tr valign="top"> 
<th scope="row">Post info link hover color:</th>
<td>
<div id="pickmainpostinfolinkhovercolor" class="rfpickcolor"><a href="javascript:;" onmousedown="pickcolor( '#pickmainpostinfolinkhovercolor', 'backgroundColor', false, 'rf_mainpostinfolinkhovercolor', this, 0, 0)">&nbsp;</a></div>
#<input name="rf_mainpostinfolinkhovercolor" maxlenght="6" id="rf_mainpostinfolinkhovercolor" type="text" value="<?php if ( get_option( 'rf_mainpostinfolinkhovercolor' ) != "") { echo get_option( 'rf_mainpostinfolinkhovercolor' ); } else { echo "2288CC"; } ?>" onkeyup="changecss('#pickmainpostinfolinkhovercolor', 'backgroundColor', this.value, 'hex', false, '');" />
</td> 
</tr>

<tr valign="top"> 
<th scope="row">Border color:</th>
<td>
<div id="pickmainbordercolor" class="rfpickcolor"><a href="javascript:;" onmousedown="pickcolor( '#pickmainbordercolor', 'backgroundColor', false, 'rf_mainbordercolor', this, 0, 0)">&nbsp;</a></div>
#<input name="rf_mainbordercolor" maxlenght="6" id="rf_mainbordercolor" type="text" value="<?php if ( get_option( 'rf_mainbordercolor' ) != "") { echo get_option( 'rf_mainbordercolor' ); } else { echo "999999"; } ?>" onkeyup="changecss('#pickmainbordercolor', 'backgroundColor', this.value, 'hex', false, '');" />
</td> 
</tr>

<tr valign="top"> 
<th scope="row">H1, H2, H3 color:</th>
<td>
<div id="pickmainheadercolor" class="rfpickcolor"><a href="javascript:;" onmousedown="pickcolor( '#pickmainheadercolor', 'backgroundColor', false, 'rf_mainheadercolor', this, 0, 0)">&nbsp;</a></div>
#<input name="rf_mainheadercolor" maxlenght="6" id="rf_mainheadercolor" type="text" value="<?php if ( get_option( 'rf_mainheadercolor' ) != "") { echo get_option( 'rf_mainheadercolor' ); } else { echo "333333"; } ?>" onkeyup="changecss('#pickmainheadercolor', 'backgroundColor', this.value, 'hex', false, '');" />
</td> 
</tr>

<tr><th><br /><h3>Comment settings</h3></th><td>&nbsp;</td></tr>

<tr valign="top"> 
<th scope="row">Background color:</th>
<td>
<div id="pickcommentsbgcolor" class="rfpickcolor"><a href="javascript:;" onmousedown="pickcolor( '#pickcommentsbgcolor', 'backgroundColor', false, 'rf_commentsbgcolor', this, 0, 0)">&nbsp;</a></div>
#<input name="rf_commentsbgcolor" maxlenght="6" id="rf_commentsbgcolor" type="text" value="<?php if ( get_option( 'rf_commentsbgcolor' ) != "") { echo get_option( 'rf_commentsbgcolor' ); } else { echo "EEEEEE"; } ?>" onkeyup="changecss('#pickcommentsbgcolor', 'backgroundColor', this.value, 'hex', false, '');" />
</td> 
</tr>

<tr valign="top"> 
<th scope="row">Text color:</th>
<td>
<div id="pickcommentstextcolor" class="rfpickcolor"><a href="javascript:;" onmousedown="pickcolor( '#pickcommentstextcolor', 'backgroundColor', false, 'rf_commentstextcolor', this, 0, 0)">&nbsp;</a></div>
#<input name="rf_commentstextcolor" maxlenght="6" id="rf_commentstextcolor" type="text" value="<?php if ( get_option( 'rf_commentstextcolor' ) != "") { echo get_option( 'rf_commentstextcolor' ); } else { echo "333333"; } ?>" onkeyup="changecss('#pickcommentstextcolor', 'backgroundColor', this.value, 'hex', false, '');" />
</td> 
</tr>

<tr valign="top"> 
<th scope="row">Text link color:</th>
<td>
<div id="pickcommentslinkcolor" class="rfpickcolor"><a href="javascript:;" onmousedown="pickcolor( '#pickcommentslinkcolor', 'backgroundColor', false, 'rf_commentslinkcolor', this, 0, 0)">&nbsp;</a></div>
#<input name="rf_commentslinkcolor" maxlenght="6" id="rf_commentslinkcolor" type="text" value="<?php if ( get_option( 'rf_commentslinkcolor' ) != "") { echo get_option( 'rf_commentslinkcolor' ); } else { echo "2288CC"; } ?>" onkeyup="changecss('#pickcommentslinkcolor', 'backgroundColor', this.value, 'hex', false, '');" />
</td> 
</tr>

<tr valign="top"> 
<th scope="row">Text link hover color:</th>
<td>
<div id="pickcommentslinkhovercolor" class="rfpickcolor"><a href="javascript:;" onmousedown="pickcolor( '#pickcommentslinkhovercolor', 'backgroundColor', false, 'rf_commentslinkhovercolor', this, 0, 0)">&nbsp;</a></div>
#<input name="rf_commentslinkhovercolor" maxlenght="6" id="rf_commentslinkhovercolor" type="text" value="<?php if ( get_option( 'rf_commentslinkhovercolor' ) != "") { echo get_option( 'rf_commentslinkhovercolor' ); } else { echo "2288CC"; } ?>" onkeyup="changecss('#pickcommentslinkhovercolor', 'backgroundColor', this.value, 'hex', false, '');" />
</td> 
</tr>

<tr valign="top"> 
<th scope="row">Comment info text color:</th>
<td>
<div id="pickcommentsinfotextcolor" class="rfpickcolor"><a href="javascript:;" onmousedown="pickcolor( '#pickcommentsinfotextcolor', 'backgroundColor', false, 'rf_commentsinfotextcolor', this, 0, 0)">&nbsp;</a></div>
#<input name="rf_commentsinfotextcolor" maxlenght="6" id="rf_commentsinfotextcolor" type="text" value="<?php if ( get_option( 'rf_commentsinfotextcolor' ) != "") { echo get_option( 'rf_commentsinfotextcolor' ); } else { echo "AAAAAA"; } ?>" onkeyup="changecss('#pickcommentsinfotextcolor', 'backgroundColor', this.value, 'hex', false, '');" />
</td> 
</tr>

<tr valign="top"> 
<th scope="row">Comment info link color:</th>
<td>
<div id="pickcommentsinfolinkcolor" class="rfpickcolor"><a href="javascript:;" onmousedown="pickcolor( '#pickcommentsinfolinkcolor', 'backgroundColor', false, 'rf_commentsinfolinkcolor', this, 0, 0)">&nbsp;</a></div>
#<input name="rf_commentsinfolinkcolor" maxlenght="6" id="rf_commentsinfolinkcolor" type="text" value="<?php if ( get_option( 'rf_commentsinfolinkcolor' ) != "") { echo get_option( 'rf_commentsinfolinkcolor' ); } else { echo "AAAAAA"; } ?>" onkeyup="changecss('#pickcommentsinfolinkcolor', 'backgroundColor', this.value, 'hex', false, '');" />
</td> 
</tr>

<tr valign="top"> 
<th scope="row">Comment info link hover color:</th>
<td>
<div id="pickcommentsinfolinkhovercolor" class="rfpickcolor"><a href="javascript:;" onmousedown="pickcolor( '#pickcommentsinfolinkhovercolor', 'backgroundColor', false, 'rf_commentsinfolinkhovercolor', this, 0, 0)">&nbsp;</a></div>
#<input name="rf_commentsinfolinkhovercolor" maxlenght="6" id="rf_commentsinfolinkhovercolor" type="text" value="<?php if ( get_option( 'rf_commentsinfolinkhovercolor' ) != "") { echo get_option( 'rf_commentsinfolinkhovercolor' ); } else { echo "2288CC"; } ?>" onkeyup="changecss('#pickcommentsinfolinkhovercolor', 'backgroundColor', this.value, 'hex', false, '');" />
</td> 
</tr>

<tr valign="top"> 
<th scope="row">Comment border color:</th>
<td>
<div id="pickcommentsbordercolor" class="rfpickcolor"><a href="javascript:;" onmousedown="pickcolor( '#pickcommentsbordercolor', 'backgroundColor', false, 'rf_commentsbordercolor', this, 0, 0)">&nbsp;</a></div>
#<input name="rf_commentsbordercolor" maxlenght="6" id="rf_commentsbordercolor" type="text" value="<?php if ( get_option( 'rf_commentsbordercolor' ) != "") { echo get_option( 'rf_commentsbordercolor' ); } else { echo "999999"; } ?>" onkeyup="changecss('#pickcommentsbordercolor', 'backgroundColor', this.value, 'hex', false, '');" />
</td> 
</tr>

<tr><th><br /><h3>Bottom bar settings</h3></th><td>&nbsp;</td></tr>


<tr valign="top"> 
<th scope="row">Background color:</th>
<td>
<div id="pickbottombgcolor" class="rfpickcolor"><a href="javascript:;" onmousedown="pickcolor( '#pickbottombgcolor', 'backgroundColor', false, 'rf_bottombgcolor', this, 0, 0)">&nbsp;</a></div>
#<input name="rf_bottombgcolor" maxlenght="6" id="rf_bottombgcolor" type="text" value="<?php if ( get_option( 'rf_bottombgcolor' ) != "") { echo get_option( 'rf_bottombgcolor' ); } else { echo "2288CC"; } ?>" onkeyup="changecss('#pickbottombgcolor', 'backgroundColor', this.value, 'hex', false, '');" />
</td> 
</tr>

<tr valign="top"> 
<th scope="row">Title color:</th>
<td>
<div id="pickbottomtitlecolor" class="rfpickcolor"><a href="javascript:;" onmousedown="pickcolor( '#pickbottomtitlecolor', 'backgroundColor', false, 'rf_bottomtitlecolor', this, 0, 0)">&nbsp;</a></div>
#<input name="rf_bottomtitlecolor" maxlenght="6" id="rf_bottomtitlecolor" type="text" value="<?php if ( get_option( 'rf_bottomtitlecolor' ) != "") { echo get_option( 'rf_bottomtitlecolor' ); } else { echo "FFFFFF"; } ?>" onkeyup="changecss('#pickbottomtitlecolor', 'backgroundColor', this.value, 'hex', false, '');" />
</td> 
</tr>

<tr valign="top"> 
<th scope="row">Text color:</th>
<td>
<div id="pickbottomtextcolor" class="rfpickcolor"><a href="javascript:;" onmousedown="pickcolor( '#pickbottomtextcolor', 'backgroundColor', false, 'rf_bottomtextcolor', this, 0, 0)">&nbsp;</a></div>
#<input name="rf_bottomtextcolor" maxlenght="6" id="rf_bottomtextcolor" type="text" value="<?php if ( get_option( 'rf_bottomtextcolor' ) != "") { echo get_option( 'rf_bottomtextcolor' ); } else { echo "FFFFFF"; } ?>" onkeyup="changecss('#pickbottomtextcolor', 'backgroundColor', this.value, 'hex', false, '');" />
</td> 
</tr>

<tr valign="top"> 
<th scope="row">Link color:</th>
<td>
<div id="pickbottomlinkcolor" class="rfpickcolor"><a href="javascript:;" onmousedown="pickcolor( '#pickbottomlinkcolor', 'backgroundColor', false, 'rf_bottomlinkcolor', this, 0, 0)">&nbsp;</a></div>
#<input name="rf_bottomlinkcolor" maxlenght="6" id="rf_bottomlinkcolor" type="text" value="<?php if ( get_option( 'rf_bottomlinkcolor' ) != "") { echo get_option( 'rf_bottomlinkcolor' ); } else { echo "FFFFFF"; } ?>" onkeyup="changecss('#pickbottomlinkcolor', 'backgroundColor', this.value, 'hex', false, '');" />
</td> 
</tr>

<tr valign="top"> 
<th scope="row">Link hover color:</th>
<td>
<div id="pickbottomlinkhovercolor" class="rfpickcolor"><a href="javascript:;" onmousedown="pickcolor( '#pickbottomlinkhovercolor', 'backgroundColor', false, 'rf_bottomlinkhovercolor', this, 0, 0)">&nbsp;</a></div>
#<input name="rf_bottomlinkhovercolor" maxlenght="6" id="rf_bottomlinkhovercolor" type="text" value="<?php if ( get_option( 'rf_bottomlinkhovercolor' ) != "") { echo get_option( 'rf_bottomlinkhovercolor' ); } else { echo "FFFFFF"; } ?>" onkeyup="changecss('#pickbottomlinkhovercolor', 'backgroundColor', this.value, 'hex', false, '');" />
</td> 
</tr>

<tr valign="top"> 
<th scope="row">Border color:</th>
<td>
<div id="pickbottombordercolor" class="rfpickcolor"><a href="javascript:;" onmousedown="pickcolor( '#pickbottombordercolor', 'backgroundColor', false, 'rf_bottombordercolor', this, 0, 0)">&nbsp;</a></div>
#<input name="rf_bottombordercolor" maxlenght="6" id="rf_bottombordercolor" type="text" value="<?php if ( get_option( 'rf_bottombordercolor' ) != "") { echo get_option( 'rf_bottombordercolor' ); } else { echo "FFFFFF"; } ?>" onkeyup="changecss('#pickbottombordercolor', 'backgroundColor', this.value, 'hex', false, '');" />
</td> 
</tr>

<tr><th><br /><h3>Footer settings</h3></th><td>&nbsp;</td></tr>

<tr valign="top"> 
<th scope="row">Background color:</th>
<td>
<div id="pickfooterbgcolor" class="rfpickcolor"><a href="javascript:;" onmousedown="pickcolor( '#pickfooterbgcolor', 'backgroundColor', false, 'rf_footerbgcolor', this, 0, 0)">&nbsp;</a></div>
#<input name="rf_footerbgcolor" maxlenght="6" id="rf_footerbgcolor" type="text" value="<?php if ( get_option( 'rf_footerbgcolor' ) != "") { echo get_option( 'rf_footerbgcolor' ); } else { echo "88CC22"; } ?>" onkeyup="changecss('#pickfooterbgcolor', 'backgroundColor', this.value, 'hex', false, '');" />
</td> 
</tr>

<tr valign="top"> 
<th scope="row">Link color:</th>
<td>
<div id="pickfootertextcolor" class="rfpickcolor"><a href="javascript:;" onmousedown="pickcolor( '#pickfootertextcolor', 'backgroundColor', false, 'rf_footertextcolor', this, 0, 0)">&nbsp;</a></div>
#<input name="rf_footertextcolor" maxlenght="6" id="rf_footertextcolor" type="text" value="<?php if ( get_option( 'rf_footertextcolor' ) != "") { echo get_option( 'rf_footertextcolor' ); } else { echo "FFFFFF"; } ?>" onkeyup="changecss('#pickfootertextcolor', 'backgroundColor', this.value, 'hex', false, '');" />
</td> 
</tr>

<tr valign="top"> 
<th scope="row">Link hover color:</th>
<td>
<div id="pickfooterlinkcolor" class="rfpickcolor"><a href="javascript:;" onmousedown="pickcolor( '#pickfooterlinkcolor', 'backgroundColor', false, 'rf_footerlinkcolor', this, 0, 0)">&nbsp;</a></div>
#<input name="rf_footerlinkcolor" maxlenght="6" id="rf_footerlinkcolor" type="text" value="<?php if ( get_option( 'rf_footerlinkcolor' ) != "") { echo get_option( 'rf_footerlinkcolor' ); } else { echo "FFFFFF"; } ?>" onkeyup="changecss('#pickfooterlinkcolor', 'backgroundColor', this.value, 'hex', false, '');" />
</td> 
</tr>

<tr valign="top"> 
<th scope="row">Background color:</th>
<td>
<div id="pickfooterlinkhovercolor" class="rfpickcolor"><a href="javascript:;" onmousedown="pickcolor( '#pickfooterlinkhovercolor', 'backgroundColor', false, 'rf_footerlinkhovercolor', this, 0, 0)">&nbsp;</a></div>
#<input name="rf_footerlinkhovercolor" maxlenght="6" id="rf_footerlinkhovercolor" type="text" value="<?php if ( get_option( 'rf_footerlinkhovercolor' ) != "") { echo get_option( 'rf_footerlinkhovercolor' ); } else { echo "FFFFFF"; } ?>" onkeyup="changecss('#pickfooterlinkhovercolor', 'backgroundColor', this.value, 'hex', false, '');" />
</td> 
</tr>

<tr><th><br />&nbsp;</th><td>&nbsp;</td></tr>

<tr valign="top"> 
<th scope="row">Save changes:</th> 
<td><input name="save" type="submit" value="Save" /></td> 
</tr>

</fieldset>
<input type="hidden" name="action" value="save" />
</form>



<form method="post">

<fieldset class="options">

<tr>
<th>Reset to default: </th>
<td><input name="reset" type="submit" value="<?php _e('Reset') ?>" /> (Resets and saves)</td>
</tr>
</table>
</div>

<input type="hidden" name="action" value="reset" />

</form>

<?php
}

function rf_admin_header() { ?>
<link href="<?php bloginfo('template_directory'); ?>/colourmod/ColourModStyle.php" rel="stylesheet" type="text/css" />
<script src="<?php bloginfo('template_directory'); ?>/colourmod/StyleModScript.js" type="text/JavaScript"></script>
<script src="<?php bloginfo('template_directory'); ?>/colourmod/ColourModScript.js" type="text/JavaScript"></script>
<?php }

add_action('admin_head', 'rf_admin_header');
add_action('admin_menu', 'rf_add_admin'); ?>
