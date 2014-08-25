<?php
if (!defined('SHOW_AUTHORS')) define('SHOW_AUTHORS', 'true');
if (!defined('TEMPLATE_DOMAIN')) define('TEMPLATE_DOMAIN', 'blogtheme');
// Uncomment this to test your localization, make sure to enter the right language code.

//function test_localization( $locale ) {
//return "fr_FR";
//}
//add_filter('locale','test_localization');


load_theme_textdomain('blogtheme', TEMPLATEPATH . '/languages/');


////////////////////////////////////////////////////////////////////////////////
// new thumbnail code for wp 2.9+
////////////////////////////////////////////////////////////////////////////////
if ( function_exists( 'add_theme_support' ) ) { // Added in 2.9
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 150, 150, true ); // Normal post thumbnails
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
      echo '<div class="error fade"><p>' . __('Please install the latest version of <a href="http://premium.wpmudev.org/project/update-notifications/" title="Download Now&raquo;">our free Update Notifications plugin</a> which helps you stay up-to-date with the most stable, secure versions of WPMU DEV themes and plugins. <a href="http://premium.wpmudev.org/wpmu-dev/update-notifications-plugin-information/">More information &raquo;</a>', 'wpmudev') . '</a></p></div>';
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

function revert_wp_menu_page() {
//revert back to normal if in wp 3.0 and menu not set ?>
<li><a <?php if ( is_home() ) { ?>class="current_page_item"<?php } ?> href="<?php bloginfo('url'); ?>"><?php _e('Home', 'blogtheme'); ?></a></li>
<?php wp_list_pages("title_li=&depth=0"); ?>
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

// CUSTOM IMAGE HEADER  - IF ON WILL BE SHOWN ELSE WILL HIDE

////////////////////////////////////////////////////////////////////////////////





define('HEADER_TEXTCOLOR', '');

define('HEADER_IMAGE', ''); // %s is theme dir uri

define('HEADER_IMAGE_WIDTH', 940); //width is fixed

define('HEADER_IMAGE_HEIGHT', 150);

define( 'NO_HEADER_TEXT', true );





function woo_admin_header_style() { ?>

<style type="text/css">

#headimg {

	background: url(<?php header_image() ?>) no-repeat;

}

#headimg {

	height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;

	width: <?php echo HEADER_IMAGE_WIDTH; ?>px;

}



#headimg h1, #headimg #desc {

	display: none;

}

</style>

<?php }



if (function_exists('add_theme_support')) {

add_theme_support( 'custom-header', array('admin-head-callback' => 'woo_admin_header_style'));

}









////////////////////////////////////////////////////////////////////////////////

// wp 2.7 wp_list_comment

////////////////////////////////////////////////////////////////////////////////





function list_comments($comment, $args, $depth) {

$GLOBALS['comment'] = $comment; ?>



<li class="post" id="comment-<?php comment_ID(); ?>">



<div class="meta grid_2 alpha">

<ul>

<li class="gravatar"><?php echo get_avatar( $comment, $size = '32' ); ?></li>

<li class="auth"><em>By</em> <?php comment_author_link(); ?></li>

<li class="date"><a href="<?php the_permalink() ?>#comment-<?php comment_ID() ?>"><?php comment_date('d/m/y'); ?> at <?php comment_time('H:i'); ?></a></li>

</ul>

</div>



<div class="postbody grid_7 omega <?php if ( $counter == 1 ) { ?>first<?php } ?>">

<div class="entry">







<?php if ($comment->comment_approved == '0') : ?>

<em><?php _e('Your comment is awaiting moderation.') ?></em>

<?php else: ?>

<?php comment_text() ?>

<?php endif; ?>



<div class="reply"><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></div>



</div><!--entry-->









</div><!--grid_7-->







<?php



}















// VARIABLES

$themename = "BlogTheme";

$shortname = "woo";

$manualurl = 'http://www.woothemes.com/support/theme-documentation/blogtheme/';

$functions_path = TEMPLATEPATH . '/functions/';

$includes_path = TEMPLATEPATH . '/includes/';



// Options panel variables and functions

require_once ($functions_path . '/admin-setup.php');



// Options panel settings

require_once ($functions_path . '/admin-options.php');



// Custom fields 

require_once ($functions_path . '/custom.php');



// Custom pages listing

require_once ($functions_path . '/getpages.php');



// Widgets

require_once ($includes_path . '/widgets.php');



// Admin Panel

function woothemes_add_admin() {



	 global $themename, $options;



	if ( isset($_GET['page']) && $_GET['page'] == basename(__FILE__) ) {

        if ( isset($_REQUEST['action']) && 'save' == $_REQUEST['action'] ) {

	

                foreach ($options as $value) {

					if($value['type'] != 'multicheck'){

                    	update_option( $value['id'], $_REQUEST[ $value['id'] ] ); 

					}else{

						foreach($value['options'] as $mc_key => $mc_value){

							$up_opt = $value['id'].'_'.$mc_key;

							update_option($up_opt, $_REQUEST[$up_opt] );

						}

					}

				}



                foreach ($options as $value) {

					if($value['type'] != 'multicheck'){

                    	if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } 

					}else{

						foreach($value['options'] as $mc_key => $mc_value){

							$up_opt = $value['id'].'_'.$mc_key;						

							if( isset( $_REQUEST[ $up_opt ] ) ) { update_option( $up_opt, $_REQUEST[ $up_opt ]  ); } else { delete_option( $up_opt ); } 

						}

					}

				}

						

				header("Location: themes.php?page=functions.php&saved=true");

			

			die;



		} else if ( isset($_REQUEST['action']) && 'reset' == $_REQUEST['action'] ) {

            foreach ($options as $value) {

            delete_option( $value['id'] );

            }

			

			header("Location: themes.php?page=functions.php&reset=true");

			die;

		}



	}



add_theme_page($themename." Options", $themename." Options", 'edit_theme_options', basename(__FILE__), 'woothemes_page');



}



function woothemes_page (){



		global $options, $themename, $manualurl;



		?>



<div class="wrap">



    			<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">



						<h2><?php echo $themename; ?> Options</h2>



						<?php if ( isset($_REQUEST['saved']) && $_REQUEST['saved'] ) { ?><div style="clear:both;height:20px;"></div><div class="warning"><?php echo $themename; ?>'s Options has been updated!</div><?php } ?>

						<?php if ( isset($_REQUEST['reset']) && $_REQUEST['reset'] ) { ?><div style="clear:both;height:20px;"></div><div class="warning"><?php echo $themename; ?>'s Options has been reset!</div><?php } ?>						

						

						<div style="clear:both;height:20px;"></div>

						

						<div class="info">

						

							<div style="width: 70%; float: left; display: inline;padding-top:4px;"><strong>Stuck on these options?</strong> <a href="<?php echo $manualurl; ?>" target="_blank">Read The Documentation Here</a> or <a href="http://forum.woothemes.com" target="blank">Visit Our Support Forum</a></div>

							<div style="width: 30%; float: right; display: inline;text-align: right;"><input name="save" type="submit" value="Save changes" /></div>

							<div style="clear:both;"></div>

						

						</div>	    			

						

						<!--START: GENERAL SETTINGS-->

     						

     						<table class="maintable">

     							

							<?php foreach ($options as $value) { ?>

	

									<?php if ( $value['type'] <> "heading" ) { ?>

	

										<tr class="mainrow">

										<td class="titledesc"><?php echo $value['name']; ?></td>

										<td class="forminp">

		

									<?php } ?>		 

	

									<?php

										

										switch ( $value['type'] ) {

										case 'text':

		

									?>

									

		        							<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option($value['id']); } else { echo $value['std']; } ?>" />

		

									<?php

										

										break;

										case 'select':

		

									?>

		

	            						<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">

	                					<?php foreach ($value['options'] as $option) { ?>

	                						<option<?php if ( get_option( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option>

	                					<?php } ?>

	            						</select>

		

									<?php

		

										break;

										case 'textarea':

										$ta_options = $value['options'];

		

									?>

									

<textarea name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" cols="<?php echo $ta_options['cols']; ?>" rows="8"><?php  if( get_option($value['id']) != "") { echo stripslashes(get_option($value['id'])); } else { echo $value['std']; } ?></textarea>



									<?php

										

										break;

										case "radio":

		

 										foreach ($value['options'] as $key=>$option) { 

				

													$radio_setting = get_option($value['id']);

													

													if($radio_setting != '') {

		    											

		    											if ($key == get_option($value['id']) ) { $checked = "checked=\"checked\""; } else { $checked = ""; }

													

													} else {

													

														if($key == $value['std']) { $checked = "checked=\"checked\""; } else { $checked = ""; }

									} ?>

									

	            					<input type="radio" name="<?php echo $value['id']; ?>" value="<?php echo $key; ?>" <?php echo $checked; ?> /><?php echo $option; ?><br />

		

									<?php }

		 

										break;

										case "checkbox":

										

										if(get_option($value['id'])) { $checked = "checked=\"checked\""; } else { $checked = ""; }

									

									?>

		            				

		            				<input type="checkbox" class="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />

		

									<?php

		

										break;

										case "multicheck":

		

 										foreach ($value['options'] as $key=>$option) {

 										

	 											$woo_key = $value['id'] . '_' . $key;

												$checkbox_setting = get_option($woo_key);

				

 												if($checkbox_setting != '') {

		    		

		    											if (get_option($woo_key) ) { $checked = "checked=\"checked\""; } else { $checked = ""; }

				

												} else { if($key == $value['std']) { $checked = "checked=\"checked\""; } else { $checked = ""; }

				

									} ?>

									

	            					<input type="checkbox" class="checkbox" name="<?php echo $woo_key; ?>" id="<?php echo $woo_key; ?>" value="true" <?php echo $checked; ?> /><label for="<?php echo $woo_key; ?>"><?php echo $option; ?></label><br />

									

									<?php }

		 

										break;

										case "heading":



									?>

									

										</table> 

		    							

		    									<h3 class="title"><?php echo $value['name']; ?></h3>

										

										<table class="maintable">

		

									<?php

										

										break;

										default:

										break;

									

									} ?>

	

									<?php if ( $value['type'] <> "heading" ) { ?>

	

										<?php if ( $value['type'] <> "checkbox" ) { ?><br/><?php } ?><span><?php echo $value['desc']; ?></span>

										</td></tr>

	

									<?php } ?>		

	

							<?php } ?>	

							

							</table>	



							<p class="submit">

								<input name="save" type="submit" value="Save changes" />

								<input type="hidden" name="action" value="save" />

							</p>





							<div style="clear:both;"></div>



						<!--END: GENERAL SETTINGS-->



            </form>

            <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">

              <p class="submit">

								<input name="reset" type="submit" value="Reset changes" />

								<input type="hidden" name="action" value="reset" />

							</p>

            </form>



</div><!--wrap-->



<div style="clear:both;height:20px;"></div>

 

 <?php



};



function woothemes_wp_head() {

     $stylesheet = get_option('woo_alt_stylesheet');

     if ($stylesheet == '') { ?>

     <link href="<?php bloginfo('template_directory'); ?>/styles/default.css" rel="stylesheet" type="text/css" />

     <?php } else {  ?>

     <link href="<?php bloginfo('template_directory'); ?>/styles/<?php echo $stylesheet; ?>" rel="stylesheet" type="text/css" />

     <?php

     }

}



add_action('wp_head', 'woothemes_wp_head');

add_action('admin_menu', 'woothemes_add_admin');

add_action('admin_head', 'woothemes_admin_head');	



?>
