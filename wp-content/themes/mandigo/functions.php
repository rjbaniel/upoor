<?php
if (!defined('SHOW_AUTHORS')) define('SHOW_AUTHORS', 'true');
if (!defined('TEMPLATE_DOMAIN')) define('TEMPLATE_DOMAIN', 'mandigo');
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




	$theme_data      = wp_get_theme('Mandigo');
	$mandigo_version = $theme_data['Version'];
	
	$mandigo_options = get_option('mandigo_options');
	if (!$mandigo_options || $mandigo_version != $mandigo_options['version']) {
		include_once('backend/upgrade.php');
		mandigo_upgrade($from = $mandigo_options['version'], $to = $mandigo_version);
	}



	// this loads the .mo translation file defined in wp-config.php
	load_theme_textdomain('mandigo');



	// we are going to hold a list of both local ('loc') and remote paths ('www'), which we will need throughout the theme
	$dirs = array();
	$dirs['loc']['theme'] = TEMPLATEPATH .'/';
	$dirs['www']['theme'] = get_bloginfo('template_directory') .'/';

	foreach (array('loc', 'www') as $i) {
		foreach(
			array(
				'images',
				'js',
				'schemes',
				'images/patterns',
				'images/headers',
				'images/icons',
				'backend',
			) as $j
		) {
			$dirs[$i][preg_replace('/.+\//', '', $j)] = $dirs[$i]['theme'] . $j .'/';
		}
	}



	// go through the images/schemes/ folder and build a list of installed schemes
	$schemes = array();
	if (($dir = @opendir($dirs['loc']['schemes'])) !== false) {
		while (($node = readdir($dir)) !== false) {
			if (!preg_match('/^\.{1,2}$/', $node) && file_exists($dirs['loc']['schemes'] ."$node/scheme.css"))
				$schemes[] = $node;
		}
	}
	sort($schemes);



	// some global vars
	$ie      = preg_match("/MSIE [4-6]/", $_SERVER['HTTP_USER_AGENT']);
	$ie7     = preg_match("/MSIE 7/",     $_SERVER['HTTP_USER_AGENT']);
	$wpmu    = function_exists('get_current_site');



	// some options may have no value, but we can't live without these ones
	$old_options = $mandigo_options;
	// make sure a scheme is selected, and that it's part of the pool of available schemes
	if (!$mandigo_options['scheme'] || !array_search($mandigo_options['scheme'], $schemes))
		$mandigo_options['scheme'] = $schemes[0];

	if (!isset($mandigo_options['background_color']) || !$mandigo_options['background_color'])           $mandigo_options['background_color']            = '#44484F';
	if (!isset($mandigo_options['background_pattern_repeat']) || !$mandigo_options['background_pattern_repeat'])  $mandigo_options['background_pattern_repeat']   = 'repeat';
	if (!isset($mandigo_options['trackbacks_position']) || !$mandigo_options['trackbacks_position'])        $mandigo_options['trackbacks_position']         = 'along';
	if (!isset($mandigo_options['header_navigation_position']) || !$mandigo_options['header_navigation_position']) $mandigo_options['header_navigation_position']  = 'right';
	if (!isset($mandigo_options['date_format']) || !$mandigo_options['date_format'])                $mandigo_options['date_format']                 = 'MdY';
	if (!isset($mandigo_options['font_family']) || !$mandigo_options['font_family'])                $mandigo_options['font_family']                 = 'sans-serif';
	// colors
	if (!isset($mandigo_options['color_post_background']) || !$mandigo_options['color_post_background'])      $mandigo_options['color_post_background']       = '#FAFAFA';
	if (!isset($mandigo_options['color_post_border']) || !$mandigo_options['color_post_border'])          $mandigo_options['color_post_border']           = '#EEEEEE';
	if (!isset($mandigo_options['color_sidebar_background']) || !$mandigo_options['color_sidebar_background'])   $mandigo_options['color_sidebar_background']    = '#EEEEEE';
	if (!isset($mandigo_options['color_sidebar_border']) || !$mandigo_options['color_sidebar_border'])       $mandigo_options['color_sidebar_border']        = '#DDDDDD';
	// SEO title schemes
	if (!isset($mandigo_options['title_scheme_index']) || !$mandigo_options['title_scheme_index'])         $mandigo_options['title_scheme_index']          = '%blogname% - %tagline%';
	if (!isset($mandigo_options['title_scheme_single']) || !$mandigo_options['title_scheme_single'])        $mandigo_options['title_scheme_single']         = '%blogname% &raquo; %post%';
	if (!isset($mandigo_options['title_scheme_page']) || !$mandigo_options['title_scheme_page'])          $mandigo_options['title_scheme_page']           = '%blogname% &raquo; %post%';
	if (!isset($mandigo_options['title_scheme_category']) || !$mandigo_options['title_scheme_category'])      $mandigo_options['title_scheme_category']       = '%blogname% &raquo; Archive for %category%';
	if (!isset($mandigo_options['title_scheme_date']) || !$mandigo_options['title_scheme_date'])          $mandigo_options['title_scheme_date']           = '%blogname% &raquo; Archive for %date%';
	if (!isset($mandigo_options['title_scheme_search']) || !$mandigo_options['title_scheme_search'])        $mandigo_options['title_scheme_search']         = '%blogname% &raquo; Search Results for &quot;%search%&quot;';
	// SEO heading levels
	if (!isset($mandigo_options['heading_level_blogname']) || !$mandigo_options['heading_level_blogname'])            $mandigo_options['heading_level_blogname']            = 'h1';
	if (!isset($mandigo_options['heading_level_blogdesc']) || !$mandigo_options['heading_level_blogdesc'])            $mandigo_options['heading_level_blogdesc']            = 'h6';
	if (!isset($mandigo_options['heading_level_page_title']) || !$mandigo_options['heading_level_page_title'])          $mandigo_options['heading_level_page_title']          = 'h2';
	if (!isset($mandigo_options['heading_level_post_title_multi']) || !$mandigo_options['heading_level_post_title_multi'])    $mandigo_options['heading_level_post_title_multi']    = 'h3';
	if (!isset($mandigo_options['heading_level_post_title_single']) || !$mandigo_options['heading_level_post_title_single'])   $mandigo_options['heading_level_post_title_single']   = 'h2';
	if (!isset($mandigo_options['heading_level_widget_title']) || !$mandigo_options['heading_level_widget_title'])        $mandigo_options['heading_level_widget_title']        = 'h4';
	// submenu animation speed
	if (!isset($mandigo_options['header_navigation_speed_appear']) || !$mandigo_options['header_navigation_speed_appear'])    $mandigo_options['header_navigation_speed_appear']    = 'fast';
	if (!isset($mandigo_options['header_navigation_speed_disappear']) || !$mandigo_options['header_navigation_speed_disappear']) $mandigo_options['header_navigation_speed_disappear'] = 'slow';
	// sidebar width
	$mandigo_options['sidebar_1_width'] = isset($mandigo_options['sidebar_1_width'])?intval($mandigo_options['sidebar_1_width']):0;
	$mandigo_options['sidebar_2_width'] = isset($mandigo_options['sidebar_2_width'])?intval($mandigo_options['sidebar_2_width']):0;
	if (!is_int($mandigo_options['sidebar_1_width']) || !$mandigo_options['sidebar_1_width']) $mandigo_options['sidebar_1_width'] = 210;
	if (!is_int($mandigo_options['sidebar_2_width']) || !$mandigo_options['sidebar_2_width']) $mandigo_options['sidebar_2_width'] = 210;

	// if we have reset some options, save changes
	if ($old_options != $mandigo_options)
		update_option('mandigo_options', $mandigo_options);

	// set some defaults for the theme viewer at wordpress.org
	if (preg_match('/wp-themes.com|wordpress.org/', get_bloginfo('wpurl'))) {
		$old_options = $mandigo_options;
		$mandigo_options['layout_width'] = 1024;
		$mandigo_options['background_pattern_file']     = 'gr.png';
		$mandigo_options['background_pattern_repeat']   = 'repeat-x';
		$mandigo_options['background_pattern_position'] = 'top left';
		if ($old_options != $mandigo_options)
			update_option('mandigo_options', $mandigo_options);
	}

	// now that we have a (valid) current scheme, set its local and remote locations
	$dirs['loc']['scheme'] = $dirs['loc']['schemes'] . $mandigo_options['scheme'] .'/';
	$dirs['www']['scheme'] = $dirs['www']['schemes'] . $mandigo_options['scheme'] .'/';



	// the following two functions search for files matching a regex pattern, recursively
	// based on http://www.php.net/function.opendir#78262
	function m_find_in_dir($root, $pattern) {
		$result = array();
		if (false === m_find_in_dir_i__($root, $pattern, $result))
			return false;
		return $result;
	}
	function m_find_in_dir_i__($root, $pattern, &$result ) {
		$dh = @opendir( $root );
		if (false === $dh)
			return false;
		while ($file = readdir($dh)) {
			if("." == $file || ".." == $file)
				continue;
			if(false !== @eregi($pattern, "{$root}/{$file}"))
				$result[] = "{$root}/{$file}";
			if(is_dir("{$root}/{$file}"))
				m_find_in_dir_i__("{$root}/{$file}", $pattern, $result);
		}
		closedir($dh);
		return true;
	}



	// this function will build links to author archives for us
	function mandigo_author_link($author_id, $author_nicename) {
		// the get_author_posts_url() function is not defined in some translated versions of WP
		// so we double check it exists
		if (function_exists('get_author_posts_url')) {
			return sprintf(
				'<a href="%s" title="%s">%s</a>',
				get_author_posts_url($author_id),
				sprintf(
					__("Posts by %s"),
					esc_attr($author_nicename)
				),
				$author_nicename
			);
		}
		return $author_nicename;
	}



	// this function builds the 'date stamps'
	function mandigo_date_stamp($date) {
		global $mandigo_options;
		
		// if date position is not set to 'datestamp' or undefined (cause it's a default), stop here
		if ($mandigo_options['date_position'] && $mandigo_options['date_position'] != 'datestamp')
			return;
		
		// split the supplied argument into (year, month_name, month_number, day)
		list($y, $mn, $m, $d) = explode('|', $date);
		// remove the space in japanese month names (hi Atsushi!)
		if (preg_match('/^ja_?/', WPLANG)) {
			$mn = str_replace(' ', '', $mn);
		}
		
		switch ($mandigo_options['date_format']) {
			case 'MdY':
				$l = array($mn, $d, $y);
				$x = array(1, 0, 0);
				break;
			case 'dmY':
				$l = array($d,  $m, $y);
				$x = array(1, 0, 0);
				break;
		}
		
		echo '
						<div class="datestamp">
							<div>
								<span class="cal1'. ($x[0] ? " cal1x" : "") .'">'. $l[0] .'</span>
								<span class="cal2'. ($x[1] ? " cal2x" : "") .'">'. $l[1] .'</span>
								<span class="cal3'. ($x[2] ? " cal3x" : "") .'">'. $l[2] .'</span>
							</div>
						</div>
		';
	}



	// this one tells if the sidebox may be displayed
	function mandigo_sidebox_conditions($single = false) {
		global $mandigo_options;
		return (
			   $mandigo_options['sidebar_count']
			&& $mandigo_options['layout_width'] == 1024
			&& $mandigo_options['sidebar_count'] == 2
			&& $mandigo_options['sidebar_1_position'] == 'right'
			&& $mandigo_options['sidebar_1_position'] == $mandigo_options['sidebar_2_position']
			&& ($single ? $mandigo_options['sidebar_always_show'] : true)
			? true
			: false
		);
	}
	


	// this one adds drop caps the the_content
	function mandigo_drop_caps($data) {
		if (preg_match ('/^\s*</', $data)) {
			return preg_replace('/^\s*(<[^>]+>[\s\r\n]*)*([a-z])/i', '$1<span class="dropcap">$2</span>', $data);
		}
		return preg_replace('/^\s*([a-z])/i', '<span class="dropcap">$1</span>', $data);
	}
	if (isset($mandigo_options['drop_caps']) && $mandigo_options['drop_caps']) {
		add_filter('the_content', 'mandigo_drop_caps');
	}

	
	
	include_once('backend/widgets.php');
	include_once('backend/theme_options.php');
	//include_once('backend/html_inserts.php');
	//include_once('backend/readme.php');




///////////* hack for double cache function *///////////////////

// No CSS, just IMG call

$it_is_wide = $mandigo_options['layout_width'];
if($it_is_wide == 1024){
$the_header_wide = '1024';
} else {
$the_header_wide = '800';
}

$it_is_slim = get_option('mandigo_slim_header');
if($it_is_slim != ''){
$the_header_slim = '100';
} else {
$the_header_slim = '250';
}

//////////////* end */////////////////


define('HEADER_TEXTCOLOR', '');
define('HEADER_IMAGE', ''); // %s is theme dir uri - empty - this to set the default image if custom heade null - don't edit
define('HEADER_IMAGE_WIDTH', $the_header_wide);
define('HEADER_IMAGE_HEIGHT', $the_header_slim);
define( 'NO_HEADER_TEXT', true );




function mandigo_admin_header_style() { ?>
<style type="text/css">
#headimg {
height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
width: <?php echo HEADER_IMAGE_WIDTH; ?>px;
}
#headimg h1, #headimg #desc {
display: none;
}
</style>

<?php }

add_theme_support( 'custom-header', array('admin-head-callback' => 'mandigo_admin_header_style'));

function mandigo_init() {
  global $dirs;
  wp_register_script('mandigo-ifixpng', $dirs['www']['js'].'jquery.ifixpng.js', array('jquery'), '1.0', true);
}
add_action('init', 'mandigo_init');

function mandigo_wp_enqueue_scripts() {
  wp_enqueue_script('mandigo-ifixpng');
}
add_action('wp_enqueue_scripts', 'mandigo_wp_enqueue_scripts');
