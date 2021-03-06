<?php
if (!defined('SHOW_AUTHORS')) define('SHOW_AUTHORS', 'true');
if (!defined('TEMPLATE_DOMAIN')) define('TEMPLATE_DOMAIN','oceanwide');
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
<?php } ?>&nbsp;&nbsp;<?php comment_author_link() ?></cite> <?php _e('Says',TEMPLATE_DOMAIN);?>:
			<?php if ($comment->comment_approved == '0') : ?>
			<em><?php _e('Your comment is awaiting moderation.',TEMPLATE_DOMAIN);?></em>
			<?php endif; ?>
			<br />

		<small class="commentmetadata">&nbsp;&nbsp;<a href="#comment-<?php comment_ID() ?>" title=""><?php comment_date('F jS, Y') ?> <?php _e('at',TEMPLATE_DOMAIN);?> <?php comment_time() ?></a> <?php edit_comment_link(__('Edit',TEMPLATE_DOMAIN),'&nbsp;&nbsp;',''); ?></small>

		<div id="commentbody"><?php comment_text() ?>
        <p><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></p>
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









if ( function_exists('register_sidebar') )

{
register_sidebar(array('name'=>'Sidebar 1'));
register_sidebar(array('name'=>'Sidebar 2'));

}



function wp_list_pages2($limit=NULL) {



	$defaults = array('depth' => 0, 'show_date' => '', 'date_format' => get_option('date_format'),

		'child_of' => 0, 'exclude' => '', 'title_li' =>'', 'echo' => 1, 'authors' => '', 'sort_column' => 'menu_order, post_title');

	$r = isset($r)?$r:array();
	$r = array_merge((array)$defaults, (array)$r);



	$output = '';

	$current_page = 0;



	// sanitize, mostly to keep spaces out

	$r['exclude'] = preg_replace('[^0-9,]', '', $r['exclude']);



	// Allow plugins to filter an array of excluded pages

	$r['exclude'] = implode(',', apply_filters('wp_list_pages_excludes', explode(',', $r['exclude'])));



	// Query pages.

	$pages = get_pages($r);



	if ( !empty($pages) ) {



		for($i=0;$i<count($pages);$i++)

		{

			$output .=' <li> <a href="'.get_page_link($pages[$i]->ID).'">'.$pages[$i]->post_title.'</a></li>';

			if($limit!=NULL)

			{

				break;

			}

		}

	}



	$output = apply_filters('wp_list_pages', $output);



	echo $output;

}

	

function get_sidebar_right() {

	do_action( 'get_sidebar' );

	if ( file_exists( TEMPLATEPATH . '/sidebar_right.php') )

		load_template( TEMPLATEPATH . '/sidebar_right.php');

	else

		load_template( ABSPATH . 'wp-content/themes/default/sidebar.php');

}



function wp_list_bookmarks2($order = 'name', $hide_if_empty = 'obsolete') {

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



			// Call get_bookmarks() with all the appropriate params

			get_bookmarks($cat->cat_ID, '<li>', "</li>", "\n", true, 'name', false);



		}

	}

}



///////////////////////////////////////////////////////////////////////////
//////////////////////////CUSTOM THEME OPTION//////////////////////////////
///////////////////////////////////////////////////////////////////////////

$themename = "oceanwide";
$shortname = "oc";

$options = array (


     array(	"name" => "Choose Your Global Body Font Size?",
			"id" => $shortname."_ow_global_body_font_size",
            "type" => "select",
            "inblock" => "css",
			"std" => "65%",
			"options" => array("65%","70%","75%","80%","85%","90%","100%")
            ),


     array(	"name" => "Choose Your Global Body Font?",
			"id" => $shortname."_ow_body_font",
            "type" => "select",
            "inblock" => "css",
			"std" => "Verdana, Arial, Times New Roman, sans-serif",
			"options" => array(
            "Verdana, Arial, Times New Roman, sans-serif",
            "Lucida Grande, Verdana, Tahoma, Trebuchet MS",
            "Arial, Verdana, Times New Roman, sans-serif",
            "Times New Roman, Georgia, Tahoma, Trajan Pro",
            "Georgia, Times New Roman, Helvetica, sans-serif",
            "Futura LT Book, Helvetica Neue, Tahoma, Georgia",
            "Tahoma, Lucida Sans, Arial",
            "Lucida Sans, Lucida Grande, Trebuchet MS",
            "Century Gothic, Century, Georgia, Times New Roman",
            "Arial Rounded MT Bold, Arial, Verdana, sans-serif",
            "Trebuchet MS, Arial, Verdana, Helvetica, sans-serif",
            "Futura-CondensedExtraBold-Norma, Arial Black, Tahoma",
            "Delicious Heavy, Georgia, Tahoma",
            "Delicious, Delicious Heavy, Decker, Denmark",
            "Helvetica Neue, Helvetica LT Std Cond, Helvetica-Normal",
            "Humana Sans ITC, Humana Sans Md ITC, Lucida Grande, Georgia",
            "Qlassik Bold, Qlassik Medium, Trebuchet MS, Tahoma, Arial"
            )
            ),

	array(	"name" => "Choose Your Global Headline Font",
			"id" => $shortname."_ow_headline_font",
            "type" => "select",
            "inblock" => "css",
            "std" => "Lucida Grande, Verdana, Tahoma, Trebuchet MS",
			"options" => array(
            "Lucida Grande, Verdana, Tahoma, Trebuchet MS",
            "Cambria, Georgia, Geneva, Verdana",
            "Arial, Verdana, Times New Roman, sans-serif",
            "Verdana, Arial, Times New Roman, sans-serif",
            "Times New Roman, Georgia, Tahoma, Trajan Pro",
            "Georgia, Times New Roman, Helvetica, sans-serif",
            "Futura LT Book, Helvetica Neue, Tahoma, Georgia",
            "Tahoma, Lucida Sans, Arial",
            "Lucida Sans, Lucida Grande, Trebuchet MS",
            "Century Gothic, Century, Georgia, Times New Roman",
            "Arial Rounded MT Bold, Arial, Verdana, sans-serif",
            "Trebuchet MS, Arial, Verdana, Helvetica, sans-serif",
            "Futura-CondensedExtraBold-Norma, Arial Black, Tahoma",
            "Delicious Heavy, Georgia, Tahoma",
            "Delicious, Delicious Heavy, Decker, Denmark",
            "Helvetica Neue, Helvetica LT Std Cond, Helvetica-Normal",
            "Humana Sans ITC, Humana Sans Md ITC, Lucida Grande, Georgia",
            "Qlassik Bold, Qlassik Medium, Trebuchet MS, Tahoma, Arial"
            )
            ),



    array(  "name" => "Enable Header Sitename Title?",
			"id" => $shortname."_ow_titlename_status",
            "inblock" => "header",
			"type" => "select",
            "std" => "yes",
			"options" => array("yes","no")),


    array(  "name" => "Header Title Background Colour <br />*<em>opacity active</em>",
			"id" => $shortname."_ow_title_background_trans_colour",
            "inblock" => "header",
			"type" => "text",
            "std" => "#33466E"),

    array(  "name" => "Header Site Description Colour",
			"id" => $shortname."_ow_titlename_text_colour",
            "inblock" => "header",
			"type" => "text",
            "std" => "#FFFFFF"),

    array(  "name" => "Header Sitename Title Colour",
			"id" => $shortname."_ow_titlename_sitename_colour",
            "inblock" => "header",
			"type" => "text",
            "std" => "#FFFFFF"),


    array(  "name" => "Header Sitename Title Size?",
			"id" => $shortname."_ow_titlename_size",
            "inblock" => "header",
			"type" => "select",
            "std" => "20px",
			"options" => array("20px","22px","24px","26px","28px","30px","32px","34px")),





    array(	"name" => "Your Desired Image Header Height *this will effect when cropping",
			"id" => $shortname."_ow_image_height",
            "inblock" => "css",
            "std" => "198",
			"type" => "text"),

    array(  "name" => "Do you want to use the images rotations? <br />*<em>size accepted 980 x <strong>your image height setting above</strong> or more</em>",
			"id" => $shortname."_ow_image_rotate_status",
            "inblock" => "rotator",
			"type" => "select",
            "std" => "no",
			"options" => array("no", "yes")),


    array(	"name" => "First Image Rotations <br />*<em>only effect if image rotate setting enable</em><br />*<em>External image url or internal image url accepted</em><br />*<em>You can upload image in write panel for internal image url</em>",
			"id" => $shortname."_ow_image_one",
            "inblock" => "rotator",
            "std" => "",
			"type" => "text"),

    array(	"name" => "Second Image Rotations",
			"id" => $shortname."_ow_image_two",
            "inblock" => "rotator",
            "std" => "",
			"type" => "text"),

    array(	"name" => "Third Image Rotations",
			"id" => $shortname."_ow_image_three",
            "inblock" => "rotator",
            "std" => "",
			"type" => "text"),

    array(	"name" => "Fourth Image Rotations",
			"id" => $shortname."_ow_image_four",
            "inblock" => "rotator",
            "std" => "",
			"type" => "text")


);

function mytheme_ow_admin() {
global $themename, $shortname, $options;
if ( isset($_REQUEST['saved']) && $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
if ( isset($_REQUEST['reset']) && $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';
?>




<div id="custom-wrap">
<div id="custom-container">
<form method="post" id="option-mz-form">

<div class="option-box">
<h5>Blog CSS Settings</h5>
<?php foreach ($options as $value) {
if (($value['inblock'] == "css") && ($value['type'] == "text")) { ?>

<div class="pwrap">
<p><?php echo $value['name']; ?>:</p>
<p><input name="<?php echo $value['id']; ?>" class="ops-select" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" /></p></div>

<?php } elseif (($value['inblock'] == "css") && ($value['type'] == "select")) { ?>

<div class="pwrap">
<p><?php echo $value['name']; ?>:</p>
<p><select name="<?php echo $value['id']; ?>" class="ops-select" id="<?php echo $value['id']; ?>">
<?php foreach ($value['options'] as $option) { ?>
<opti<?php _e('on');?> <?php if ( get_option( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option>
<?php } ?>
</select>
</p></div>

<?php } elseif (($value['inblock'] == "css") && ($value['type'] == "textarea")) { ?>

<div class="pwrap">
<p><?php echo $value['name']; ?>:</p>
<?php $valuex = $value['id'];
$valuey = stripslashes($valuex);
$video_code = get_option($valuey);
?>
<p><textarea name="<?php echo $valuey; ?>" cols="40%" rows="8" /><?php if ( get_option($valuey) != "") { echo stripslashes($video_code); } else { echo $value['std']; } ?></textarea>
</p></div>
<?php }

}
?>
</div>



<div class="option-box">
<h5>Blog Header Settings</h5>
<?php foreach ($options as $value) {
if (($value['inblock'] == "header") && ($value['type'] == "text")) { ?>

<div class="pwrap">
<p><?php echo $value['name']; ?>:</p>
<p><input name="<?php echo $value['id']; ?>" class="ops-select" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" /></p></div>

<?php } elseif (($value['inblock'] == "header") && ($value['type'] == "select")) { ?>

<div class="pwrap">
<p><?php echo $value['name']; ?>:</p>
<p><select name="<?php echo $value['id']; ?>" class="ops-select" id="<?php echo $value['id']; ?>">
<?php foreach ($value['options'] as $option) { ?>
<opti<?php _e('on');?> <?php if ( get_option( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option>
<?php } ?>
</select>
</p></div>

<?php } elseif (($value['inblock'] == "header") && ($value['type'] == "textarea")) { ?>

<div class="pwrap">
<p><?php echo $value['name']; ?>:</p>
<?php $valuex = $value['id'];
$valuey = stripslashes($valuex);
$video_code = get_option($valuey);
?>
<p><textarea name="<?php echo $valuey; ?>" cols="40%" rows="8" /><?php if ( get_option($valuey) != "") { echo stripslashes($video_code); } else { echo $value['std']; } ?></textarea>
</p></div>
<?php }

}
?>
</div>



<div class="option-box">
<h5>Blog Header Image Rotate Settings</h5>
<?php foreach ($options as $value) {
if (($value['inblock'] == "rotator") && ($value['type'] == "text")) { ?>

<div class="pwrap">
<p><?php echo $value['name']; ?>:</p>
<p><input name="<?php echo $value['id']; ?>" class="ops-select" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" /></p></div>

<?php } elseif (($value['inblock'] == "rotator") && ($value['type'] == "select")) { ?>

<div class="pwrap">
<p><?php echo $value['name']; ?>:</p>
<p><select name="<?php echo $value['id']; ?>" class="ops-select" id="<?php echo $value['id']; ?>">
<?php foreach ($value['options'] as $option) { ?>
<opti<?php _e('on');?> <?php if ( get_option( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option>
<?php } ?>
</select>
</p></div>

<?php } elseif (($value['inblock'] == "rotator") && ($value['type'] == "textarea")) { ?>

<div class="pwrap">
<p><?php echo $value['name']; ?>:</p>
<?php $valuex = $value['id'];
$valuey = stripslashes($valuex);
$video_code = get_option($valuey);
?>
<p><textarea name="<?php echo $valuey; ?>" cols="40%" rows="8" /><?php if ( get_option($valuey) != "") { echo stripslashes($video_code); } else { echo $value['std']; } ?></textarea>
</p></div>
<?php }

}
?>
</div>

<p class="submit">
<input name="save" type="submit" class="saveme" value="Save changes" />
<input type="hidden" name="action" value="save" />
</p>
</form>

<form method="post">
<p class="submit">
<input name="reset" type="submit" class="saveme" value="<?php _e('Reset')?>" />
<input type="hidden" name="action" value="reset" />
</p>
</form>
</div>
 </div>


<?php
}

function mytheme_add_ow_admin() {
global $themename, $shortname, $options;
if ( isset($_GET['page']) && $_GET['page'] == basename(__FILE__) ) {
if ( isset($_REQUEST['action']) && 'save' == $_REQUEST['action'] ) {
foreach ($options as $value) {
update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }
foreach ($options as $value) {
if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }
header("Location: themes.php?page=functions.php&saved=true");
die;
} else if( isset($_REQUEST['action']) && 'reset' == $_REQUEST['action'] ) {
foreach ($options as $value) {
delete_option( $value['id'] ); }
header("Location: themes.php?page=functions.php&reset=true");
die;
}
}
add_theme_page($themename." Options", "Blog Options", 'edit_theme_options', basename(__FILE__), 'mytheme_ow_admin');
}



////////////////////////////////////////////////////////////////////////////////
// add theme cms pages
////////////////////////////////////////////////////////////////////////////////

function mytheme_wp_ow_head() { ?>
<link href="<?php bloginfo('template_directory'); ?>/admin/ow-admin.css" rel="stylesheet" type="text/css" />
<?php }

add_action('admin_head', 'mytheme_wp_ow_head');
add_action('admin_menu', 'mytheme_add_ow_admin');







///////////////////////////////////////////////////////////////////////////
//////////////////////////CUSTOM HEADER CONFIG/////////////////////////////
///////////////////////////////////////////////////////////////////////////

$user_image_height = get_option('oc_ow_image_height');

if($user_image_height==''){$user_image_height='198';}else{$user_image_height = get_option('oc_ow_image_height'); }

define('HEADER_TEXTCOLOR', '');
define('HEADER_IMAGE', '%s/images/header_center_bg.png'); // %s is theme dir uri
define('HEADER_IMAGE_WIDTH', 980); //width is fixed
define('HEADER_IMAGE_HEIGHT', $user_image_height);
define( 'NO_HEADER_TEXT', true );

function oceanwide_admin_header_style() {
?>
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
<?php
}


function oceanwide_header_style() {
?>
<style type="text/css">

#header_center {
width: 970px;
height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
overflow: hidden;
float: left;
position: relative;
}
#header_center_original {
width: 970px;
height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
overflow: hidden;
float: left;
position: relative;
}
</style>
<?php
}


if ( function_exists('add_theme_support') ) {
	add_theme_support( 'custom-header', array('wp-head-callback' => 'oceanwide_header_style', 'admin-head-callback' => 'oceanwide_admin_header_style'));
}

function oceanwide_init() {
  wp_register_script('oceanwide-cycle', get_bloginfo('stylesheet_directory').'/js/cycle.js', array('jquery'), '1.0', false);
}
add_action('init', 'oceanwide_init');

function oceanwide_wp_enqueue_scripts() {
  wp_enqueue_script('oceanwide-cycle');
}
add_action('wp_enqueue_scripts', 'oceanwide_wp_enqueue_scripts');
