<?php
if (!defined('SHOW_AUTHORS')) define('SHOW_AUTHORS', 'true');
if (!defined('TEMPLATE_DOMAIN')) define('TEMPLATE_DOMAIN', 'colorspacer');
////////////////////////////////////////////////////////////////////////////////
// load text domain
////////////////////////////////////////////////////////////////////////////////

// Uncomment this to test your localization, make sure to enter the right language code.

//function test_localization( $locale ) {
//return "fr_FR";
//}
//add_filter('locale','test_localization');


load_theme_textdomain('colorpaper', TEMPLATEPATH . '/languages/');


////////////////////////////////////////////////////////////////////////////////
// new thumbnail code for wp 2.9+
////////////////////////////////////////////////////////////////////////////////
if ( function_exists( 'add_theme_support' ) ) { // Added in 2.9
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 80, 80, true ); // Normal post thumbnails
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


<li <?php comment_class('clearfix'); ?> id="comment-<?php comment_ID(); ?>">
<div class="comment-author">
<?php if (function_exists('avatar_display_comments')) { ?>
<?php avatar_display_comments(get_comment_author_email(),'56',''); ?>
<?php } else { ?>
<?php if (function_exists('get_avatar')) { echo get_avatar( get_comment_author_email() , 56 ); } ?>
<?php } ?>
<span class="<?php echo $style; ?> weight-bold verdana block large"><?php comment_author_link() ?></span>
<span class="small verdana light"><?php _e('on', 'colorpaper'); ?> <?php comment_date('F jS, Y') ?></span>

</div>

				<div class="comment-text">

					<?php if ($comment->comment_approved == '0') : ?>

						<em class="light"><?php _e('Your comment is awaiting moderation.', 'colorpaper'); ?></em>

					<?php endif; ?>



					<span class="medium">
                    <?php comment_text() ?>
                    <p><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></p>
                    </span>

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








if ( function_exists('register_sidebar') )

    register_sidebar(array(

        'before_widget' => '<li id="%1$s" class="widget %2$s">',

        'after_widget' => '</li>',

        'before_title' => '<h5 class="widgettitle">',

        'after_title' => '</h5>',

    ));

	



/* 00 - SIDEBAR WIDGETS

/* ----------------------------------------------*/



function get_popular($limit = 7) {

	global $wpdb;

	

	$getposts = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_type = 'post' ORDER BY comment_count DESC LIMIT 0,".$limit);	

	foreach($getposts as $thepost) {

		echo '<li><a href="'.get_permalink($thepost->ID).'">'.$thepost->post_title.'</a></li>';

	}

}



/*

function get_comments($limit = 7, $stops = 65) {

	global $wpdb;



	$getcomments = $wpdb->get_results("SELECT * FROM $wpdb->comments WHERE comment_approved = '1' ORDER BY comment_date DESC LIMIT 0,".$limit);

	

	foreach($getcomments as $thecomments) {

		if ( strlen ( $thecomments->comment_content ) <= $stops ) {

			$comment = $thecomments->comment_content;

		} else {

			$comment = substr($thecomments->comment_content, 0, strrpos(substr($thecomments->comment_content, 0, $stops), ' ')) . '...';

		}

		

		echo '<li><a href="'.get_permalink($thecomments->comment_post_ID).'"><span class="light"><strong>'.$thecomments->comment_author.'</strong> said </span> '.$comment.'</a></li>';

	}

}

*/



function get_featured ($category) {

	query_posts('category_name='.$category); if (have_posts()) : while (have_posts()) : the_post();

		echo'<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';

	endwhile; endif;

}



function get_recent($limit) {

	query_posts('showposts='.$limit); if (have_posts()) : while (have_posts()) : the_post();

		echo'<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';

	endwhile; endif;

}



/* 00 - POST OFFSET

/* ----------------------------------------------*/



function my_post_limit($limit) { 

	global $paged, $myOffset;

	

	if (empty($paged)) {

			$paged = 1;

	}

	

	$postperpage = intval(get_option('posts_per_page'));

	$pgstrt = ( ( intval( $paged ) -1 ) * $postperpage ) + $myOffset . ', ';

	$limit = 'LIMIT '.$pgstrt.$postperpage;

	return $limit;

}



function total_pages() {

	global $wpdb;

	$mySearch = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_type = 'post' and post_status = 'publish'");

	

	$count = 0;

	

	foreach($mySearch as $post) {

		$count++;

	}



	$postperpage = intval(get_option('posts_per_page'));

	

	$NumResults = ceil(($count) / $postperpage );

	echo $NumResults;

}



/* 00 - CUSTOM THEME OPTIONS

/* ----------------------------------------------*/



$themename = "Color Paper";



$cats_array = get_categories('hide_empty=0');

$categories = array();



foreach ($cats_array as $cats) {

	$categories[$cats->cat_ID] = $cats->cat_name;

}



$options = array (

	array(

		"type" => "section",

		"name" => "General Options"),

	array(

		"name" => "About Message",

		"id" => "about_message",

		"type" => "textarea",

		"std" => "About me. Edit this in the options panel.",

		"description" => "The message that will show on the right sidebar. Leave blank to disclude it from the sidebar. <strong>HTML is allowed</strong>."),

	/*array(

		"type" => "section",

		"name" => "AJAX Tabs (Requires v. 2.6.2)"),

	array(

		"name" => "Popular Limit",

		"id" => "popular_limit",

		"type" => "select",

		"std" => "7",

		"options" => array("1", "2", "3", "4", "5", "6", "7", "8", "9", "10"),

		"description" => "Number of popular articles to show in the AJAX tab box. <strong>Requires WordPress Version 2.6.2</strong>"),

	array(

		"name" => "Comments Limit",

		"id" => "comments_limit",

		"type" => "select",

		"std" => "7",

		"options" => array("1", "2", "3", "4", "5", "6", "7", "8", "9", "10"),

		"description" => "Number of recent comments to show in the AJAX tab box. <strong>Requires WordPress Version 2.6.2</strong>"),

	array(

		"name" => "Featured Category",

		"id" => "featured_cat",

		"type" => "select",

		"options" => $categories,

		"description" => "The name of the category to be featured in the AJAX tab box. <strong>Requires WordPress Version 2.6.2</strong>"),*/

	array(

		"type" => "section",

		"name" => "General Sidebar"),

	array(

		"name" => "Recent Limit",

		"id" => "recent_limit",

		"type" => "select",

		"std" => "6",

		"options" => array("1", "2", "3", "4", "5", "6", "7", "8", "9", "10"),

		"description" => "Number of recent post to show in the sidebar. (Does not display on homepage.)"),

	array(

		"name" => "Show Flickr Feed",

		"id" => "show_flickr",

		"type" => "select",

		"std" => "Yes",

		"options" => array("Yes", "No"),

		"description" => "Show the Sidebar Flickr Photo Stream?"),

	array(

		"name" => "Flickr Title",

		"id" => "flickr_title",

		"type" => "text",

		"std" => "Photo Stream",

		"description" => "Enter the title to appear above the Flickr Photo Stream"),

	array(

		"name" => "Flickr ID",

		"id" => "flickr_id",

		"type" => "text",

		"std" => "",

		"description" => "Your Flickr User ID"),

	array(

		"name" => "Flickr Stream Count",

		"id" => "flickr_count",

		"type" => "select",

		"std" => "6",

		"options" => array("3", "6", "9"),

		"description" => "Show the Sidebar Flickr Photo Stream?")

	/*array(

		"name" => "Sidebar Ad",

		"id" => "side_ad",

		"type" => "textarea",

		"std" => "",

		"description" => "Place any advertisement code here. <strong>HTML is allowed</strong>")*/

);



function theme_add_admin() {

	global $themename, $shortname, $options;



	if ( isset($_GET['page']) && $_GET['page'] == basename(__FILE__) ) {

    	if ( isset($_REQUEST['action']) && 'save' == $_REQUEST['action'] ) {

			foreach ($options as $value) {

				update_option( $value['id'], $_REQUEST[ $value['id'] ] ); 

			}

			

			foreach ($options as $value) {

				if( isset( $_REQUEST[ $value['id'] ] ) ) { 

					update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); 

				} else { 

					delete_option( $value['id'] ); 

				} 

			}

			

			header("Location: admin.php?page=functions.php&saved=true");

			

			die;



        } 

	}



	add_theme_page($themename." Options", $themename." Options", 'edit_theme_options', basename(__FILE__), 'theme_admin');



}



function theme_admin() {

	

	global $themename, $shortname, $options;



	if ( isset($_REQUEST['saved']) && $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';

    if ( isset($_REQUEST['reset']) && $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';

?>

		<div id="wpwrap">

			<div id="wpcontent">

				<div id="wpbody">

					<div class="wrap">

						<div id="poststuff">

							<form method="post">

								<div class="submitbox" id="submitlink">

									<div id="previewview">

										<span style="color:#FFFFFF; font-weight:bold;">Settings</span>

									</div>

									<div class="inside">

										<p>Modify the following settings to adjust the theme to your likings.</p>

									</div>

	

									<p class="submit">

										<input name="save" type="submit" value="Save changes" />    

										<input type="hidden" name="action" value="save" />

									</p>

								</div>

								

								<div id="post-body">

									<?php foreach ($options as $value) { ?>

										<?php if($value['type'] == "section") { ?>

											<h2><?php echo $value['name']; ?></h2>

										<?php } 

											switch ( $value['type'] ) {

											case 'text':

										?>

											<div id="namediv" class="stuffbox">

												<h3><label for="link_name"><?php echo $value['name']; ?></label></h3>

												<div class="inside">

													<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes( get_option( $value['id'] ) ); } else { echo stripslashes( $value['std'] ); } ?>" size="90" />

													<p><?php echo $value['description']; ?></p>

												</div>

											</div>

										<?php										

											break;

											case 'select' :

										?>

											<div id="namediv" class="stuffbox">

												<h3><label for="link_name"><?php echo $value['name']; ?></label></h3>

												<div class="inside">

													<select name="<?php echo $value['id']; ?>">

													<?php foreach ($value['options'] as $option) { ?>

                										<option<?php if ( get_option( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option>

                									<?php } ?>

													</select>

													<p><?php echo $value['description']; ?></p>

												</div>

											</div>

										<?php

											break;

											case 'textarea' :

										?>

											<div id="namediv" class="stuffbox">

												<h3><label for="link_name"><?php echo $value['name']; ?></label></h3>

												<div class="inside">

													<textarea cols="30" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" cols="90" rows="5"><?php if ( get_option( $value['id'] ) != "") { echo stripslashes( get_option( $value['id'] ) ); } else { echo stripslashes( $value['std'] ); } ?></textarea>

													<p><?php echo $value['description']; ?></p>

												</div>

											</div>

										<?php

											break;									

											}

										?>

									<?php } ?>

								</div>

							</form>

						</div>

					</div>

				</div>

			</div>

		</div>

<?php

}





global $options, $value;
foreach ($options as $value) {

	if (isset($value['id']) && isset($value['std']) && get_option( $value['id'] ) === FALSE) { 

		$$value['id'] = stripslashes( nl2br( $value['std'] ) ); 

	} else if (isset($value['id'])) {

		$$value['id'] = stripslashes( get_option( nl2br( $value['id'] ) ) ); 

	} 

}



$value = array();



add_action('admin_menu', 'theme_add_admin');



?>
