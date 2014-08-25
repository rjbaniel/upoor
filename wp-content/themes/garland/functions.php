<?php
if (!defined('SHOW_AUTHORS')) define('SHOW_AUTHORS', 'true');
if (!defined('TEMPLATE_DOMAIN')) define('TEMPLATE_DOMAIN', 'garland');
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

} //end check




$currentLocale = get_locale();
if(!empty($currentLocale)) {
$moFile = dirname(__FILE__) . "/lang/garland-" . $currentLocale . ".mo";
if(@file_exists($moFile) && is_readable($moFile)) load_theme_textdomain('garland', $moFile);
}

function bfa_remove_word_private($string) {
$string = str_ireplace("private: ", "", $string);
return $string;
}
add_filter('the_title', 'bfa_remove_word_private');


// add support for 2.9 post thumbnails
if ( function_exists( 'add_theme_support' ) )
		add_theme_support( 'post-thumbnails' );


function custom_comment($comment, $args, $depth) {
       $GLOBALS['comment'] = $comment; ?>
       <?php global $i; ?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID( ); ?>">
<div id="comment-<?php comment_ID( ); ?>">
<div class="commentnumber"><?php echo $i+1; ?></div> 
       <div class="comment-author"><?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $size = '32' ); ?></div>
<cite class="fn"><em><?php comment_author_link() ?></em></cite> says:
<?php if ($comment->comment_approved == '0') : ?>
<em><?php _e('Your comment is awaiting moderation.') ?></em>
<?php endif; ?>
<br />
<div class="commentmetadata"><a href="#comment-<?php comment_ID() ?>" title="">
<?php comment_date('F jS Y') ?> at <?php comment_time() ?></a>&nbsp;&nbsp;<?php edit_comment_link(__(__('(Edit)'),'','')); ?></div>
	<?php comment_text() ?>

<?php //echo comment_reply_link(array('before' => '<div class="reply">', 'after' => '</div>', 'reply_text' => 'Reply to this comment', 'depth' => $depth, 'max_depth' => $args['max_depth'] ));  ?>
<?php comment_reply_link(array_merge( $args, array('before' => '<div class="reply">', 'after' => '</div>', 'reply_text' => __('Reply to this comment'), 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?> 
</div>
<?php $i++; }
//function to replace invalid ellipsis with text linking to the post
function elpie_excerpt($text)
{
  global $post;
   return str_replace('[...]', '<a href="'. get_permalink($post->ID) . '">' . '[Read More &rarr;]' . '</a>', $text);
}
add_filter('the_excerpt', 'elpie_excerpt');
add_filter('get_comments_number', 'comment_count', 0);
function comment_count( $count ) {
        if ( ! is_admin() ) {
                global $id;
            //    $comments_by_type = &separate_comments(get_comments('status=approve&post_id=' . $id));
			// fix for bugged php?
			$get_comments = get_comments('status=approve&post_id=' . $id);
			$comments_by_type = &separate_comments($get_comments);
     			return count($comments_by_type['comment']);
        } else {
                return $count;
        }
}
function pings_count( $count ) {
        if ( ! is_admin() ) {
                global $id;
            //    $comments_by_type = &separate_comments(get_comments('status=approve&post_id=' . $id));
			// fix for bugged php?
			$get_comments = get_comments('status=approve&post_id=' . $id);
			$comments_by_type = &separate_comments($get_comments);
     			return count($comments_by_type['ping']);
        } else {
                return $count;
        }
}
add_filter('query_vars', 'add_my_var');
function add_my_var($public_query_vars) {
        $public_query_vars[] = 'garland_css';
        return $public_query_vars;
}
add_action('template_redirect', 'my_var_output');
function my_var_output() {
        $myvalue=get_query_var('garland_css');
        if ($myvalue) {
include('css.php');
                exit; // this stops WordPress entirely
        }
}

add_filter('query_vars', 'add_my_var_main');
function add_my_var_main($public_query_vars) {
        $public_query_vars[] = 'main_css';
        return $public_query_vars;
}
add_action('template_redirect', 'my_var_output_main');
function my_var_output_main() {
        $myvalue=get_query_var('main_css');
        if ($myvalue) {
include('style.php');
                exit; // this stops WordPress entirely
        }
}




// add feed links to header (WP2.7.1)
if (function_exists('add_theme_support'))
    add_theme_support('automatic-feed-links');
/*
add_filter('get_comments_number', 'get_new_comment_count', 0);
function get_new_comment_count( $count ) {
	global $wp_query;
	return count($wp_query->comments_by_type['comment']);
}
*/
function list_pings($comment, $args, $depth) {
       $GLOBALS['comment'] = $comment;
?>
        <div id="comment-<?php comment_ID(); ?>"><?php comment_author_link();
}
function garland_admin_link() {
	if( current_user_can('level_10') ) :
		  echo "<li><a href='"; 
		  bloginfo('url'); 
		  echo "/wp-admin/' title='User Area' class='login'>";
		  _e('Admin', 'garland');
		  echo "</a></li>";	
		  endif;
}
$themecolors = array(
	'bg' => 'ffffff',
	'text' => '000000',
	'link' => '027ac6'
);
if ( function_exists('register_sidebar') )
	register_sidebar(array('name' => __('Left Sidebar', 'garland'), 'id' => 'left-sidebar'));
if ( function_exists('register_sidebar') )
	register_sidebar(array('name' => __('Right Sidebar', 'garland'), 'id' => 'right-sidebar'));
function garland_admin_menu() {
	$page = add_theme_page(__("Garland options", 'garland'), __("Garland options", 'garland'), 'edit_theme_options', 'custom-color', 'garland_admin_page');
	add_action("load-$page", 'garland_save_colors' );
	add_action("admin_print_scripts-$page", 'garland_admin_js');
	add_action("admin_head-$page", 'garland_admin_head');
	add_action("admin_print_scripts-$page", 'kill_feedback', 1 );
}
function garland_admin_js() {
	wp_deregister_script( 'prototype' );
		wp_enqueue_script( 'jquery' );			// wp.com has jquery on every page, let's make sure we do too
	// wp.com apparently already has farbtastic registered, but we probably don't
	//wp_register_script( 'farbtastic', get_stylesheet_directory_uri() . '/farbtastic-prototype.js', array('jquery'), true );
	wp_deregister_script( 'farbtastic' );
	wp_register_script( 'jscolor', get_stylesheet_directory_uri() . '/jscolor/jscolor.js' );
	wp_enqueue_script( 'jscolor' );
}
function garland_admin_head() {
	$base = garland_color('base');
	$_base = substr($base, 1);
	$text = garland_color('text');
	$link = garland_color('link');
	$_top = substr(garland_color('top'), 1);
	$_bottom = substr(garland_color('bottom'), 1);
	$style_uri = get_stylesheet_directory_uri();
echo <<<EOHEAD
<style type="text/css">
	#preview {
		width: 596px;
		height: 371px;
		background: url("$style_uri/garland-image.php?src=preview.png&top=$_top&bottom=$_bottom&base=$_base");
		position: relative;
		margin: 0 auto;

	}
	#preview h3 {
		position: absolute;
		top: 160px;
		left: 75px;
		font-family: Helvetica, Arial, sans-serif;
		font-weight: normal;
		font-size: 160%;
		line-height: 130%;
		margin: 0;
		padding: 0;
	}
	#preview p {
		position: absolute;
		top: 190px;
		left: 75px;
		width: 446px;
		color: $text;
	}
	#preview a, #preview a:link, #preview a:visited {
		text-decoration: none;
		border: none;
		color: $link;
	}
	#preview a:hover {
		text-decoration: underline;
		border: none;
		color: $link;
	}
</style>
EOHEAD;
}
function garland_using_custom_colors() {
	if ( get_theme_mod( 'custom-colors' ) )
		return true;
	return false;
}

function garland_color( $color, $shift = false ) {
	$colors = garland_custom_colors();
	if ( isset($colors[$color]) )
		return ( $shift && $colors[$color][1] ? $colors[$color][1] : $colors[$color][0] );
	return $color;
}

function garland_custom_colors() {
	if ( !$colors = get_theme_mod( 'custom-colors' ) ) {
		$colors = array();
		foreach ( garland_colors() as $label => $color ) {
			$colors[$label] = array( $color['default'] );
			if ( isset($colors[$label]['shift']) )
				$colors[$label][] = $colors[$label]['shift'][0];
		}
	}
	return $colors;
}

function garland_colors() {
	return array(
		'base' => array( 'label' => __('Base', 'garland'), 'el' => 'body, #wrapper, .commentlist .meta .alt', 'prop' => 'background-color', 'default' => '#0072b9', 'shift' => array( '#EDF5FA', '#ffffff' )  ),
		'meta' => array( 'label' => 'Meta', 'el' => '.meta', 'prop' => 'background-color', 'default' => '#EDF4F9' ),
		'quote' => array( 'label' => 'Quote', 'el' => '.blockquote', 'prop' => 'background-color', 'default' => '#EDF4F9' ),
		'link' => array( 'label' => __('Link', 'garland'), 'el' => 'a, a:link, a:hover, a:visited', 'prop' => 'color', 'default' => '#0062A0' ),
		'top' => array( 'label' => __('Header Top', 'garland'), 'default' => '#0472EC' ),
		'bottom' => array( 'label' => __('Header Bottom', 'garland'), 'default' => '#67AAF4' ),
		'text' => array ( 'label' => __('Text', 'garland'), 'el' => '#wrapper', 'prop' => 'color', 'default' => '#494949' )
	);
}

function garland_images() {
	return array(
		'bg-navigation-item.png' => array( 'el' => array(
				'ul.primary-links li a, ul.primary-links li a:link, ul.primary-links li a:visited',
				'ul.primary-links li a:hover, ul.primary-links li a.active'
			),
			'args' => array(
				array( 'top', 'bottom' ),
				array( 'top', 'bottom' )
			),
			'color' => array(
				'transparent',
				'transparent'
			),
			'post' => array(
				'no-repeat 50% 0',
				'no-repeat 50% -48px'
			 )
		),
		'bg-navigation.png' => array( 'el' => '#navigation', 'args' => 'base', 'post' => 'repeat-x 50% 100%' ),
		'body.png' => array( 'el' => '#wrapper', 'args' => array( 'base', 'top', 'bottom' ), 'color' => 'base', 'post' => 'repeat-x 50% 0'),
		'bg-content.png' => array( 'el' => '#wrapper #container #center #squeeze', 'args' => array( 'base', 'top', 'bottom' ), 'color' => '#fff', 'post' => 'repeat-x 50% 0'),
		'bg-content-right.png' => array( 'el' => '#wrapper #container #center .right-corner', 'args' => array( 'base', 'top', 'bottom' ), 'color' => 'transparent', 'post' => 'no-repeat 100% 0'),
		'bg-content-left.png' => array( 'el' => '#wrapper #container #center .right-corner .left-corner', 'args' => array( 'base', 'top', 'bottom' ), 'color' => 'transparent', 'post' => 'no-repeat 0 0')
	);
}

function garland_admin_page() {
	if ( isset($_GET['updated']) ) : ?>
	<div class="updated fade"><p><?php _e('Garland options Updated', 'garland'); ?></p></div>
<?php endif; ?>
<div class="wrap">
	<h2><?php _e('Custom Colors', 'garland'); ?></h2>
<?php garland_color_form(); ?>
<h2><?php _e('Preview', 'garland') ?></h2>
<div id="preview" class="preview-base preview-top preview-bottom">
	<h3 class="preview-text">Lorem ipsum dolor</h3>
	<p class="preview-text">
		Sit amet, consectetur adipisicing elit, sed do eiusmod <a href="#" class="preview-link">tempor incididunt</a> ut labore et
		dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
		nisi ut aliquip ex ea commodo consequat. Duis aute <a href="#" class="preview-link">irure dolor</a> in reprehenderit in
		voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat
		cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
	<p>
</div>
</div>
<?php }
function garland_colors_css() {
	if ( !garland_using_custom_colors() )
		return;
	echo "\n" . '<style type="text/css" media="screen">';
	echo '@import url(' . get_bloginfo('wpurl') . '/?garland_css=1);';
	echo "\n" . '</style>';
}

function garland_color_form()  {
	$colors = garland_colors(); ?>
<form name="custom-colors" id="custom-colors" action="" method="post">
<table id="color-table" class="alignleft">
<?php	foreach ( $colors as $label => $color ) : ?>
	<tr>
		<th scope="row"><label for="<?php echo $label; ?>-color"><?php echo $color['label']; ?></th>
		<td><input type="text" name="custom-color[<?php echo $label; ?>]" id="<?php echo $label; ?>-color" class="color {hash:true}" value="<?php echo garland_color( $label ); ?>" /></td>
	</tr>
<?php	endforeach; ?>
</table>
<p class="submit" style="clear: both;">
<input name="show_exerpts" type="checkbox" value="show" <?php if( get_theme_mod( 'show_exerpts' ) ) {?> checked="checked" <?php } _e('/> Show exerpts instead of posts on main page.<br /><br />', 'garland'); ?>
<input name="show_debug" type="checkbox" value="debug" <?php if( get_theme_mod( 'show_debug' ) ) {?> checked="checked" <?php } _e('/> Show queries and page generation time in the footer.<br /><br />', 'garland'); ?>
<input name="show_fluid" type="checkbox" value="fluid" <?php if( get_theme_mod( 'show_fluid' ) ) {?> checked="checked" <?php } _e('/> Make theme fluid (full width).<br /><br />', 'garland'); ?>
<input name="cat_nav" type="checkbox" value="cat_nav" <?php if( get_theme_mod( 'cat_nav' ) ) {?> checked="checked" <?php } _e('/> Show categories instead of pages in the header.<br /><br />', 'garland'); ?>
<input type="checkbox" name="footer" value="footer" <?php if( get_theme_mod( 'footer' ) ) {?> checked="checked" <?php } ?> /> <input type="text" value="<?php echo htmlspecialchars( get_theme_mod( 'my_footer_text' )); ?>" id='my_footer_text' name='my_footer_text' /> Add your own footer text.<br /><br />

<input name="404" type="checkbox" value="404" <?php if( get_theme_mod( '404' ) ) {?> checked="checked" <?php } _e('/> Email admin on 404 errors.<br /><br />', 'garland'); ?>

<input name="sbl" type="checkbox" value="sbl" <?php if( get_theme_mod( 'sbl' ) ) {?> checked="checked" <?php } _e('/> Hide left sidebar. (will make theme full width)<br /><br />', 'garland'); ?>
<input name="sbr" type="checkbox" value="sbr" <?php if( get_theme_mod( 'sbr' ) ) {?> checked="checked" <?php } _e('/> Hide right sidebar. (will make theme full width)<br /><br />', 'garland'); ?>
<input name="banner" type="checkbox" value="banner" <?php if( get_theme_mod( 'banner' ) ) {?> checked="checked" <?php } _e('/> Show image in header. ', 'garland'); ?><input type="text" value="<?php echo htmlspecialchars( get_theme_mod( 'banner_image' )); ?>" id='banner_image' name='banner_image' /> Link to image.<br />
<br />


<?php if ( get_theme_mod('banner') ): ?>
<img src="<?php echo get_theme_mod('banner_image'); ?>" alt="<?php bloginfo('description'); ?>" /><br /><br />
<?php endif; ?>
<input type="submit" value="<?php echo esc_attr(__('Update Options', 'garland')); ?>" />
<input type="submit" name="reset-colors" value="<?php echo esc_attr(__('Reset to Default Colors', 'garland')); ?>" class="delete" />
</p>
</form>
<?php }
function garland_save_colors() {
	if ( !$_POST )
		return;
	require( 'color-module.php' );
	$colors = garland_custom_colors();
	$defaults = garland_colors();
	if ( isset($_POST['reset-colors']) ) {
		remove_theme_mod( 'custom-colors' );
	} else {
		foreach ( $_POST['custom-color'] as $label => $color ) {
			$colors[$label] = array( preg_replace('/[^#a-fA-F0-9]/', '', $color) );
			if ( isset($defaults[$label]['shift']) )
				$colors[$label][] = _color_shift( $colors[$label][0], $defaults[$label]['default'], $defaults[$label]['shift'][0], $defaults[$label]['shift'][1] );
		}
	if ( isset($_POST['show_exerpts']) ) {
		set_theme_mod( 'show_exerpts', 'true' );
	} else {
	remove_theme_mod( 'show_exerpts' );
	}
	if ( isset($_POST['show_debug']) ) {
		set_theme_mod( 'show_debug', 'true' );
	} else {
	remove_theme_mod( 'show_debug' );
	}
	if ( isset($_POST['show_fluid']) ) {
	set_theme_mod( 'show_fluid', 'true' );
	} else {
	remove_theme_mod( 'show_fluid' );
	}
	if ( isset($_POST['cat_nav']) ) {
	set_theme_mod( 'cat_nav', 'true' );
	} else {
	remove_theme_mod( 'cat_nav' );
	}
	if ( isset($_POST['footer']) ) {
	$footertext = stripslashes($_POST['my_footer_text']);
	set_theme_mod( 'my_footer_text', $footertext );
	set_theme_mod( 'footer', 'true' );
	} else {
	remove_theme_mod( 'footer' );
	}
	if ( isset($_POST['comment_num']) ) {
	set_theme_mod( 'comment', 'true' );
	} else {
	remove_theme_mod( 'comment' );
	}
	if ( isset($_POST['404']) ) {
	set_theme_mod( '404', 'true' );
	} else {
	remove_theme_mod( '404' );
	}
	if ( isset($_POST['sbr']) ) {
	set_theme_mod( 'sbr', 'true' );
	remove_theme_mod( 'sbl' );
	} else {
	remove_theme_mod( 'sbr' );
	}
	if ( isset($_POST['sbl']) ) {
	set_theme_mod( 'sbl', 'true' );
	remove_theme_mod( 'sbr' );
	} else {
	remove_theme_mod( 'sbl' );
	}
	if ( isset($_POST['page']) ) {
	set_theme_mod( 'page', 'true' );
	} else {
	remove_theme_mod( 'page' );
	}
	if ( isset($_POST['banner']) ) {
	set_theme_mod( 'banner', 'true' );
	} else {
	remove_theme_mod( 'banner' );
	}

	if ( isset($_POST['zip']) ) {

	set_theme_mod( 'zip', 'true' );

	} else {

	remove_theme_mod( 'zip' );

	}
	if ( isset($_POST['banner_image']) ) {
	set_theme_mod( 'banner_image', $_POST['banner_image'] );
	} else {
	remove_theme_mod( 'banner_image' );
	}
	set_theme_mod( 'custom-colors', $colors );
	}
	wp_redirect( add_query_arg('updated', '1') );
	exit;
}

function kill_feedback() {
	remove_action( 'admin_head', 'feedback_hackpage' );
	remove_action( 'admin_print_scripts', 'feedback_scripts' );
	remove_action( 'admin_head', 'feedbackform_javascript' );
}

add_action( 'admin_menu', 'garland_admin_menu' );
add_action( 'wp_head', 'garland_colors_css', '1' );


?>
