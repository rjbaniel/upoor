<?php
if (!defined('SHOW_AUTHORS')) define('SHOW_AUTHORS', 'true');
if (!defined('TEMPLATE_DOMAIN')) define('TEMPLATE_DOMAIN', 'jq');
////////////////////////////////////////////////////////////////////////////////
// load text domain
////////////////////////////////////////////////////////////////////////////////

// Uncomment this to test your localization, make sure to enter the right language code.

//function test_localization( $locale ) {
//return "fr_FR";
//}
//add_filter('locale','test_localization');


load_theme_textdomain('jq', TEMPLATEPATH . '/languages/');

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

// wp_enqueue_script('dropmenu', get_template_directory_uri() . '/js/dropmenu.js', array('jquery'));
// wp_enqueue_style('nav', get_template_directory_uri() . '/nav.css', array(), false, 'screen');
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
// CUSTOM IMAGE HEADER
////////////////////////////////////////////////////////////////////////////////

define('HEADER_TEXTCOLOR', '');
define('HEADER_IMAGE', ''); // %s is theme dir uri
define('HEADER_IMAGE_WIDTH', 960); //width is fixed
define('HEADER_IMAGE_HEIGHT', 150);
define('NO_HEADER_TEXT', true );

function jq_admin_header_style() { ?>
<style type="text/css">
#headimg { background: url(<?php header_image() ?>) no-repeat; }
#headimg { height: <?php echo HEADER_IMAGE_HEIGHT; ?>px; width: <?php echo HEADER_IMAGE_WIDTH; ?>px; }
#headimg h1, #headimg #desc { display: none; }
</style>
<?php }

add_theme_support( 'custom-header', array('admin-head-callback' => 'jq_admin_header_style'));



function jq_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class('clearfix') ?> id="comment-<?php comment_ID() ?>">

         <?php echo get_avatar($comment, 48); ?>

      <?php if ($comment->comment_approved == '0') : ?>
         <em><?php _e('Your comment is awaiting moderation.') ?></em>
      <?php endif; ?>

      <p class="comment-details"><?php if (1==$comment->user_id) echo 'Admin comment by '; else if ($comment->user_id) echo 'Author comment by '; ?><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><em><?php comment_author_link() ?></em></a> &middot; <?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></p>

            		<div class="comment-text">
                    		<?php comment_text() ?>
            		</div>

		<?php comment_reply_link(array_merge($args, array(
					'depth' => $depth,
					'before' => '<p class="comment-reply">', 
					'after' => '</p>'
				)));
		?>
<?php } ?>
<?php
// Widget Settings
if ( function_exists('register_sidebar') )
        {
        register_sidebar(array(
        'name' => 'sidebar_right',
        'before_widget' => '<div id="%1$s" class="widget">',
        'after_widget' => '</div>',
        'before_title' => '<h4><a href="#" title="Toggle" class="hide_widget">',
        'after_title' => '</a></h4>',
        ));

        register_sidebar(array(
        'name' => 'sidebar_bottom_left',
        'before_widget' => '<div id="%1$s" class="widget">',
        'after_widget' => '</div>',
        'before_title' => '<h4><a href="#" title="Toggle" class="hide_widget">',
        'after_title' => '</a></h4>',
        ));

        register_sidebar(array(
        'name' => 'sidebar_bottom_middle',
        'before_widget' => '<div id="%1$s" class="widget">',
        'after_widget' => '</div>',
        'before_title' => '<h4><a href="#" title="Toggle" class="hide_widget">',
        'after_title' => '</a></h4>',
        ));

        register_sidebar(array(
        'name' => 'sidebar_bottom_right',
        'before_widget' => '<div id="%1$s" class="widget">',
        'after_widget' => '</div>',
        'before_title' => '<h4><a href="#" title="Toggle" class="hide_widget">',
        'after_title' => '</a></h4>',
        ));
}

?>
<?php
$themename = "jQ";
$shortname = "jq";

$options = array (

	array(	"name" => "Here you find various options to change the appearance of the theme.",
			"type" => "title"),
			
	array(	"type" => "open"),

        array(	"name" => "Style Schemes",
			"desc" => "Choose a style scheme.",
			"id" => $shortname."_style_scheme",
			"std" => "Default",
			"type" => "select",
			"options" => array("Default", "Serif", "Dark")),
	
	array(	"name" => "Background colour",
			"desc" => "Enter a value for the background colour (without CSS mark-up, like <em>#ff0000</em>).",
			"id" => $shortname."_bg_color",
			"std" => "",
			"type" => "text"),

	array(	"name" => "Page colour",
			"desc" => "Enter a value for the page colour (without CSS mark-up, like <em>#ff0000</em>).",
			"id" => $shortname."_page_color",
			"std" => "",
			"type" => "text"),

	array(  "name" => "Sidebar",
			"desc" => "Check this box if you would like to display the sidebar on the left of the page.",
            "id" => $shortname."_sidebar_left",
            "type" => "checkbox",
            "std" => "false"),

	array(  "name" => "Navigation",
			"desc" => "Check this box if you would like to display categories instead of pages in the navigation.",
            "id" => $shortname."_nav_display",
            "type" => "checkbox",
            "std" => "false"),

	array(  "name" => "Index Pages",
			"desc" => "Check this box if you would like to show the excerpt instead of the entire post on index pages.",
            "id" => $shortname."_post_display",
            "type" => "checkbox",
            "std" => "false"),

	array(  "name" => "Content Slider",
			"desc" => "Check this box if you would like to hide the content slider.",
            "id" => $shortname."_slide_display",
            "type" => "checkbox",
            "std" => "false"),

	array(  "name" => "Admin E-mail",
			"desc" => "Check this box if you would like to hide the admin email address.",
            "id" => $shortname."_mail_display",
            "type" => "checkbox",
            "std" => "false"),
	
	array(	"type" => "close")
	
);

function jq_add_admin() {

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

    add_theme_page($themename." Options", "".$themename." Options", 'edit_theme_options', basename(__FILE__), 'jq_admin');

}

function jq_admin() {

    global $themename, $shortname, $options;

    if ( isset($_REQUEST['saved']) && $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p>'.$themename.' settings saved.</p></div>';
    if ( isset($_REQUEST['reset']) && $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p>'.$themename.' settings reset.</p></div>';
    
?>
<div class="wrap">
<h2><?php echo $themename; ?> settings</h2>

<form method="post">



<?php foreach ($options as $value) { 
    
	switch ( $value['type'] ) {
	
		case "open":
		?>
        <table width="100%" border="0" style="color:#333;">		    
        
		<?php break;
		
		case "close":
		?>
		
        </table><br />
        
        
		<?php break;
		
		case "title":
		?>
		<table width="100%" border="0"><tr>
        	<td colspan="2"><h3 style="font:normal 14px Verdana,sans-serif;color:#21759b;"><?php echo $value['name']; ?></h3></td>
        </tr>

		<?php break;
		
		case 'select':
		?>
        <tr>
            <td width="25%" rowspan="2" valign="middle"><?php echo $value['name']; ?></td>
	            <td width="75%"><select style="width:400px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
	                <?php foreach ($value['options'] as $option) { ?>
	                <option <?php if ( get_option( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option>
	                <?php } ?>
	            </select></td></tr>
                        <tr>
            <td><small><?php echo $value['desc']; ?></small></td>
        </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #ccc;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>
        
		<?php break;

		case 'text':
		?>
        
        <tr>
            <td width="25%" rowspan="2" valign="middle"><?php echo $value['name']; ?></td>
            <td width="75%"><input style="width:400px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" /></td>
        </tr>

        <tr>
            <td><small><?php echo $value['desc']; ?></small></td>
        </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #ccc;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

<?php
        break;
            
		case "checkbox":
		?>
            <tr>
            <td width="25%" rowspan="2" valign="middle"><?php echo $value['name']; ?></td>
                <td width="75%"><?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = ""; } ?>
                        <input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
                        </td>
            </tr>
                        
            <tr>
                <td><small><?php echo $value['desc']; ?></small></td>
           </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #ccc;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>
            
        <?php 		break;	
 
} 
}
?>
<!--</table>-->
<p class="submit" style="margin:0;padding:0;">
<input name="save" type="submit" value="Save changes" />    
<input type="hidden" name="action" value="save" />
</p>
</form>
<form method="post">
<p class="submit">
<input name="reset" type="submit" value="Reset" />
<input type="hidden" name="action" value="reset" />
</p>
</form>

<?php
}
add_action('admin_menu', 'jq_add_admin');

function jq_init() {
	wp_register_script('jq-superfish', get_bloginfo('template_directory').'/lib/js/superfish.js', array('jquery'), '1.0', true);
	wp_register_script('jq-supersubs', get_bloginfo('template_directory').'/lib/js/supersubs.js', array('jquery'), '1.0', true);
	wp_register_script('jq-cookies', get_bloginfo('template_directory').'/lib/js/cookies.js', array('jquery'), '1.0', true);
	wp_register_script('jq-fontResizer', get_bloginfo('template_directory').'/lib/js/fontResizer.js', array('jquery'), '1.0', true);
	wp_register_script('jq-theme', get_bloginfo('template_directory').'/lib/js/theme.js', array('jquery'), '1.0', true);
}
add_action('init', 'jq_init');

function jq_wp_enqueue_scripts() {
	wp_enqueue_script('jq-superfish');
	wp_enqueue_script('jq-supersubs');
	wp_enqueue_script('jq-cookies');
	wp_enqueue_script('jq-fontResizer');
	wp_enqueue_script('jq-theme');
}
add_action('wp_enqueue_scripts', 'jq_wp_enqueue_scripts');
