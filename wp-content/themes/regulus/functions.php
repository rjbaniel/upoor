<?php
if (!defined('SHOW_AUTHORS')) define('SHOW_AUTHORS', 'true');
if (!defined('TEMPLATE_DOMAIN')) define('TEMPLATE_DOMAIN','regulus');

load_theme_textdomain('regulus');
////////////////////////////////////////////////////////////////////////////////
// new thumbnail code for wp 2.9+
////////////////////////////////////////////////////////////////////////////////
if ( function_exists( 'add_theme_support' ) ) { // Added in 2.9
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 120, 120, true ); // Normal post thumbnails
	add_image_size( 'single-post-thumbnail', 400, 9999 ); // Permalink thumbnail size
}

////////////////////////////////////////////////////////////////////////////////
// wp 2.7 wp_list_comment
////////////////////////////////////////////////////////////////////////////////

function list_comments($comment, $args, $depth) {
$GLOBALS['comment'] = $comment; ?>

			<dt <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
			<?php if (function_exists('avatar_display_comments')) { ?>
<?php avatar_display_comments(get_comment_author_email(),'48',''); ?>
<?php } else { ?>
<?php if (function_exists('get_avatar')) { echo get_avatar( get_comment_author_email() , 48 ); } ?>
<?php } ?><a href="#<?php comment_ID() ?>">#</a> <?php comment_author_link() ?> - <?php
			comment_date();
			edit_comment_link(__('[Edit]','regulus'));?>
			</dt>
			<dd class="<?php echo $class; ?>">

			<?php

			comment_text(); ?>
               <p><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></p>
			</dd>



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



	// WIDGETS
	if ( function_exists( 'register_sidebars' ) ) {
		register_sidebar();
		
		wp_unregister_sidebar_widget( __('Search','regulus') );
		wp_unregister_widget_control( __('Search','regulus') );

		wp_unregister_sidebar_widget( __('Pages','regulus') );
		wp_unregister_widget_control( __('Pages','regulus') );
		
		wp_register_sidebar_widget( 'regulus_calendar_1', __('Calendar','regulus'), 'bm_calendar' );
	}

function regulus_add_theme_page() {

	if ( isset($_GET['page']) && $_GET['page'] == basename(__FILE__) ) {
	
	    // save settings
		if ( isset($_REQUEST['action']) &&'save' == $_REQUEST['action'] ) {

			// text input
			update_option( 'regulus_name', $_REQUEST[ 'r_name' ] );
			update_option( 'regulus_email', $_REQUEST[ 'r_email' ] );
			update_option( 'regulus_about', stripslashes( $_REQUEST[ 'r_about' ] ) );
			update_option( 'regulus_headerImage', $_REQUEST[ 'r_headerImage' ] );
			update_option( 'regulus_colourScheme', $_REQUEST[ 'r_colourScheme' ] );
			update_option( 'regulus_headerImageURL', $_REQUEST[ 'r_headerImageURL' ] );
			update_option( 'regulus_homeLink', $_REQUEST[ 'r_homeLink' ] );
			update_option( 'regulus_homeURL', $_REQUEST[ 'r_homeURL' ] );
			
			// yes/ no
			if( isset( $_REQUEST[ 'r_calendar' ] ) ) { update_option( 'regulus_calendar', 1 ); } else { delete_option( 'regulus_calendar' ); }
			if( isset( $_REQUEST[ 'r_meta' ] ) ) { update_option( 'regulus_meta', 1 ); } else { delete_option( 'regulus_meta' ); }
			if( isset( $_REQUEST[ 'r_admin' ] ) ) { update_option( 'regulus_admin', 1 ); } else { delete_option( 'regulus_admin' ); }
			if( isset( $_REQUEST[ 'r_posts' ] ) ) { update_option( 'regulus_posts', 1 ); } else { delete_option( 'regulus_posts' ); }
			if( isset( $_REQUEST[ 'r_months' ] ) ) { update_option( 'regulus_months', 1 ); } else { delete_option( 'regulus_months' ); }
			if( isset( $_REQUEST[ 'r_excerpt' ] ) ) { update_option( 'regulus_excerpt', 1 ); } else { delete_option( 'regulus_excerpt' ); }
			if( isset( $_REQUEST[ 'r_author' ] ) ) { update_option( 'regulus_author', 1 ); } else { delete_option( 'regulus_author' ); }
			if( isset( $_REQUEST[ 'r_linkcat' ] ) ) { update_option( 'regulus_linkcat', 1 ); } else { delete_option( 'regulus_linkcat' ); }
			if( isset( $_REQUEST[ 'r_sidealign' ] ) ) { update_option( 'regulus_sidealign', 1 ); } else { delete_option( 'regulus_sidealign' ); }
			if( isset( $_REQUEST[ 'r_heading' ] ) ) { update_option( 'regulus_heading', 1 ); } else { delete_option( 'regulus_heading' ); }

			// goto theme edit page
			header("Location: themes.php?page=functions.php&saved=true");
			die;

  		// reset settings
		} else if( isset($_REQUEST['action']) && 'reset' == $_REQUEST['action'] ) {

			delete_option( 'regulus_name' );
			delete_option( 'regulus_email' );
			delete_option( 'regulus_about' );
			delete_option( 'regulus_headerImage' );
			delete_option( 'regulus_headerImageURL' );
			delete_option( 'regulus_colourScheme' );
			delete_option( 'regulus_homeLink' );
			delete_option( 'regulus_homeURL' );			

			delete_option( 'regulus_calendar' );
			delete_option( 'regulus_meta' );
			delete_option( 'regulus_admin' );
			delete_option( 'regulus_posts' );
			delete_option( 'regulus_months' );
			delete_option( 'regulus_excerpt' );
			delete_option( 'regulus_author' );
			delete_option( 'regulus_linkcat' );
			delete_option( 'regulus_sidealign' );
			delete_option( 'regulus_heading' );

			// goto theme edit page
			header("Location: themes.php?page=functions.php&reset=true");
			die;

		}
	}

    add_theme_page(__('Regulus Theme Options','regulus'), __('Current Theme Options','regulus'), 'edit_theme_options', basename(__FILE__), 'regulus_theme_page');

}

function regulus_theme_page() {

	// --------------------------
	// regulus theme page content
	// --------------------------

	if ( isset($_REQUEST['saved']) && $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.__('Settings saved.','regulus').'</strong></p></div>';
	if ( isset($_REQUEST['reset']) && $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.__('Settings reset.','regulus').'</strong></p></div>';
	if ( $_REQUEST['super'] ) $superUser = true; else $superUser = false;
	
?>

<div class="wrap">
<h2>Regulus 2.3</h2>

<p><?php _e('Developed by Ben Gillbanks at Binary Moon. Check the <a href="http://www.binarymoon.co.uk/projects/regulus/">Regulus page for updates</a>','regulus'); ?></p>

<form method="post">


<!-- blog layout options -->
<style>

	#colourSchemePreview { display:block; width:60%; height:40px; border:1px solid #000; }

	.CS_orange { background-color:#fc0; }
	.CS_green { background-color:#5f7; }
	.CS_blue { background-color:#bbf; }
	.CS_pink { background-color:#f9c; }
	.CS_white { background-color:#fff; }
	.CS_blend { background-color:#eef; }
	.CS_black { background-color:#000; }
	.CS_dred { background-color:#900; }
	.CS_sgreen { background-color:#09c; }
	.CS_yellow { background-color:#fe0; }	

</style>

<script>

function updateHeaderImage( newpic ) {

	newimage = "<?php bloginfo('template_url') ?>/images/bg_" + newpic.value + ".jpg";

	document.getElementById( 'placeholder' ).src = newimage;
	return true;

}

function updateColour( newcolour ) {

	document.getElementById( 'colourSchemePreview' ).className = "CS_" + newcolour.value;

}

function updateHeaderImageSelect( form ) {

	text = form.r_headerImageURL.value;
	
    if ( text == "" ) {
    
        newpic = form.r_headerImage.value;
    
		newimage = "<?php bloginfo('template_url') ?>/images/bg_" + newpic + ".jpg";

 		form.r_headerImage.disabled = 0;
		
	} else {
	
		newimage = form.r_headerImageURL.value;
		
		form.r_headerImage.disabled = 1;
		
	}
	
	document.getElementById( 'placeholder' ).src = newimage;
}

function defaultImage() {

	newimage = "<?php bloginfo('template_url') ?>/images/bg_disabled.jpg";

	document.getElementById( 'placeholder' ).src = newimage;

}

</script>

<fieldset class="options">
<legend><?php _e('Header settings','regulus'); ?></legend>

<p><?php _e('To use your own header image enter the <strong>complete</strong> url into the Header Image URL box below - eg "http://www.yoursite.com/yourfile.jpg". To fill the header area completely you should make the image <strong>730</strong> pixels wide by <strong>140</strong> pixels high. Any smaller and the image will tile. To use one of the supplied images simply leave this box blank and select the image from the drop down.','regulus'); ?></p>

<table width="100%" cellspacing="2" cellpadding="5" class="editform">

<?php


	regulus_th(__('Header Image URL','regulus'));
		regulus_input( "r_headerImageURL", "text", "", get_option( 'regulus_headerImageURL' ), "", "updateHeaderImageSelect( this.form )" );
	regulus_cth();

	$value = get_option( 'regulus_headerImage' );
	
	if ( get_option( 'regulus_headerImageURL' ) != "" ) {
	
	    $disabled = true;

	}
	
	regulus_th(__('Header Image','regulus'));

		if ( $disabled == true ) {
			echo "<select name=\"r_headerImage\" style=\"width:60%;\" onchange=\"updateHeaderImage( this )\" disabled=\"true\">";
		} else {
            echo "<select name=\"r_headerImage\" style=\"width:60%;\" onchange=\"updateHeaderImage( this )\">";
		}
	    
		regulus_input( "r_headerImage", "option", "Regulus Classic", "1", $value );
		regulus_input( "r_headerImage", "option", "Electric Swirl", "2", $value );
		regulus_input( "r_headerImage", "option", "Smooth", "3", $value );
		regulus_input( "r_headerImage", "option", "Piece of the Puzzle", "4", $value );
		regulus_input( "r_headerImage", "option", "Skyline", "5", $value );
		regulus_input( "r_headerImage", "option", "Tech Style", "6", $value );
		regulus_input( "r_headerImage", "option", "Old and New", "7", $value );
		regulus_input( "r_headerImage", "option", "Bloom", "8", $value );
		// regulus_input( "r_headerImage", "option", "Random", "random", $value );
		echo "</select>";
		
		echo "<img id=\"placeholder\" onError=\"defaultImage();\" src=\"";
		bloginfo('template_url');
		
		if ( $disabled == true ) {
			echo "/images/bg_disabled.jpg\" width=\"60%\" />";
		} else {
			echo "/images/bg_$value.jpg\" width=\"60%\" />";
		}

		
	regulus_cth();
	
	regulus_th(__('Home Link Text (optional)','regulus'));
		regulus_input( "r_homeLink", "text", "", get_option( 'regulus_homeLink' ) );
	regulus_cth();
	
	regulus_th(__('Home Link URL (optional)','regulus'));
		regulus_input( "r_homeURL", "text", "", get_option( 'regulus_homeURL' ) );
	regulus_cth();	
	
	regulus_th(__('Header Text','regulus'));
		regulus_input( "r_heading", "checkbox", __('Hide blog title and description? (Useful if you use the custom header image)','regulus'), "1", get_option( 'regulus_heading' ) );
	regulus_cth();
	
?>

</table>
</fieldset>

<fieldset class="options">
<legend><?php _e('Blog Settings','regulus'); ?></legend>

<p><?php _e('Change the way your blog looks and acts with the many blog settings below','regulus'); ?></p>

<table width="100%" cellspacing="2" cellpadding="5" class="editform">

<?php
	
	$value = get_option( 'regulus_colourScheme' );
	regulus_th(__('Colour Scheme','regulus'));

	    echo "<select name=\"r_colourScheme\" style=\"width:60%;\" onchange=\"updateColour( this )\">";
		regulus_input( "r_colourScheme", "option", "Orange Spice", "orange", $value );
		regulus_input( "r_colourScheme", "option", "Green Peace", "green", $value );
		regulus_input( "r_colourScheme", "option", "Calm Blue", "blue", $value );
		regulus_input( "r_colourScheme", "option", "Sea Green", "sgreen", $value );
		regulus_input( "r_colourScheme", "option", "Passionate Pink", "pink", $value );
		regulus_input( "r_colourScheme", "option", "Whitewash", "white", $value );
		regulus_input( "r_colourScheme", "option", "Blend it in", "blend", $value );
		regulus_input( "r_colourScheme", "option", "Dark as night", "black", $value );
		regulus_input( "r_colourScheme", "option", "Blood Red", "dred", $value );
		regulus_input( "r_colourScheme", "option", "Canary", "yellow", $value );
		echo "</select>";
		
		echo "<div id=\"colourSchemePreview\" class=\"CS_" . $value . "\"></div>";		
		
	regulus_cth();	

	if ( $superUser == true ) {
	
	regulus_th(__('Post Options','regulus'));
		regulus_input( "r_excerpt", "checkbox", __('Show Excerpts on the homepage (removes images and some other tags)?','regulus'), "1", get_option( 'regulus_excerpt' ) );
		// regulus_input( "r_author", "checkbox", __('Show Post Author on the homepage?','regulus'), "1", get_option( 'regulus_author' ) );
	regulus_cth();
	
	}
	
	$display_regulus_sidebar = false;

	regulus_th(__('Sidebar Options','regulus'));
	
		// if plugin installed
		if ( !function_exists('is_dynamic_sidebar') ) {
		
			$display_regulus_sidebar = true;
			
		} else {
		
		    //plugin installed - is it used?
		    if ( is_dynamic_sidebar() == false ) { $display_regulus_sidebar = true; }

		}

		// display regulus sidebar settings
 		if ( $display_regulus_sidebar == true ) {

			regulus_input( "r_calendar", "checkbox", __('Show Calendar?','regulus'), "1", get_option( 'regulus_calendar' ) );
			regulus_input( "r_meta", "checkbox", __('Show meta content (login, site admin etc)?','regulus'), "1", get_option( 'regulus_meta' ) );
			regulus_input( "r_posts", "checkbox", __('Show Recent Posts','regulus'), "1", get_option( 'regulus_posts' ) );
			regulus_input( "r_months", "checkbox", __('Show all archive months','regulus'), "1", get_option( 'regulus_months' ) );
			regulus_input( "r_linkcat", "checkbox", __('Use Link categories in blog roll?','regulus'), "1", get_option( 'regulus_linkcat' ) );

		}

		//if ( $superUser == true ) regulus_input( "r_admin", "checkbox", __('Display Admin options (only for admin user when logged in)','regulus'), "1", get_option( 'regulus_admin' ) );
		regulus_input( "r_admin", "checkbox", __('Display Admin options (only for admin user when logged in)','regulus'), "1", get_option( 'regulus_admin' ) );

		regulus_input( "r_sidealign", "checkbox", __('Align sidebar to the left?','regulus'), "1", get_option( 'regulus_sidealign' ) );
	regulus_cth();

?>

</table>

</fieldset>


<!-- personal options -->
<fieldset class="options">
<legend><?php _e('Personal Information','regulus'); ?></legend>

<p><?php _e('The name and email address are used to highlight the comments you post. The about information will appear at the top of the right hand column (optional)','regulus'); ?></p>

<table width="100%" cellspacing="2" cellpadding="5" class="editform">

<?php

	regulus_th(__('Your Name','regulus'));
		regulus_input( "r_name", "text", "", get_option( 'regulus_name' ) );
	regulus_cth();

	regulus_th(__('Your Email Address','regulus'));
		regulus_input( "r_email", "text", "", get_option( 'regulus_email' ) );
	regulus_cth();

	regulus_th(__('About You','regulus'));
		regulus_input( "r_about", "textarea", "", get_option( 'regulus_about' ) );
	regulus_cth();

?>

</table>

</fieldset>

<?php

	regulus_input( "save", "submit", "", __('Save Settings','regulus') );
	
?>

<input type="hidden" name="action" value="save" />

</form>



<form method="post">

<fieldset class="options">
<legend><?php _e('Reset','regulus'); ?></legend>

<p><?php _e('If for some reason you want to uninstall Regulus then press the reset button to clean things up in the database.','regulus'); ?></p>
<?php

	regulus_input( "reset", "submit", "", __('Reset Settings','regulus') );
	
?>

</div>

<input type="hidden" name="action" value="reset" />

</form>

<?php
}

add_action('admin_menu', 'regulus_add_theme_page');


// helper functions
// ----------------

function regulus_input( $var, $type, $description = "", $value = "", $selected="", $onchange="" ) {

	// ------------------------
	// add a form input control
	// ------------------------
	
 	echo "\n";
 	
	switch( $type ){
	
	    case "text":

	 		echo "<input name=\"$var\" id=\"$var\" type=\"$type\" style=\"width: 60%\" class=\"code\" value=\"$value\" onchange=\"$onchange\"/>";
			
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

  			echo "<label><input name=\"$var\" id=\"$var\" type=\"$type\" value=\"$value\" $extra /> $description</label><br/>";

  			break;

		case "textarea":
		
		    echo "<textarea name=\"$var\" id=\"$var\" style=\"width: 60%; height: 10em;\" class=\"code\">$value</textarea>";
		
		    break;
	}

}

function regulus_th( $title ) {

	// ------------------
	// add a table header
	// ------------------

   	echo "<tr valign=\"top\">";
	echo "<th width=\"33%\" scope=\"row\">$title :</th>";
	echo "<td>";

}

function regulus_cth() {

	echo "</td>";
	echo "</tr>";
	
}


function bm_writeAbout() {

	$tempVar = get_option( 'regulus_about' );
	
	// $tempVar = apply_filters( "the_content", $tempVar );
	
	$tempVar = bm_tidy_html( $tempVar );

	if( $tempVar != "" && $tempVar != "<br />\n" ) {
	    echo "\t<li id=\"about\">";
		echo "\t\t<h2>About...</h2>\n";
		echo "\t\t" . $tempVar . "\n";
		echo "\t</li>\n";
	}

}

function bm_getProperty( $property ) {

	$value = get_option( "regulus_" . $property );
	
	if( $value == "1" ) {
        return 1;
	} else {
		return 0;
	}
	

}

function bm_calendar() {

	echo "<li>";
	echo "<div id=\"wp-cal-container\">";
	get_calendar( 3 );
	echo "</div>";
	echo "</li>";
	
}


// -------------------------------------
// format html for display in a web page
// -------------------------------------
function bm_tidy_html( $data ) {

	//remove dodgy characters
	$data = htmlspecialchars( $data );
	//remove carriage returns
	$data = str_replace( "\r", "", $data );
	//swap newlines for line breaks
	$data = str_replace( "\n", "<br />", $data );
	//replace <br>
	$data = str_replace( "<br>", "<br />", $data );
	//add paragraph tags
	$data = "<p>" . str_replace( "<br /><br />", "</p>\n<p>", $data ) . '</p>';
	//remove newline at the end of paragraphs
	$data = str_replace( "<br /></p>", "</p>", $data);
	//remove empty paragraphs
	$data = str_replace( "<p></p>", "", $data);
	$data = str_replace( "<p><br></p>", "", $data );

	$data = stripslashes( $data );

	return $data;

}

/*

Plugin Name: WP Admin Bar 2
Version: 2.2
Plugin URI: http://mattread.com/archives/2005/03/wp-admin-bar-20/
Description: Adds a small admin bar to the top of every page.
Author: Matt Read
Author URI: http://www.mattread.com/

modified by Ben Gillbanks for use in Regulus theme
url :http://www.binarymoon.co.uk

*/

function bm_admin_bar()
{
	global $user_level, $user_ID, $user_nickname, $posts, $author;
	$_authordata = get_userdata($posts[0]->post_author);
	get_currentuserinfo();

	if ( isset($user_level) ) {

		?>
		<li>
		<h2><?php _e('Admin Controls','regulus'); ?></h2>
		<ul id="wp-admin-bar">

		<?php

		// START Special case for write.
		$write_level	= ( get_option('new_users_can_blog') ) ? 0 : 1;
		//$write_text		= ( is_single() OR is_page() ) ? 'Write' : '<strong>Write</strong>';
		$write_array	= array( '<strong>'.__('Write','regulus').'</strong>', $write_level, 'post.php' );
		// END

		// START Special case for edit.
		// if (single OR page) AND (user level greater than author level OR is author OR is admin).
		$edit_level		= ( ( is_single() OR is_page() ) AND ( $user_level > $_authordata->user_level OR $_authordata->ID == $user_ID OR $user_level == 10 ) ) ? 0 : 11;
		$edit_array		= array('<strong>'.__('Edit','regulus').'</strong>',$edit_level,'post.php?action=edit&amp;post=' . $posts[0]->ID );
		// END

		$menu			= array(

			array(__('Dashboard','regulus'),8,'index.php','dashboard'),

			$write_array,
			$edit_array,

		);

		$menu = apply_filters( 'wp_admin_bard', $menu ); // user level 11 to skip

		foreach ( $menu as $item ) {
			if ($user_level >= $item[1]) {
				echo "\n\t<li><a href='".get_option('siteurl')."/wp-admin/{$item[2]}' title='$item[3]'>{$item[0]}</a></li>";
			}
		}

		// Login and logout link.
		echo "\n\t<li>"; wp_loginout(); echo "</li>";
		echo "\n</ul>";
		echo "</li>";

	}
}



/*

Plugin Name: Author Highlight
Plugin URI: http://dev.wp-plugins.org/wiki/AuthorHighlight
Description: Author Highlight is a plugin that prints out a user-specified class attribute if the comment is made by the specified author. It is useful if you would like to apply a different style to comments made by yourself.
Version: 1.0
Author: Jonathan Leighton
Author URI: http://turnipspatch.com/
Licence: This WordPress plugin is licenced under the GNU General Public Licence. For more information see: http://www.gnu.org/copyleft/gpl.html

For documentation, please visit http://dev.wp-plugins.org/wiki/AuthorHighlight

modified by Ben Gillbanks for use in Regulus theme
url :http://www.binarymoon.co.uk

*/

$bm_author_highlight = array(
	"class_name_highlight" => "highlighted",
	"class_name_else" => "",
   	"email" => get_option( 'regulus_email' ),
   	"author" => get_option( 'regulus_name' )
);

function bm_author_highlight() {

	global $comment;
	global $bm_author_highlight;

	if ( empty( $bm_author_highlight["author"] ) || empty( $bm_author_highlight["email"] ) || empty( $bm_author_highlight["class_name_highlight"] ) )
		return;

	$author = $comment -> comment_author;
	$email	= $comment -> comment_author_email;

	if ( strcasecmp( $author, $bm_author_highlight[ "author" ] ) == 0 && strcasecmp( $email, $bm_author_highlight["email"]) == 0 ) {

	return $bm_author_highlight[ "class_name_highlight" ];

	} else {

		return $bm_author_highlight[ "class_name_else" ];

	}

}

/*
Plugin Name: the_excerpt Reloaded
Plugin URI: http://guff.szub.net/the-excerpt-reloaded
Description: This mod of WordPress' template function the_excerpt() knows there is no spoon.
Version: 0.2
Author: Kaf Oseo
Author URI: http://szub.net

~Changelog:
0.2 (16-Dec-2004)
Plugin now attempts to correct *broken* HTML tags (those allowed
through 'allowedtags') by using WP's balanceTags function.  This
is controlled through the 'fix_tags' parameter.

Copyright (c) 2004
Released under the GPL license
http://www.gnu.org/licenses/gpl.txt

	This is a WordPress plugin (http://wordpress.org).

	WordPress is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published
	by the Free Software Foundation; either version 2 of the License,
	or (at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
	General Public License for more details.

	For a copy of the GNU General Public License, write to:

	Free Software Foundation, Inc.
	59 Temple Place, Suite 330
	Boston, MA  02111-1307
	USA

	You can also view a copy of the HTML version of the GNU General
	Public License at http://www.gnu.org/copyleft/gpl.html

modified by Ben Gillbanks for use in Regulus theme
url :http://www.binarymoon.co.uk

*/

function bm_the_excerpt_reloaded($excerpt_length=100, $allowedtags='<a>,<ul>,<li>,<blockquote>', $filter_type='excerpt', $use_more_link=false, $more_link_text="(more...)", $force_more_link=false, $fakeit=1, $fix_tags=true) {
	if (preg_match('%^content($|_rss)|^excerpt($|_rss)%', $filter_type)) {
		$filter_type = 'the_' . $filter_type;
	}
	$text = apply_filters($filter_type, bm_get_the_excerpt_reloaded($excerpt_length, $allowedtags, $use_more_link, $more_link_text, $force_more_link, $fakeit));
	$text = ($fix_tags) ? balanceTags($text) : $text;
	echo $text;
}

function bm_get_the_excerpt_reloaded($excerpt_length, $allowedtags, $use_more_link, $more_link_text, $force_more_link, $fakeit) {
	global $id, $post;
	$output = '';
	$output = $post->post_excerpt;
	if (!empty($post->post_password)) { // if there's a password
		if ($_COOKIE['wp-postpass_'.COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
			$output = __('There is no excerpt because this is a protected post.','regulus');
			return $output;
		}
	}


	// If we haven't got an excerpt, make one.
	if ((($output == '') && ($fakeit == 1)) || ($fakeit == 2)) {
		$output = $post->post_content;
		$output = strip_tags($output, $allowedtags);
		$blah = explode(' ', $output);
		if (count($blah) > $excerpt_length) {
			$k = $excerpt_length;
			$use_dotdotdot = 1;
		} else {
			$k = count($blah);
			$use_dotdotdot = 0;
		}
		$excerpt = '';
		for ($i=0; $i<$k; $i++) {
			$excerpt .= $blah[$i] . ' ';
		}
		// Display "more" link (use css class 'more-link' to set layout).
		if (($use_more_link && $use_dotdotdot) || $force_more_link) {
			$excerpt .= "<div class=\"more-link\"> <a href=\"". get_permalink() . "#more-$id\">$more_link_text</a></div>";
		} else {
			$excerpt .= ($use_dotdotdot) ? '...' : '';
		}
		 $output = $excerpt;
	} // end if no excerpt
	return $output;
}

function BX_top_parent_page() {

	global $post;
	$BX_post = $post;

	$topparentpageid = $BX_post->ID;

	$BX_post_parent_id = $BX_post->post_parent;

	while ( $BX_post_parent_id ) {
		$BX_post	= &get_post( $BX_post_parent_id );
		$topparentpageid = $BX_post->ID;
		$BX_post_parent_id = $BX_post->post_parent;
	}

	return $topparentpageid;
}

?>
