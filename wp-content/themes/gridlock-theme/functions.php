<?php
if (!defined('SHOW_AUTHORS')) define('SHOW_AUTHORS', 'true');
if (!defined('TEMPLATE_DOMAIN')) define('TEMPLATE_DOMAIN', 'gridlock-theme');
// Admin Panel and other functions for Gridlock.


define('GRIDLOCK_VERSION', 1.5);
define('GRIDLOCK_REVISION', 15);

add_action('admin_menu', 'gridlock_add_theme_page');
// set up the sidebar.
if (function_exists('register_sidebar')) register_sidebar();

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
<h3 class="comment_title">
<?php if (function_exists('avatar_display_comments')) { ?>
<?php avatar_display_comments(get_comment_author_email(),'48',''); ?>
<?php } else { ?>
<?php if (function_exists('get_avatar')) { echo get_avatar( get_comment_author_email() , 48 ); } ?>
<?php } ?>&nbsp;&nbsp;<?php comment_author_link(); ?> <?php _e("says:",TEMPLATE_DOMAIN); ?>&nbsp;&nbsp;&nbsp;<em><a href="#comment-<?php comment_ID() ?>" title=""><?php comment_date(__('F jS, Y','andreas09')) ?> <?php _e('at','andreas09'); ?> <?php comment_time() ?></a> <?php edit_comment_link('e','',''); ?>&nbsp;&nbsp;&nbsp;<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></em>  </h3>

	<div class="comment_box">
	<?php if ($comment->comment_approved == '0') : ?>
			<strong><em><?php _e("Your comment is awaiting moderation.",TEMPLATE_DOMAIN); ?></em></strong>
	<?php endif; ?>

	<?php comment_text(); ?>
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

define('HEADER_TEXTCOLOR', '#FFF');
define('HEADER_IMAGE', ''); // %s is theme dir uri
define('HEADER_IMAGE_WIDTH', 770); //width is fixed
define('HEADER_IMAGE_HEIGHT', 90);

function gridlock_admin_header_style() { ?>
<style type="text/css">
#headimg { background: url(<?php header_image() ?>) no-repeat; }
#headimg { height: <?php echo HEADER_IMAGE_HEIGHT; ?>px; width: <?php echo HEADER_IMAGE_WIDTH; ?>px; }
</style>
<?php }

add_theme_support( 'custom-header', array('admin-head-callback' => 'gridlock_admin_header_style'));













function gridlock_init() {
	// initialises Gridlock upon install and activation. Sets default variables.
	add_option('gridlock_featured_cat', 1);
	add_option('gridlock_secondary_cat', 2);
	add_option('gridlock_about_slug', '');
	add_option('gridlock_about_blurb', '');
	add_option('gridlock_photolocation', '');
	add_option('gridlock_delicious_username', '');
	add_option('gridlock_centre_page', 'false');
	add_option('gridlock_disable_sifr', 'false');
	add_option('gridlock_disable_ie6_warning', 'false');
	add_option('gridlock_disable_logo', 'false');
	add_option('gridlock_disable_favicon', 'false');
	add_option('gridlock_use_secondary', 'true');
	add_option('gridlock_currentfeature_caption', 'Currently Featured');
	add_option('gridlock_pastfeature_caption', 'Previously Featured');
	add_option('gridlock_secondary_caption', 'Secondary Feature');
	add_option('gridlock_delicious_caption', 'del.icio.us Links');
	add_option('gridlock_update_time', 0);
	add_option('gridlock_check_for_updates', true);
}

function gridlock_add_theme_page() {
	// check for defaults and init if they don't exist
	if(get_option('gridlock_featured_cat') == '') {
		gridlock_init();
	}
	
	if ($_GET['page'] == basename(__FILE__)) {
		if ( isset($_REQUEST['action']) && 'save' == $_REQUEST['action'] ) {
			if(isset($_REQUEST['gridlock_featured_cat'])) {
				// set featured cat
				if($_REQUEST['gridlock_featured_cat'] == '')
					update_option('gridlock_featured_cat', 1);
				else
					update_option('gridlock_featured_cat', $_REQUEST['gridlock_featured_cat']);
			}
			if(isset($_REQUEST['gridlock_secondary_cat'])) {
				// set secondary cat
				if($_REQUEST['gridlock_secondary_cat'] == '')
					update_option('gridlock_secondary_cat', 1);
				else
					update_option('gridlock_secondary_cat', $_REQUEST['gridlock_secondary_cat']);
			}
			
			if(isset($_REQUEST['gridlock_about_slug'])) {
				// set about page slug
				if($_REQUEST['gridlock_about_slug'] == '')
					update_option('gridlock_about_slug', '');
				else
					update_option('gridlock_about_slug', $_REQUEST['gridlock_about_slug']);
			}
			
			if(isset($_REQUEST['gridlock_about_blurb'])) {
				// set about page slug
				if($_REQUEST['gridlock_about_blurb'] == '')
					update_option('gridlock_about_blurb', '');
				else
					update_option('gridlock_about_blurb', $_REQUEST['gridlock_about_blurb']);
			}
			
			if(isset($_REQUEST['gridlock_photolocation'])) {
				// set photo link location
				if($_REQUEST['gridlock_photolocation'] == '')
					update_option('gridlock_photolocation', '');
				else
					update_option('gridlock_photolocation', $_REQUEST['gridlock_photolocation']);
			}
			
			if(isset($_REQUEST['gridlock_delicious_username'])) {
				// del.icio.us username
				if($_REQUEST['gridlock_delicious_username'] == '')
					update_option('gridlock_delicious_username', '');
				else
					update_option('gridlock_delicious_username', $_REQUEST['gridlock_delicious_username']);
			}
			
			if(isset($_REQUEST['gridlock_delicious_caption'])) {
				// del.icio.us section head
				if($_REQUEST['gridlock_delicious_caption'] == '')
					update_option('gridlock_delicious_caption', 'del.icio.us Links');
				else
					update_option('gridlock_delicious_caption', $_REQUEST['gridlock_delicious_caption']);
			}
			
			if(isset($_REQUEST['gridlock_disable_sifr'])) {
				// disable sifr
					update_option('gridlock_disable_sifr', 'true');
			} else	update_option('gridlock_disable_sifr', 'false');
			
			if(isset($_REQUEST['gridlock_centre_page'])) {
				// disable sifr
					update_option('gridlock_centre_page', 'true');
			} else	update_option('gridlock_centre_page', 'false');
			
			if(isset($_REQUEST['gridlock_disable_ie6_warning'])) {
				// disable IE6 warning
					update_option('gridlock_disable_ie6_warning', 'true');
			} else	update_option('gridlock_disable_ie6_warning', 'false');
			
			if(isset($_REQUEST['gridlock_disable_favicon'])) {
				// disable Gridlock favicon
					update_option('gridlock_disable_favicon', 'true');
			} else	update_option('gridlock_disable_favicon', 'false');
			
			if(isset($_REQUEST['gridlock_disable_logo'])) {
				// disable Gridlock logo
					update_option('gridlock_disable_logo', 'true');
			} else	update_option('gridlock_disable_logo', 'false');
			
			if(isset($_REQUEST['gridlock_use_secondary'])) {
				// disable Gridlock logo
					update_option('gridlock_use_secondary', 'true');
			} else	update_option('gridlock_use_secondary', 'false');
			
			if(isset($_REQUEST['gridlock_currentfeature_caption'])) {
				// set about page slug
				if($_REQUEST['gridlock_currentfeature_caption'] == '')
					update_option('gridlock_currentfeature_caption', 'Currently Featured');
				else
					update_option('gridlock_currentfeature_caption', $_REQUEST['gridlock_currentfeature_caption']);
			}
			
			if(isset($_REQUEST['gridlock_pastfeature_caption'])) {
				// set about page slug
				if($_REQUEST['gridlock_pastfeature_caption'] == '')
					update_option('gridlock_pastfeature_caption', 'Previously Featured');
				else
					update_option('gridlock_pastfeature_caption', $_REQUEST['gridlock_pastfeature_caption']);
			}
			
			if(isset($_REQUEST['gridlock_secondary_caption'])) {
				// set about page slug
				if($_REQUEST['gridlock_secondary_caption'] == '')
					update_option('gridlock_secondary_caption', 'Secondary Feature');
				else
					update_option('gridlock_secondary_caption', $_REQUEST['gridlock_secondary_caption']);
			}
			
			header("Location: themes.php?page=functions.php&saved=true");
			die;			
		}
		add_action('admin_head', 'gridlock_theme_page_head');
	}
	add_theme_page('Gridlock Options', 'Gridlock Options', 'edit_theme_options', basename(__FILE__), 'gridlock_theme_page');
} // done with initial request handling

function gridlock_theme_page_head() {
	// header stuff, css and the like
?>

	<style type="text/css">
		div#gridlock-div {
			display: block;
		}
		div#gridlockCaption {
			border-top: 1px solid #0d324f;
			margin: 10px 20px 0px 10px;
			padding: 10px;
			text-align: center;
		}
		div#gridlockCaption p {
			text-align: center;
		}
		img#gridlockLogo {
			border: 0; margin: 0; padding: 0;
			display: block;
			width: 174px; height: 51px;
			text-decoration: none;
		}
	</style>

<?php
} // end gridlock theme page head

function gridlock_theme_page() {
  // check the update server once a week
  $update_message = null;
  
  if(get_option('gridlock_check_for_updates') == 'true') {   
    if(get_option('gridlock_update_time') < (time() - (60 * 60 * 24 * 7))) {
      $update_message = ping_updateserver();
      update_option('gridlock_update_time', time());
    }
  }
    
	if ( isset($_REQUEST['saved']) && $_REQUEST['saved'] || $update_message ) {
	   echo '<div id="message" class="updated fade">';
	   
	   if ($_REQUEST['saved']) echo '<p><strong>Options saved.</strong></p>';
	   if ($update_message)    echo '<p>' . $update_message . '</p>';
	   
	   echo '</div>';
  }
?>
<div class="wrap">
	<div id="gridlock-div">
		<h2>Gridlock Options</h2>
		<p>Leaving a text field blank will disable the functionality for that option. Section heads will revert to 
			default values. HTML is not currently allowed in the About Page Sidebar blurb.</p>
		<form name="gridlock" method="post" action="<?php $_SERVER['REQUEST_URI']; ?>">
			<input type="hidden" name="action" value="save" />
			<table class="optiontable">
				<tbody>
					<tr>
						<th>Featured Category:</th>
						<td>
						  <?php
							 	$selected_cat = get_option('gridlock_featured_cat');

							  if (get_bloginfo('version') < 2.3) { 
							    echo('<select name="gridlock_featured_cat">');
						      gridlock_dropdown_cats(true, 'All Categories', 'ID', 'asc', false, false, true, false, $selected_cat); 
						      echo('</select>');
						    } else {
						      wp_dropdown_categories('orderby=ID&order=ASC&hide_empty=0&name=gridlock_featured_cat&selected=' . $selected_cat);
						    }
							?>
							</select>
						</td>
					</tr>
						<tr>
							<th>Featured Section Head:</th>
							<td><input name="gridlock_currentfeature_caption" type="text" class="code" value="<?php echo(stripslashes(get_option('gridlock_currentfeature_caption'))); ?>" /></td>
						</tr>
						<tr>
							<th>Past Feature Section Head:</th>
							<td><input name="gridlock_pastfeature_caption" type="text" class="code" value="<?php echo(stripslashes(get_option('gridlock_pastfeature_caption'))); ?>" /></td>
						</tr>
					<tr>
						<th>Secondary Category <br />(Webzine-style) Options:</th>
						<td>
							<label for="gridlock_use_secondary">
							<input type="checkbox" name="gridlock_use_secondary" id="gridlock_use_secondary" <?php if(get_option('gridlock_use_secondary') == 'true') { ?> checked="checked" <?php } ?>	/>
							Use secondary category for third post
							</label>
						</td>
					</tr>
					<tr>
						<th>Secondary Category:</th>
						<td>
							<?php
							 	$selected_cat = get_option('gridlock_secondary_cat');

							  if (get_bloginfo('version') < 2.3) { 
							    echo('<select name="gridlock_secondary_cat">');
						      gridlock_dropdown_cats(true, 'All Categories', 'ID', 'asc', false, false, true, false, $selected_cat); 
						      echo('</select>');
						    } else {
						      wp_dropdown_categories('orderby=ID&order=ASC&hide_empty=0&name=gridlock_secondary_cat&selected=' . $selected_cat);
						    }
							?>
						</td>
					</tr>
					<tr>
						<th>Secondary/Tertiary Section Head:</th>
						<td><input name="gridlock_secondary_caption" type="text" class="code" value="<?php echo(stripslashes(get_option('gridlock_secondary_caption'))); ?>" /></td>
					</tr>
					<tr>
						<th>About Page Post Slug:</th>
						<td><input name="gridlock_about_slug" type="text" class="code" value="<?php echo(get_option('gridlock_about_slug')); ?>" /></td>
					</tr>
					<tr>
							<th>About Page Sidebar Blurb:</th>
							<td><textarea name="gridlock_about_blurb" class="code" rows="5" cols="25"><?php echo(html_entity_decode(stripslashes(get_option('gridlock_about_blurb')))); ?></textarea></td>
						</tr>
					<tr>
						<th>Photos Link URI:</th>
						<td><input name="gridlock_photolocation" type="text" class="code" value="<?php echo(get_option('gridlock_photolocation')); ?>" /></td>
					</tr>
					<tr>
						<th><a href="http://del.icio.us/" title="del.icio.us">del.icio.us</a> Username:</th>
						<td><input name="gridlock_delicious_username" type="text" class="code" value="<?php echo(get_option('gridlock_delicious_username')); ?>" /></td>
					</tr>
					<tr>
						<th>del.icio.us Section Head:</th>
						<td><input name="gridlock_delicious_caption" type="text" class="code" value="<?php echo(stripslashes(get_option('gridlock_delicious_caption'))); ?>" /></td>
					</tr>
					<tr>
						<th>Display Options:</th>
						<td>
						  <label for="gridlock_centre_page">
						  <input type="checkbox" name="gridlock_centre_page" id="gridlock_centre_page" <?php if(get_option('gridlock_centre_page') == 'true') { ?> checked="checked" <?php } ?> />
						  Centre Page
						  </label><br />
							<label for="gridlock_disable_sifr">
							<input type="checkbox" name="gridlock_disable_sifr" id="gridlock_disable_sifr" <?php if(get_option('gridlock_disable_sifr') == 'true') { ?> checked="checked" <?php } ?>	/>
							Disable sIFR Typography
							</label><br />
							<label for="gridlock_disable_ie6_warning">
							<input type="checkbox" name="gridlock_disable_ie6_warning" id="gridlock_disable_ie6_warning" <?php if(get_option('gridlock_disable_ie6_warning') == 'true') { ?> checked="checked" <?php } ?>	/>
							Disable Internet Explorer 6 Warning
							</label><br />
							<label for="gridlock_disable_favicon">
							<input type="checkbox" name="gridlock_disable_favicon" id="gridlock_disable_favicon" <?php if(get_option('gridlock_disable_favicon') == 'true') { ?> checked="checked" <?php } ?>	/>
							Disable integrated favicon
							</label><br />
							<label for="gridlock_disable_logo">
							<input type="checkbox" name="gridlock_disable_logo" id="gridlock_disable_logo" <?php if(get_option('gridlock_disable_logo') == 'true') { ?> checked="checked" <?php } ?>	/>
							Disable logo
							</label><br />
						</td>
					</tr>
				</tbody>
			</table>
		<p class="submit">
			<input type="submit" name="Save" value="Update Options &raquo;" />
		</p>
		</form>
		<div id="gridlockCaption">
			<p><strong>Gridlock <?php echo(GRIDLOCK_VERSION); ?></strong> (Build 1) &copy; 2005-2007 Eston Bond. Some rights reserved.</p>
			<img src="<?php bloginfo('stylesheet_directory'); ?>/images/themecredit.gif" alt="theme by hyalineskies" title="hyalineskies" />	
		</div>
		
	</div>
</div>	
<?php
} // end theme page


// check for updates. Return message if an update is available.
function ping_updateserver() {
  $message = false;
  
  $ch = curl_init();
  
  if ($ch) {
  // set curl options.
  $res = curl_setopt_array(
                      array(
                          CURLOPT_URL => 'http://update.hyalineskies.com/?theme=gridlock',
                          CURLOPT_RETURNTRANSFER => true
                            )
                          );                 
  
    if($res) { 
      $result = curl_exec();
      if ($result) {
        // cool, we got a result from the server with the version.
        $version_info = json_decode($result, true);
        if($version_info['revision_number'] > GRIDLOCK_REVISION) {
          $message = 'Your version of Gridlock is out of date. Gridlock is now at version ' . $version_info['version'] . '.'
                   . '<a href="' . $version_info['url'] . '" title="Download new version">Download New Version</a>';
        }
      }
    }
  }
  
  return $message;
}
  

// maintaining this old function for <2.3 reverse compatibility.
function gridlock_dropdown_cats($optionall = 1, $all = 'All', $sort_column = 'ID', $sort_order = 'asc',
		$optiondates = 0, $optioncount = 0, $hide_empty = 1, $optionnone=FALSE,
		$selected=0, $hide=0) {
			
		global $wpdb;
		if ( ($file == 'blah') || ($file == '') )
			$file = get_option('home') . '/';
		if ( !$selected )
			$selected=$cat;
		$sort_column = 'cat_'.$sort_column;

		$query = "
			SELECT cat_ID, cat_name, category_nicename,category_parent,
			COUNT($wpdb->post2cat.post_id) AS cat_count,
			DAYOFMONTH(MAX(post_date)) AS lastday, MONTH(MAX(post_date)) AS lastmonth
			FROM $wpdb->categories LEFT JOIN $wpdb->post2cat ON (cat_ID = category_id)
			LEFT JOIN $wpdb->posts ON (ID = post_id)
			WHERE cat_ID > 0
			";
		if ( $hide ) {
			$query .= " AND cat_ID != $hide";
			$query .= get_category_children($hide, " AND cat_ID != ");
		}
		$query .=" GROUP BY cat_ID";
		if ( intval($hide_empty) == 1 )
			$query .= " HAVING cat_count > 0";
		$query .= " ORDER BY $sort_column $sort_order, post_date DESC";

		$categories = $wpdb->get_results($query);
		if ( intval($optionall) == 1 ) {
			$all = apply_filters('wp_list_categories', $all);
			echo "\t<option value='0'>$all</option>\n";
		}
		if ( intval($optionnone) == 1 )
			echo "\t<option value='-1'>".__('None')."</option>\n";
		if ( $categories ) {
			foreach ( $categories as $category ) {
				$cat_name = apply_filters('wp_list_categories', $category->cat_name, $category);
				echo "\t<option value=\"".$category->cat_ID."\"";
				if ( $category->cat_ID == $selected )
					echo ' selected="selected"';
				echo '>';
				echo $cat_name;
				if ( intval($optioncount) == 1 )
					echo '&nbsp;&nbsp;('.$category->cat_count.')';
				if ( intval($optiondates) == 1 )
					echo '&nbsp;&nbsp;'.$category->lastday.'/'.$category->lastmonth;
				echo "</option>\n";
			}
		}
}
?>
