<?php
if (!defined('SHOW_AUTHORS')) define('SHOW_AUTHORS', 'true');
if (!defined('TEMPLATE_DOMAIN')) define('TEMPLATE_DOMAIN', 'andreas');
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

} //end check





////////////////////////////////////////////////////////////////////////////////
// wp 2.7 wp_list_comment
////////////////////////////////////////////////////////////////////////////////
function list_comments($comment, $args, $depth) {
$GLOBALS['comment'] = $comment; ?>


<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
<cite><?php if (function_exists('avatar_display_comments')) { ?>
<?php avatar_display_comments(get_comment_author_email(),'48',''); ?>
<?php } else { ?>
<?php if (function_exists('get_avatar')) { echo get_avatar( get_comment_author_email() , 48 ); } ?>
<?php } ?>&nbsp;&nbsp;<?php comment_author_link() ?></cite> <?php _e('Says','andreas09'); ?>:
<?php if ($comment->comment_approved == '0') : ?>
<em><?php _e('Your comment is awaiting moderation.','andreas09'); ?></em>
<?php endif; ?>
<br />

<small class="commentmetadata"><a href="#comment-<?php comment_ID() ?>" title=""><?php comment_date(__('F jS, Y','andreas09')) ?> <?php _e('at','andreas09'); ?> <?php comment_time() ?></a> <?php edit_comment_link('e','',''); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class="reply"><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></div></small>

<?php comment_text() ?>


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











if ( function_exists('register_sidebar') )  {
register_sidebar(array('name' => 'Main Sidebar'));
register_sidebar(array('name' => 'Right Sidebar'));
}


// WP-Andreas09 Search Box
	function widget_andreas09_search() {
?>
   <li><?php include (TEMPLATEPATH . '/searchform.php'); ?></li>
<?php
}
if ( function_exists('wp_register_sidebar_widget') )
    wp_register_sidebar_widget('andreas_search_1', __('Search'), 'wp_register_sidebar_widget');

// WP-Andreas09 Subscribe 	
	function widget_andreas09_subscribe() {
?>
<li><h2><?php _e('Subscribe','andreas09'); ?></h2>
<ul>
<li class="feed"><a href="<?php bloginfo('rss2_url'); ?>"><?php _e('Entries (RSS)','andreas09'); ?></a></li>
<li class="feed"><a href="<?php bloginfo('comments_rss2_url'); ?>"><?php _e('Comments (RSS)','andreas09'); ?></a></li>
</ul>
</li>
<?php
}
if ( function_exists('wp_register_sidebar_widget') )
    wp_register_sidebar_widget('andreas09_subscribe_1', __('RSS Subscribe'), 'widget_andreas09_subscribe');	 

// WP-Andreas09 Meta 	
	function widget_andreas09_meta() {
?>
<li><h2><?php _e('Meta','andreas09'); ?></h2>
<ul>
<?php wp_register(); ?>
<li><?php wp_loginout(); ?></li>
<?php wp_meta(); ?>
</ul>
</li>
<?php
}
if ( function_exists('wp_register_sidebar_widget') )
    wp_register_sidebar_widget('andreas09_meta', __('Meta'), 'widget_andreas09_meta');
 
// WP-Andreas09 Recent Posts 	
	function widget_andreas09_recent_entries() {
?>
<li id="recent-posts"><h2><?php _e('Recent Posts','andreas09'); ?></h2>
<ul>
<?php wp_get_archives('type=postbypost&limit=10'); ?>
</ul>
</li>
<?php
}
if ( function_exists('wp_register_sidebar_widget') )
    wp_register_sidebar_widget('andreas09_recent_entries_1', __('Recent Posts'), 'widget_andreas09_recent_entries');
 
 

////////////////////////////////////////////////////////////////////////////////
// load text domain
////////////////////////////////////////////////////////////////////////////////

// Uncomment this to test your localization, make sure to enter the right language code.

//function test_localization( $locale ) {
//return "fr_FR";
//}
//add_filter('locale','test_localization');


load_theme_textdomain('andreas09', TEMPLATEPATH . '/languages/');


function wp_andreas09_add_theme_page() {

	if ( isset($_GET['page']) && $_GET['page'] == basename(__FILE__) ) {
		if ( isset($_REQUEST['action']) && 'save' == $_REQUEST['action'] ) {
			update_option( 'wp_andreas09_ImageColour', $_REQUEST[ 'set_ImageColour' ] );
			header("Location: themes.php?page=functions.php&saved=true");
			die;
		} else if( isset($_REQUEST['action']) && 'reset' == $_REQUEST['action'] ) {
			delete_option( 'wp_andreas09_ImageColour' );
			header("Location: themes.php?page=functions.php&reset=true");
			die;
		}
	}

    add_theme_page("WP-Andreas09 Theme Options", __('Colour Options','andreas09'), 'edit_theme_options', basename(__FILE__), 'wp_andreas09_theme_page');
}

function wp_andreas09_theme_page() {
	if ( isset($_REQUEST['saved']) && $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.__('Settings saved.','andreas09').'</strong></p></div>';
	if ( isset($_REQUEST['reset']) && $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.__('Settings reset.','andreas09').'</strong></p></div>';

?>

<div class="wrap">
<h1>WP-Andreas09</h1>
<p>WP-Andreas09 <?php _e('was designed by','andreas09'); ?> <a href="http://andreasviklund.com">Andreas Viklund</a> <?php _e('and Ported to WordPress by','andreas09'); ?> <a href="http://webgazette.co.uk">Ainslie Johnson</a>.</p>

<h3><?php _e('Available Image Colours:','andreas09'); ?></h3>
<style>
ul.horizontal {padding-top: 5px; padding-bottom: 5px; width: 90%;}
.horizontal li {list-style: none; padding: 5px 0 5px 10px; margin: 10px; border: 1px solid #000000; font-weight: bold;}
li.blue { background: url(<?php bloginfo('template_url'); ?>/images/bodybg-blue.jpg);}
li.green { background: url(<?php bloginfo('template_url'); ?>/images/bodybg-green.jpg);}
li.red { background: url(<?php bloginfo('template_url'); ?>/images/bodybg-red.jpg);}
li.orange { background: url(<?php bloginfo('template_url'); ?>/images/bodybg-orange.jpg);}
li.purple { background: url(<?php bloginfo('template_url'); ?>/images/bodybg-purple.jpg);}
li.black { background: url(<?php bloginfo('template_url'); ?>/images/bodybg-black.jpg);}
li.isecore { background: url(<?php bloginfo('template_url'); ?>/images/bodybg-isecore.jpg);}
li.pink { background: url(<?php bloginfo('template_url'); ?>/images/bodybg-pink.jpg);}
li.blue2 { background: url(<?php bloginfo('template_url'); ?>/images/bodybg-blue2.jpg);}
li.green2 { background: url(<?php bloginfo('template_url'); ?>/images/bodybg-green2.jpg);}
li.red2 { background: url(<?php bloginfo('template_url'); ?>/images/bodybg-red2.jpg);}
li.orange2 { background: url(<?php bloginfo('template_url'); ?>/images/bodybg-orange2.jpg);}
li.purple2 { background: url(<?php bloginfo('template_url'); ?>/images/bodybg-purple2.jpg);}
li.black2 { background: url(<?php bloginfo('template_url'); ?>/images/bodybg-black2.jpg);}
.center {text-align: center;}
</style>

<ul class="horizontal">
<li class="blue"><?php _e('Original Blue','andreas09') ?></li>
<li class="green"><?php _e('Original Green','andreas09') ?></li>
<li class="red"><?php _e('Original  Red','andreas09') ?></li>
<li class="orange"><?php _e('Original Orange','andreas09') ?></li>
<li class="purple"><?php _e('Original Purple','andreas09') ?></li>
<li class="black"><?php _e('Original Black','andreas09') ?></li>
<li class="isecore">Isecore <?php _e('Blue - Curtesy of','andreas09') ?> <a href="http://blog.isecore.net/">Isecore</a></li>
<li class="pink"><?php _e('Pretty Pink','andreas09') ?></li>
<li class="blue2"><?php _e('Striped Blue','andreas09') ?></li>
<li class="green2"><?php _e('Striped Green','andreas09') ?></li>
<li class="red2"><?php _e('Striped Red','andreas09') ?></li>
<li class="orange2"><?php _e('Striped Orange','andreas09') ?></li>
<li class="purple2"><?php _e('Striped Purple','andreas09') ?></li>
<li class="black2"><?php _e('Striped Black','andreas09') ?></li>
</ul>
<h3><?php _e('Image Colour Settings','andreas09') ?></h3>
<form method="post">
<p><?php _e('Select colour from list:','andreas09') ?> 
<?php
	$value = get_option( 'wp_andreas09_ImageColour' );
	    echo "<select name=\"set_ImageColour\" style=\"width:200px;\" onchange=\"updateColour( this )\">";
		wp_andreas09_input( "set_ImageColour", "option", __('Original Blue','andreas09'), "blue", $value );
		wp_andreas09_input( "set_ImageColour", "option", __('Original Green','andreas09'), "green", $value );
		wp_andreas09_input( "set_ImageColour", "option", __('Original Red','andreas09'), "red", $value );
		wp_andreas09_input( "set_ImageColour", "option", __('Original Orange','andreas09'), "orange", $value );
		wp_andreas09_input( "set_ImageColour", "option", __('Original Purple','andreas09'), "purple", $value );
		wp_andreas09_input( "set_ImageColour", "option", __('Original Black','andreas09'), "black", $value );
		wp_andreas09_input( "set_ImageColour", "option", __('Isecore Blue','andreas09'), "isecore", $value );
		wp_andreas09_input( "set_ImageColour", "option", __('Pretty Pink','andreas09'), "pink", $value );
		wp_andreas09_input( "set_ImageColour", "option", __('Striped Blue','andreas09'), "blue2", $value );
		wp_andreas09_input( "set_ImageColour", "option", __('Striped Green','andreas09'), "green2", $value );
		wp_andreas09_input( "set_ImageColour", "option", __('Striped Red','andreas09'), "red2", $value );
		wp_andreas09_input( "set_ImageColour", "option", __('Striped Orange','andreas09'), "orange2", $value );
		wp_andreas09_input( "set_ImageColour", "option", __('Striped Purple','andreas09'), "purple2", $value );
		wp_andreas09_input( "set_ImageColour", "option", __('Striped Black','andreas09'), "black2", $value );
		echo "</select>";
?>
</p>

<!-- Save Settings Button -->
<?php wp_andreas09_input( "save", "submit", "", __('Save Settings','andreas09') ); ?>
<input type="hidden" name="action" value="save" />
</form>
<p class="center"><?php _e('With credit to','andreas09'); ?> <a href="http://www.binarymoon.co.uk/" title="Binary Moon - games, web design, and other random nonsense">Ben Gillbanks</a>. <?php _e('I could not have implemented the <strong>Current Theme Options</strong> without his excellent example in the','andreas09'); ?> <a href="http://www.binarymoon.co.uk/regulus/" title="Regulus theme for WordPress">Regulus</a></p>

</div>

<?php
}

add_action('admin_menu', 'wp_andreas09_add_theme_page');

function wp_andreas09_input( $var, $type, $description = "", $value = "", $selected="" ) {
 	echo "\n";
	switch( $type ){
		case "submit":
	 		echo "<p class=\"submit\"><input name=\"$var\" type=\"$type\" value=\"$value\" /></p>";
			break;

		case "option":
			if( $selected == $value ) { $extra = "selected=\"true\""; }
			echo "<option value=\"$value\" $extra >$description</option>";
		    break;
 	}
}

/*
Plugin Name: PageNav
Plugin URI: http://www.adsworth.info/wp-pagesnav
Description: Header Navigation.
Author: Adi Sieker
Version: 0.0.1
Author URI: http://www.adsworth.info/
*/
/*  Copyright 2004  Adi J. Sieker  (email : adi@adsworth.info)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

function wp_andreas09_nav($args = '') {
    global $wp_query;
	parse_str($args, $r);
	if (!isset($r['current']))          $r['current'] = -1;
	if (!isset($r['show_all_parents'])) $r['show_all_parents'] = 0;
	if (!isset($r['show_root']))        $r['show_root'] = 0;
	if (!isset($r['list_tag']))        $r['show_root'] = 1;

    if($r['current'] == "")
        return;

    if($r['current'] == -1 && $wp_query->is_page == true) {
        $r['current'] = $wp_query->post->ID;
    }

    if($r['current'] == -1 && $r['show_root'] != 0) {
        $r['current'] = 0;
    }
    
	// Query pages.
	$pages = get_pages($args);
	if ( $pages ) {
    	// Now loop over all pages that were selected
    	$page_tree = Array();
    	$parent_page_id = null;
    	$parents= Array();
    	foreach($pages as $page) {
    		// set the title for the current page
    		$page_tree[$page->ID]['title'] = $page->post_title;
    		$page_tree[$page->ID]['parent'] = $page->post_parent;
    
    		// set the selected date for the current page
    		// depending on the query arguments this is either
    		// the createtion date or the modification date
    		// as a unix timestamp. It will also always be in the
    		// ts field.
    		if (! empty($r['show_date'])) {
    			if ('modified' == $r['show_date'])
    				$page_tree[$page->ID]['ts'] = $page->time_modified;
    			else
    				$page_tree[$page->ID]['ts'] = $page->time_created;
    		}
    
    		// The tricky bit!!
    		// Using the parent ID of the current page as the
    		// array index we set the curent page as a child of that page.
    		// We can now start looping over the $page_tree array
    		// with any ID which will output the page links from that ID downwards.
    		$page_tree[$page->post_parent]['children'][] = $page->ID; 	
            if( $r['current'] == $page->ID) {
                if($page->post_parent != 0 || $r['show_root'] == true)
                    $parents[] = $page->post_parent;
            }

    	}

    	$len = count($parents);
    	for($i = 0; $i < $len ; $i++) {
    	    $parent_page_id = $parents[$i];
    	    $parent_page = $page_tree[$parent_page_id];

    	    if(isset($parent_page['parent']) && !in_array($parent_page['parent'], $parents)) {
    	        if($parent_page['parent'] != 0 || $r['show_root'] == true) {
        	        $parents[] = $parent_page['parent'];
        	        $len += 1;
        	        if( $len >= 2 && $r['show_all_parents'] == 0) {
        	            break;
        	        }

        	    }
    	    }
        }

        $parents = array_reverse($parents);

        $level = 0;
        $parent_out == false;
        foreach( $parents as $parent_page_id ) {
            $level += 1;
      		$css_class = 'level' . $level;
      		if( $r['list_tag'] == true || $parent_out == true)
	        	echo "<ul class='". $css_class . "'>";
            foreach( $page_tree[$parent_page_id]['children'] as $page_id) {
        		$cur_page = $page_tree[$page_id];
        		$title = $cur_page['title'];

                $css_class = '';
        		if( $page_id == $r['current']) {
        			$css_class .= ' current';
  	      		}
				if( $page_id == $page_tree[$r['current']]['parent']){
					$css_class .= 'currentparent';
				}
                echo "<li class='" . $css_class . "' ><a href='" . get_page_link($page_id) . "' title='" . esc_html($title) . "'>" . $title . "</a></li>\n";
            }

	        	echo "</ul>";

	        $parent_out = true;

        }

    	if( is_array($page_tree[$r['current']]['children']) === true ) {
            $level += 1;
      		$css_class = 'level' . $level;
      		if( $r['list_tag'] == true || $parent_out == true)
		       	echo "<ul class='". $css_class . " children'>";
            foreach( $page_tree[$r['current']]['children'] as $page_id) {
        		$cur_page = $page_tree[$page_id];
        		$title = $cur_page['title'];
        
                echo "<li class='" . $css_class . "'><a href='" . get_page_link($page_id) . "' title='" . esc_html($title) . "'>" . $title . "</a></li>\n";
            }

	        	echo "</ul>";

        }
     }
}
?>
