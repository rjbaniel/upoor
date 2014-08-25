<?php
if (!defined('SHOW_AUTHORS')) define('SHOW_AUTHORS', 'true');
if (!defined('TEMPLATE_DOMAIN')) define('TEMPLATE_DOMAIN', 'monotone');
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

// define widths
define('MIN_WIDTH', 560);
define('MAX_WIDTH', 840);

function partial($file) { include $file.'.php'; }


function header_function() {
	global $vertical;
	if(!is_single() && is_home() && !is_archive()) query_posts("posts_per_page=1");
	if(!is_archive() && !is_search()) : ?>
		<style type="text/css" media="screen">
		<?php
		while ( have_posts() ) : the_post();
			// ececute the specific stylesheet
			print_stylesheet();
			// determine if an image is vertical or not
			if(is_vertical(the_image_url(true))) { $vertical = true; }
 		endwhile; rewind_posts(); ?>
		</style>
	<?php endif;
}

// remove image tag from post_content for display
function image_scrape($entry) {
	// don't scrape the image for the feed
	if (is_feed()) { return $entry; }
	
	//remove image tag
	$entry = preg_replace('/<img [^>]*src=(\"|\').+?(\1)[^>]*\/*>/','', $entry);
	
	//remove any empty tags left by the scrape.
	$entry = str_replace('<p> </p>', '', $entry);
	$entry = preg_replace( '|<([a-z]+)[^>]*>\s*</\1>|i', '', $entry );
	$entry = preg_replace( '|<([a-z]+)[^>]*>\s*</\1>|i', '', $entry );
	$entry = preg_replace( '|<([a-z]+)[^>]*>\s*</\1>|i', '', $entry );
	return $entry;
}

// this resets post meta
function reset_colors($post) {
	delete_post_meta($post->ID, 'image_md5');
	delete_post_meta($post->ID, 'image_url');
	delete_post_meta($post->ID, 'image_size');
	delete_post_meta($post->ID, 'image_tag');
	
	delete_post_meta($post->ID, 'image_color_base');
	delete_post_meta($post->ID, 'image_colors');
	delete_post_meta($post->ID, 'image_colors_bg');
	delete_post_meta($post->ID, 'image_colors_fg');
}

function image_setup($postid) {
	global $post;
	$post = get_post($postid);
	
	// get url
	if ( !preg_match('/<img ([^>]*)src=(\"|\')(.+?)(\2)([^>\/]*)\/*>/', $post->post_content, $matches) ) {
		reset_colors($post);
		return false;
	}

	// url setup
	$post->image_url = $matches[3];

	if ( !$post->image_url = preg_replace('/\?w\=[0-9]+/','', $post->image_url) )
		return false;

	$post->image_url = esc_url( $post->image_url, 'raw' );
	$previous_md5 = get_post_meta($post->ID, 'image_md5', true);
	$previous_url = get_post_meta($post->ID, 'image_url', true);
	
	if ( ( md5($post->image_tag) != $previous_md5 ) or ( $post->image_url != $previous_url ) ) {
		reset_colors($post);

		add_post_meta($post->ID, 'image_url', $post->image_url);
		add_post_meta($post->ID, 'image_md5', md5($post->image_tag));
		
		//image tag setup
		$extra = $matches[1].' '.$matches[5];
		$extra = preg_replace('/width=(\"|\')[0-9]+(\1)/','', $extra);
		$extra = preg_replace('/height=(\"|\')[0-9]+(\1)/','', $extra);
		$width = (is_vertical($post->image_url)) ? MIN_WIDTH : MAX_WIDTH;
		

		delete_post_meta($post->ID, 'image_tag');
		add_post_meta($post->ID, 'image_tag', '<img src="'.$post->image_url.'?w='.$width.'" '.$extra.' />');
		
		// get colors
		get_all_colors($post);
		return false;
	}

	return true;
}

function is_vertical($url) {
	if(preg_match('/(jpg|jpeg|jpe|JPEG|JPG|png|PNG|gif|GIF)/',$url)) {
	global $post;
	$size = get_post_meta($post->ID, 'image_size', true);
	if ( !$size ) {
		$size = getimagesize($url);
		add_post_meta($post->ID, 'image_size', $size);
	}
	$post->image_width = $size[0];
	if($size) {
		if($size[0] == $size[1]) return true;
		if($size[0] < $size[1]) return true;
		if($size[0] < MIN_WIDTH) return true;
	}
	return false;
	}
	return false;
}

function the_image($return = null) {
	global $post;
	$tag = get_post_meta($post->ID, 'image_tag', true);
	if(!$tag) {
		image_setup($post->ID);
		$tag = get_post_meta($post->ID, 'image_tag', true);
	}
	$tag = preg_replace('/width=(\"|\')[0-9]+(\1)/','', $tag);
	$tag = preg_replace('/height=(\"|\')[0-9]+(\1)/','', $tag);
	if($return) return $tag; /*else*/ echo $tag;
}

function the_image_url($return = null) {
	global $post;
	$tag = get_post_meta($post->ID, 'image_url', true);
	if(!$tag) {
		image_setup($post->ID);
		$tag = get_post_meta($post->ID, 'image_url', true);
	}
	if($return) return $tag; /*else*/ echo $tag;
}

function the_thumbnail() {
	global $post;
	$src = preg_replace('/\?w\=[0-9]+/','?w=125', the_image(true));
	$src = '<div class="image thumbnail">'.$src.'</div>';
	echo $src;
}

function get_all_colors($post) {
	//pull from DB
	$base->bg = get_post_meta($post->ID, 'image_colors_bg',true);
	$base->fg = get_post_meta($post->ID, 'image_colors_fg',true);
	
	// show return variable if full
	if($base->bg != '' && $base->fg != '') {
		return $base;
	} else {
	// else, get the colors
		include_once("csscolor.php");
		$base = new CSS_Color(base_color($post));
		//set bg
		$bg = $base->bg;
		//set fg
		$fg = $base->fg;
		if( add_post_meta($post->ID, 'image_colors_bg', $bg, false)
		&&  add_post_meta($post->ID, 'image_colors_fg', $fg, false)) return $base;
	}
}

function print_stylesheet() {
	global $post;
	$color = get_all_colors($post);
	?>
	#page {
	  	background-color:#<?php echo $color->bg['-1']; ?>;
		color:#<?php echo $color->fg['-2']; ?>;
	}
	
	a,a:link, a:visited {
		color: #<?php echo $color->fg['-3']; ?>;
	}

  	a:hover, a:active {
		color: #<?php echo $color->bg['+2']; ?>;
	}
	
		h1, h1 a, h1 a:link, h1 a:visited, h1 a:active {
		color: #<?php echo $color->fg['0']; ?>;
		}
		h1 a:hover {
			color:#<?php echo $color->bg['+2']; ?>;
		}
		.navigation a, .navigation a:link, 
		.navigation a:visited, .navigation a:active {
		 
		  	color: #<?php echo $color->fg['0']; ?>;
		}
		h1:hover, h2:hover, h3:hover, h4:hover, h5:hover h6:hover,
		.navigation a:hover {
			color:#<?php echo $color->fg['-2']; ?>;
		}
		
	.description,
	h3#respond,
	#comments,
	h2, h2 a, h2 a:link, h2 a:visited, h2 a:active,
	h3, h3 a, h3 a:link, h3 a:visited, h3 a:active,
	h4, h4 a, h4 a:link, h4 a:visited, h4 a:active,
	h5, h5 a, h5 a:link, h5 a:visited, h5 a:active,
	h6, h6 a, h6 a:link, h6 a:visited, h6 a:active {
	  	/* Use the corresponding foreground color */
	  	color: #<?php echo $color->fg['-1']; ?>;
		border-color: #<?php echo $color->bg['+3']; ?>;
		border-bottom: #<?php echo $color->bg['+3']; ?>;
	}

	#postmetadata, #commentform p, .commentlist li, #post, #postmetadata .sleeve, #post .sleeve,
	#content {
		color: #<?php echo $color->fg['-2']; ?>;
		border-color: #<?php echo $color->fg['-2']; ?>;
	} <?php
}

function base_color($post) {
	
	$url = get_post_meta($post->ID, 'image_url', true);

	// get the image name
	$imgname = trim($url);
	
	// create a working image 
	$im = imagecreatefromjpeg($imgname);
	
	$height = imagesy($im);
	$top = $height - 400;
	$width = imagesx($im);

	// sample five points in the image, based on rule of thirds and center
	$rgb = array();
	
	$topy = round($height / 3);
	$bottomy = round(($height / 3) * 2);
	$leftx = round($width / 3);
	$rightx = round(($width / 3) * 2);
	$centery = round($height / 2);
	$centerx = round($width / 2);
	
	$rgb[1] = imagecolorat($im, $leftx, $topy);
	$rgb[2] = imagecolorat($im, $rightx, $topy);
	$rgb[3] = imagecolorat($im,  $leftx, $bottomy);
	$rgb[4] = imagecolorat($im,  $rightx, $bottomy);
	$rgb[5] = imagecolorat($im, $centerx, $centery);
	
	// extract each value for r, g, b
	$r = array();
	$g = array();
	$b = array();
	$hex = array();
	
	$ct = 0; $val = 50;
	
	// process points
	for ($i = 1; $i <= 5; $i++) {
	   $r[$i] = ($rgb[$i] >> 16) & 0xFF;
	   $g[$i] = ($rgb[$i] >> 8) & 0xFF;
	   $b[$i] = $rgb[$i] & 0xFF;
	
	   // find darkest color
	   $tmp = $r[$i] + $g[$i] + $b[$i];
	
	   	if ($tmp < $val) {
	       $val = $tmp;
	       $ct = $i;
	   	}
		$hex[$i] = rgbhex($r[$i],$g[$i],$b[$i]);
	}
	return $hex[3];
}

function rgbhex($red, $green, $blue) { return sprintf('%02X%02X%02X', $red, $green, $blue); }





////////////////////////////////////////////////////////////////////////////////
// load text domain
////////////////////////////////////////////////////////////////////////////////

// Uncomment this to test your localization, make sure to enter the right language code.

//function test_localization( $locale ) {
//return "fr_FR";
//}
//add_filter('locale','test_localization');


load_theme_textdomain('monotone', TEMPLATEPATH . '/languages/');

////////////////////////////////////////////////////////////////////////////////
// wp 2.7 wp_list_comment
////////////////////////////////////////////////////////////////////////////////



function list_comments($comment, $args, $depth) {
$GLOBALS['comment'] = $comment; ?>


<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<div class="gravatar">
         <?php if (function_exists('avatar_display_comments')) { ?>
<?php avatar_display_comments(get_comment_author_email(),'32',''); ?>
<?php } else { ?>
<?php if (function_exists('get_avatar')) { echo get_avatar( get_comment_author_email() , 32 ); } ?>
<?php } ?>
        </div>
			<div class="metadata">
				<a href="#comment-<?php comment_ID() ?>" title=""><?php comment_date('j M Y') ?> at <?php comment_time() ?></a>
				<cite><?php comment_author_link() ?></cite>
				<?php edit_comment_link(__('edit', 'monotone'),'<br />',''); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
			</div>
			<div class="content">

				<?php if ($comment->comment_approved == '0') : ?>
				<p><em><?php _e('Your comment is awaiting moderation.', 'monotone'); ?></em></p>
				<?php endif; ?>
				<?php comment_text() ?>
			</div>
			<div class="clear"></div>


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














// filters and actions
//add_action('wp_head', header_function);
add_filter('the_content', 'image_scrape');
add_action('publish_post', 'image_setup');
add_action('publish_page', 'image_setup');
