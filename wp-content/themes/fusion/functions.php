<?php
if (!defined('SHOW_AUTHORS')) define('SHOW_AUTHORS', 'true');
if (!defined('TEMPLATE_DOMAIN')) define('TEMPLATE_DOMAIN', 'fusion');
/* Fusion/digitalnature */

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
	class description_custom_walker extends Walker_Nav_Menu
	{
		function start_el(&$output, $item, $depth, $args) {
			global $wp_query;
			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		   
			$class_names = $value = '';
			
			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			
			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
			$class_names = ' class="'. esc_attr( $class_names ) . '"';
		   
			$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
	
			$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
			$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
			$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
			$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
	
			$prepend = '';
			$append = '';
			
			if($depth != 0) {
				$description = $append = $prepend = "";
			} else {
				$description = '';
			}
			
			$item_output = $args->before;
			$item_output .= '<a class="fadeThis" '. $attributes .'><span><span>';
			$item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
			$item_output .= $description.$args->link_after;
			$item_output .= '</span></span></a>';
			$item_output .= $args->after;
			
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}


  function bp_wp_custom_nav_menu($get_custom_location='', $get_default_menu=''){
	$options = array('walker' => new description_custom_walker(), 'theme_location' => "$get_custom_location", 'menu_id' => '', 'echo' => false, 'container' => false, 'container_id' => '', 'fallback_cb' => "$get_default_menu");
	$menu = wp_nav_menu($options);
	$menu_list = preg_replace( array( '#^<ul[^>]*>#', '#</ul>$#' ), '', $menu );
	return $menu_list;
  }

  function revert_wp_menu_page() { //revert back to normal if in wp 3.0 and menu not set
	echo preg_replace('@\<li([^>]*)>\<a([^>]*)>(.*?)\<\/a>@i', '<li$1><a$2><span><span>$3</span></span></a>', wp_list_pages('echo=0&title_li=&'));
  }

  function revert_wp_menu_cat() { //revert back to normal if in wp 3.0 and menu not set 
	wp_list_categories('orderby=id&show_count=0&use_desc_for_title=0&title_li=');
  }

  function add_wp_menu_drop_js_script() {
	wp_enqueue_script('dropmenu', get_template_directory_uri() . '/js/dropmenu.js', array('jquery'));
	wp_enqueue_style('nav', get_template_directory_uri() . '/nav.css', array(), false, 'screen');
  }
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





function init_language() {
	if (class_exists('xili_language')) {
		define('THEME_TEXTDOMAIN','fusion');
		define('THEME_LANGS_FOLDER','/lang');
	} else {
	   load_theme_textdomain('fusion', get_template_directory() . '/lang');
	}
}
add_action ('init', 'init_language');

// theme options
$options = array (

    array(
   "id" => "fusion_body_font",
   "default" => "Lucida Grande,arial,sans serif",
   "type" => "fusion_body_font"),

  array(
   "id" => "fusion_headline_font",
   "default" => "Lucida Grande,arial,sans serif",
   "type" => "fusion_headline_font"),

  array(
   "id" => "fusion_font_size",
   "default" => "12px",
   "type" => "fusion_font_size"),

  array(
   "id" => "fusion_jquery",
   "default" => "yes",
   "type" => "fusion_jquery"),

  array(
   "id" => "fusion_meta",
   "default" => "",
   "type" => "fusion_meta"),

  array(
   "id" => "fusion_indexposts",
   "default" => "full",
   "type" => "fusion_indexposts"),

  array(
   "id" => "fusion_controls",
   "default" => "yes",
   "type" => "fusion_controls"),

  array(
   "id" => "fusion_3col",
   "default" => "no",
   "type" => "fusion_3col"),

  array(
   "id" => "fusion_header",
   "default" => "default",
   "type" => "fusion_header"),

  array(
   "id" => "fusion_headercolor",
   "default" => "000",
   "type" => "fusion_headercolor"),

  array(
   "id" => "fusion_logo",
   "default" => "no",
   "type" => "fusion_logo"),

  array(
   "id" => "fusion_sidebarpos",
   "default" => "right",
   "type" => "fusion_sidebarpos"),

  array(
   "id" => "fusion_topnav",
   "default" => "pages",
   "type" => "fusion_topnav"),

  array(
   "id" => "fusion_search",
   "default" => "default",
   "type" => "fusion_search"),

  array(
   "id" => "fusion_searchcode",
   "default" => "",
   "type" => "fusion_searchcode"),

  array(
   "id" => "fusion_footer",
   "default" => "",
   "type" => "fusion_footer"),

  array(
   "id" => "fusion_css",
   "default" => "",
   "type" => "fusion_css"),

  array(
   "id" => "fusion_sortcategories",
   "default" => "name",
   "type" => "fusion_sortcategories"),

  array(
   "id" => "fusion_showcategorycount",
   "default" => "on",
   "type" => "fusion_showcategorycount"),

  array(
   "id" => "fusion_twitterid",
   "default" => "",
   "type" => "fusion_twitterid"),

  array(
   "id" => "fusion_twitterentries",
   "default" => "5",
   "type" => "fusion_twitterentries"),

  array(
   "id" => "fusion_flickrid",
   "default" => "",
   "type" => "fusion_flickrid")

);

$uploadpath = wp_upload_dir();
if ($uploadpath['baseurl']=='') $uploadpath['baseurl'] = get_bloginfo('url').'/wp-content/uploads';

function fusion_options() {
  global $options, $uploadpath;

  if ( isset($_REQUEST['action']) && 'fusion_save' == $_REQUEST['action'] ) {

    foreach ($options as $value) {
     if( !isset( $_REQUEST[ $value['id'] ] ) ) {  } else { update_option( $value['id'], stripslashes($_REQUEST[ $value['id']])); } }
     if(stristr($_SERVER['REQUEST_URI'],'&saved=true')) {
     $location = $_SERVER['REQUEST_URI'];
    } else {
     $location = $_SERVER['REQUEST_URI'] . "&saved=true";
    }

    if ($_FILES["file-logo"]["type"]){
     $directory = $uploadpath['basedir'].'/';
     move_uploaded_file($_FILES["file-logo"]["tmp_name"],
     $directory . $_FILES["file-logo"]["name"]);
     update_option('fusion_logoimage', $uploadpath['baseurl']. "/". $_FILES["file-logo"]["name"]);
    }

    if ($_FILES["file-header"]["type"]){
     $directory = $uploadpath['basedir'].'/';
     move_uploaded_file($_FILES["file-header"]["tmp_name"],
     $directory . $_FILES["file-header"]["name"]);
     update_option('fusion_headerimage', $uploadpath['baseurl']. "/". $_FILES["file-header"]["name"]);
    }

    if ($_FILES["file-header2"]["type"]){
     $directory = $uploadpath['basedir'].'/';
     move_uploaded_file($_FILES["file-header2"]["tmp_name"],
     $directory . $_FILES["file-header2"]["name"]);
     update_option('fusion_headerimage2', $uploadpath['baseurl']. "/". $_FILES["file-header2"]["name"]);
    }
    header("Location: $location");
    die;
  }  else if ( isset($_REQUEST['action']) && 'fusion_reset' == $_REQUEST['action'] ) {
  foreach ($options as $default) {

  delete_option( $default['id'] );

  }
  header("Location: themes.php?page=fusion-settings&reset=true");
  die;
  }




  // set default options
  foreach ($options as $default) {
  if(get_option($default['id'])=="") {
  	update_option($default['id'],$default['default']);
  }
  }

  /*
  // delete all options
  foreach ($options as $default) {
  delete_option($default['id'],$default['default']);
  }
  */

  // add_menu_page('Fusion', __('Fusion theme','fusion'), 10, 'fusion-settings', 'fusion_admin');
  add_theme_page(__('Fusion settings','fusion'), __('Fusion settings','fusion'), 'edit_theme_options', 'fusion-settings', 'fusion_admin');
}

function fusion_admin() {
    global $options, $uploadpath;


?>
<div class="wrap">
  <h2 class="alignleft"><?php _e("Fusion theme settings","fusion");?></h2><a class="alignright" style="margin: 20px;" href="http://digitalnature.ro/projects/fusion">Fusion homepage</a>
  <br clear="all" />
  <?php if ( isset($_REQUEST['saved']) && $_REQUEST['saved'] ) { ?><div id="message" class="updated fade"><p><strong><?php _e('Settings saved.','fusion'); ?></strong></p></div><?php } ?>
   <?php if ( isset($_REQUEST['reset']) && $_REQUEST['reset'] ) { ?><div id="message" class="updated fade"><p><strong><?php _e('Settings reset.','fusion'); ?></strong></p></div><?php } ?>

  <style type="text/css"> @import "<?php print get_option('siteurl'). "/wp-content/themes/". get_option('template') ?>/js/colorpicker/colorpicker.css"; </style>
  <script type="text/javascript" src="<?php print get_option('siteurl'). "/wp-content/themes/". get_option('template') ?>/js/colorpicker/colorpicker.js"></script>
  <script type="text/javascript">

   // disable the ability to change options based on what the user previously selected
   function checkoptions(){
    document.getElementById('fusion_header').disabled=false;
    var headervalue = document.getElementById("fusion_header").value;
    if(headervalue == "user") { document.getElementById("userheader").style.display = "block"; } else { document.getElementById("userheader").style.display = "none"; }
    if(headervalue == "user2") { document.getElementById("usercolor").style.display = "block"; } else { document.getElementById("usercolor").style.display = "none"; }

    if (document.getElementById('fusion_logo-yes').checked){  document.getElementById("userlogo").style.display = "block"; }
    else { document.getElementById("userlogo").style.display = "none"; }

   }

   // run at page load
   jQuery(document).ready(function() {
    checkoptions();

   jQuery('#fusion_headercolor').ColorPicker({
	onSubmit: function(hsb, hex, rgb) {
		jQuery('#fusion_headercolor').val(hex);
	},
	onBeforeShow: function () {
		jQuery(this).ColorPickerSetColor(this.value);
	},
	onChange: function(hsb, hex, rgb) {
		jQuery('#fusion_headercolor').val(hex);
        jQuery('#fusion_headercolor').css("background-color","#"+hex);
        colortype = hex[0];
        if (isNaN(colortype)) jQuery('#fusion_headercolor').css("color","#000");
        else jQuery('#fusion_headercolor').css("color","#fff");
	}
    })
    .bind('keyup', function(){
    	jQuery(this).ColorPickerSetColor(this.value);
    });
   });

  </script>

<form method="post" id="myForm" enctype="multipart/form-data" onclick="checkoptions();">
<div id="poststuff" class="metabox-holder">

 <div class="stuffbox">
  <h3><label for="link_url"><?php _e("General","fusion"); ?></label></h3>
  <div class="inside">
    <table class="form-table" style="width: auto">
    <?php
     foreach ($options as $value) {

      switch ( $value['type'] ) {

      case "fusion_body_font": ?>

        <tr>
        <th scope="row"><?php _e("Body Fonts","fusion") ?><br /><?php _e("(Choose your desired headline fonts)","arclite"); ?></th>
        <td>

           <label>
            <select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" class="code">
              <option <?php if (get_option($value['id'])=='Lucida Grande,arial,sans serif') {?> selected="selected" <?php } ?> >Lucida Grande,arial,sans serif</option>

              <option <?php if (get_option($value['id'])=='Arial, sans-serif') {?> selected="selected" <?php } ?> >Arial, sans-serif</option>
              <option <?php if (get_option($value['id'])=='Tahoma, Helvetica, Trebuchet MS') {?> selected="selected" <?php } ?> >Tahoma, Helvetica, Trebuchet MS</option>

              <option <?php if (get_option($value['id'])=='Verdana, Arial, sans-serif') {?> selected="selected" <?php } ?> >Verdana, Arial, sans-serif</option>
              <option <?php if (get_option($value['id'])=='Geneva, Arial, Helvetica') {?> selected="selected" <?php } ?> >Geneva, Arial, Helvetica</option>

              <option <?php if (get_option($value['id'])=='Helvetica, Arial, sans-serif') {?> selected="selected" <?php } ?> >Helvetica, Arial, sans-serif</option>
              <option <?php if (get_option($value['id'])=='Calibri, Helvetica, Trebuchet MS') {?> selected="selected" <?php } ?> >Calibri, Helvetica, Trebuchet MS</option>

              <option <?php if (get_option($value['id'])=='Georgia, Times New Roman, Helvetica, sans-serif') {?> selected="selected" <?php } ?> >Georgia, Times New Roman, Helvetica, sans-serif</option>
              <option <?php if (get_option($value['id'])=='Cambria, Georgia, Times New Roman') {?> selected="selected" <?php } ?> >Cambria, Georgia, Times New Roman</option>
              <option <?php if (get_option($value['id'])=='Century Gothic, Century, Georgia, Times New Roman') {?> selected="selected" <?php } ?> >Century Gothic, Century, Georgia, Times New Roman</option>

              <option <?php if (get_option($value['id'])=='Trebuchet MS, Arial, Verdana, Helvetica, sans-serif') {?> selected="selected" <?php } ?> >Trebuchet MS, Arial, Verdana, Helvetica, sans-serif</option>
              <option <?php if (get_option($value['id'])=='Helvetica Neue, Helvetica LT Std Cond, Helvetica-Normal') {?> selected="selected" <?php } ?> >Helvetica Neue, Helvetica LT Std Cond, Helvetica-Normal</option>
              <option <?php if (get_option($value['id'])=='Myriad Pro, Tahoma, arial') {?> selected="selected" <?php } ?> >Myriad Pro, Tahoma, arial</option>

              <option <?php if (get_option($value['id'])=='Union, Lucida Grande, Lucida Sans Unicode') {?> selected="selected" <?php } ?> >Union, Lucida Grande, Lucida Sans Unicode</option>
              <option <?php if (get_option($value['id'])=='Candara, Arial, Verdana, sans-serif') {?> selected="selected" <?php } ?> >Candara, Arial, Verdana, sans-serif</option>

            </select>
         </label>

        </td>
        </tr>

         <?php break;
          case "fusion_headline_font": ?>

        <tr>
        <th scope="row"><?php _e("Headline Fonts","fusion") ?><br /><?php _e("(Choose your desired headline fonts)","arclite"); ?></th>
        <td>

           <label>
            <select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" class="code">
              <option <?php if (get_option($value['id'])=='Lucida Grande,arial,sans serif') {?> selected="selected" <?php } ?> >Lucida Grande,arial,sans serif</option>

              <option <?php if (get_option($value['id'])=='Arial, sans-serif') {?> selected="selected" <?php } ?> >Arial, sans-serif</option>
              <option <?php if (get_option($value['id'])=='Tahoma, Helvetica, Trebuchet MS') {?> selected="selected" <?php } ?> >Tahoma, Helvetica, Trebuchet MS</option>

              <option <?php if (get_option($value['id'])=='Verdana, Arial, sans-serif') {?> selected="selected" <?php } ?> >Verdana, Arial, sans-serif</option>
              <option <?php if (get_option($value['id'])=='Geneva, Arial, Helvetica') {?> selected="selected" <?php } ?> >Geneva, Arial, Helvetica</option>


              <option <?php if (get_option($value['id'])=='Helvetica, Arial, sans-serif') {?> selected="selected" <?php } ?> >Helvetica, Arial, sans-serif</option>
              <option <?php if (get_option($value['id'])=='Calibri, Helvetica, Trebuchet MS') {?> selected="selected" <?php } ?> >Calibri, Helvetica, Trebuchet MS</option>

              <option <?php if (get_option($value['id'])=='Georgia, Times New Roman, Helvetica, sans-serif') {?> selected="selected" <?php } ?> >Georgia, Times New Roman, Helvetica, sans-serif</option>
              <option <?php if (get_option($value['id'])=='Cambria, Georgia, Times New Roman') {?> selected="selected" <?php } ?> >Cambria, Georgia, Times New Roman</option>
              <option <?php if (get_option($value['id'])=='Century Gothic, Century, Georgia, Times New Roman') {?> selected="selected" <?php } ?> >Century Gothic, Century, Georgia, Times New Roman</option>

              <option <?php if (get_option($value['id'])=='Trebuchet MS, Arial, Verdana, Helvetica, sans-serif') {?> selected="selected" <?php } ?> >Trebuchet MS, Arial, Verdana, Helvetica, sans-serif</option>
              <option <?php if (get_option($value['id'])=='Helvetica Neue, Helvetica LT Std Cond, Helvetica-Normal') {?> selected="selected" <?php } ?> >Helvetica Neue, Helvetica LT Std Cond, Helvetica-Normal</option>
              <option <?php if (get_option($value['id'])=='Myriad Pro, Tahoma, arial') {?> selected="selected" <?php } ?> >Myriad Pro, Tahoma, arial</option>

              <option <?php if (get_option($value['id'])=='Union, Lucida Grande, Lucida Sans Unicode') {?> selected="selected" <?php } ?> >Union, Lucida Grande, Lucida Sans Unicode</option>
              <option <?php if (get_option($value['id'])=='Candara, Arial, Verdana, sans-serif') {?> selected="selected" <?php } ?> >Candara, Arial, Verdana, sans-serif</option>

            </select>
         </label>

        </td>
        </tr>

         <?php break;
      case "fusion_font_size": ?>
        <tr>
        <th scope="row"><?php _e("Content Font Size","fusion"); ?><br><?php _e("(Choose your desired content font size. ex: 12px, 13px, 14px...)","fusion"); ?></th>
        <td>
         <label>
          <input type="text" size="20" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="<?php if ( get_option( $value['id'] ) == "") { ?> <?php echo '12px'; ?><?php } else { ?><?php print get_option($value['id']); ?><?php } ?>" />
         </label>
        </td>
        </tr>


        <?php break;

        case "fusion_jquery": ?>

        <tr>
        <th scope="row"><?php _e("Use jQuery","fusion"); ?><br /><?php _e("(Don't change this unless you know what you're doing)","fusion"); ?></th>
        <td>
         <label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> /><?php _e("Yes","fusion"); ?></label>
         &nbsp;&nbsp;
         <label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> /><?php _e("No","fusion"); ?></label>
        </td>
        </tr>

      <?php break;
      case "fusion_meta": ?>
        <tr>
        <th scope="row"><?php _e("Homepage meta keywords","fusion"); ?><br><?php _e("(Separate with commas. Tags are used as keywords on other pages. Leave empty if you are using a SEO plugin)","fusion"); ?></th>
        <td>
         <label>
          <input type="text" size="20" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="<?php print get_option($value['id']); ?>" />
         </label>
        </td>
        </tr>

      <?php break;
        case "fusion_indexposts": ?>
        <tr>
        <th scope="row"><?php _e("Index page/Archives show:","fusion"); ?></th>
        <td>
         <label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-full" type="radio" value="full"<?php if ( get_option( $value['id'] ) == "full") { echo " checked"; } ?> /><?php _e("Full posts","fusion"); ?></label>
         &nbsp;&nbsp;
         <label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-excerpt" type="radio" value="excerpt"<?php if ( get_option( $value['id'] ) == "excerpt") { echo " checked"; } ?> /><?php _e("Excerpts only","fusion"); ?></label>
        </td>
        </tr>

  	  <?php break;
	  case "fusion_controls": ?>
        <tr>
        <th scope="row"><?php _e("Show layout controls (Aa/<>)","fusion"); ?></th>
        <td>
         <label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> /><?php _e("Yes","fusion"); ?></label>

         &nbsp;&nbsp;
        <label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> /><?php _e("No","fusion"); ?></label>
        </td>
        </tr>

      <?php break;
        case "fusion_3col": ?>
        <tr>
        <th scope="row"><?php _e("Enable 2nd sidebar on all pages","fusion"); ?><br /><?php _e("(use the 3-column page template if you only want it on certain pages)","fusion"); ?></th>
        <td>
         <label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> /><?php _e("Yes","fusion"); ?></label>
         &nbsp;&nbsp;
         <label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> /><?php _e("No","fusion"); ?></label>
        </td>
        </tr>


      <?php break;
	}
	}
	?>
   </table>
  </div>
 </div>

 <div class="stuffbox">
  <h3><label for="link_url"><?php _e("Header","fusion"); ?></label></h3>
  <div class="inside">
   <table class="form-table" style="width: auto">
    <?php
     foreach ($options as $value) {
      switch ( $value['type'] ) {
        case "fusion_topnav": ?>
        <tr>
        <th scope="row"><?php _e("Top navigation shows","fusion"); ?></th>
        <td>
         <label><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-pages" type="radio" value="pages"<?php if ( get_option( $value['id'] ) == "pages") { echo " checked"; } ?> /><?php _e("Pages","fusion"); ?></label>
         &nbsp;&nbsp;
         <label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-categories" type="radio" value="categories"<?php if ( get_option( $value['id'] ) == "categories") { echo " checked"; } ?> /><?php _e("Categories","fusion"); ?></label>
        </td>
        </tr>

      <?php break;
        case "fusion_header": ?>

        <tr>
        <th scope="row"><?php _e("Header background","fusion"); ?></th>
        <td>
         <label>
            <select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" class="code">
              <option <?php if (get_option($value['id'])=='default') {?> selected="selected" <?php } ?> value="default"><?php _e('Theme default (gray noise)','fusion'); ?></option>
              <option style="color: #ed1f24" <?php if (get_option($value['id'])=='user') {?> selected="selected" <?php } ?> value="user"><?php _e('User defined image(s) (upload)','fusion'); ?></option>
              <option style="color: #ed1f24" <?php if (get_option($value['id'])=='user2') {?> selected="selected" <?php } ?> value="user2"><?php _e('User defined color','fusion'); ?></option>
            </select>
         </label>
         <div id="userheader" style="display: none;">
         <?php if(is_writable($uploadpath['basedir'])) { ?>
          <br />
          <?php _e('Centered image (upload a 960x200 image for best fit):','fusion'); ?><br />
          <input type="file" name="file-header" id="file-header" />
          <br />
          <br />
          <?php if(get_option('fusion_headerimage')) { echo '<div><img src="'; echo get_option('fusion_headerimage'); echo '"  style="margin-top:10px;" /></div>'; } ?>
          <?php _e('Tiled image, repeats itself across the entire header (centered image will show on top of it, if specified):','fusion'); ?><br />
          <input type="file" name="file-header2" id="file-header2" />
          <?php if(get_option('fusion_headerimage2')) { echo '<div><img src="'; echo get_option('fusion_headerimage2'); echo '"  style="margin-top:10px;" /></div>'; } ?>

        <?php } else {  ?>
          <em style="color:#ed1f24"><?php printf(__('Can\'t upload! Directory %s is not writable!<br />Change write permissions with CHMOD 755 or 777','fusion'), $uploadpath['baseurl']); ?></em>
        <?php }  ?>

         </div>

         <div id="usercolor" style="display: none;">
          <?php _e('Pick a color','fusion'); ?> <input type="text" id="fusion_headercolor" name="fusion_headercolor" style="background: #<?php print get_option('fusion_headercolor'); ?>; color: #<?php $colortype = get_option('fusion_headercolor'); $colortype = $colortype[0]; if(is_numeric($colortype)) print 'fff'; else print '000';  ?>" value="<?php print get_option('fusion_headercolor'); ?>" />
         </div>

        </td>
        </tr>

      <?php break;
      case "fusion_logo": ?>

        <tr>
        <th scope="row"><?php _e("Logo image","fusion"); ?></th>
        <td>
         <label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-yes" type="radio" value="yes"<?php if ( get_option( $value['id'] ) == "yes") { echo " checked"; } ?> /><?php _e("Yes","fusion"); ?></label>

         &nbsp;&nbsp;
        <label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>-no" type="radio" value="no"<?php if ( get_option( $value['id'] ) == "no") { echo " checked"; } ?> /><?php _e("No","fusion"); ?></label>

        <div id="userlogo">
        <?php if(is_writable($uploadpath['basedir'])) {
         _e("Upload a custom logo image","fusion"); ?><br />
         <input type="file" name="file-logo" id="file-logo" />
         <?php if(get_option('fusion_logoimage')) { echo '<div style="background: #666;margin-top:10px;"><img src="'; echo get_option('fusion_logoimage'); echo '"  style="padding:10px;" /></div>'; } ?>
        <?php } else {  ?>
          <em style="color:#ed1f24"><?php printf(__('Can\'t upload! Directory %s is not writable!<br />Change write permissions with CHMOD 755 or 777','fusion'), $uploadpath['baseurl']); ?></em>
        <?php }  ?>

        </div>

        </td>
        </tr>
      <?php break;
    	}
      }
	?>
   </table>
  </div>
 </div>

 <div class="stuffbox">
  <h3><label for="link_url"><?php _e("Sidebar","fusion"); ?></label></h3>
  <div class="inside">
   <table class="form-table" style="width: auto">
<?php
 foreach ($options as $value) {
  switch ( $value['type'] ) {
	case "fusion_sidebarpos": ?>
        <tr>
        <th scope="row"><?php _e("Sidebar position","fusion"); ?></th>
        <td>
         <label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="radio" value="left"<?php if ( get_option( $value['id'] ) == "left") { echo " checked"; } ?> /><?php _e("Left","fusion"); ?></label>

         &nbsp;&nbsp;
        <label><input  name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="radio" value="right"<?php if ( get_option( $value['id'] ) == "right") { echo " checked"; } ?> /><?php _e("Right (default)","fusion"); ?></label>
        </td>
        </tr>
     <?php
    	}
      }
	?>
   </table>
  </div>
 </div>

 <div class="stuffbox">
  <h3><label for="link_url"><?php _e("Footer","fusion"); ?></label></h3>
  <div class="inside">
   <table class="form-table" style="width: auto">
    <?php
     foreach ($options as $value) {
      switch ( $value['type'] ) {
    	case "fusion_footer": ?>
        <tr>
        <th scope="row"><?php _e("Add content","fusion"); ?><br /><?php _e("(HTML allowed)","fusion"); ?></th>
        <td>
         <label>
          <textarea class="code" rows="4" cols="60" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"><?php print get_option($value['id']); ?></textarea>
         </label>
        </td>
        </tr>
    <?php
      }
     }
	?>
   </table>
  </div>
 </div>

 <div class="stuffbox">
  <h3><label for="link_url"><?php _e("User CSS code","fusion"); ?></label></h3>
  <div class="inside">
   <table class="form-table" style="width: auto">
    <?php
     foreach ($options as $value) {
      switch ( $value['type'] ) {
    	case "fusion_css": ?>

        <tr>
        <th scope="row"><?php _e("Modify anything related to design using simple CSS","fusion"); ?><br /><br /><span style="color: #ed1f24"><?php _e("Avoid modifying theme files and use this option instead to preserve changes after update","fusion"); ?></span></th>
        <td valign="top">
         <label>
          <textarea class="code" rows="12" cols="60" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"><?php print get_option($value['id']); ?></textarea>


         </label>
        </td>
        <td valign="top">
        Examples:
          <p><em style="color: #5db408">/* Set a fluid page width */</em><br /><code>#page{ width: 95%; }</code></p>
              <p><em style="color: #5db408">/* Make links red, without background on mouse over */</em><br /><code>a, a:hover{ color: #ed1f24; }<br />a:hover{ background: none; }</code></p>
              <p><em style="color: #5db408">/* Decrease header height to 150 pixels and hide the logo */</em><br /><code>#page-wrap2, #header{ height: 150px; }<br />body{ background-position: left 150px; }<br />a#logo{ display: none; }</code></p>
              <p><em style="color: #5db408">/* Increase tag line text size */</em><br /><code>#topnav, #topnav a{ font-size: 130%; }</code></p>
              <p><em style="color: #5db408">/* Hide post information bar */</em><br /><code>.postinfo{ display: none; }</code></p>
              <p><em style="color: #5db408">/* Make tabs narrower */</em><br /><code>#tabs{ letter-spacing: -0.04em; font-size: 13px; }<br />#tabs a span span{ padding: 4px 0 0 0; }</code></p>
              <p><em style="color: #5db408">/* Use Windows Arial style fonts, instead of Mac's Lucida */</em><br /><code>body, input, textarea, select, h3, h4, h5, h6,<br />#sidebar h2.title, #sidebar2 h2.title{ font-family: Arial, Helvetica; }</code></p>

        </td>
        </tr>

    <?php
      }
     }
	?>
   </table>
  </div>
 </div>

</div>
<input name="fusion_save" type="submit" class="button-primary" value="<?php _e('Save changes','fusion'); ?>" />
<input type="hidden" name="action" value="fusion_save" />
</form>

<form>
<input name="fusion_reset" type="submit" class="button-primary" value="<?php _e('Reset changes','fusion'); ?>" />
<input type="hidden" name="action" value="fusion_reset" />
</form>
</div>
<?php
}
add_action('admin_menu', 'fusion_options');


// register sidebars
if ( function_exists('register_sidebar')) {
    register_sidebar(array(
        'name' => 'Default sidebar',
        'id' => 'sidebar-1',
		'before_widget' => '<li><div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div></li>',
		'before_title' => '<h2 class="title">',
		'after_title' => '</h2>'
    ));


    register_sidebar(array(
        'name' => '2nd sidebar (only on 3-col pages)',
        'id' => 'sidebar-2',
		'before_widget' => '<li><div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div></li>',
		'before_title' => '<h2 class="title">',
		'after_title' => '</h2>'
    ));


    register_sidebar(array(
        'name' => 'Footer',
        'id' => 'sidebar-3',
		'before_widget' => '<li id="%1$s" class="widget %2$s"><div class="the-content">',
		'after_widget' => '</div></li>',
		'before_title' => '<h4 class="title">',
		'after_title' => '</h4>'
    ));
}


// theme widget: Categories
function fusion_CategoryWidget($args){
 extract($args);
 echo $before_widget;
?>
 <!-- sidebar menu (categories) -->
 <ul class="nav">
   <?php if(get_option('fusion_jquery')=='no') {
      echo preg_replace('@\<li([^>]*)>\<a([^>]*)>(.*?)\<\/a>@i', '<li$1><a$2><span>$3</span></a>', wp_list_categories('orderby='.get_option('fusion_sortcategories').'&show_count=0&echo=0&title_li='));
   }
   else{
    if(get_option('fusion_categorycount')=='on')
      echo preg_replace('@\<li([^>]*)>\<a([^>]*)>(.*?)\<\/a> \(\<a ([^>]*)([^>]*)>XML\<\/a>\) \((.*?)\)@i', '<li $1><a$2><span>$3 <em>($6)</em></span></a><a class="rss tip" $4></a>', wp_list_categories('orderby='.get_option('fusion_sortcategories').'&show_count=1&echo=0&title_li=&feed=XML'));
    else
   echo preg_replace('@\<li([^>]*)>\<a([^>]*)>(.*?)\<\/a> \(\<a ([^>]*) ([^>]*)>(.*?)\<\/a>\)@i', '<li $1><a$2><span>$3</span></a><a class="rss tip" $4></a>', wp_list_categories('show_count=0&echo=0&title_li=&feed=XML'));
   }
 ?>
   <?php if (function_exists('xili_language_list')) { xili_language_list(); } ?>
  </ul>
  <!-- /sidebar menu -->
 <?php
 echo $after_widget;
}

function fusion_CategoryWidgetAdmin() {
  // check if anything's been sent
  if (isset($_POST['update_widgetoptions'])) {
   	update_option("fusion_sortcategories",strip_tags(stripslashes($_POST['fusion_sortcategories'])));
   	update_option("fusion_categorycount",strip_tags(stripslashes($_POST['fusion_categorycount'])));
  }
?>
  <label>
    <?php _e('Sort categories by:','fusion'); ?>
    <select style="width: 100%;" name="fusion_sortcategories" id="fusion_sortcategories" class="code">
       <option <?php if (get_option('fusion_sortcategories')=='name') {?> selected="selected" <?php } ?> value="name"><?php _e('Alphabetically (default)','fusion'); ?></option>
       <option <?php if (get_option('fusion_sortcategories')=='id') {?> selected="selected" <?php } ?> value="id"><?php _e('Unique category ID','fusion'); ?></option>
       <option <?php if (get_option('fusion_sortcategories')=='slug') {?> selected="selected" <?php } ?> value="slug"><?php _e('Category slug','fusion'); ?></option>
       <option <?php if (get_option('fusion_sortcategories')=='count') {?> selected="selected" <?php } ?> value="count"><?php _e('Post count','fusion'); ?></option>
    </select>
  </label>
  <br />
  <br />
  <label>
  <input name="fusion_categorycount" id="fusion_categorycount" type="checkbox" <?php if (get_option('fusion_categorycount')=='on') { echo " checked"; } ?> /><?php _e("Show category count","fusion"); ?>
  </label>
  <input type="hidden" id="update_widgetoptions" name="update_widgetoptions" value="1" />
<?php
}

wp_register_sidebar_widget('fusion_categories_1', 'Fusion: '.__('Categories','fusion'), 'fusion_CategoryWidget');
wp_register_widget_control('fusion_categories_1', 'Fusion: '.__('Categories','fusion'), 'fusion_CategoryWidgetAdmin');


// theme widget: Search
function fusion_SearchWidget($args){
 extract($args);
 echo $before_widget;
 if(get_option('fusion_search')=='googlesearch') { ?>
         <!-- google search form -->
          <div id="searchtab">
            <div class="inside">
			  <form action="http://www.google.com/cse" method="get">
					<div class="content">
                       <fieldset>
						<input type="text" class="searchfield" id="searchbox" name="q" size="24" value="<?php _e("Search","fusion"); ?>" onfocus="if(this.value == '<?php _e("Search","fusion"); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e("Search","fusion"); ?>';}" />
						<input type="submit" class="searchbutton" name="sa" value="GO" />
						<input type="hidden" name="cx" value="<?php print get_option('fusion_searchcode'); ?>" />
						<input type="hidden" name="ie" value="UTF-8" />
                       </fieldset>
					</div>
			  </form>
            </div>
          </div>
         <!-- /google search form -->
  <?php } else { ?>
         <!-- wp search form -->
          <div id="searchtab">
            <div class="inside">
              <form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
              <fieldset>
                <input type="text" name="s" id="searchbox" class="searchfield" value="<?php _e("Search","fusion"); ?>" onfocus="if(this.value == '<?php _e("Search","fusion"); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e("Search","fusion"); ?>';}" />
                 <input type="submit" value="Go" class="searchbutton" />
              </fieldset>
              </form>
            </div>
          </div>
         <!-- /wp search form -->
  <?php }
 echo $after_widget;
}

function fusion_SearchWidgetAdmin() {
  // check if anything's been sent
  if (isset($_POST['update_widgetoptions'])) {
   	update_option("fusion_search",strip_tags(stripslashes($_POST['fusion_search'])));
   	update_option("fusion_searchcode",strip_tags(stripslashes($_POST['fusion_searchcode'])));
  }
?>
  <script type="text/javascript">
   // disable the ability to change options based on what the user previously selected
   function checkoptions(){
    if (document.getElementById('fusion_search-googlesearch').checked){ document.getElementById("googlesearchcode").style.display = "block"; }
    else { document.getElementById("googlesearchcode").style.display = "none"; }
   }
   // run at page load
   jQuery(document).ready(function() {
    checkoptions();
   });
  </script>
  <h3><?php _e('Search handled by:','fusion'); ?></h3>
  <label><input name="fusion_search" id="fusion_search-default" type="radio" onchange="checkoptions();" value="default"<?php if (get_option('fusion_search') == "default") { echo " checked"; } ?> />Wordpress</label>&nbsp;&nbsp;
  <label><input name="fusion_search" id="fusion_search-googlesearch" type="radio" onchange="checkoptions();" value="googlesearch"<?php if (get_option('fusion_search') == "googlesearch") { echo " checked"; } ?> />Google</label>&nbsp;&nbsp;
  <div id="googlesearchcode">
    <strong>CX</strong> <input type="text" size="40" name="fusion_searchcode" id="fusion_searchcode" value="<?php print get_option('fusion_searchcode'); ?>" />
    <br /><small><?php _e("Find <code>name='cx'</code> in the <strong>Search box code</strong> of <a href='http://www.google.com/coop/cse/'>Google Custom Search Engine</a>, and type the <code>value</code> above.<br/>","fusion"); ?></small>
  </div>
  <input type="hidden" id="update_widgetoptions" name="update_widgetoptions" value="1" />
<?php
}
wp_register_sidebar_widget('fusion_search_1', 'Fusion: '.__('Search','fusion'), 'fusion_SearchWidget');
wp_register_widget_control('fusion_search_1', 'Fusion: '.__('Search','fusion'), 'fusion_SearchWidgetAdmin',300);


// theme widget: Twitter
function fusion_TwitterWidget($args){
 extract($args);
 echo $before_widget;
 print $before_title.__('Twitter posts','fusion').$after_title; ?>

 <?php
 $username = get_option('fusion_twitterid');
 $limit = get_option('fusion_twitterentries'); ?>

 <?php print "<ul id=\"twitter_update_list\">"; ?>
 <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/blogger.js"></script>
 <script type="text/javascript" src="http://twitter.com/statuses/user_timeline/<?php echo $username; ?>.json?callback=twitterCallback2&amp;count=<?php echo $limit; ?>"></script>

 <?php print "</ul>";



echo $after_widget; ?>

<?php }

function fusion_TwitterWidgetAdmin() {
  // check if anything's been sent
  if (isset($_POST['update_widgetoptions'])) {
   	update_option("fusion_twitterid", strip_tags(stripslashes($_POST['fusion_twitterid'])));
   	update_option("fusion_twitterentries", strip_tags(stripslashes($_POST['fusion_twitterentries'])));
  }
  ?>
  <fieldset>
   <strong><?php _e('Your Twitter ID:','fusion'); ?></strong><br />
   <input type="text" size="30" name="fusion_twitterid" id="fusion_twitterid" value="<?php print get_option('fusion_twitterid'); ?>" />
  </fieldset>
  <br />
  <fieldset>
   <strong><?php _e('Maximum number of entries to display:','fusion'); ?></strong><br />
   <input type="text" size="6" name="fusion_twitterentries" id="fusion_twitterentries" value="<?php print get_option('fusion_twitterentries'); ?>" />
  </fieldset>
  <input type="hidden" id="update_widgetoptions" name="update_widgetoptions" value="1" />
<?php
}
wp_register_sidebar_widget('fusion_twitter_1', 'Fusion: '.__('Twitter posts','fusion'), 'fusion_TwitterWidget');
wp_register_widget_control('fusion_twitter_1', 'Fusion: '.__('Twitter posts','fusion'), 'fusion_TwitterWidgetAdmin');


// theme widget: Flickr
function fusion_FlickrWidget($args){
 extract($args);
 echo $before_widget;
 print $before_title.__('Flickr gallery','fusion').$after_title; ?>

 <div class="flickr">
 <div class="flickr-thumb">
 <?php
 $username = get_option('fusion_flickrid');
 ?>

 <script type="text/javascript">
 /* <![CDATA[ */
  jQuery(function(){
   jQuery.getJSON("http://api.flickr.com/services/feeds/photos_public.gne?ids=<?php print $username; ?>&lang=en-us&format=json&jsoncallback=?", function(data){
     jQuery.each(data.items, function(index, item){
      jQuery("<img />").attr("src", item.media.m).addClass("thumb").appendTo(".flickr").wrap("<a href=\"" + item.link + "\" mce_href=\"" + item.link + "\"></a>").wrap("<div class='flickr-thumb' />");
      webshot(".flickr-thumb img","tooltip");
     });
   });
  });
 /* ]]> */
 </script>
</div>
</div>
 <?php

 echo $after_widget;
}

function fusion_FlickrWidgetAdmin() {
  // check if anything's been sent
  if (isset($_POST['update_widgetoptions'])) {
   	update_option("fusion_flickrid", strip_tags(stripslashes($_POST['fusion_flickrid'])));
  }
  ?>
  <fieldset>
   <strong><?php _e('Your <a href="http://idgettr.com/" target="_blank">Flickr ID</a>:','fusion'); ?></strong><br />
   <input type="text" size="30" name="fusion_flickrid" id="fusion_flickrid" value="<?php print get_option('fusion_flickrid'); ?>" />
  </fieldset>
  <input type="hidden" id="update_widgetoptions" name="update_widgetoptions" value="1" />
<?php
}
wp_register_sidebar_widget('fusion_flicker_1', 'Fusion: '.__('Flickr gallery','fusion'), 'fusion_FlickrWidget');
wp_register_widget_control('fusion_flicker_1', 'Fusion: '.__('Flickr gallery','fusion'), 'fusion_FlickrWidgetAdmin');


// check if sidebar has widgets
function is_sidebar_active($index = 1) {
  global $wp_registered_sidebars;
  if (is_int($index)): $index = "sidebar-$index";
  else :
  	$index = sanitize_title($index);
  	foreach ((array) $wp_registered_sidebars as $key => $value):
    	if ( sanitize_title($value['name']) == $index):
		 $index = $key;
	     break;
		endif;
	endforeach;
  endif;
  $sidebars_widgets = wp_get_sidebars_widgets();
  if (empty($wp_registered_sidebars[$index]) || !array_key_exists($index, $sidebars_widgets) || !is_array($sidebars_widgets[$index]) || empty($sidebars_widgets[$index]))
    return false;
  else
  	return true;
}

// list pings
function list_pings($comment, $args, $depth) {
 $GLOBALS['comment'] = $comment;
 ?>
 <li id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?>
<?php
}

// list comments
function list_comments($comment, $args, $depth) {
 $GLOBALS['comment'] = $comment;
 global $commentcount;
 if(!$commentcount) { $commentcount = 0; }
 ?> <!-- comment entry -->
	<li <?php if (function_exists('comment_class')) { if (function_exists('get_avatar') && get_option('show_avatars')) echo comment_class('with-avatars'); else comment_class(); } else { print 'class="comment';if (function_exists('get_avatar') && get_option('show_avatars')) print ' with-avatars'; print '"';  } ?> id="comment-<?php comment_ID() ?>">
      <div class="wrap tiptrigger">
       <?php if (function_exists('get_avatar') && get_option('show_avatars')): ?>
       <div class="avatar">
         <a class="gravatar"><?php echo get_avatar($comment, 64); ?></a>
       </div>
       <?php endif; ?>
       <div class="details <?php if($comment->comment_author_email == get_the_author_meta('email')) echo 'admincomment'; else echo 'regularcomment'; ?>">
        <p class="head">
         <span class="info">
          <?php
           if (get_comment_author_url()):
            $authorlink='<a id="commentauthor-'.get_comment_ID().'" href="'.get_comment_author_url().'">'.get_comment_author().'</a>';
           else:
            $authorlink='<b id="commentauthor-'.get_comment_ID().'">'.get_comment_author().'</b>';
           endif;
           printf(__('%s by %s on %s', 'fusion'), '<a href="#comment-'.get_comment_ID().'">#'.++$commentcount.'</a>', $authorlink, get_comment_time(get_option('date_format')).' - '.get_comment_time(get_option('time_format')));
          ?>
         </span>
        </p>
        <!-- comment contents -->
        <div class="text">
		 <?php if ($comment->comment_approved == '0'): ?>
		 <p class="error"><small><?php _e('Your comment is awaiting moderation.','fusion'); ?></small></p>
		 <?php endif; ?>
		 <div id="commentbody-<?php comment_ID() ?>">
          <?php comment_text(); ?>
         </div>
       </div>
       <!-- /comment contents -->
       </div>
   	   <div class="act tip">
        <?php if(comments_open()): ?>
         <?php if (function_exists('comment_reply_link')): ?>
	     <span class="button reply"><?php comment_reply_link(array_merge( $args, array('add_below' => 'commentbody', 'depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => '<span><span>'.__('Reply','fusion').'</span></span>'.$my_comment_count))) ?></span>
         <?php endif; ?>
         <span class="button quote"><a title="<?php _e('Quote','fusion'); ?>" href="javascript:void(0);" onclick="MGJS_CMT.quote('commentauthor-<?php comment_ID() ?>', 'comment-<?php comment_ID() ?>', 'commentbody-<?php comment_ID() ?>', 'comment');"><span><span><?php _e('Quote','fusion'); ?></span></span></a></span>
        <?php endif; ?>
        <?php edit_comment_link('<span><span>'.__("Edit","fusion").'</span></span>','<span class="button submit">','</span>'); ?>
	   </div>

      </div>
<?php
  } // </li> is added by wordpress
?>
