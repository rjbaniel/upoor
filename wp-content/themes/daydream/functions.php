<?php
if (!defined('SHOW_AUTHORS')) define('SHOW_AUTHORS', 'true');
if (!defined('TEMPLATE_DOMAIN')) define('TEMPLATE_DOMAIN', 'daydream');
////////////////////////////////////////////////////////////////////////////////
// load text domain
////////////////////////////////////////////////////////////////////////////////
function init_localization( $locale ) {
return "en_EN";
}
// Uncomment add_filter below to test your localization, make sure to enter the right language code.
// add_filter('locale','init_localization');

load_theme_textdomain('daydream', TEMPLATEPATH . '/languages/');

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




if ( function_exists('register_sidebar') )
    register_sidebar();


function dd_add_admin() {
		
		if ( isset($_REQUEST['dd_action']) && 'save' == $_REQUEST['dd_action'] ) {

			// Update Options
			update_option('dd_asides_cat', $_REQUEST['dd_asides_cat'] );
			update_option('dd_colour_scheme', $_REQUEST['dd_colour_scheme'] );
			update_option('dd_menu_home', $_REQUEST['dd_menu_home'] );
			update_option('dd_menu_order', $_REQUEST['dd_menu_order'] );
			update_option('dd_gravatars', $_REQUEST['dd_gravatars'] );
			update_option('dd_title', $_REQUEST['dd_title'] );
			update_option('dd_archives_page', $_REQUEST['dd_archives_page'] );
			update_option('dd_tags_page', $_REQUEST['dd_tags_page'] );
			update_option('dd_tagsearch_page', $_REQUEST['dd_tagsearch_page'] );
			update_option('dd_tags_cats', $_REQUEST['dd_tags_cats'] );
			update_option('dd_tags_desc', $_REQUEST['dd_tags_desc'] );
			
				if (get_option('dd_archives_page') == "yes" && !checkForStaticPage('Archives')) {
					createStaticPage('Archives', '', 'archives.php');
				} else if (get_option('dd_archives_page') != "yes") {
					deleteStaticPage('Archives');
				}
				
				if (get_option('dd_tags_page') == "yes" && !checkForStaticPage('Tags')) {
					createStaticPage('Tags', '', 'tags.php');
				} else if (get_option('dd_tags_page') != "yes" || !function_exists('UTW_ShowTagsForCurrentPost')) {
					deleteStaticPage('Tags');
				}
				
				if (get_option('dd_tagsearch_page') == "yes" && !checkForStaticPage('Tag Search')) {
					createStaticPage('Tag Search', '', 'searchtags.php');
				} else if (get_option('dd_tagsearch_page') != "yes" || !function_exists('UTW_ShowTagsForCurrentPost')) {
					deleteStaticPage('Tag Search');
				}
				
	
			// Go back to the options
			header("Location: themes.php?page=functions.php&saved=true");
			die;
		}

    add_theme_page("Day Dream Options", "Day Dream Options", 'edit_theme_options', basename(__FILE__), 'dd_admin');
	add_option('dd_colour_scheme', 'Blue', null, 'yes');
	add_option('dd_menu_home', 'yes', null, 'yes');
	add_option('dd_menu_order', 'alpha', null, 'yes');
	add_option('dd_gravatars', 'off', null, 'yes');
	add_option('dd_title', 'left', null, 'yes');
	add_option('dd_tags_desc', 'yes', null, 'yes');
	add_option('dd_archives_page', 'no', null, 'yes');
	add_option('dd_tags_page', 'no', null, 'yes');
	add_option('dd_tagsearch_page', 'no', null, 'yes');
	add_option('dd_tags_cats', 'both', null, 'yes');
	add_option('dd_tags_desc', 'yes', null, 'yes');


}

function dd_admin() {

	if ( $_GET['saved'] ) echo '<div id="message" class="updated fade"><p>Day Dream options saved. <a href="'. get_bloginfo('url') .'">View Site &raquo;</a></strong></p></div>';
	
?>

<div class="wrap">
<h2>Day Dream Options</h2>



	<form id='dd_options' method="post">
	
			<h3>Title</h3>
			
				<p><label for="dd_title" style="width: 90px;">Title and Description:</label>
					<input type="radio" name="dd_title" value="left" <?php if (get_option('dd_title') == "left") { echo "checked='checked'"; } ?> /> Left Align (default)<br />
					<input type="radio" name="dd_title" value="centre" <?php if (get_option('dd_title') == "centre") { echo "checked='checked'"; } ?> /> Centre<br />
					<input type="radio" name="dd_title" value="right" style="margin-left: 90px;" <?php if (get_option('dd_title') == "right") { echo "checked='checked'"; } ?> /> Right Align<br />
					<div class="hint" style="margin-left: 90px;">Right aligning can look pretty good, it provides some balance against the left aligned menu.</div></p>
			
			
			<h3>Menu</h3>
				
				<p><label for="dd_menu_home" style="width: 90px;">Home link:</label>
					<input type="radio" name="dd_menu_home" value="yes" <?php if (get_option('dd_menu_home') == "yes") { echo "checked='checked'"; } ?> /> Show in the menu<br />
					<input type="radio" name="dd_menu_home" value="no" style="margin-left: 90px;" <?php if (get_option('dd_menu_home') == "no") { echo "checked='checked'"; } ?> /> Do not show in the menu<br />
					<div class="hint" style="margin-left: 90px;">A link home is also created in the header but an additional link is shown in the menu by deafult.</div></p>
					
				<p><label for="dd_menu_order" style="width: 90px;">Order:</label>
					<input type="radio" name="dd_menu_order" value="alpha" <?php if (get_option('dd_menu_order') == "alpha") { echo "checked='checked'"; } ?> /> Alphabetically<br />
					<input type="radio" name="dd_menu_order" value="by_id" style="margin-left: 90px;" <?php if (get_option('dd_menu_order') == "by_id") { echo "checked='checked'"; } ?> /> By ID<br />
					<input type="radio" name="dd_menu_order" value="page_order" style="margin-left: 90px;" <?php if (get_option('dd_menu_order') == "page_order") { echo "checked='checked'"; } ?> /> Page Order<br />
					<div class="hint" style="margin-left: 90px;">Page order is set when creating and editing pages. Alphabetical is the default.</div></p>

			
			<h3>Pages</h3>
			
				<p><label for="dd_archives_page" style="width: 90px;">Archives:</label>
					<input type="checkbox" name="dd_archives_page" value="yes" <?php if (get_option('dd_archives_page') == "yes" || checkForStaticPage('Archives') ) { echo "checked='checked'"; } ?> /> Create Page<br />
					</p>
				
				
				
					<?php if (function_exists('UTW_ShowTagsForCurrentPost') && function_exists('UTW_TagArchive')) { ?>
					
						<input type="checkbox" name="dd_tags_page" value="yes" <?php if (get_option('dd_tags_page') == "yes" || checkForStaticPage('Tags') ) { echo "checked='checked'"; } ?> /> Create Tag Cloud Page<br />
						<div class="hint" style="margin-left: 90px;">Read more about tags <a href="http://www.neato.co.nz/wp-content/plugins/UltimateTagWarrior/ultimate-tag-warrior-help.html">here</a>. Credit goes to <a href="http://www.neato.co.nz/">Christine Davis</a> for this plugin.</div></p>
					
					<?php } else { ?>
						
					
						
					<?php } ?>
			
			
			
			
				<?php if (function_exists('UTW_ShowTagsForCurrentPost')) { ?>
				
					<p><label for="dd_tags_cats" style="width: 90px;">Display:</label>
						<input type="radio" name="dd_tags_cats" value="both" <?php if (get_option('dd_tags_cats') == "both") { echo "checked='checked'"; } ?> /> Show both Tags and Categories<br />
						<input type="radio" name="dd_tags_cats" value="tags" style="margin-left: 90px;" <?php if (get_option('dd_tags_cats') == "tags") { echo "checked='checked'"; } ?> /> Replace Categories with Tags<br />
						<div class="hint" style="margin-left: 90px;">Tags will only replace categories visibly on the index page, your categories won't be destroyed, I promise.</div></p>
					
					<p><label for="dd_tags_desc" style="width: 90px;">Description:</label>
						<input type="checkbox" name="dd_tags_desc" value="yes" <?php if (get_option('dd_tags_desc') == "yes") { echo "checked='checked'"; } ?> /> Display description of Tags on Tag Cloud Page.<br />
						<div class="hint" style="margin-left: 90px;">"A tag cloud (more traditionally known as a weighted list in the field of visual design) 
						is a visual depiction of content tags used on this blog."</div></p>

                   	<h3>Asides</h3>

				<p><label for="dd_asides_cat">Category for Asides:</label>
					<?php
					global $wpdb;
					$asides_cats = get_categories();
					?>
					<select name="dd_asides_cat" id="dd_asides_cat">
						<option value="0">No Asides</option>
						<option value="0">----</option>
						<?php
						foreach ($asides_cats as $cat) {
							if ($cat->cat_ID == get_option('dd_asides_cat')) {
								echo '<option value="' . $cat->cat_ID . '" selected="selected">' . $cat->cat_name . '</option>';
							} else {
								echo '<option value="' . $cat->cat_ID . '">' . $cat->cat_name . '</option>';
							}
						}
						?>
					</select><br />
					<?php
						if (get_option('dd_asides_cat') == 0) {
							echo "<div class='hint'>To enable asides please select the category you'd like to use.</div>";
						} else {
							echo "<div class='hint'>Select 'No Asides' to turn Asides off.</div>";
						}
					?>
					</p>



				<?php } else { ?>
						
					
						
				<?php } ?>
					
			

		
		

		
			<?php if (function_exists('gravatar')) { ?>
			
			
			
			<?php } else { ?>
			
		
			
			<?php }	?>
	
			
		
		<h3>Colour Schemes</h3>
		
			<p><label for="dd_colour_scheme">Select a Colour Scheme:</label>
				<img src="<?php bloginfo('template_directory'); ?>/images/option_blue.jpg" alt="Blue" />
				<input type="radio" name="dd_colour_scheme" value="Blue" <?php if (get_option('dd_colour_scheme') == "Blue") { echo "checked='checked'"; } ?> />
			
				
				<img src="<?php bloginfo('template_directory'); ?>/images/option_green.jpg" alt="Green" />
				<input type="radio" name="dd_colour_scheme" value="Green" <?php if (get_option('dd_colour_scheme') == "Green") { echo "checked='checked'"; } ?> /><br />
				
				<p style="margin-left: 140px;">
				<img src="<?php bloginfo('template_directory'); ?>/images/option_pink.jpg" alt="Pink" />
				<input type="radio" name="dd_colour_scheme" value="Pink" <?php if (get_option('dd_colour_scheme') == "Pink") { echo "checked='checked'"; } ?> />
				
				
				<img src="<?php bloginfo('template_directory'); ?>/images/option_grey.jpg" alt="Grey" />
				<input type="radio" name="dd_colour_scheme" value="Grey" <?php if (get_option('dd_colour_scheme') == "Grey") { echo "checked='checked'"; } ?> /></p>

				
				<div class='hint'>Blue is the default, select the button next to the square to select that colour scheme. The grey version 
				is a little plain compared to the others, it encourages customisation.<br /><br />
                <b>you can also use <a href="/wp-admin/themes.php?page=custom-header">custom header</a> to customize your header image</b></div></p>

		<p><input name="save" id="save" type="submit" value="Save Options" /></p>
		
		<input type="hidden" name="dd_action" value="save" />
	
	</form>

<?php
}

function dd_admin_header() { ?>

	<style media="screen" type="text/css">
		
		form#dd_options { margin: 20px 0 0 40px; }
		
			form#dd_options h3 {
				font-size: 1.5em;
				font-weight: normal;
				margin: 30px 0 0 0;
				}
				
				form#dd_options p { margin: 10px 0; }
				
				form#dd_options label { 
					width: 140px;
					display: block;
					float: left;
					}
					
					form#dd_options div.hint {
						color: #666;
						margin: -8px 0 0 140px;
						width: 500px;
						}
						
			form#dd_options input#save { margin: 20px 0 0 140px; }
			
			
		
	</style>

<?php }

add_action('admin_head', 'dd_admin_header');
add_action('admin_menu', 'dd_add_admin');

	/*
	Plugin Name: Nice Categories
	Plugin URI: http://txfx.net/2004/07/22/wordpress-conversational-categories/
	Description: Displays the categories conversationally, like: Category1, Category2 and Category3
	Version: 1.5.1
	Author: Mark Jaquith
	Author URI: http://txfx.net/
	*/
	
	function the_nice_category($normal_separator = ', ', $penultimate_separator = ' and ') {
		$categories = get_the_category();
	   
		  if (empty($categories)) {
			_e('Uncategorized');
			return;
		}
	
		$thelist = '';
			$i = 1;
			$n = count($categories);
			foreach ($categories as $category) {
				$category->cat_name = $category->cat_name;
					if (1 < $i && $i != $n) $thelist .= $normal_separator;
					if (1 < $i && $i == $n) $thelist .= $penultimate_separator;
				$thelist .= '<a href="' . get_category_link($category->cat_ID) . '" title="' . sprintf(__("View all posts in %s"), $category->cat_name) . '">'.$category->cat_name.'</a>';
						 ++$i;
			}
		echo apply_filters('the_category', $thelist, $normal_separator);
	} 
	
	/*
	This next function is stolen directly
	from the Tarski theme, it is used to 
	create static pages. It'll be used to create the archives page and
	the tags page.
	*/
	
	function createStaticPage($post_title, $content, $template) {
		global $wpdb, $user_ID;
		get_currentuserinfo();
		
		$now = current_time('mysql');
		$now_gmt = current_time('mysql', 1);
		$post_author = $user_ID;
		$id_result = $wpdb->get_row("SHOW TABLE STATUS LIKE '$wpdb->posts'");
		$post_ID = $id_result->Auto_increment;
		$post_name = sanitize_title($post_title, $post_ID);
		$ping_status = get_option('default_ping_status');
		$comment_status = get_option('default_comment_status');
		
		$postquery ="INSERT INTO $wpdb->posts (ID, post_author, post_date, post_date_gmt, post_content, post_title, post_excerpt,  post_status, comment_status, ping_status, post_password, post_name, to_ping, post_modified, post_modified_gmt, post_parent, menu_order) VALUES ('$post_ID', '$post_author', '$now', '$now_gmt', '$content', '$post_title', '', 'static', '$comment_status', '$ping_status', '', '$post_name', '', '$now', '$now_gmt', '', '')";
		$result = $wpdb->query($postquery);
		
		$metaquery = "INSERT INTO $wpdb->postmeta(meta_id, post_id, meta_key, meta_value) VALUES('', '$post_ID', '_wp_page_template', '$template')";
		$result2 = $wpdb->query($metaquery);
	}
	
	function checkForStaticPage($title) {
		global $wpdb, $user_ID;
		get_currentuserinfo();
		
		$query = "SELECT ID FROM $wpdb->posts WHERE post_title='$title' AND post_status='static'";
		$result = $wpdb->query($query);
		
		if($result > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	function deleteStaticPage($title) {
		global $wpdb;
		
		$result_del = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_title = '$title' AND post_status = 'static'");
		
		wp_delete_post($result_del);
	}









////////////////////////////////////////////////////////////////////////////////
// wp 2.7 wp_list_comment
////////////////////////////////////////////////////////////////////////////////

function list_comments($comment, $args, $depth) {
$GLOBALS['comment'] = $comment; ?>


<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
			<?php if ($comment->comment_approved == '0') : ?>
			<p class="await_mod">Your comment is awaiting moderation.</p>
			<?php endif; ?>

            <?php if (function_exists('avatar_display_comments')) { ?>
<?php avatar_display_comments(get_comment_author_email(),'48',''); ?>
<?php } else { ?>
<?php if (function_exists('get_avatar')) { echo get_avatar( get_comment_author_email() , 48 ); } ?>
<?php } ?>

<?php if ($comment->comment_approved == '0') : ?>
<em><?php _e('Your comment is awaiting moderation.','daydream'); ?></em>
<?php endif; ?>

			<?php comment_text() ?>

			<div class="cmntmeta"><?php comment_author_link() ?> - <?php comment_date('F jS, Y') ?> <?php _e('at');?> <?php comment_time() ?></a> <?php edit_comment_link('e','',''); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></div>


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

define('HEADER_TEXTCOLOR', '');
define('HEADER_IMAGE', ''); // %s is theme dir uri
define('HEADER_IMAGE_WIDTH', 527); //width is fixed
define('HEADER_IMAGE_HEIGHT', 273);

function dd_admin_header_style() { ?>
<style type="text/css">
#headimg { background: url(<?php header_image() ?>) no-repeat; }
#headimg { height: <?php echo HEADER_IMAGE_HEIGHT; ?>px; width: <?php echo HEADER_IMAGE_WIDTH; ?>px; }
#headimg h1 {
  padding-top: 150px;
  padding-bottom: 10px;
  margin: 0px;
  text-align: center;
  width: 100%;
  float: left;
}
#headimg #desc {
  margin: 0px;
  padding: 0px;
  width: 100%;
  float: left;
  text-align: center !important;
}
#headimg a {
  text-decoration: none;
}


</style>
<?php }

add_theme_support( 'custom-header', array('admin-head-callback' => 'dd_admin_header_style'));

















?>
