<?php
if (!defined('SHOW_AUTHORS')) define('SHOW_AUTHORS', 'true');
if (!defined('TEMPLATE_DOMAIN')) define('TEMPLATE_DOMAIN','terrafirma');
////////////////////////////////////////////////////////////////////////////////
// load text domain
////////////////////////////////////////////////////////////////////////////////
function init_localization( $locale ) {
return "en_EN";
}
// Uncomment add_filter below to test your localization, make sure to enter the right language code.
// add_filter('locale','init_localization');

load_theme_textdomain( TEMPLATE_DOMAIN, TEMPLATEPATH . '/languages/' );



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
// new thumbnail code for wp 2.9+
////////////////////////////////////////////////////////////////////////////////
if ( function_exists( 'add_theme_support' ) ) { // Added in 2.9
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 120, 120, true ); // Normal post thumbnails
	add_image_size( 'single-post-thumbnail', 400, 9999 ); // Permalink thumbnail size
}


if ( function_exists('register_sidebar') )
	register_sidebar();
if ( function_exists('wp_unregister_sidebar_widget') )
	{
		wp_unregister_sidebar_widget('terrafirma_links_1', __('Links') );	
	}
	if ( function_exists('wp_register_sidebar_widget') )
	{
		wp_register_sidebar_widget('terrafirma_links_1', __('Links'), 'terrafirma_ShowLinks');
	}
// For backward Compatiblity to older versions of WordPress
add_filter( 'comments_template', 'legacy_comments' );
function legacy_comments( $file ) {
	if ( !function_exists('wp_list_comments') )
		$file = TEMPLATEPATH . '/old-comments.php';
	return $file;
}

function terrafirma_ShowLinks() { ?>
    <?php 
        if (function_exists('wp_list_bookmarks'))
          wp_list_bookmarks();
        else
          wp_list_bookmarks('name'); 
    ?>
<?php }


function terrafirma_add_theme_page() {

	if ( isset($_GET['page']) && $_GET['page'] == basename(__FILE__) ) {
	
	    // save settings
		if ( isset($_REQUEST['action']) && 'save' == $_REQUEST['action'] ) {

			update_option( 'terrafirma_asideid', $_REQUEST[ 's_asideid' ] );
			update_option( 'terrafirma_sortpages', $_REQUEST[ 's_sortpages' ] );


            update_option( 'terrafirma_profileimg', $_REQUEST[ 's_profileimg' ] );


			if( isset( $_POST[ 'excludepages' ] ) ) { update_option( 'terrafirma_excludepages', implode(',', $_POST['excludepages']) ); } else { delete_option( 'terrafirma_excludepages' ); }
			// goto theme edit page
			header("Location: themes.php?page=functions.php&saved=true");
			die;

  		// reset settings
		} else if( isset($_REQUEST['action']) && 'reset' == $_REQUEST['action'] ) {

			delete_option( 'terrafirma_asideid' );
			delete_option( 'terrafirma_sortpages' );			
			delete_option( 'terrafirma_excludepages' );
			delete_option( 'terrafirma_profileimg' );
			
			// goto theme edit page
			header("Location: themes.php?page=functions.php&reset=true");
			die;

		}
	}


    add_theme_page("TerraFirma Options", "TerraFirma Options", 'edit_theme_options', basename(__FILE__), 'terrafirma_theme_page');

}

function terrafirma_theme_page() {
	// --------------------------
	// TerraFirma theme page content
	// --------------------------
	if ( isset($_REQUEST['saved']) && $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>TerraFirma Theme: Settings saved.</strong></p></div>';
	if ( isset($_REQUEST['reset']) && $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>TerraFirma Theme: Settings reset.</strong></p></div>';
?>
<style>
	.wrap { border:#ccc 1px dashed;}
	.block { margin:1em;padding:1em;line-height:1.6em;}
	table tr td {border:#ddd 1px solid;font-family:Verdana, Arial, Serif;font-size:0.9em;}
	h4 {font-size:1.3em;color:#969669;font-weight:bold;margin:0;padding:10px 0;}	
</style>
<div class="wrap">

<h2>TerraFirma 3.5</h2>

<div class="block">
  <img src="<?php bloginfo('stylesheet_directory'); ?>/screenshot.jpg" alt="TerraFirma Screenshot" style="float:left;margin:1em;" />
  <h4>WordPress Theme: <a href="http://wpthemepark.com/themes/terrafirma/">TerraFirma</a> </h4>

</div>

<br style="clear:both;" />
<form method="post">


<!-- blog layout options -->
<fieldset class="options">
<legend>Theme Settings</legend>

<p>Change the way your blog looks and acts with the many blog settings below</p>

<table width="100%" cellspacing="5" cellpadding="10" class="editform">
<tr>
<td valign="top" colspan="2" style="border:0px;margin:0;padding:0;">
	<input type="hidden" name="action" value="save" />
	<?php tf_input( "save", "submit", "", "Save Settings" );?>
</td>
</tr>

<tr valign="top">
<td align="left">
	<?php
	tf_heading("List Pages / Navigation");
		global $wpdb;
		$results = $wpdb->get_results("SELECT ID, post_title from $wpdb->posts WHERE post_status='static' or post_type='page' AND post_parent=0 ORDER BY post_title");
		$excludepages = explode(',', get_option('terrafirma_excludepages'));

		if($results) {
			_e('<br/>Exclude the Following Pages from the Top Navigation <br/><br/>');
			foreach($results as $page) {
				echo '<input type="checkbox" name="excludepages[]" value="' . $page->ID . '"';
				if(in_array($page->ID, $excludepages)) { echo ' checked="checked"'; }
				echo ' /> <a href="' . get_permalink($page->ID) . '">' . $page->post_title . '</a><br />';
			}		
		}
		_e('<br/><br/>');
		echo "<br/><strong> Sort the List Pages by </strong><br/>";
		
		tf_input( "s_sortpages", "radio", "Page Title ?", "post_title", get_option( 'terrafirma_sortpages' ) );
		tf_input( "s_sortpages", "radio", "Date ?", "post_date", get_option( 'terrafirma_sortpages' ) );		
		tf_input( "s_sortpages", "radio", "Page Order ?", "menu_order", get_option( 'terrafirma_sortpages' ) );
		echo "(Each Page can be given a page order number, from the wordpress admin, edit page area)";
		echo "<br/>";			
?>
</td>
<td>
<?php
	tf_heading( "Support for Asides / Side Notes" );
	echo "Asides are the 'quick bits' of information you want to post. They do not have to look like a regular post.";
	echo "<br/><br/>Learn More at <a href='http://photomatt.net/2004/05/19/asides/'>Matt's Asides technique</a>";
?>
	<?php
		global $wpdb, $img_firma;
		$id = get_option('terrafirma_asideid');
        $img_firma = get_option('terrafirma_profileimg');
		$defaults = array(
			'show_option_all' => '', 'show_option_none' => '', 
			'orderby' => 'ID', 'order' => 'ASC', 
			'show_last_update' => 0, 'show_count' => 0, 
			'hide_empty' => 1, 'child_of' => 0, 
			'exclude' => '', 'echo' => 1, 
			'selected' => 0, 'hierarchical' => 0, 
			'name' => 'cat', 'class' => 'postform'
		);
		$r = wp_parse_args( $args, $defaults );
		extract( $r );

		$asides_cats = get_categories($r);      

	?>
			<p>Select the category here. Any posts under this category will look like an Aside.</p>
			<select name="s_asideid" id="s_asideid">
        <option value="0">NOT SELECTED</option>
        <?php
					foreach ($asides_cats as $cat) {
					if ($id == $cat->cat_ID)
					{
						$sIsSelected = "selected='true'";
					}
					else
					{
						$sIsSelected = "";			
					}
						echo '<option value="' . $cat->cat_ID . '"'. $sIsSelected. '>' . $cat->cat_name . '</option>';
				}?>
		</select>


       <p>Insert your profile images full url here. <em>*must start with http://</em><br /><small>suitable size 150px x 80px</small></p>
       <?php tf_input( "s_profileimg", "text", "", get_option( 'terrafirma_profileimg' ), get_option( 'terrafirma_profileimg' ) ); ?>



         </td>



</td>
</tr>	
<tr>
<td valign="top" colspan="2" style="border:0px;margin:0;padding:0;">
	<input type="hidden" name="action" value="save" />
	<?php tf_input( "save", "submit", "", "Save Settings" );?>
</td>
</tr>
</table>
</fieldset>
</form>

<form method="post">

<fieldset class="options">
<legend>Reset</legend>

<p>If for some reason you want to uninstall TerraFirma then press the reset button to clean things up in the database.</p>
<p>You have to make sure to delete the theme folder, if you want to completely remove the theme.</p>
<?php

	tf_input( "reset", "submit", "", "Reset Settings" );
	
?>

</div>
<input type="hidden" name="action" value="reset" />
</form>

<?php
}
add_action('admin_menu', 'terrafirma_add_theme_page');


function tf_input( $var, $type, $description = "", $value = "", $selected="" ) {

	// ------------------------
	// add a form input control
	// ------------------------
	
 	echo "\n";
 	
	switch( $type ){
	
	    case "text":

	 		echo "<input name=\"$var\" id=\"$var\" type=\"$type\" style=\"width: 70%\" class=\"text\" value=\"$value\" />";
			
			break;
			
		case "submit":
		
	 		echo "<p class=\"submit\"><input name=\"$var\" type=\"$type\" value=\"$value\" /></p>";

			break;

		case "option":
		
			if( $selected == $value ) { $extra = "selected=\"true\""; }

			echo "<option value=\"$value\" $extra >$description</option>";
		
		    break;
  		case "radio":
  		
			if( $selected == $value ) { $extra = "checked=\"true\""; }
  		
  			echo "<label><input name=\"$var\" id=\"$var\" type=\"$type\" value=\"$value\" $extra /> $description</label><br/>";
  			
  			break;
  			
		case "checkbox":
		
			if( $selected == $value ) { $extra = "checked=\"true\""; }

  			echo "<label for=\"$var\"><input name=\"$var\" id=\"$var\" type=\"$type\" value=\"$value\" $extra /> $description</label><br/>";

  			break;

		case "textarea":
		
		    echo "<textarea name=\"$var\" id=\"$var\" style=\"width: 80%; height: 10em;\" class=\"code\">$value</textarea>";
		
		    break;
	}

}

function tf_heading( $title ) {
	// ------------------
	// add a table header
	// ------------------
   echo "<h4>" .$title . "</h4>";
}
