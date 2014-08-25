<?php
define('TEMPLATE_DOMAIN', 'dixi');
define('EDITOR_BG_ENABLE', 'no'); //should be yes or no...
define('USE_NEW_COMMENT_FORM','no');
////////////////////////////////////////////////////////////////////////////////
// load text domain
////////////////////////////////////////////////////////////////////////////////
load_theme_textdomain( TEMPLATE_DOMAIN, TEMPLATEPATH . '/languages/' );

///////////////////////////////////////////////////////////////////////////////
// Load Theme Styles and Javascripts
///////////////////////////////////////////////////////////////////////////////
/*---------------------------load styles--------------------------------------*/
if ( ! function_exists( 'devtheme_load_styles' ) ) :
function devtheme_load_styles() {
global $theme_version, $bp_existed;
wp_enqueue_style( 'dev-base', get_template_directory_uri() . '/lib/css/base.css', array(), $theme_version );


if($bp_existed):
wp_enqueue_style( 'dev-bp-base', get_template_directory_uri() . '/_inc/css/bp-default.css', array( 'dev-base' ), $theme_version );
wp_enqueue_style( 'dev-bp-css', get_template_directory_uri() . '/lib/css/bp-css.css', array( 'dev-base' ), $theme_version );
wp_enqueue_style( 'dev-bp-adminbar', get_template_directory_uri() . '/_inc/css/adminbar.css', array( 'dev-base' ), $theme_version );
endif;

/*if( is_rtl() ):
wp_enqueue_style( 'dev-rtl', get_template_directory_uri() . '/lib/css/rtl.css', array( 'dev-base' ), $theme_version );
endif;*/

if( file_exists( TEMPLATEPATH . '/lib/css/custom.css' ) ):
wp_enqueue_style( 'dev-custom', get_template_directory_uri() . '/lib/css/custom.css', array( 'dev-base' ), $theme_version );
endif;

// If the current theme is a child theme, enqueue its stylesheet
if ( is_child_theme() && 'wpmu-dixi' == get_template() ) {
if( file_exists( STYLESHEETPATH . '/lib/css/child-style.css' ) ):
wp_enqueue_style( 'dev-base-child', get_stylesheet_directory_uri() . '/lib/css/child-style.css', array( 'dev-base' ), $theme_version );
endif;
}

?>

<?php
}
endif;
add_action( 'wp_enqueue_scripts', 'devtheme_load_styles' );

/*---------------------------load js scripts--------------------------------------*/
if ( ! function_exists( 'devtheme_load_scripts' ) ) :
function devtheme_load_scripts() {
global $theme_version, $bp_existed;
wp_enqueue_script("jquery");
wp_enqueue_script('dev-dropmenu-js', get_template_directory_uri() . '/lib/scripts/dropmenu.js', array( 'jquery' ), $theme_version );
wp_enqueue_script('modernizr', get_template_directory_uri() . '/lib/scripts/modernizr.js', array("jquery"), $theme_version );
wp_enqueue_script('wpmudev-theme-js', get_template_directory_uri() . '/lib/scripts/wpmudev-theme.js', array("jquery"), $theme_version );
if ( is_singular() && get_option( 'thread_comments' ) && comments_open() ) wp_enqueue_script( 'comment-reply' );
}
endif;
add_action( 'wp_enqueue_scripts', 'devtheme_load_scripts' );



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


////////////////////////////////////////////////////////////////////////////////
// browser detect
///////////////////////////////////////////////////////////////////
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

function wp_add_css_ie_tweak() {
global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
if($is_IE) { ?>
<?php print "<style type='text/css' media='screen'>"; ?>
.picture-activity-thumb { width: 100px; height: 100px; display: block; }
img.feat-thumb { width: auto; max-width: 600px; height: auto; }
<?php print "</style>"; ?>
<?php }
}
add_action('wp_head','wp_add_css_ie_tweak');

////////////////////////////////////////////////////////////////////////////////
// Get Featured Post Image
////////////////////////////////////////////////////////////////////////////////
function wp_custom_post_thumbnail($the_post_id='', $with_wrap='', $wrap_w='', $wrap_h='', $title='', $fetch_size='',$fetch_w='', $fetch_h='',$alt_class='') {
// do global first
global $wpdb, $post, $posts;
$detect_post_id = $the_post_id;
if($with_wrap == 'yes') {
$before_wrap = "<div style='width: $wrap_w; height: $wrap_h; overflow: hidden;'>";
$after_wrap = "</div>";
}
?>

<a href="<?php echo the_permalink(); ?>">

<?php if(get_the_post_thumbnail() != "") : ?>

<?php
$image_id = get_post_thumbnail_id();
if($fetch_size == 'original') {
$image_url = wp_get_attachment_image_src($image_id,'large');
} else {
$image_url = wp_get_attachment_image_src($image_id,array($fetch_w,$fetch_h));
}
$image_url = $image_url[0];
?>
<?php echo $before_wrap; ?>
<img width="<?php echo $fetch_w; ?>" height="auto" class="feat-post-thumbnail <?php echo $alt_class; ?>" title="<?php the_title(); ?>" alt="" src="<?php echo $image_url; ?>">
<?php echo $after_wrap; ?>


<?php else: ?>

<?php
$images = get_children(array(
'post_parent' => $the_post_id,
'post_type' => 'attachment',
'numberposts' => 1,
'post_mime_type' => 'image')); ?>
<?php if ($images) : ?>
<?php foreach($images as $image) :
if($fetch_size == 'original') {
$attachment= wp_get_attachment_image_src($image->ID,'large');
} else {
$attachment= wp_get_attachment_image_src($image->ID, array($fetch_w,$fetch_h));
} ?>
<?php echo $before_wrap; ?>
<img width="<?php echo $fetch_w; ?>" height="auto" class="feat-post-attachment <?php echo $alt_class; ?>" title="<?php the_title(); ?>" alt="" src="<?php echo $attachment[0]; ?>">
<?php echo $after_wrap; ?>
<?php endforeach; ?>


<?php elseif( !$images ): ?>

<?php
$get_post_attachment = $wpdb->get_var("SELECT guid FROM " . $wpdb->prefix . "posts WHERE post_parent = '" . $detect_post_id . "' AND post_type = 'attachment' ORDER BY menu_order ASC LIMIT 1");
// If images exist for this page

if($get_post_attachment) {  ?>
<img width="<?php echo $fetch_w; ?>" height="auto" class="feat-post-wp <?php echo $alt_class; ?>" title="<?php the_title(); ?>" alt="" src="<?php echo $get_post_attachment; ?>">

<?php } else { ?>

<?php
$first_img = '';
ob_start();
ob_end_clean();
$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
$first_img = $matches[1][0]; ?>

<?php if($first_img) { ?>
<?php echo $before_wrap; ?>
<img width="<?php echo $fetch_w; ?>" height="auto" class="feat-post-regex <?php echo $alt_class; ?>" title="<?php the_title(); ?>" alt="" src="<?php echo $first_img; ?>">
<?php echo $after_wrap; ?>
<?php } ?>

<?php } ?>

<?php endif; ?>

<?php endif; ?>

</a>

<?php }


///////////////////////////////////////////////////////////////////////////
// Custom footer code
///////////////////////////////////////////////////////////////////////////
function wp_network_footer() {
global $blog_id, $current_site, $current_blog;
if( is_multisite() ) {
$current_site = get_current_site();
$current_network_site = get_current_site_name(get_current_site());

if ( function_exists( 'bp_exists' ) ) {
$current_network_domain = bp_get_root_domain();
} else {
if(function_exists('network_home_url')) {
$current_network_domain = network_home_url();
} else {
$current_network_domain = 'http://' . $current_site->domain . $current_site->path;
}
}

if( BLOG_ID_CURRENT_SITE != $current_blog->blog_id && BP_ROOT_BLOG != $current_blog->blog_id ) { ?>
<?php _e('Hosted by', TEMPLATE_DOMAIN); ?> <a target="_blank" title="<?php echo $current_network_site->site_name; ?>" href="<?php echo $current_network_domain; ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?>

<?php
}
}

////////////////////////////////////////////////////////////////////////////////
// new code for wp 3.0+
////////////////////////////////////////////////////////////////////////////////
if ( function_exists( 'add_theme_support' ) ) { // Added in 2.9
    add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 200, 150, true ); // Normal post thumbnails
	add_image_size( 'single-post-thumbnail', 600, 9999 ); // Permalink thumbnail size

    // Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

    if(EDITOR_BG_ENABLE == 'yes') {
    // This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();
    }

    if ( ! isset( $content_width ) ) $content_width = 600;
    }


if ( function_exists( 'register_nav_menus' ) ) {
    add_theme_support( 'menus' ); // new nav menus for wp 3.0
    // This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
    'main-nav' => __( 'Main Navigation',TEMPLATE_DOMAIN )
	) );

///////////////////////////////////////////////////////////////////////////////
// custom walker nav for mobile navigation
///////////////////////////////////////////////////////////////////////////////
class description_custom_walker extends Walker_Nav_Menu {
function start_el(&$output, $item, $depth, $args) {
           global $wp_query;
           $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
           $class_names = $value = '';
           $classes = empty( $item->classes ) ? array() : (array) $item->classes;
           $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
           $class_names = ' class="'. esc_attr( $class_names ) . '"';
           $output .= $indent . '';
           $prepend = '';
           $append = '';
//$description  = ! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';

           if($depth != 0) { $description = $append = $prepend = ""; }
           $item_output = $args->before;
           $item_output .= "<option value='" . $item->url . "'>" . $item->title . "</option>";
           $item_output .= $args->after;

           $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
           }
}



function bp_wp_custom_mobile_nav_menu($get_custom_location='', $get_default_menu=''){
$options = array('walker' => new description_custom_walker(), 'theme_location' => "$get_custom_location", 'menu_id' => '', 'echo' => false, 'container' => false, 'container_id' => '', 'fallback_cb' => "$get_default_menu");
$menu = wp_nav_menu($options);
$menu_list = preg_replace( array( '#^<ul[^>]*>#', '#</ul>$#' ), '', $menu );
return $menu_list;
}

///////////////////////////////////////////////////////////////////////////////
// remove open ul to fit the custom bp navigation.php
///////////////////////////////////////////////////////////////////////////////
function bp_wp_custom_nav_menu($get_custom_location='', $get_default_menu=''){
$options = array('theme_location' => "$get_custom_location", 'menu_id' => '', 'echo' => false, 'container' => false, 'container_id' => '', 'fallback_cb' => "$get_default_menu");
$menu = wp_nav_menu($options);
$menu_list = preg_replace( array( '#^<ul[^>]*>#', '#</ul>$#' ), '', $menu );
return $menu_list;
}


function revert_wp_menu_page($args) { //revert back to normal if in wp 3.0 and menu not set
global $bp, $bp_existed;
	$pages_args = array(
		'depth'      => 0,
		'echo'       => false,
		'exclude'    => '',
		'title_li'   => ''
	);
	$menu = wp_page_menu( $pages_args );
	$menu = str_replace( array( '<div class="menu"><ul>', '</ul></div>' ), array( '', '' ), $menu );
	echo $menu;
    if($bp_existed):
    do_action( 'bp_nav_items' );
    endif;
 ?>
<?php }

if ( !function_exists( 'wp_dtheme_page_menu_args' ) ) :
function wp_dtheme_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'wp_dtheme_page_menu_args' );
endif;



function revert_wp_mobile_menu_page() {
global $wpdb;
$qpage = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "posts WHERE post_type='page' AND post_status='publish' ORDER by ID");
foreach ($qpage as $ipage ) {
echo "<option value='" . get_permalink( $ipage->ID ) . "'>" . $ipage->post_title . "</option>";
}
}

function revert_wp_menu_cat() { //revert back to normal if in wp 3.0 and menu not set ?>
<?php wp_list_categories('orderby=id&show_count=0&use_desc_for_title=0&title_li='); ?>
<?php }
}  // end register_nav_menus check


function get_mobile_navigation($type='', $nav_name='') {
   $id = "{$type}-dropdown";
  $js =<<<SCRIPT
<script type="text/javascript">
 jQuery(document).ready(function($){
  $("select#{$id}").change(function(){
    window.location.href = $(this).val();
  });
 });
</script>
SCRIPT;
    echo $js;
  echo "<select name=\"{$id}\" id=\"{$id}\">";
  echo "<option>Where to?</option>"; ?>
<?php echo bp_wp_custom_mobile_nav_menu($get_custom_location=$nav_name, $get_default_menu='revert_wp_mobile_menu_page'); ?>
<?php echo "</select>"; }

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
if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'. __('Background settings reset.', TEMPLATE_DOMAIN) . '</strong></p></div>';
?>
<div class="wrap" id="custom-background">
<?php screen_icon(); ?>
<h2><?php _e('Preset Background', TEMPLATE_DOMAIN); ?></h2>
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
<p><?php _e("Custom Background must be empty in order for the <strong>Preset Background</strong> to work.",TEMPLATE_DOMAIN); ?><?php if( get_background_image() ) { ?><br /><?php _e("You have image uploaded in custom background",TEMPLATE_DOMAIN); ?>, <a href="<?php echo admin_url('/themes.php?page=custom-background'); ?>"><?php _e("remove the uploaded background",TEMPLATE_DOMAIN); ?></a> first<?php } ?></p>
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
<th scope="row"><?php _e( 'Position' , TEMPLATE_DOMAIN); ?></th>
<td><fieldset><legend class="screen-reader-text"><span><?php _e( 'Background Position', TEMPLATE_DOMAIN ); ?></span></legend>
<label>
<input name="cbackground-position-x" type="radio" value="left"<?php checked('left', get_theme_mod('cbackground-position-x', 'left')); ?> />
<?php _e('Left', TEMPLATE_DOMAIN) ?>
</label>
<label>
<input name="cbackground-position-x" type="radio" value="center"<?php checked('center', get_theme_mod('cbackground-position-x', 'center')); ?> />
<?php _e('Center', TEMPLATE_DOMAIN) ?>
</label>
<label>
<input name="cbackground-position-x" type="radio" value="right"<?php checked('right', get_theme_mod('cbackground-position-x', 'right')); ?> />
<?php _e('Right', TEMPLATE_DOMAIN) ?>
</label>
</fieldset></td>
</tr>

<tr valign="top">
<th scope="row"><?php _e( 'Repeat' , TEMPLATE_DOMAIN); ?></th>
<td><fieldset><legend class="screen-reader-text"><span><?php _e( 'Background Repeat', TEMPLATE_DOMAIN ); ?></span></legend>
<label><input type="radio" name="cbackground-repeat" value="no-repeat"<?php checked('no-repeat', get_theme_mod('cbackground-repeat', 'no-repeat')); ?> /> <?php _e('No Repeat', TEMPLATE_DOMAIN); ?></label>
	<label><input type="radio" name="cbackground-repeat" value="repeat"<?php checked('repeat', get_theme_mod('cbackground-repeat', 'repeat')); ?> /> <?php _e('Tile', TEMPLATE_DOMAIN); ?></label>
	<label><input type="radio" name="cbackground-repeat" value="repeat-x"<?php checked('repeat-x', get_theme_mod('cbackground-repeat', 'repeat-x')); ?> /> <?php _e('Tile Horizontally', TEMPLATE_DOMAIN); ?></label>
	<label><input type="radio" name="cbackground-repeat" value="repeat-y"<?php checked('repeat-y', get_theme_mod('cbackground-repeat', 'repeat-y')); ?> /> <?php _e('Tile Vertically', TEMPLATE_DOMAIN); ?></label>
</fieldset></td>
</tr>

<tr valign="top">
<th scope="row"><?php _e( 'Attachment', TEMPLATE_DOMAIN ); ?></th>
<td><fieldset><legend class="screen-reader-text"><span><?php _e( 'Background Attachment', TEMPLATE_DOMAIN ); ?></span></legend>
<label>
<input name="cbackground-attachment" type="radio" value="scroll" <?php checked('scroll', get_theme_mod('cbackground-attachment', 'scroll')); ?> />
<?php _e('Scroll', TEMPLATE_DOMAIN) ?>
</label>
<label>
<input name="cbackground-attachment" type="radio" value="fixed" <?php checked('fixed', get_theme_mod('cbackground-attachment', 'fixed')); ?> />
<?php _e('Fixed', TEMPLATE_DOMAIN) ?>
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
add_theme_page(_g (__('Preset Background Image', TEMPLATE_DOMAIN)),  _g (__('Preset Background Image', TEMPLATE_DOMAIN)),  'edit_theme_options', 'preset-background.php', 'preset_background_images_init');
}

// Add support for custom backgrounds
add_theme_support( 'custom-background', array('wp-head-callback' => 'new_custom_background_cb') );
add_action('admin_head','default_background_images_css');
if(is_dir($handle_path)) {
add_action('admin_menu','add_preset_bg_init');
}
} //end check



///////////////////////////////////////////////////////////////////////////////
// fetch post img
//////////////////////////////////////////////////////////////////////////////
function custom_get_post_img ($the_post_id='', $width='', $height='', $size='') {
$detect_post_id = $the_post_id;

$images = get_children(array(
'post_parent' => $the_post_id,
'post_type' => 'attachment',
'numberposts' => 1,
'post_mime_type' => 'image'));
if ($images)
foreach($images as $image) {
$attachment = wp_get_attachment_image_src($image->ID, $size); ?>

<div class="alignleft" style="float: left; width: <?php echo $width; ?>px; height: <?php echo $height; ?>px; background: url(<?php echo $attachment[0]; ?>) no-repeat center center; overflow:hidden;"></div>

<?php
}
}


////////////////////////////////////////////////////////////////////////////////
// includes
////////////////////////////////////////////////////////////////////////////////
include( TEMPLATEPATH . '/lib/functions/conditional-functions.php' );
include( TEMPLATEPATH . '/lib/functions/widgets-functions.php' );


////////////////////////////////////////////////////////////////////////////////
// includes custom-function - rename _inc/functions/custom-functions-sample.php
////////////////////////////////////////////////////////////////////////////////
//include( TEMPLATEPATH . '/_inc/functions/custom-functions.php' );

//load buddypress default functions//
if($bp_existed == 'true') {
include( TEMPLATEPATH . '/bp-functions.php' );
include( TEMPLATEPATH . '/lib/functions/bp-component-functions.php' );

///////////////////////////////////////////////////////////////////////////////////
/// get username by id - buddypress only
///////////////////////////////////////////////////////////////////////////////////
function bp_get_username_by_id($id) {
global $wpdb, $bp;
$bp_get_the_username = $wpdb->get_var("SELECT user_nicename FROM " . $wpdb->base_prefix . "users WHERE ID = '" . $id . "'");
return $bp_get_the_username;
}

///////////////////////////////////////////////////////////////////////
/// check if is friend
///////////////////////////////////////////////////////////////////////
function bp_displayed_user_is_friend() {
global $bp;
$friend_privacy_enable = get_option('tn_wpmu_dixi_friend_privacy_status');
$friend_privacy_redirect = get_option('tn_wpmu_dixi_friend_privacy_redirect');

if($friend_privacy_enable == "enable") {
if ( bp_is_user_activity() || bp_is_user_profile() || bp_is_user() ) {
if ( ('is_friend' != BP_Friends_Friendship::check_is_friend( $bp->loggedin_user->id, $bp->displayed_user->id )) && (bp_loggedin_user_id() != bp_displayed_user_id()) ) {
if ( !is_super_admin( bp_loggedin_user_id() ) ) {
if($friend_privacy_redirect == '') {
bp_core_redirect( $bp->root_domain );
} else {
bp_core_redirect( $friend_privacy_redirect );
}
}
}
}
} //enable
}
add_filter('get_header','bp_displayed_user_is_friend',3);

///////////////////////////////////////////////////////////////
// check privacy
////////////////////////////////////////////////////////////////
function check_if_privacy_on() {
global $bp;
$privacy_enable = get_option('tn_wpmu_dixi_privacy_status');
$privacy_redirect = get_option('tn_wpmu_dixi_privacy_redirect');
if($privacy_enable == "enable") {
if ( bp_is_profile_component() || bp_is_activity_component() || bp_is_page( BP_MEMBERS_SLUG ) || bp_is_user() ) {
if(!is_user_logged_in()) {
if($privacy_redirect == '') {
bp_core_redirect( $bp->root_domain . '/' . bp_get_root_slug( 'register' ) );
} else {
bp_core_redirect( $privacy_redirect );
}
}
}
} //off
}
add_filter('get_header','check_if_privacy_on',1);

function check_if_create_group_limit() {
global $bp;
$create_limit_enable = get_option('tn_wpmu_dixi_create_group_status');
$create_limit_redirect = get_option('tn_wpmu_dixi_create_group_redirect');
if($create_limit_enable == "yes") {
if( bp_is_group_create() ) {
if ( current_user_can( 'delete_others_posts' ) ) { //only admins and editors
} else {
if( $create_limit_redirect == '' ) {
bp_core_redirect( $bp->root_domain . '/' );
} else {
bp_core_redirect( $create_limit_redirect );
}
}
}

} //off
}
add_filter('get_header','check_if_create_group_limit',2);

/////////////////////////////////////////////////////////////////////////////////////////////////////////
// additional hook on bp
//////////////////////////////////////////////////////////////////////////////////////////////////////////
/* Display Username in Directory */
function my_member_username() {
global $members_template;
return $members_template->member->user_login;
}
add_filter('bp_member_name','my_member_username');

//Add a View BuddyPress profile link in Dashboard >> Users
function user_row_actions_bp_view($actions, $user_object) {
global $bp;
$actions['view'] = '<a href="' . bp_core_get_user_domain($user_object->ID) . '">' . __('View BP', TEMPLATE_DOMAIN) . '</a>';
return $actions;
}
add_filter('user_row_actions', 'user_row_actions_bp_view', 10, 2);



///////////////////////////////////////////////////////////////////////
/// add like it facebook stream
///////////////////////////////////////////////////////////////////////
function add_stream_facebooklike_button() {
$permalink = bp_get_activity_thread_permalink();
if ( preg_match('#/p/(\d+)/?#i', $permalink, $matches) )
	$permalink = bp_get_activity_user_link() . bp_get_activity_slug() . '/' . $matches[1] . '/';
?>
<?php if(is_user_logged_in()) { ?>
<div style="margin: 14px 0px; float:left; width: 100%; clear:both;">
	<div class="fb-like" data-href="<?php echo $permalink ?>" data-send="false" data-width="450" data-show-faces="true"></div>
</div>
<?php } ?>
<?php }
$tn_wpmu_stream_facebook_like_status = get_option('tn_wpmu_dixi_stream_facebook_like_status');
if($tn_wpmu_stream_facebook_like_status == 'enable') {
add_action('bp_activity_entry_content', 'add_stream_facebooklike_button');
}



///////////////////////////////////////////////////////////////////////
/// add facebook root
///////////////////////////////////////////////////////////////////////
function add_facebook_root() {
	?>
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	<?php
}
$tn_wpmu_post_facebook_like_status = get_option('tn_wpmu_dixi_post_facebook_like_status');
if($tn_wpmu_stream_facebook_like_status == 'enable' || $tn_wpmu_post_facebook_like_status == 'enable') {
add_action('wp_footer', 'add_facebook_root');
}



///////////////////////////////////////////////////////////////////////
/// fetch specific groups
///////////////////////////////////////////////////////////////////////

function fetch_specific_groups($limit='', $size='', $type='', $block_id='') {
global $wpdb, $bp;
$specific_group_id = get_option('tn_blogsmu_home_feat_group_id');
$fetch_group = "SELECT * FROM " . $wpdb->base_prefix . "bp_groups WHERE id IN (" . $specific_group_id . ") ORDER BY id LIMIT $limit";
$sql_fetch_group = $wpdb->get_results($fetch_group); ?>
<div id="<?php echo $block_id; ?>" class="avatar-block">
<?php
$no_avatar = get_template_directory_uri() . '/_inc/images/default.png';
foreach($sql_fetch_group as $group) {
$avatar_full = bp_core_fetch_avatar( 'item_id=' . $group->id . '&class=avatar&object=group&type=' . $type . '&width=' . $size . '&height=' . $size );
$group_description = stripslashes($group->description);
?>
<div class="item-avatar"><a title="<?php echo $group->name . ' - ' . short_text($group_description, 150); ?>" href="<?php echo $bp->root_domain . '/' . bp_get_root_slug( 'groups' ) . '/' . $group->slug; ?>">
<?php echo $avatar_full; ?>
</a></div>
<?php } ?>
</div>
<?php }


///////////////////////////////////////////////////////////////////////
/// fetch random not friend
///////////////////////////////////////////////////////////////////////
function fetch_random_notfriend($limit=6, $size=120) {
global $wpdb, $bp, $friendList, $initiatorList;
$current_loggedin_user = $bp->loggedin_user->id;
$fetch_friend = "SELECT * FROM " . $wpdb->base_prefix . "bp_friends WHERE friend_user_id = '" . $current_loggedin_user . "' AND is_confirmed = '1' ORDER BY rand() LIMIT $limit";
$sql_fetch_friend = $wpdb->get_results($fetch_friend);
$fetch_initiator = "SELECT * FROM " . $wpdb->base_prefix . "bp_friends WHERE initiator_user_id = '" . $current_loggedin_user . "' AND is_confirmed = '1' ORDER BY rand() LIMIT $limit";
$sql_fetch_initiator = $wpdb->get_results($fetch_initiator); ?>
<ul id="random-groups">
<?php
if($sql_fetch_friend) {
foreach($sql_fetch_friend as $friend) {
$array_friend[] = $friend->initiator_user_id;
$friendList = implode(",",$array_friend);
}
}
if($sql_fetch_initiator) {
foreach($sql_fetch_initiator as $initiator) {
$array_initiator[] = $initiator->friend_user_id;
$initiatorList = implode(",",$array_initiator);
}
}
if($sql_fetch_friend && $sql_fetch_initiator) {
$listallfriend = $current_loggedin_user . ',' . $friendList . ',' . $initiatorList;
} else if (!$sql_fetch_friend) {
$listallfriend = $current_loggedin_user . ','  . $initiatorList;
} else if (!$sql_fetch_initiator) {
$listallfriend = $current_loggedin_user . ','  . $friendList;
} else if(!$sql_fetch_friend && !$sql_fetch_initiator) {
$listallfriend = $current_loggedin_user . ',9999999999999,99999999999999999999';
}

// echo $friendList;
$fetch_friend_step2 = "SELECT * FROM " . $wpdb->base_prefix . "users WHERE ID NOT IN ( "  . $listallfriend . ") ORDER BY rand() LIMIT $limit";
$sql_fetch_friend_step2 = $wpdb->get_results($fetch_friend_step2);
foreach($sql_fetch_friend_step2 as $fof) {
$avatar_full = bp_core_fetch_avatar( 'item_id=' . $fof->ID . '&class=av-border&object=user&type=full&width=' . $size . '&height=' . $size );
?>
<li><a title="<?php _e("add",TEMPLATE_DOMAIN); ?> <?php echo $fof->user_nicename; ?> <?php _e("as friend",TEMPLATE_DOMAIN); ?>" href="<?php echo $bp->root_domain . '/' . bp_get_root_slug( 'members' ) . '/' . strtolower( $fof->user_nicename ) . '/'; ?>">
<?php echo $avatar_full; ?>
</a></li>
<?php } ?>
</ul>
<?php }
/////////////////////////////////////////////////////////////////////////////////////////////////////////
// end
////////////////////////////////////////////////////////////////////////////////////////////////////////

} // end $bp_existed checked

function add_post_facebooklike_button() { ?>
<div class="fb-like" data-href="<?php the_permalink() ?>" data-send="false" data-width="300" data-show-faces="true"></div>
<?php }
$tn_wpmu_post_facebook_like_status = get_option('tn_wpmu_dixi_post_facebook_like_status');
if($tn_wpmu_post_facebook_like_status == 'enable') {
add_action('bp_after_post_content', 'add_post_facebooklike_button');
}


///////////////////////////////////////////////////////////////
// single wp adminbar css
////////////////////////////////////////////////////////////////

/* original code from jonas john */
if( !function_exists('colourCreator') ) {
function colourCreator($colour, $per)
{
    $colour = substr( $colour, 1 ); // Removes first character of hex string (#)
    $rgb = ''; // Empty variable
    $per = $per/100*255; // Creates a percentage to work with. Change the middle figure to control colour temperature

    if  ($per < 0 ) // Check to see if the percentage is a negative number
    {
        // DARKER
        $per =  abs($per); // Turns Neg Number to Pos Number
        for ($x=0;$x<3;$x++)
        {
            $c = hexdec(substr($colour,(2*$x),2)) - $per;
            $c = ($c < 0) ? 0 : dechex($c);
            $rgb .= (strlen($c) < 2) ? '0'.$c : $c;
        }
    }
    else
    {
        // LIGHTER
        for ($x=0;$x<3;$x++)
        {
            $c = hexdec(substr($colour,(2*$x),2)) + $per;
            $c = ($c > 255) ? 'ff' : dechex($c);
            $rgb .= (strlen($c) < 2) ? '0'.$c : $c;
        }
    }
    return '#'.$rgb;
}
         }

if( !is_multisite() ) {

function buddypress_single_adminbar_css() {
$ms_bg = get_option('tn_wpmu_dixi_adminbar_bg_color');
$ms_hover_bg = get_option('tn_wpmu_dixi_adminbar_hover_bg_color');
?>
<?php if( $ms_bg ) { print "<style type='text/css'>"; ?>
div#wp-admin-bar, div#wpadminbar { z-index: 9999; background: <?php echo $ms_bg; ?> none !important; }
div#wpadminbar .quicklinks > ul > li { border-right: 1px solid <?php echo colourCreator($ms_bg,-20); ?> !important; }
#wpadminbar .quicklinks > ul > li > a, #wpadminbar .quicklinks > ul > li > .ab-empty-item, #wpadminbar .quicklinks .ab-top-secondary > li a {
   border-right: 0px none !important;
   border-left: 0px none !important;
}
#wpadminbar .ab-top-secondary {
  background: <?php echo colourCreator($ms_bg,-10); ?> none !important;
}
#wpadminbar .quicklinks .ab-top-secondary > li {
  border-left: 1px solid <?php echo colourCreator($ms_bg,20); ?> !important;
  }

div#wp-admin-bar ul.main-nav li:hover, div#wp-admin-bar ul.main-nav li.sfhover, div#wp-admin-bar ul.main-nav li ul li.sfhover {
background: <?php echo $ms_hover_bg; ?> none !important; }
#wp-admin-bar .padder { background: transparent none !important; }
<?php print "</style>"; ?>
<?php } }

add_action('wp_enqueue_scripts', 'buddypress_single_adminbar_css'); // init global wp_head
add_action('admin_enqueue_scripts', 'buddypress_single_adminbar_css'); // init global admin_head

}



////////////////////////////////////////////////////////////////////////////////
// wp 2.7 wp_list_comment micro classes
////////////////////////////////////////////////////////////////////////////////

function comment_add_microid($classes) {
$c_email=get_comment_author_email();
$c_url=get_comment_author_url();
if (!empty($c_email) && !empty($c_url)) {
$microid = 'microid-mailto+http:sha1:' . sha1(sha1('mailto:'.$c_email).sha1($c_url));
$classes[] = $microid;
}
return $classes;
}
add_filter('comment_class','comment_add_microid');

////////////////////////////////////////////////////////////////////////////////
// wp 2.7 wp_list_pingback
////////////////////////////////////////////////////////////////////////////////

function list_pings($comment, $args, $depth) {
$GLOBALS['comment'] = $comment; ?>
<li id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?>
<?php }

////////////////////////////////////////////////////////////////////////////////
// wp 2.7 wp comment count
////////////////////////////////////////////////////////////////////////////////
add_filter('get_comments_number', 'comment_count', 0);
function comment_count( $count ) {
global $id;
$comments_by_split = get_comments('post_id=' . $id);
$comments_by_type = &separate_comments($comments_by_split);
return count($comments_by_type['comment']);
}

////////////////////////////////////////////////////////////////////////////////
// Short title
////////////////////////////////////////////////////////////////////////////////
function the_short_title(){ echo substr_replace(the_title('','',false),'...','40'); }

////////////////////////////////////////////////////////////////////////////////
// Comment and pingback separate controls
////////////////////////////////////////////////////////////////////////////////
$bm_trackbacks = array();
$bm_comments = array();
function split_comments( $source ) {
if ( $source ) foreach ( $source as $comment ) {
global $bm_trackbacks;
global $bm_comments;
if ( $comment->comment_type == 'trackback' || $comment->comment_type == 'pingback' ) {
$bm_trackbacks[] = $comment;
} else {
$bm_comments[] = $comment;
}
}
}

////////////////////////////////////////////////////////////////////////////////
// Most Comments
////////////////////////////////////////////////////////////////////////////////
function get_hottopics($limit) {
global $wpdb, $post;
$mostcommenteds = $wpdb->get_results("SELECT $wpdb->posts.ID, post_title, post_name, post_date, post_type, post_status, COUNT($wpdb->comments.comment_post_ID) AS 'comment_total' FROM $wpdb->posts LEFT JOIN $wpdb->comments ON $wpdb->posts.ID = $wpdb->comments.comment_post_ID WHERE comment_approved = '1' AND post_date_gmt < '".gmdate("Y-m-d H:i:s")."' AND post_status = 'publish' AND post_password = '' GROUP BY $wpdb->comments.comment_post_ID ORDER  BY comment_total DESC LIMIT $limit");
foreach ($mostcommenteds as $post) {
$post_title = htmlspecialchars(stripslashes($post->post_title));
$comment_total = (int) $post->comment_total;
echo "<li><a href=\"".get_permalink()."\">$post_title&nbsp;<strong>($comment_total)</strong></a></li>";
}
}

////////////////////////////////////////////////////////////////////////////////
// excerpt the_content()
////////////////////////////////////////////////////////////////////////////////
function custom_the_excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }
  $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
  return $excerpt;
}

function custom_the_content($limit) {
global $id, $post;
  $content = explode(' ', get_the_content(), $limit);
  if (count($content)>=$limit) {
    array_pop($content);
    $content = implode(" ",$content).'...';
  } else {
    $content = implode(" ",$content);
  }
  $content = preg_replace('/\[.+\]/','', $content);
  $content = apply_filters('the_content', $content);
  $content = str_replace(']]>', ']]&gt;', $content);
  $content = strip_tags($content, '<p>');
  return $content . "<p><a href=\"". get_permalink() . "#more-$id\">" . __('...Click here to read more &raquo;', TEMPLATE_DOMAIN) . "</a></p>";
}


////////////////////////////////////////////////////////////////////////////////
// WP-PageNavi
////////////////////////////////////////////////////////////////////////////////


function custom_wp_pagenavi($before = '', $after = '', $prelabel = '', $nxtlabel = '', $pages_to_show = 5, $always_show = false) {
	global $request, $posts_per_page, $wpdb, $paged;
	if(empty($prelabel)) {
		$prelabel  = '<strong>&laquo;</strong>';
	}
	if(empty($nxtlabel)) {
		$nxtlabel = '<strong>&raquo;</strong>';
	}
	$half_pages_to_show = round($pages_to_show/2);
	if (!is_single()) {
		if(!is_category()) {
			preg_match('#FROM\s(.*)\sORDER BY#siU', $request, $matches);
		} else {
			preg_match('#FROM\s(.*)\sGROUP BY#siU', $request, $matches);
		}
		$fromwhere = $matches[1];
		$numposts = $wpdb->get_var("SELECT COUNT(DISTINCT ID) FROM $fromwhere");
		$max_page = ceil($numposts /$posts_per_page);
		if(empty($paged)) {
			$paged = 1;
		}
		if($max_page > 1 || $always_show) {
			echo "$before <div class=\"wp-pagenavi\"><span class=\"pages\">Page $paged of $max_page:</span>";
			if ($paged >= ($pages_to_show-1)) {
				echo '<a href="'.get_pagenum_link().'">&laquo; First</a>';
			}
			previous_posts_link($prelabel);
			for($i = $paged - $half_pages_to_show; $i  <= $paged + $half_pages_to_show; $i++) {
				if ($i >= 1 && $i <= $max_page) {
					if($i == $paged) {
						echo "<strong class='current'>$i</strong>";
					} else {
						echo ' <a href="'.get_pagenum_link($i).'">'.$i.'</a> ';
					}
				}
			}
			next_posts_link($nxtlabel, $max_page);
			if (($paged+$half_pages_to_show) < ($max_page)) {
				echo '<a href="'.get_pagenum_link($max_page).'">Last &raquo;</a>';
			}
			echo "</div> $after";
		}
	}
}

////////////////////////////////////////////////////////////////////////////////
// excerpt features
////////////////////////////////////////////////////////////////////////////////

function the_excerpt_feature($excerpt_length='', $allowedtags='', $filter_type='none', $use_more_link='', $more_link_text = '', $force_more_link=true, $fakeit=1, $fix_tags=true) {

if (preg_match('%^content($|_rss)|^excerpt($|_rss)%', $filter_type)) {
$filter_type = 'the_' . $filter_type;
}
$text = apply_filters($filter_type, get_the_excerpt_feature($excerpt_length, $allowedtags, $use_more_link, $more_link_text, $force_more_link, $fakeit));
$text = ($fix_tags) ? balanceTags($text) : $text;
echo $text;
}

function get_the_excerpt_feature($excerpt_length, $allowedtags, $use_more_link, $more_link_text, $force_more_link, $fakeit) {
global $id, $post;
$output = '';
$output = $post->post_excerpt;
if (!empty($post->post_password)) { // if there's a password
if ( post_password_required($post) ) {  // and it doesn't match the cookie
$output = __('There is no excerpt because this is a protected post.', TEMPLATE_DOMAIN);
return $output;
}
}

// If we haven't got an excerpt, make one.
if ((($output == '') && ($fakeit == 1)) || ($fakeit == 2)) {
$output = $post->post_content;
$output = strip_tags($output, $allowedtags);

$output = preg_replace( '|\[(.+?)\](.+?\[/\\1\])?|s', '', $output );

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
$excerpt .= "<a href=\"". get_permalink() . "#more-$id\">" . __('<br />...Click here to read more &raquo;', TEMPLATE_DOMAIN) . "</a>";
} else {
$excerpt .= ($use_dotdotdot) ? '...' : '';
}
$output = $excerpt;
} // end if no excerpt
return $output;
}

////////////////////////////////////////////////////////////////////////////////
// make cat name show properly without slug tag
////////////////////////////////////////////////////////////////////////////////
function refine_cat_name($cat) {
$cat_name = str_replace("-", " ", $cat);
return $cat_name;
}


////////////////////////////////////////////////////////////////////////////////
// Get Recent Comments With Avatar
////////////////////////////////////////////////////////////////////////////////
function get_avatar_recent_comment($avatar_size ='') {
global $wpdb;

$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID,
comment_post_ID, comment_author, comment_author_email, comment_date_gmt, comment_approved,
comment_type,comment_author_url,
SUBSTRING(comment_content,1,50) AS com_excerpt
FROM $wpdb->comments
LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID =
$wpdb->posts.ID)
WHERE comment_approved = '1' AND comment_type = '' AND
post_password = ''
ORDER BY comment_date_gmt DESC LIMIT 10";

$comments = $wpdb->get_results($sql);
$output = '';
$gravatar_status = 'on'; /* off if not using */

foreach ($comments as $comment) {

$email = $comment->comment_author_email;
$grav_name = $comment->comment_author;
$grav_url = "http://www.gravatar.com/avatar.php?gravatar_id=" . md5($email) . "&amp;size=" . $avatar_size;
?>

<li>
<?php if($gravatar_status == 'on') { ?>
<?php if (function_exists('get_avatar')) { ?>
<?php echo get_avatar( $comment->comment_author_email , 32 ); ?>
<?php } else { ?>
<?php echo "<img class='alignleft' src='http://www.gravatar.com/avatar.php?gravatar_id=" . md5($email) . "&size=32&default=$default' alt='$user_identity' />"; ?>
<?php } ?>
<?php } ?>


<?php echo strip_tags($comment->comment_author); ?>: <br />
<a href="<?php echo get_permalink($comment->ID); ?>#comment-<?php echo $comment->comment_ID; ?>" title="on <?php echo $comment->post_title; ?>">
<?php echo strip_tags($comment->com_excerpt); ?>...
</a>
</li>
<?php
}

}
////////////////////////////////////////////////////////////////////////////////
// Register Sidebar Widget
////////////////////////////////////////////////////////////////////////////////

function dixi_widget_init() {
global $bp_existed;
$get_layout_mode = get_option('tn_wpmu_dixi_layout_mode');

register_sidebar(array(
'name'=> __('Left Sidebar',TEMPLATE_DOMAIN),
'id'=> 'left-sidebar',
'description'=> __('Left Sidebar Widget', TEMPLATE_DOMAIN),
'before_widget' => '<li id="%1$s" class="widget %2$s">',
'after_widget' => '</li>',
'before_title' => '<h3>',
'after_title' => '</h3>',
));

register_sidebar(array(
'name'=>__('Right Sidebar',TEMPLATE_DOMAIN),
'id'=> 'right-sidebar',
'description'=> __('Right Sidebar Widget', TEMPLATE_DOMAIN),
'before_widget' => '<li id="%1$s" class="widget %2$s">',
'after_widget' => '</li>',
'before_title' => '<h3>',
'after_title' => '</h3>',
));


if(($get_layout_mode == "") || ($get_layout_mode == "custom homepage")){
register_sidebar(array(
'name'=>__('Frontpage',TEMPLATE_DOMAIN),
'id'=> 'frontpage',
'description'=> __('Frontpage Widget', TEMPLATE_DOMAIN),
'before_widget' => '<li id="%1$s" class="widget %2$s">',
'after_widget' => '</li>',
'before_title' => '<h3>',
'after_title' => '</h3>',
));
}


if($bp_existed == 'true') {
register_sidebar(array(
'name'=>__('BuddyPress Sidebar',TEMPLATE_DOMAIN),
'id'=> 'buddypress-sidebar',
'description'=> __('BuddyPress Sidebar Widget', TEMPLATE_DOMAIN),
'before_widget' => '<li id="%1$s" class="widget %2$s">',
'after_widget' => '</li>',
'before_title' => '<h3>',
'after_title' => '</h3>',
));
}

if ( class_exists( 'bbPress' ) ) {
register_sidebar(array(
'name'=> __('BBPress Sidebar', TEMPLATE_DOMAIN),
'id'=> 'bbpress-sidebar',
'description'=> __('BBPress Sidebar Widget', TEMPLATE_DOMAIN),
'before_widget' => '<li id="%1$s" class="widget %2$s">',
'after_widget' => '</li>',
'before_title' => '<h3>',
'after_title' => '</h3>',
));
}

}
add_action('widgets_init','dixi_widget_init');

////////////////////////////////////////////////////////////////////////////////
// Function to delete folder
////////////////////////////////////////////////////////////////////////////////
if( !function_exists('deleteDirectory') ):
function deleteDirectory($dir) {
    if (!file_exists($dir)) return true;
    if (!is_dir($dir) || is_link($dir)) return unlink($dir);
        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') continue;
            if (!deleteDirectory($dir . "/" . $item)) {
                chmod($dir . "/" . $item, 0777);
                if (!deleteDirectory($dir . "/" . $item)) return false;
            };
        }
return rmdir($dir);
    }
endif;


////////////////////////////////////////////////////////////////////////////////
function _g($str) { return __($str, 'option-page'); }
////////////////////////////////////////////////////////////////////////////////
if( !function_exists( 'dev_remove_all_scripts' ) ) :
function dev_remove_all_scripts() {
wp_deregister_script('jquery');
wp_deregister_script('jquery-ui-tabs');
}
endif;

function mytheme_wp_wpmu_dixi_head() { ?>
<link href="<?php echo get_template_directory_uri(); ?>/lib/admin/options-css.css" rel="stylesheet" type="text/css" />
<?php if( isset($_GET['page']) && (($_GET["page"] == "functions.php") || ($_GET["page"] == "site-intro.php") || ($_GET["page"] == "gallery.php"))) { ?>
<link href='http://fonts.googleapis.com/css?family=Cantarell' rel='stylesheet' type='text/css'/>
<link href='http://fonts.googleapis.com/css?family=Cardo' rel='stylesheet' type='text/css'/>
<link href='http://fonts.googleapis.com/css?family=Crimson+Text' rel='stylesheet' type='text/css'/>
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'/>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'/>
<link href='http://fonts.googleapis.com/css?family=IM+Fell+DW+Pica' rel='stylesheet' type='text/css'/>
<link href='http://fonts.googleapis.com/css?family=Josefin+Sans+Std+Light' rel='stylesheet' type='text/css'/>
<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'/>
<link href='http://fonts.googleapis.com/css?family=Molengo' rel='stylesheet' type='text/css'/>
<link href='http://fonts.googleapis.com/css?family=Neuton' rel='stylesheet' type='text/css'/>
<link href='http://fonts.googleapis.com/css?family=Nobile' rel='stylesheet' type='text/css'/>
<link href='http://fonts.googleapis.com/css?family=OFL+Sorts+Mill+Goudy+TT' rel='stylesheet' type='text/css'/>
<link href='http://fonts.googleapis.com/css?family=Reenie+Beanie' rel='stylesheet' type='text/css'/>
<link href='http://fonts.googleapis.com/css?family=Tangerine' rel='stylesheet' type='text/css'/>
<link href='http://fonts.googleapis.com/css?family=Old+Standard+TT' rel='stylesheet' type='text/css'/>
<link href='http://fonts.googleapis.com/css?family=Volkorn' rel='stylesheet' type='text/css'/>
<link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz' rel='stylesheet' type='text/css'/>
<link href='http://fonts.googleapis.com/css?family=Just+Another+Hand' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Terminal+Dosis+Light' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Ubuntu:light,regular,bold' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/lib/scripts/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/lib/scripts/jscolor.js"></script>


<?php
$tn_wpmu_dixi_intro_header_on = get_option('tn_wpmu_dixi_intro_header_on');
if($tn_wpmu_dixi_intro_header_on != 'disable') { ?>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/lib/scripts/var.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/lib/scripts/quicktags.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/lib/scripts/simple-code.php"></script>
<?php } ?>

<?php add_action('admin_head', 'dev_remove_all_scripts', 100);  } ?>
<?php }


add_action('admin_head', 'mytheme_wp_wpmu_dixi_head');

////////////////////////////////////////////////////////////////////////////////
// add theme custom crop
////////////////////////////////////////////////////////////////////////////////



// function to generate random strings
function RandomString($length=3)
{
$randstr='';
srand((double)microtime()*1000000);
$chars = array ('1','2','3','4','5','6','7','8','9','0');
for ($rand = 0; $rand <= $length; $rand++)
{
$random = rand(0, count($chars) -1);
$randstr .= $chars[$random];
}
return $randstr;
}



////////////////////////////////////////////////////////////////////////////////
// CUSTOM IMAGE HEADER  - IF ON WILL BE SHOWN ELSE WILL HIDE
////////////////////////////////////////////////////////////////////////////////

$header_enable = get_option('tn_wpmu_dixi_header_on');
$header_width = get_option('tn_wpmu_dixi_site_width');

if($header_enable == 'enable' || $header_enable == '') {
if($header_width != "") { $header_width_px = $header_width; } else { $header_width_px = '982'; }

$custom_height = get_option('tn_wpmu_dixi_image_height');
if($custom_height==''){$custom_height='150';}else{$custom_height = get_option('tn_wpmu_dixi_image_height'); }
define('HEADER_TEXTCOLOR', '');
define('HEADER_IMAGE', '%s/lib/css/images/header.jpg'); // %s is theme dir uri
define('HEADER_IMAGE_WIDTH', $header_width_px); //width is fixed
define('HEADER_IMAGE_HEIGHT', $custom_height);
define('NO_HEADER_TEXT', true );

function wpmu_dixi_admin_header_style() { ?>
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
add_theme_support( 'custom-header', array('admin-head-callback' => 'wpmu_dixi_admin_header_style') );
}
}


//make text string shorter
function short_text($text='', $wordcount='') {
$text_count = strlen( $text );
if ( $text_count <= $wordcount ) {
$text = $text;
} else {
$text = substr( $text, 0, $wordcount );
$text = $text . '...';
}
return $text;
}

////////////////////////////////////////////////////////////////////////////////
// get google web font
////////////////////////////////////////////////////////////////////////////////
function font_show(){
$bodytype = get_option('tn_wpmu_dixi_body_font');
$navtype = get_option('tn_wpmu_dixi_nav_font');
$headtype = get_option('tn_wpmu_dixi_headline_font');

if ($bodytype == ""){ ?>
<?php } else if ($bodytype == "Cantarell, arial, serif" ){ ?>
<link href='http://fonts.googleapis.com/css?family=Cantarell' rel='stylesheet' type='text/css'/>
<?php } else if ($bodytype == "Cardo, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Cardo' rel='stylesheet' type='text/css'/>
<?php } else if ($bodytype == "Crimson Text, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Crimson+Text' rel='stylesheet' type='text/css'/>
<?php } else if ($bodytype == "Droid Sans, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'/>
<?php } else if ($bodytype == "Droid Serif, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'/>
<?php } else if ($bodytype == "IM Fell DW Pica, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=IM+Fell+DW+Pica' rel='stylesheet' type='text/css'/>
<?php } else if ($bodytype == "Josefin Sans Std Light, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Josefin+Sans+Std+Light' rel='stylesheet' type='text/css'/>
<?php } else if ($bodytype == "Lobster, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'/>
<?php } else if ($bodytype == "Molengo, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Molengo' rel='stylesheet' type='text/css'/>
<?php } else if ($bodytype == "Neuton, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Neuton' rel='stylesheet' type='text/css'/>
<?php } else if ($bodytype == "Nobile, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Nobile' rel='stylesheet' type='text/css'/>
<?php } else if ($bodytype == "OFL Sorts Mill Goudy TT, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=OFL+Sorts+Mill+Goudy+TT' rel='stylesheet' type='text/css'/>
<?php } else if ($bodytype == "Reenie Beanie, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Reenie+Beanie' rel='stylesheet' type='text/css'/>
<?php } else if ($bodytype == "Tangerine, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Tangerine' rel='stylesheet' type='text/css'/>
<?php } else if ($bodytype == "Old Standard TT, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Old+Standard+TT' rel='stylesheet' type='text/css'/>
<?php } else if ($bodytype == "Volkorn, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Volkorn' rel='stylesheet' type='text/css'/>
<?php } else if ($bodytype == "Yanone Kaffessatz, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz' rel='stylesheet' type='text/css'/>
<?php } else if ($bodytype == "Just Another Hand, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Just+Another+Hand' rel='stylesheet' type='text/css'>
<?php } else if ($bodytype == "Terminal Dosis Light, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Terminal+Dosis+Light' rel='stylesheet' type='text/css'>
<?php } else if ($bodytype == "Ubuntu, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Ubuntu:light,regular,bold' rel='stylesheet' type='text/css'>
<?php }

if ($navtype == ""){ ?>
<?php } else if ($navtype == "Cantarell, arial, serif" ){ ?>
<link href='http://fonts.googleapis.com/css?family=Cantarell' rel='stylesheet' type='text/css'/>
<?php } else if ($navtype == "Cardo, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Cardo' rel='stylesheet' type='text/css'/>
<?php } else if ($navtype == "Crimson Text, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Crimson+Text' rel='stylesheet' type='text/css'/>
<?php } else if ($navtype == "Droid Sans, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'/>
<?php } else if ($navtype == "Droid Serif, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'/>
<?php } else if ($navtype == "IM Fell DW Pica, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=IM+Fell+DW+Pica' rel='stylesheet' type='text/css'/>
<?php } else if ($navtype == "Josefin Sans Std Light, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Josefin+Sans+Std+Light' rel='stylesheet' type='text/css'/>
<?php } else if ($navtype == "Lobster, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'/>
<?php } else if ($navtype == "Molengo, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Molengo' rel='stylesheet' type='text/css'/>
<?php } else if ($navtype == "Neuton, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Neuton' rel='stylesheet' type='text/css'/>
<?php } else if ($navtype == "Nobile, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Nobile' rel='stylesheet' type='text/css'/>
<?php } else if ($navtype == "OFL Sorts Mill Goudy TT, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=OFL+Sorts+Mill+Goudy+TT' rel='stylesheet' type='text/css'/>
<?php } else if ($navtype == "Reenie Beanie, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Reenie+Beanie' rel='stylesheet' type='text/css'/>
<?php } else if ($navtype == "Tangerine, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Tangerine' rel='stylesheet' type='text/css'/>
<?php } else if ($navtype == "Old Standard TT, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Old+Standard+TT' rel='stylesheet' type='text/css'/>
<?php } else if ($navtype == "Volkorn, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Volkorn' rel='stylesheet' type='text/css'/>
<?php } else if ($navtype == "Yanone Kaffessatz, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz' rel='stylesheet' type='text/css'/>
<?php } else if ($navtype == "Just Another Hand, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Just+Another+Hand' rel='stylesheet' type='text/css'>
<?php } else if ($navtype == "Terminal Dosis Light, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Terminal+Dosis+Light' rel='stylesheet' type='text/css'>
<?php } else if ($navtype == "Ubuntu, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Ubuntu:light,regular,bold' rel='stylesheet' type='text/css'>
<?php }

if ($headtype == ""){ ?>
<?php } else if ($headtype == "Cantarell, arial, serif" ){ ?>
<link href='http://fonts.googleapis.com/css?family=Cantarell' rel='stylesheet' type='text/css'/>
<?php } else if ($headtype == "Cardo, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Cardo' rel='stylesheet' type='text/css'/>
<?php } else if ($headtype == "Crimson Text, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Crimson+Text' rel='stylesheet' type='text/css'/>
<?php } else if ($headtype == "Droid Sans, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'/>
<?php } else if ($headtype == "Droid Serif, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'/>
<?php } else if ($headtype == "IM Fell DW Pica, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=IM+Fell+DW+Pica' rel='stylesheet' type='text/css'/>
<?php } else if ($headtype == "Josefin Sans Std Light, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Josefin+Sans+Std+Light' rel='stylesheet' type='text/css'/>
<?php } else if ($headtype == "Lobster, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'/>
<?php } else if ($headtype == "Molengo, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Molengo' rel='stylesheet' type='text/css'/>
<?php } else if ($headtype == "Neuton, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Neuton' rel='stylesheet' type='text/css'/>
<?php } else if ($headtype == "Nobile, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Nobile' rel='stylesheet' type='text/css'/>
<?php } else if ($headtype == "OFL Sorts Mill Goudy TT, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=OFL+Sorts+Mill+Goudy+TT' rel='stylesheet' type='text/css'/>
<?php } else if ($headtype == "Reenie Beanie, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Reenie+Beanie' rel='stylesheet' type='text/css'/>
<?php } else if ($headtype == "Tangerine, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Tangerine' rel='stylesheet' type='text/css'/>
<?php } else if ($headtype == "Old Standard TT, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Old+Standard+TT' rel='stylesheet' type='text/css'/>
<?php } else if ($headtype == "Volkorn, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Volkorn' rel='stylesheet' type='text/css'/>
<?php } else if ($headtype == "Yanone Kaffeesatz, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz' rel='stylesheet' type='text/css'>
<?php } else if ($headtype == "Just Another Hand, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Just+Another+Hand' rel='stylesheet' type='text/css'>
<?php } else if ($headtype == "Terminal Dosis Light, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Terminal+Dosis+Light' rel='stylesheet' type='text/css'>
<?php } else if ($headtype == "Ubuntu, arial, serif"){ ?>
<link href='http://fonts.googleapis.com/css?family=Ubuntu:light,regular,bold' rel='stylesheet' type='text/css'>
<?php }

}

include( TEMPLATEPATH . '/lib/functions/options-functions.php' );
include( TEMPLATEPATH . '/lib/functions/customizer-functions.php' );
?>