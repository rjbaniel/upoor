<?php
if (!defined('SHOW_AUTHORS')) define('SHOW_AUTHORS', 'true');
if (!defined('TEMPLATE_DOMAIN')) define('TEMPLATE_DOMAIN','stripedplus');
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

<div <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
<div class="commentcontent">

    <p class="commentinfo"><cite><?php if (function_exists('avatar_display_comments')) { ?>
<?php avatar_display_comments(get_comment_author_email(),'48',''); ?>
<?php } else { ?>
<?php if (function_exists('get_avatar')) { echo get_avatar( get_comment_author_email() , 48 ); } ?>
<?php } ?>&nbsp;&nbsp; <?php comment_author_link() ?> &#8212; <?php comment_date() ?> @ <a href="#comment-<?php comment_ID() ?>"><?php comment_time() ?></a>&nbsp;&nbsp;<?php edit_comment_link(__('edit', TEMPLATE_DOMAIN),'',''); ?>&nbsp;&nbsp;<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></cite></p>  <?php comment_text() ?>
</div>

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
$sitewidth = get_option('striped_sitewidth');
$headerheight = get_option('striped_headerheight');

if($sitewidth == '') { $sitewidth = '600'; }
if($headerheight == '') { $headerheight = '120'; }

define('HEADER_TEXTCOLOR', '#FFF');
define('HEADER_IMAGE', ''); // %s is theme dir uri
define('HEADER_IMAGE_WIDTH', $sitewidth); //width is fixed
define('HEADER_IMAGE_HEIGHT', $headerheight);

function stripedplus_admin_header_style() { ?>
<style type="text/css">
#headimg { background: url(<?php header_image() ?>) no-repeat; }
#headimg { height: <?php echo HEADER_IMAGE_HEIGHT; ?>px; width: <?php echo HEADER_IMAGE_WIDTH; ?>px; }
</style>
<?php }

add_theme_support( 'custom-header', array('admin-head-callback' => 'stripedplus_admin_header_style'));

function header_custom_style() { ?>
<?php if('' != get_header_image() ) { ?>
<style type="text/css">
#header { background: url(<?php header_image() ?>) repeat !important; }
#header h1 a { color: #<?php header_textcolor() ?> !important; text-decoration: none; }
</style>
<?php } ?>
<?php }

add_action('wp_head', 'header_custom_style');





if ( function_exists('register_sidebar') ) {
register_sidebar(array(
'name' => 'Top Left',
'before_widget' => '',
'after_widget' => '',
'before_title' => '<h3>',
'after_title' => '</h3>',
));
register_sidebar(array(
'name' => 'Top Right',
'before_widget' => '',
'after_widget' => '',
'before_title' => '<h3>',
'after_title' => '</h3>',
));
register_sidebar(array(
'name' => 'Bottom Left',
'before_widget' => '',
'after_widget' => '',
'before_title' => '<h3>',
'after_title' => '</h3>',
));
register_sidebar(array(
'name' => 'Bottom Right',
'before_widget' => '',
'after_widget' => '',
'before_title' => '<h3>',
'after_title' => '</h3>',
)); }

function widget_striped_search() { ?>
<h3>Search</h3>
<form method="get" id="searchform" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<div id="Search"><input type="text" value="<?php echo esc_html($s, 1); ?>" name="s" id="s" /></div>
</form>
<?php }

function widget_striped_links() { ?>
<h3>Blogroll</h3>
<ul>
<?php get_bookmarks(-1, '<li>', '</li>', '', TRUE, '', FALSE); ?>
</ul>
<?php }

function widget_striped_pages() { ?>
<h3><?php _e('Pages');?></h3>
<ul>
<?php wp_list_pages('sort_column=menu_order&depth=1&title_li='); ?>
</ul>
<?php }

if ( function_exists('wp_register_sidebar_widget') ) {
wp_register_sidebar_widget('striped_search_1', __('Search'), 'widget_striped_search');
wp_register_sidebar_widget('striped_links_1', __('Links'), 'widget_striped_links');
wp_register_sidebar_widget('striped_pages_1', __('Pages'), 'widget_striped_pages'); }

function striped_add_admin() {

	if ( isset($_GET['page']) && $_GET['page'] == basename(__FILE__) ) {
	
	    // save settings
		if ( isset($_REQUEST['action']) && 'save' == $_REQUEST['action'] ) {

			update_option( 'striped_backgroundimage', $_REQUEST[ 's_backgroundimage' ] );
			update_option( 'striped_headerimage', $_REQUEST[ 's_headerimage' ] );

			update_option( 'striped_backgroundcolor', $_REQUEST[ 's_backgroundcolor' ] );
			update_option( 'striped_maincolor', $_REQUEST[ 's_maincolor' ] );
			update_option( 'striped_maincolortwo', $_REQUEST[ 's_maincolortwo' ] );
			update_option( 'striped_lightborder', $_REQUEST[ 's_lightborder' ] );
			update_option( 'striped_darkborder', $_REQUEST[ 's_darkborder' ] );
			update_option( 'striped_commentoddcolor', $_REQUEST[ 's_commentoddcolor' ] );
			update_option( 'striped_commentblockquotecolor', $_REQUEST[ 's_commentblockquotecolor' ] );

			update_option( 'striped_headerfooterfontcolor', $_REQUEST[ 's_headerfooterfontcolor' ] );
			update_option( 'striped_headerfontcolorhover', $_REQUEST[ 's_headerfontcolorhover' ] );
			update_option( 'striped_currentpagefontcolor', $_REQUEST[ 's_currentpagefontcolor' ] );
			update_option( 'striped_mainfontcolor', $_REQUEST[ 's_mainfontcolor' ] );
			update_option( 'striped_datefontcolor', $_REQUEST[ 's_datefontcolor' ] );
			update_option( 'striped_smalldatefontcolor', $_REQUEST[ 's_smalldatefontcolor' ] );
			update_option( 'striped_commentfontcolor', $_REQUEST[ 's_commentfontcolor' ] );
			update_option( 'striped_commentlinkcolor', $_REQUEST[ 's_commentlinkcolor' ] );
			
			update_option( 'striped_font', $_REQUEST[ 's_font' ] );
			update_option( 'striped_headerheight', $_REQUEST[ 's_headerheight' ] );
			update_option( 'striped_sitewidth', $_REQUEST[ 's_sitewidth' ] );
			update_option( 'striped_type', $_REQUEST[ 's_type' ] );

			

			if( isset( $_REQUEST[ 's_backgroundimage' ] ) ) { update_option( 'striped_backgroundimage', $_REQUEST[ 's_backgroundimage' ]  ); } else { delete_option( 'striped_backgroundimage' ); }
			if( isset( $_REQUEST[ 's_headerimage' ] ) ) { update_option( 'striped_headerimage', $_REQUEST[ 's_headerimage' ]  ); } else { delete_option( 'striped_headerimage' ); }

			if( isset( $_REQUEST[ 's_backgroundcolor' ] ) ) { update_option( 'striped_backgroundcolor', $_REQUEST[ 's_backgroundcolor' ]  ); } else { delete_option( 'striped_backgroundcolor' ); }
			if( isset( $_REQUEST[ 's_maincolor' ] ) ) { update_option( 'striped_maincolor', $_REQUEST[ 's_maincolor' ]  ); } else { delete_option( 'striped_maincolor' ); }
			if( isset( $_REQUEST[ 's_maincolortwo' ] ) ) { update_option( 'striped_maincolortwo', $_REQUEST[ 's_maincolortwo' ]  ); } else { delete_option( 'striped_maincolortwo' ); }
			if( isset( $_REQUEST[ 's_lightborder' ] ) ) { update_option( 'striped_lightborder', $_REQUEST[ 's_lightborder' ]  ); } else { delete_option( 'striped_lightborder' ); }
			if( isset( $_REQUEST[ 's_darkborder' ] ) ) { update_option( 'striped_darkborder', $_REQUEST[ 's_darkborder' ]  ); } else { delete_option( 'striped_darkborder' ); }
			if( isset( $_REQUEST[ 's_commentoddcolor' ] ) ) { update_option( 'striped_commentoddcolor', $_REQUEST[ 's_commentoddcolor' ]  ); } else { delete_option( 'striped_commentoddcolor' ); }
			if( isset( $_REQUEST[ 's_commentblockquotecolor' ] ) ) { update_option( 'striped_commentblockquotecolor', $_REQUEST[ 's_commentblockquotecolor' ]  ); } else { delete_option( 'striped_commentblockquotecolor' ); }


			if( isset( $_REQUEST[ 's_headerfooterfontcolor' ] ) ) { update_option( 'striped_headerfooterfontcolor', $_REQUEST[ 's_headerfooterfontcolor' ]  ); } else { delete_option( 'striped_headerfooterfontcolor' ); }
			if( isset( $_REQUEST[ 's_headerfontcolorhover' ] ) ) { update_option( 'striped_headerfontcolorhover', $_REQUEST[ 's_headerfontcolorhover' ]  ); } else { delete_option( 'striped_headerfontcolorhover' ); }
			if( isset( $_REQUEST[ 's_currentpagefontcolor' ] ) ) { update_option( 'striped_currentpagefontcolor', $_REQUEST[ 's_currentpagefontcolor' ]  ); } else { delete_option( 'striped_currentpagefontcolor' ); }
			if( isset( $_REQUEST[ 's_mainfontcolor' ] ) ) { update_option( 'striped_mainfontcolor', $_REQUEST[ 's_mainfontcolor' ]  ); } else { delete_option( 'striped_mainfontcolor' ); }
			if( isset( $_REQUEST[ 's_datefontcolor' ] ) ) { update_option( 'striped_datefontcolor', $_REQUEST[ 's_datefontcolor' ]  ); } else { delete_option( 'striped_datefontcolor' ); }
			if( isset( $_REQUEST[ 's_smalldatefontcolor' ] ) ) { update_option( 'striped_smalldatefontcolor', $_REQUEST[ 's_smalldatefontcolor' ]  ); } else { delete_option( 'striped_smalldatefontcolor' ); }
			if( isset( $_REQUEST[ 's_commentfontcolor' ] ) ) { update_option( 'striped_commentfontcolor', $_REQUEST[ 's_commentfontcolor' ]  ); } else { delete_option( 'striped_commentfontcolor' ); }
			if( isset( $_REQUEST[ 's_commentlinkcolor' ] ) ) { update_option( 'striped_commentlinkcolor', $_REQUEST[ 's_commentlinkcolor' ]  ); } else { delete_option( 'striped_commentlinkcolor' ); }

			if( isset( $_REQUEST[ 's_font' ] ) ) { update_option( 'striped_font', $_REQUEST[ 's_font' ]  ); } else { delete_option( 'striped_font' ); }
			if( isset( $_REQUEST[ 's_headerheight' ] ) ) { update_option( 'striped_headerheight', $_REQUEST[ 's_headerheight' ]  ); } else { delete_option( 'striped_headerheight' ); }
			if( isset( $_REQUEST[ 's_sitewidth' ] ) ) { update_option( 'striped_sitewidth', $_REQUEST[ 's_sitewidth' ]  ); } else { delete_option( 'striped_sitewidth' ); }
			if( isset( $_REQUEST[ 's_type' ] ) ) { update_option( 'striped_type', $_REQUEST[ 's_type' ]  ); } else { delete_option( 'striped_type' ); }
			

			// goto theme edit page
			header("Location: themes.php?page=functions.php&saved=true");
			die;

  		// reset settings
		} else if( isset($_REQUEST['action']) && 'reset' == $_REQUEST['action'] ) {

			delete_option( 'striped_backgroundimage' );
			delete_option( 'striped_headerimage' );

			delete_option( 'striped_backgroundcolor' );
			delete_option( 'striped_maincolor' );
			delete_option( 'striped_maincolortwo' );
			delete_option( 'striped_lightborder' );
			delete_option( 'striped_darkborder' );
			delete_option( 'striped_commentoddcolor' );
			delete_option( 'striped_commentblockquotecolor' );

			delete_option( 'striped_headerfooterfontcolor' );
			delete_option( 'striped_headerfontcolorhover' );
			delete_option( 'striped_currentpagefontcolor' );
			delete_option( 'striped_mainfontcolor' );
			delete_option( 'striped_datefontcolor' );
			delete_option( 'striped_smalldatefontcolor' );
			delete_option( 'striped_commentfontcolor' );
			delete_option( 'striped_commentlinkcolor' );

			delete_option( 'striped_font' );
			delete_option( 'striped_headerheight' );
			delete_option( 'striped_sitewidth' );
			delete_option( 'striped_type' );

			// goto theme edit page
			header("Location: themes.php?page=functions.php&reset=true");
			die;

		}
	}

    add_theme_page("StripedPlus Options", "Theme Options", 'edit_theme_options', basename(__FILE__), 'striped_admin');

}

function striped_admin() {

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
<h2>StripedPlus</h2>

<form method="post">

<fieldset class="options">
<legend>StripedPlus Settings</legend>

<p>This theme is made by <a href="http://theundersigned.net">the undersigned</a>, please contact me or write in <a href="http://webdesignbook.net/forum/viewforum.php?id=18">my forum</a>, if you find any bugs .</p>

<table width="100%" cellspacing="2" cellpadding="5" class="editform" >


<tr><th><br /><h3>Images</h3></th><td>&nbsp;</td></tr>

<tr valign="top"> 
<th scope="row">Background image:</th> 
<td>http://<input name="s_backgroundimage" type="text" value="<?php echo get_option( 'striped_backgroundimage' ); ?>" /> (URL)</td> 
</tr>

<tr valign="top"> 
<th scope="row">Header image:</th> 
<td>http://<input name="s_headerimage" type="text" value="<?php echo get_option( 'striped_headerimage' ); ?>" /> (URL)</td> 
</tr>


<tr><th><br /><h3>Site colors</h3></th><td>&nbsp;</td></tr>

<tr valign="top"> 
<th scope="row">Background color:</th> 
<td>
<div id="backgroundcolorpick" class="stripedpickcolor"><a href="javascript:;" onmousedown="pickcolor( '#backgroundcolorpick', 'backgroundColor', false, 's_backgroundcolor', this)">&nbsp;</a></div>
#<input name="s_backgroundcolor" maxlenght="6" id="s_backgroundcolor" type="text" value="<?php if ( get_option( 'striped_backgroundcolor' ) != "") { echo get_option( 'striped_backgroundcolor' ); } else { echo "FFF"; } ?>" onkeyup="changecss('#backgroundcolorpick', 'backgroundColor', this.value, 'hex', false, '');" />
</td> 
</tr>

<tr valign="top"> 
<th scope="row">Main color:</th>
<td>
<div id="maincolorpick" class="stripedpickcolor"><a href="javascript:;" onmousedown="pickcolor( '#maincolorpick', 'backgroundColor', false, 's_maincolor', this)">&nbsp;</a></div>
#<input name="s_maincolor" maxlenght="6" id="s_maincolor" type="text" value="<?php if ( get_option( 'striped_maincolor' ) != "") { echo get_option( 'striped_maincolor' ); } else { echo "AA0000"; } ?>" onkeyup="changecss('#maincolorpick', 'backgroundColor', this.value, 'hex', false, '');" />
</td>
</tr>

<tr valign="top"> 
<th scope="row">Main color 2:</th> 
<td>
<div id="maincolortwopick" class="stripedpickcolor"><a href="javascript:;" onmousedown="pickcolor( '#maincolortwopick', 'backgroundColor', false, 's_maincolortwo', this)">&nbsp;</a></div>
#<input name="s_maincolortwo" maxlenght="6" id="s_maincolortwo" type="text" value="<?php if ( get_option( 'striped_maincolortwo' ) != "") { echo get_option( 'striped_maincolortwo' ); } else { echo "444444"; } ?>" onkeyup="changecss('#maincolortwopick', 'backgroundColor', this.value, 'hex', false, '');" />
</td>
</tr>

<tr valign="top"> 
<th scope="row">Light border:</th> 
<td>
<div id="lightborderpick" class="stripedpickcolor"><a href="javascript:;" onmousedown="pickcolor( '#lightborderpick', 'backgroundColor', false, 's_lightborder', this)">&nbsp;</a></div>
#<input name="s_lightborder" maxlenght="6" id="s_lightborder" type="text" value="<?php if ( get_option( 'striped_lightborder' ) != "") { echo get_option( 'striped_lightborder' ); } else { echo "CCCCCC"; } ?>" onkeyup="changecss('#lightborderpick', 'backgroundColor', this.value, 'hex', false, '');" />
</td> 
</tr>

<tr valign="top"> 
<th scope="row">Dark border:</th>
<td>
<div id="darkborderpick" class="stripedpickcolor"><a href="javascript:;" onmousedown="pickcolor( '#darkborderpick', 'backgroundColor', false, 's_darkborder', this)">&nbsp;</a></div>
#<input name="s_darkborder" maxlenght="6" id="s_darkborder" type="text" value="<?php if ( get_option( 'striped_darkborder' ) != "") { echo get_option( 'striped_darkborder' ); } else { echo "666666"; } ?>" onkeyup="changecss('#darkborderpick', 'backgroundColor', this.value, 'hex', false, '');" />
</td> 
</tr>

<tr valign="top"> 
<th scope="row">Odd comments:</th> 
<td>
<div id="commentoddcolorpick" class="stripedpickcolor"><a href="javascript:;" onmousedown="pickcolor( '#commentoddcolorpick', 'backgroundColor', false, 's_commentoddcolor', this)">&nbsp;</a></div>
#<input name="s_commentoddcolor" maxlenght="6" id="s_commentoddcolor" type="text" value="<?php if ( get_option( 'striped_commentoddcolor' ) != "") { echo get_option( 'striped_commentoddcolor' ); } else { echo "EEEEEE"; } ?>" onkeyup="changecss('#commentoddcolorpick', 'backgroundColor', this.value, 'hex', false, '');" />
</td> 
</tr>

<tr valign="top"> 
<th scope="row">Comment blockquotes:</th>
<td>
<div id="commentblockquotecolorpick" class="stripedpickcolor"><a href="javascript:;" onmousedown="pickcolor( '#commentblockquotecolorpick', 'backgroundColor', false, 's_commentblockquotecolor', this, 0, 0)">&nbsp;</a></div>
#<input name="s_commentblockquotecolor" maxlenght="6" id="s_commentblockquotecolor" type="text" value="<?php if ( get_option( 'striped_commentblockquotecolor' ) != "") { echo get_option( 'striped_commentblockquotecolor' ); } else { echo "DDDDDD"; } ?>" onkeyup="changecss('#commentblockquotecolorpick', 'backgroundColor', this.value, 'hex', false, '');" />
</td> 
</tr>


<tr><th><br /><h3>Font colors</h3></th><td>&nbsp;</td></tr>

<tr valign="top"> 
<th scope="row">Header and footer font color:</th>
<td>
<div id="headerfooterfontcolorpick" class="stripedpickcolor"><a href="javascript:;" onmousedown="pickcolor( '#headerfooterfontcolorpick', 'backgroundColor', false, 's_headerfooterfontcolor', this, 0, 0)">&nbsp;</a></div>
#<input name="s_headerfooterfontcolor" maxlenght="6" id="s_headerfooterfontcolor" type="text" value="<?php if ( get_option( 'striped_headerfooterfontcolor' ) != "") { echo get_option( 'striped_headerfooterfontcolor' ); } else { echo "FFFFFF"; } ?>" onkeyup="changecss('#headerfooterfontcolorpick', 'backgroundColor', this.value, 'hex', false, '');" />
</td> 
</tr>

<tr valign="top"> 
<th scope="row">Header hover color:</th>
<td>
<div id="headerfontcolorhoverpick" class="stripedpickcolor"><a href="javascript:;" onmousedown="pickcolor( '#headerfontcolorhoverpick', 'backgroundColor', false, 's_headerfontcolorhover', this, 0, 0)">&nbsp;</a></div>
#<input name="s_headerfontcolorhover" maxlenght="6" id="s_headerfontcolorhover" type="text" value="<?php if ( get_option( 'striped_headerfontcolorhover' ) != "") { echo get_option( 'striped_headerfontcolorhover' ); } else { echo "EEEEEE"; } ?>" onkeyup="changecss('#headerfontcolorhoverpick', 'backgroundColor', this.value, 'hex', false, '');" />
</td> 
</tr>

<tr valign="top"> 
<th scope="row">Current page font color:</th>
<td>
<div id="currentpagefontcolorpick" class="stripedpickcolor"><a href="javascript:;" onmousedown="pickcolor( '#currentpagefontcolorpick', 'backgroundColor', false, 's_currentpagefontcolor', this, 0, 0)">&nbsp;</a></div>
#<input name="s_currentpagefontcolor" maxlenght="6" id="s_currentpagefontcolor" type="text" value="<?php if ( get_option( 'striped_currentpagefontcolor' ) != "") { echo get_option( 'striped_currentpagefontcolor' ); } else { echo "AAAAAA"; } ?>" onkeyup="changecss('#currentpagefontcolorpick', 'backgroundColor', this.value, 'hex', false, '');" />
</td> 
</tr>

<tr valign="top"> 
<th scope="row">Main fontcolor:</th>
<td>
<div id="mainfontcolorpick" class="stripedpickcolor"><a href="javascript:;" onmousedown="pickcolor( '#mainfontcolorpick', 'backgroundColor', false, 's_mainfontcolor', this, 0, 0)">&nbsp;</a></div>
#<input name="s_mainfontcolor" maxlenght="6" id="s_mainfontcolor" type="text" value="<?php if ( get_option( 'striped_mainfontcolor' ) != "") { echo get_option( 'striped_mainfontcolor' ); } else { echo "000000"; } ?>" onkeyup="changecss('#mainfontcolorpick', 'backgroundColor', this.value, 'hex', false, '');" />
</td> 
</tr>

<tr valign="top"> 
<th scope="row">Date font color:</th> 
<td>
<div id="datefontcolorpick" class="stripedpickcolor"><a href="javascript:;" onmousedown="pickcolor( '#datefontcolorpick', 'backgroundColor', false, 's_datefontcolor', this, 0, 0)">&nbsp;</a></div>
#<input name="s_datefontcolor" maxlenght="6" id="s_datefontcolor" type="text" value="<?php if ( get_option( 'striped_datefontcolor' ) != "") { echo get_option( 'striped_datefontcolor' ); } else { echo "666666"; } ?>" onkeyup="changecss('#datefontcolorpick', 'backgroundColor', this.value, 'hex', false, '');" />
</td> 
</tr>

<tr valign="top"> 
<th scope="row">Post information font color:</th> 
<td>
<div id="smalldatefontcolorpick" class="stripedpickcolor"><a href="javascript:;" onmousedown="pickcolor( '#smalldatefontcolorpick', 'backgroundColor', false, 's_smalldatefontcolor', this, 0, 0)">&nbsp;</a></div>
#<input name="s_smalldatefontcolor" maxlenght="6" id="s_smalldatefontcolor" type="text" value="<?php if ( get_option( 'striped_smalldatefontcolor' ) != "") { echo get_option( 'striped_smalldatefontcolor' ); } else { echo "999999"; } ?>" onkeyup="changecss('#smalldatefontcolorpick', 'backgroundColor', this.value, 'hex', false, '');" />
</td> 
</tr>

<tr valign="top"> 
<th scope="row">Comment font color:</th>
<td>
<div id="commentfontcolorpick" class="stripedpickcolor"><a href="javascript:;" onmousedown="pickcolor( '#commentfontcolorpick', 'backgroundColor', false, 's_commentfontcolor', this, 0, 0)">&nbsp;</a></div>
#<input name="s_commentfontcolor" maxlenght="6" id="s_commentfontcolor" type="text" value="<?php if ( get_option( 'striped_commentfontcolor' ) != "") { echo get_option( 'striped_commentfontcolor' ); } else { echo "333333"; } ?>" onkeyup="changecss('#commentfontcolorpick', 'backgroundColor', this.value, 'hex', false, '');" />
</td> 
</tr>

<tr valign="top"> 
<th scope="row">Comment link color:</th>
<td>
<div id="commentlinkcolorpick" class="stripedpickcolor"><a href="javascript:;" onmousedown="pickcolor( '#commentlinkcolorpick', 'backgroundColor', false, 's_commentlinkcolor', this, 0, 0)">&nbsp;</a></div>
#<input name="s_commentlinkcolor" maxlenght="6" id="s_commentlinkcolor" type="text" value="<?php if ( get_option( 'striped_commentlinkcolor' ) != "") { echo get_option( 'striped_commentlinkcolor' ); } else { echo "666666"; } ?>" onkeyup="changecss('#commentlinkcolorpick', 'backgroundColor', this.value, 'hex', false, '');" />
</td> 
</tr>


<tr><th><br /><h3>Site settings</h3></th><td>&nbsp;</td></tr>

<tr valign="top"> 
<th scope="row">Site font:</th> 
<td>
<select name="s_font">	
<option value="Georgia, 'Times New Roman', Times, serif"  <?php if (get_option( 'striped_font' ) == "Georgia, \'Times New Roman\', Times, serif") { echo "selected='selected'"; } ?>>Georgia, 'Times New Roman', Times, serif</option>
<option value="Arial, Helvetica, 'sans-serif'"  <?php if (get_option( 'striped_font' ) == "Arial, Helvetica, \'sans-serif\'") { echo "selected='selected'"; } ?>>Arial, Helvetica, 'sans-serif'</option>
<option value="'Courier New', Courier, Monaco, monospace"  <?php if (get_option( 'striped_font' ) == "\'Courier New\', Courier, Monaco, monospace") { echo "selected='selected'"; } ?>>'Courier New', Courier, Monaco, monospace</option>
<option value="Helvetica, Geneva, Arial, SunSans-Regular, sans-serif"  <?php if (get_option( 'striped_font' ) == "Helvetica, Geneva, Arial, SunSans-Regular, sans-serif") { echo "selected='selected'"; } ?>>Helvetica, Geneva, Arial, SunSans-Regular, sans-serif</option>
<option value="'Trebuchet MS', Geneva, Arial, Helvetica, SunSans-Regular, sans-serif"  <?php if (get_option( 'striped_font' ) == "\'Trebuchet MS\', Geneva, Arial, Helvetica, SunSans-Regular, sans-serif") { echo "selected='selected'"; } ?>>'Trebuchet MS', Geneva, Arial, Helvetica, SunSans-Regular, sans-serif</option>
<option value="Verdana, Arial, Helvetica, sans-serif"  <?php if (get_option( 'striped_font' ) == "Verdana, Arial, Helvetica, sans-serif") { echo "selected='selected'"; } ?>>Verdana, Arial, Helvetica, sans-serif</option>
</select>
</td> 
</tr>

<tr valign="top"> 
<th scope="row">Header height:</th> 
<td><input name="s_headerheight" type="text" value="<?php if ( get_option( 'striped_headerheight' ) != "") { echo get_option( 'striped_headerheight' ); } else { echo "120"; } ?>" /> px</td> 
</tr>

<tr valign="top"> 
<th scope="row">Site width:</th> 
<td><input name="s_sitewidth" type="text" value="<?php if ( get_option( 'striped_sitewidth' ) != "") { echo get_option( 'striped_sitewidth' ); } else { echo "600"; } ?>" />
<select name="s_type" width="40px">	
<option value='px'  <?php if (get_option( 'striped_type' ) == "px") { echo "selected='selected'"; } ?>>px</option>
<option value='%'  <?php if (get_option( 'striped_type' ) == "%") { echo "selected='selected'"; } ?>>%</option>
</select>
</td> 
</tr>

<tr valign="top"> 
<th scope="row">Save changes:</th> 
<td><input name="save" type="submit" value="Save" /></td> 
</tr>

</fieldset>
<input type="hidden" name="action" value="save" />
</form>



<form method="post">

<fieldset class="options">

<tr><th>&nbsp;</th><td>&nbsp;</td></tr>
<tr>
<th>Reset to default: </th>
<td><input name="reset" type="submit" value="<?php _e('Reset')?>" /></td>
</tr>
</table>
</div>

<input type="hidden" name="action" value="reset" />

</form>

<?php
}

function striped_admin_header() { ?>
<link href="<?php bloginfo('template_directory'); ?>/colourmod/ColourModStyle.php" rel="stylesheet" type="text/css" />
<script src="<?php bloginfo('template_directory'); ?>/colourmod/StyleModScript.js" type="text/JavaScript"></script>
<script src="<?php bloginfo('template_directory'); ?>/colourmod/ColourModScript.js" type="text/JavaScript"></script>
<?php }

add_action('admin_head', 'striped_admin_header');
add_action('admin_menu', 'striped_add_admin'); ?>
