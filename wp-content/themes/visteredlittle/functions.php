<?php
if (!defined('SHOW_AUTHORS')) define('SHOW_AUTHORS', 'true');
if (!defined('TEMPLATE_DOMAIN')) define('TEMPLATE_DOMAIN','visterdlittle');
////////////////////////////////////////////////////////////////////////////////
// wp 2.7 wp_list_comment
////////////////////////////////////////////////////////////////////////////////

function list_comments($comment, $args, $depth) {
$GLOBALS['comment'] = $comment; ?>

<div <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
<div class="blogbefore named">
    	<div class="left"></div>
    	<div class="right"></div>
    	<div class="middle"></div>
</div>
<div class="post">
<div class="comment-author named" id="comment-<?php comment_ID() ?>"><?php if (function_exists('avatar_display_comments')) { ?>
<?php avatar_display_comments(get_comment_author_email(),'48',''); ?>
<?php } else { ?>
<?php if (function_exists('get_avatar')) { echo get_avatar( get_comment_author_email() , 48 ); } ?>
<?php } ?>&nbsp;&nbsp;<?php comment_author_link(); ?></div>
<div class="headertext"><?php comment_type(); ?> <?php _e('on');?> <?php comment_time(__('F jS, Y')); ?>. <?php edit_comment_link('e', '', ''); ?></div>
<?php if ($comment->comment_approved == '0') : ?>
<p><em><?php _e('Your comment is awaiting moderation.', VL_DOMAIN ); ?></em></p>
<?php endif; ?>
<?php comment_text(); ?>
<p><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></p>
</div>
<div class="blogafter">
    	<div class="left"></div>
    	<div class="right"></div>
    	<div class="middle"></div>
</div>
</div>

<?php

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





define('VL_DOMAIN', 'vistered-little');

$_BENICE[]='vistered-little;6770968883708243;0065577911';


$visteredlittle_is_setup = FALSE;

function visteredlittle_setup()
{
	$locale = get_locale();
	if ( empty($locale) )
		$locale = 'en_US';	
    load_textdomain(VL_DOMAIN, dirname(__FILE__) . '/localization/' . $locale . '.mo');
    $visteredlittle_is_setup = 1;
}

add_action('init', 'visteredlittle_setup');


require_once( dirname(__FILE__).'/wallpaper_functions.php' );
if( !function_exists( 'get_skin' ) ) {
	include( dirname(__FILE__).'/skins/default/functions.php' );
}

if( function_exists( 'presentationtoolkit' ) ) {
	$vl_wallpaper_options = 'Wallpaper {radio|random|' . __('Random', VL_DOMAIN). ' (' . __('default', VL_DOMAIN) . ')';
	$count_wallpapers = 0;
	foreach( $vl_wallpapers as $format => $vl_sub_wallpapers )
	{
		foreach( $vl_sub_wallpapers as $vl_wallpaper )
		{
			$vl_wallpaper_options .= "|$count_wallpapers|" . basename($vl_wallpaper->wallpaper);
			++$count_wallpapers;
		}
	}
	$vl_wallpaper_options .= '} ## ';
	$vl_wallpaper_options .= __('Select a default wallpaper for your page.', VL_DOMAIN);

	$logo_width_help_string = __('Enter the width of the logo in pixels. The default is 500.', VL_DOMAIN);
	$logo_height_help_string = __('Enter the height of the logo in pixels. The default is 90.', VL_DOMAIN);
	if( function_exists( 'imagesx' ) )
	{
		$logo_width_help_string .= __('An attempt will be made to determine the logo width automatically.', VL_DOMAIN);
		$logo_height_help_string .= __('An attempt will be made to determine the logo height automatically.', VL_DOMAIN);
	}
	$options = array();

	$options['sidebarlocation'] = __('Sidebar Location', VL_DOMAIN )
		. ' {radio|right|' 
		. __('Right', VL_DOMAIN)
		. ' (' 
		. __('default', VL_DOMAIN) 
		. ')|left|'
		. __('Left', VL_DOMAIN)
		. '} ## '
		. __('Select which side of the page you want your sidebar to be on.', VL_DOMAIN);

	$options['quadpossidebar'] = __('Side Bar Type', VL_DOMAIN) 
		. ' {radio|mono|' 
		. __('Single Position', VL_DOMAIN) 
		. ' (' . __('default', VL_DOMAIN) . ')|quad|' 
		. __('Quad Position', VL_DOMAIN) 
		. '} ## ' 
		. __('A quad position sidebar allows you to configure widgets that are displayed in a wide section at the top of the side bar, on the left and right of the side bar and a wide sections at the bottom of the side bar.', VL_DOMAIN);

	$options['headerposition'] = __('Header Position', VL_DOMAIN ) 
		. ' {radio|normal|' 
		. __('Normal', VL_DOMAIN ) 
		. '|fixed|' 
		. __('Fixed', VL_DOMAIN) 
		. ' (' 
		. __('default', VL_DOMAIN) 
		. ')} ## ' 
		. __('Select whether the header should have normal or Fixed positioning.', VL_DOMAIN);

	$options['headersearch'] = __('Header Search Field', VL_DOMAIN ) 
		. ' {radio|show|' 
		. __('Show', VL_DOMAIN ) 
		. ' (' 
		. __('default', VL_DOMAIN) 
		. ')|hide|' 
		. __('Hide', VL_DOMAIN) 
		. '} ## ' 
		. __('Select whether to display a search box in the header.', VL_DOMAIN);

	$options['framedthumbs'] = __('Thumbnail Frames', VL_DOMAIN ) 
		. ' {radio|border|' 
		. __('Use CSS Border', VL_DOMAIN ) 
		. ' (' 
		. __('default', VL_DOMAIN) 
		. ')|image|' 
		. __('Use Image', VL_DOMAIN) 
		. '} ## ' 
		. __('Select whether to use a CSS border or an image to frame the wallpaper thumbnails.', VL_DOMAIN);

	$options['thumbpos'] = __('Thumbnail Location', VL_DOMAIN ) 
		. ' {radio|left|' 
		. __('Left', VL_DOMAIN ) 
		. ' (' 
		. __('default', VL_DOMAIN)
		. ')|right|' 
		. __('Right', VL_DOMAIN) 
		. '|sidebar|' 
		. __('Sidebar', VL_DOMAIN) 
		. '|none|' 
		. __('None', VL_DOMAIN) 
		. '} ## ' 
		. __('Select where you would like the thumbnails to be displayed.', VL_DOMAIN);

	$options['wallpaper'] = $vl_wallpaper_options;

	$options['randomthumb'] = __('Random Wallpaper Option', VL_DOMAIN ) 
		. ' {radio|hide|' 
		. __('Hide', VL_DOMAIN ) 
		. ' (' 
		. __('default', VL_DOMAIN) 
		. ')|show|' 
		. __('Show', VL_DOMAIN) 
		. '} ## ' 
		. __('Select if a thumbnail should be shown to the user to have random wallpapers.', VL_DOMAIN);

	$options['logo_dir'] = __('Logo Path', VL_DOMAIN ) 
		. ' ## ' 
		. __('Enter the path (relative to "', VL_DOMAIN) 
		. get_bloginfo('template_directory') 
		. __('") to the directory containing your site logos or the path to a single logo (leave blank to use "' , VL_DOMAIN)
		. get_bloginfo( 'title' ) 
		. __('" instead).<br/>If a directory is specified, then every time the site is displayed, a random logo will be selected from this directory.<br/>Recognised types: gif, png, jpeg and tiff', VL_DOMAIN);

	$options['logo_width'] = __('Logo Width', VL_DOMAIN ) 
		. ' ## ' . $logo_width_help_string;

	$options['logo_height'] = __('Logo Height', VL_DOMAIN ) 
		. ' ## ' . $logo_height_help_string;

	$options['archive_links'] = __('Archive Links', VL_DOMAIN ) 
		. ' {radio|oldnew|' 
		. __('Older and Newer', VL_DOMAIN ) 
		. ' (' 
		. __('default', VL_DOMAIN) 
		. ')|monthly|' 
		. __('Monthly', VL_DOMAIN) 
		. '|both|' 
		. __('Both', VL_DOMAIN) 
		. '} ## ' 
		. __('Select if the Archived menu should display an Older/Newer link, Monthly links or both.', VL_DOMAIN);

	$options['credits'] = __('Credits', VL_DOMAIN ) 
		. ' {radio|show|' 
		. __('Show', VL_DOMAIN ) 
		. ' (' 
		. __('default', VL_DOMAIN) 
		. ')|hide|' 
		. __('Hide', VL_DOMAIN) 
		. '} ## ' 
		. __('If you like Vistered Little, then you can say thank you by showing me some link love.  Otherwise you can disable the link in the footer by selecting hide.', VL_DOMAIN);

	$options['metacredits'] = __('Credits in Meta', VL_DOMAIN ) 
		. ' {radio|show|' 
		. __('Show', VL_DOMAIN ) 
		. ' (' 
		. __('default', VL_DOMAIN) 
		. ')|hide|' 
		. __('Hide', VL_DOMAIN) 
		. '} ## ' 
		. __('You can also hide the link to Vistered Little in the Meta widget, by selecting hide here.', VL_DOMAIN);

	$options['headcredits'] = __('Credits in Head', VL_DOMAIN ) 
		. ' {radio|include|' 
		. __('Include', VL_DOMAIN ) 
		. ' (' 
		. __('default', VL_DOMAIN) 
		. ')|remove|' 
		. __('Remove', VL_DOMAIN) 
		. '} ## ' 
		. __('There is one more link to Vistered Little, which is located in the xhtml head section (i.e. not visible).  Select remove to get rid of it as well.', VL_DOMAIN);

	$options['comment-policy'] = __('Comment Policy', VL_DOMAIN ) 
		. ' {textarea|10|100%}## ' 
		. __('Here you can specify the comment moderation policy for your site.', VL_DOMAIN);

	$options['custom_path'] = __('Customization directory', VL_DOMAIN ) 
		. ' ## ' 
		. __('Enter the path (relative to "', VL_DOMAIN) 
		. get_bloginfo('template_directory') 
		. __('") to a directory containing custom stylesheets and/or custom php files.<br/>Files ending with ".css" or ".css.php" will be included as stylesheets.  Files ending in "-ie.css" or "-ie.css.php" will also be included as stylesheets, but will only be visible to IE 6.  All other files ending in ".php" will be included at the end of this themes "functions.php" file.', VL_DOMAIN);

	if( function_exists('sideblog') ) {
		$options[ 'sideblog_format' ] = __('Sideblog format', VL_DOMAIN)
				. ' {radio|combined|' 
				. __('Combined', VL_DOMAIN ) 
				. '|separated|' 
				. __('Separated (' , VL_DOMAIN)
				. __('default', VL_DOMAIN) 
				. ')} ## '
				. __('If you want your sideblog to display in a single box, select "Combined" and set the sideblog display format to <pre><code>&lt;div&gt;&lt;h4&gt;%title_url%&lt;/h4&gt;%content%&lt;/div&gt;</code></pre>If you want the sideblog title and posts to appear in separate boxes, select "Separated" and set the sideblog display format to <pre><code>&lt;div class="menubefore"&gt;&lt;/div&gt;&lt;div class="menu"&gt;&lt;h4&gt;%title_url%&lt;/h4&gt;%content%&lt;/div&gt;&lt;div class="menuafter"&gt;&lt;/div&gt;</code></pre>', VL_DOMAIN);		
	}	

	$options['showauthor'] = __('Show Author', VL_DOMAIN ) 
		. ' {radio|show|' 
		. __('Show', VL_DOMAIN ) 
		. ' (' 
		. __('default', VL_DOMAIN) 
		. ')|hide|' 
		. __('Hide', VL_DOMAIN) 
		. '} ## ' 
		. __("Select Hide if you don't want the author to be displayed at the top of posts.", VL_DOMAIN);

	$options['font-family'] = __('Font', VL_DOMAIN ) 
		. ' ## ' 
		. __('Specify the font you want to use for the site.', VL_DOMAIN)
		. __('<br/>The default is <code>"verdana", sans-serif</code>', VL_DOMAIN);

	$options['title-font-family'] = __('Title Font', VL_DOMAIN ) 
		. ' ## ' 
		. __("Specify the font you want to use for the site's Title.", VL_DOMAIN)
		. __('<br/>The default is <code>"Trebuchet MS", sans-serif</code>', VL_DOMAIN);

	$options['font-size'] = __('Font Size', VL_DOMAIN ) 
		. ' ## ' 
		. __("Specify the font size you want to use for the site.", VL_DOMAIN)
		. __('<br/>The default is <code>20px</code>', VL_DOMAIN);

	presentationtoolkit( $options, __FILE__ );
}

if( function_exists('get_theme_option') ) {
	function vl_get_theme_option( $option, $default = null ) {
		$rval = get_theme_option( $option );
		return empty( $rval ) ? $default : $rval;
	}	
}
else {
	function vl_get_theme_option( $option, $default = null ) {
		return $default;
	}		
}
 
function ie_skin_stylesheet_url() {
	global $vl_skin;
   	$vl_css="/skins/$vl_skin-ie.css.php";
    
    if( file_exists(dirname(__FILE__).$vl_css) )
    	return $vl_css;
    else
    	return "/skins/common-ie.css.php?skin=$vl_skin";
}

function wallpaper_selection()
{
	global $vl_wallpapers;
	$keys = array_merge( array_keys( $vl_wallpapers[ 'tiled' ] ), array_keys( $vl_wallpapers[ 'bottom-left' ] ) );
	$idx = array_rand( $keys );
	if( function_exists('get_theme_option') && get_theme_option('wallpaper') ) {
		$idx = get_theme_option('wallpaper');
	}
	if( isset( $_SESSION['vl_wallpaper'] ) )
	{
		if( $_SESSION['vl_wallpaper'] == "-1" )
			$idx = "-1";
		else if( isset( $keys[$_SESSION['vl_wallpaper']]))
			$idx = $_SESSION['vl_wallpaper'];
	}
	return $idx;
}

function wallpaper_id()
{
	$idx = wallpaper_selection();
	if( $idx == "-1" ) {
		global $vl_wallpapers;
		$keys = array_merge( array_keys( $vl_wallpapers[ 'tiled' ] ), array_keys( $vl_wallpapers[ 'bottom-left' ] ) );
		$idx = array_rand( $keys );
	}
	return $idx;
}

function wallpaper_class()
{
	return 'wallpaper' . wallpaper_id();
}

$vl_thumbpos = "left";
if( function_exists('get_theme_option') && get_theme_option('thumbpos') )
	$vl_thumbpos = get_theme_option('thumbpos');

function headerThumbs()
{
    global $vl_thumbpos;
	return  $vl_thumbpos == "left" || $vl_thumbpos == "right";
}

function sidebarThumbs()
{
    global $vl_thumbpos;
	return  $vl_thumbpos == "sidebar";
}

function menu_position_stylesheet_url() {
    if( function_exists('get_theme_option') 
		&& get_theme_option('sidebarlocation') == "left") {
		return '/menuleft.css';
    }
    else {
    	return false;
	}
}

if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => __('Banner', VL_DOMAIN),
		'before_widget' => '<div class="post">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>'
	));

	if( !function_exists('get_theme_option') || get_theme_option('quadpossidebar') != 'quad' ) {
	    register_sidebar(array(
			'name' => __('Sidebar', VL_DOMAIN),
	        'before_widget' => '<div class="menubefore"></div><div class="menu">',
	        'after_widget' => '</div><div class="menuafter"></div>',
	        'before_title' => '<h4>',
	        'after_title' => '</h4>'
	    ));
	}
	else {
		$options = array(
			'name' => __('Quadbar - Top', VL_DOMAIN),
	        'before_widget' => '<div class="menubefore"></div><div class="menu">',
	        'after_widget' => '</div><div class="menuafter"></div>',
	        'before_title' => '<h4>',
	        'after_title' => '</h4>'
	    );
	    register_sidebar( $options );
		$options[ 'name' ] = __('Quadbar - Left', VL_DOMAIN);
	    register_sidebar( $options );

		$options[ 'name' ] = __('Quadbar - Right', VL_DOMAIN);
	    register_sidebar( $options );

		$options[ 'name' ] = __('Quadbar - Bottom', VL_DOMAIN);
	    register_sidebar( $options );
	}
	
	register_sidebar(array(
		'name' => __('Footer Bar', VL_DOMAIN),
		'before_widget' => '<div class="post">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>'
	));

	// if you change before_widget, make sure you change miniwigets as well
	register_sidebar(array(
		'name' => __('End Of Post', VL_DOMAIN),
		'before_widget' => '<div class="footer-item" style="">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>'
	));

	register_sidebar(array(
		'name' => __('2nd Banner', VL_DOMAIN),
		'before_widget' => '<div class="post">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>'
	));

	register_sidebar(array(
		'name' => __('3rd Banner', VL_DOMAIN),
		'before_widget' => '<div class="post">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>'
	));

}



function get_bloghaslogos() {
    if( vl_get_theme_option('logo_dir') )
	{
		$path = trim( vl_get_theme_option('logo_dir') );
		if( !empty( $path ) ) {
			$d=dirname(__FILE__) . "/" . $path;
			if( file_exists( $d ) )
			{
				$dir = @opendir($d);
				if( $dir ) {
					while ($f = readdir($dir)) { 
						$matches = null;
						if (eregi("(.*)\.(gif)|(jpe?g)|(png)|(tiff?)",$f,$matches)) { 
							return true; 
						}
					}
				}
				else {
					$matches = null;
					if (eregi("(.*)\.(gif)|(jpe?g)|(png)|(tiff?)",$path,$matches)) { 
						return true; 
					}
				}
			}
		}
	}
    return false;
}

$vl_has_logos = -1;

function vl_get_bloglogodir()
{
	global $vl_has_logos;
	if( $vl_has_logos == -1 ) {
		$vl_has_logos = get_bloghaslogos();
	}
	if( $vl_has_logos ) {
		return trim( get_theme_option('logo_dir') );
	}
	return null;
}

function vl_bloglogostyle()
{
	if( vl_get_bloglogodir() )
	{
		$link = get_bloginfo('template_directory') . '/logos.css.php?dir=' . vl_get_bloglogodir();
		if( get_theme_option('logo_width') ) {
			$vl_logo_width = trim( get_theme_option('logo_width') );
			if( !empty( $vl_logo_width) ) {
				$link .= '&amp;width=' . $vl_logo_width;
			}
		}
		if( get_theme_option('logo_height') ) {
			$vl_logo_height = trim( get_theme_option('logo_height') );
			if( !empty( $vl_logo_height) ) {
				$link .= '&amp;height=' . $vl_logo_height;
			}
		}
	?>
<link rel="stylesheet" href="<?php echo $link; ?>" type="text/css" media="screen" />
<!--[if lte IE 6]>
<link rel="stylesheet" href="<?php echo $link; ?>&amp;ie" type="text/css" media="screen" />
<![endif]-->
	<?php
	}
}

/*
 * function vl_wp_list_bookmarks()
 *
 * Copied from Wordpress
 *
 * Output a list of all links, listed by category, using the
 * settings in $wpdb->linkcategories and output it as a nested
 * HTML unordered list.
 *
 * Parameters:
 *   order (default 'name')  - Sort link categories by 'name' or 'id'
 *   hide_if_empty (default true)  - Supress listing empty link categories
 */
function vl_wp_list_bookmarks($order = 'name', $hide_if_empty = 'obsolete') {
	$order = strtolower($order);

	// Handle link category sorting
	$direction = 'ASC';
	if ( '_' == substr($order,0,1) ) {
		$direction = 'DESC';
		$order = substr($order,1);
	}

	if ( !isset($direction) )
		$direction = '';

	$cats = get_categories("type=link&orderby=$order&order=$direction&hierarchical=0");

	// Display each category
	if ( $cats ) {
		foreach ( (array) $cats as $cat ) {
			// Handle each category.

			// Display the category name
			echo '	<li id="linkcat-' . $cat->cat_ID . '" class="linkcat"><h4>' . $cat->cat_name . "</h4>\n\t<ul>\n";
			// Call get_bookmarks() with all the appropriate params
			get_bookmarks($cat->cat_ID, '<li>', "</li>", "\n", true, 'name', false);

			// Close the last category
			echo "\n\t</ul>\n</li>\n";
		}
	}
}


require_once( dirname(__FILE__).'/widgets.php' );
require_once( dirname(__FILE__).'/miniwidgets.php' );

if( function_exists( 'get_theme_option' ) && get_theme_option('custom_path') != null )
{
	$d=dirname(__FILE__) . "/" . get_theme_option('custom_path');
	if( file_exists( $d ) )
	{
		$dir = opendir($d);
		while ($f = readdir($dir)) { 
			$matches = null;
			if (eregi("(.*)\.css.php",$f,$matches)) { 
				continue;
			}
			$matches = null;
			if (eregi("(.*)\.php",$f,$matches)) { 
				include( $d . '/' . $f );
			}
		}
	}
}

function customstyles() {
	if( function_exists( 'get_theme_option' ) && get_theme_option('custom_path') != null )
	{
		$d=dirname(__FILE__) . "/" . get_theme_option('custom_path');
		if( file_exists( $d ) )
		{
			$dir = opendir($d);
			$iefiles = array();
			while ($f = readdir($dir)) { 
				$matches = null;
				if( preg_match('|\.css(\.php)?|', $f) ) {
					$url = get_stylesheet_directory_uri() . '/' . get_theme_option('custom_path') . '/' . $f; 
					if( preg_match('|\-ie\.css(\.php)?|', $f) ) {
						$iefiles[] = $url;
					}
					else {
						?><link rel="stylesheet" href="<?php echo $url ?>" type="text/css" /><?php
					}
				}
			}
			foreach( $iefiles as $url ) {
				?><!--[if lte IE 6]><?php
				?><link rel="stylesheet" href="<?php echo $url ?>" type="text/css" media="screen" /><?php
				?><![endif]--><?php
			}
		}
	}
}

add_action('wp_head', 'customstyles');


function vl_widget_count($index = 1) {
	global $wp_registered_sidebars, $wp_registered_widgets;

	if( $wp_registered_sidebars ) {
		if ( is_int($index) ) {
			$index = "sidebar-$index";
		} else {
			$index = sanitize_title($index);
			foreach ( $wp_registered_sidebars as $key => $value ) {
				if ( sanitize_title($value['name']) == $index ) {
					$index = $key;
					break;
				}
			}
		}
	
		$sidebars_widgets = wp_get_sidebars_widgets();
	
		if ( empty($wp_registered_sidebars[$index]) || !is_array($sidebars_widgets[$index]) || empty($sidebars_widgets[$index]) )
			return false;
		return count($sidebars_widgets[$index]);
	}

	global $registered_sidebars, $registered_widgets;

	if( $registered_sidebars ) {
		if ( is_int($index) ) {
			$index = sanitize_title('Sidebar ' . $index);
		} else {
			$index = sanitize_title($index);
		}
	
		$sidebars_widgets = get_option('sidebars_widgets');
	
		$sidebar = $registered_sidebars[$index];
	
		if ( empty($sidebar) || !is_array($sidebars_widgets[$index]) || empty($sidebars_widgets[$index]) )
			return false;
		return count($sidebars_widgets[$index]);
	}	
	return false;
}

function vl_add_styles( $styles ) {
	if( !function_exists( 'blogskinstyles' ) ) {
		$url = get_stylesheet_directory_uri() . '/skins/default/style.css.php';
		if( function_exists( 'add_presentationtoolkit_skin_query' ) ) {
			$url = add_presentationtoolkit_skin_query( 'Default', $url );
		}
		$styles[] = $url;
	}
	return $styles;
}

function vl_add_styles_ie( $styles ) {
	if( !function_exists( 'blogskinstyles' ) ) {
		$ieurl = get_stylesheet_directory_uri() . '/skins/default/style-ie.css.php?skin=default';
		if( function_exists( 'add_presentationtoolkit_skin_query' ) ) {
			$ieurl = add_presentationtoolkit_skin_query( 'Default', $ieurl );
		}
		$styles[] = $ieurl;
	}
	return $styles;
}

function vl_add_extra_css( $css ) {
	$font = vl_get_theme_option('font-family', '"verdana", sans-serif' );
	$size = vl_get_theme_option('font-size', '14px');
	$css = <<<VL_EOD
.mceContentBody {
	font-family: $font;
	font-size: $size; 
}
VL_EOD;
	return $css;
}

add_action( 'real_wysiwyg_style_sheets', 'vl_add_styles' );
add_action( 'real_wysiwyg_style_sheets_ie', 'vl_add_styles_ie' );
add_action( 'real_wysiwyg_extra_css', 'vl_add_extra_css' );

?>
