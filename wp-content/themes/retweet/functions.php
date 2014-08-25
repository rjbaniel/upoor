<?php
if (!defined('SHOW_AUTHORS')) define('SHOW_AUTHORS', 'true');
if (!defined('TEMPLATE_DOMAIN')) define('TEMPLATE_DOMAIN','retweet');
if ( function_exists('register_sidebar') )
    register_sidebar(array(
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>',
    ));


////////////////////////////////////////////////////////////////////////////////
// load text domain
////////////////////////////////////////////////////////////////////////////////
function init_localization( $locale ) {
return "zh_CN";
}
// Uncomment add_filter below to test your localization, make sure to enter the right language code.
// add_filter('locale','init_localization');

load_theme_textdomain('retweet', TEMPLATEPATH . '/languages/');

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
// new thumbnail code for wp 2.9+
////////////////////////////////////////////////////////////////////////////////
if ( function_exists( 'add_theme_support' ) ) { // Added in 2.9
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 120, 120, true ); // Normal post thumbnails
	add_image_size( 'single-post-thumbnail', 400, 9999 ); // Permalink thumbnail size
}


function custom_comments($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    global $commentcount;
    if(!$commentcount) $commentcount = 0;
    $commentcount ++;
    global $commentalt;
    ($commentalt == "alt")?$commentalt="":$commentalt="alt";   
?>
    <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
	<div class="listable">
	<span class="author <?php echo $commentalt?>"><?php echo get_avatar( $comment, 48 ); ?></span>
	</div>
	<div class="status-body">
		<strong><?php comment_author_link( ); ?></strong><?php if ($comment->comment_approved == '0') : ?><p><small>Your comment is awaiting moderation.</small></p><?php endif; ?><?php comment_text( ); ?>
		<span class="meta">
			<?php comment_date( ); ?> <?php comment_time(); ?> | <a href="#comment-<?php comment_ID( ); ?>" class="commenturl">#<?php echo $commentcount ?></a> <?php comment_reply_link(array('depth' => $depth, 'max_depth'=> $args['max_depth'], 'reply_text' => "@"));?>
		</span>
		<span class="actions">
		<?php edit_comment_link('','<span class="edit_button">','</span>'); ?>
		<span class="reply_button"><?php comment_reply_link(array('depth' => $depth, 'max_depth'=> $args['max_depth'], 'reply_text' => ""));?></span>
		</span>
	</div>
<?php } ?>
<?php
class ClassicOptions {
	function getOptions() {

		$options = get_option('classic_options');
		if (!is_array($options)) {
			$options['retweet_notice'] = false;
			$options['retweet_notice_content'] = '';
			$options['retweet_reply'] = false;
			$options['retweet_twitter_username'] = '';
			$options['retweet_twitter_number'] = '3';
			$options['retweet_design_switch'] = '';
			$options['retweet_design_background'] = '';
			$options['retweet_design_background_tile'] = false;
			$options['retweet_design_bgcolor'] = '#000000';
			$options['retweet_design_text'] = '#15564D';
			$options['retweet_design_links'] = '#A11B3D';
			$options['retweet_design_sidebar'] = '#EFF3A5';
			$options['retweet_design_sidebarborder'] = '#DBE080';
			$options['retweet_round_border'] = false;
			$options['retweet_logo'] = false;
			$options['retweet_wide'] = false;
			$options['retweet_description'] = '';
			$options['retweet_rss'] = '';
			update_option('classic_options', $options);
		}
		return $options;
	}
 
	function init() {
		if(isset($_POST['classic_save'])) {
			$options = ClassicOptions::getOptions();
			if ($_POST['retweet_notice']) {
				$options['retweet_notice'] = (bool)true;
			} else {
				$options['retweet_notice'] = (bool)false;
			}
			if ($_POST['retweet_reply']) {
				$options['retweet_reply'] = (bool)true;
			} else {
				$options['retweet_reply'] = (bool)false;
			}
			if ($_POST['retweet_round_border']) {
				$options['retweet_round_border'] = (bool)true;
			} else {
				$options['retweet_round_border'] = (bool)false;
			}
			if ($_POST['retweet_logo']) {
				$options['retweet_logo'] = (bool)true;
			} else {
				$options['retweet_logo'] = (bool)false;
			}
			if ($_POST['retweet_design_background_tile']) {
				$options['retweet_design_background_tile'] = (bool)true;
			} else {
				$options['retweet_design_background_tile'] = (bool)false;
			}
			if ($_POST['retweet_wide']) {
				$options['retweet_wide'] = (bool)true;
			} else {
				$options['retweet_wide'] = (bool)false;
			}
			$options['retweet_design_switch'] = $_POST['retweet_design_switch'];
			$options['retweet_notice_content'] = stripslashes($_POST['retweet_notice_content']);
			$options['retweet_twitter_username'] = stripslashes($_POST['retweet_twitter_username']);
			$options['retweet_twitter_number'] = stripslashes($_POST['retweet_twitter_number']);
			$options['retweet_design_background'] = stripslashes($_POST['retweet_design_background']);
			$options['retweet_design_bgcolor'] = stripslashes($_POST['retweet_design_bgcolor']);
			$options['retweet_design_text'] = stripslashes($_POST['retweet_design_text']);
			$options['retweet_design_links'] = stripslashes($_POST['retweet_design_links']);
			$options['retweet_design_sidebar'] = stripslashes($_POST['retweet_design_sidebar']);
			$options['retweet_design_sidebarborder'] = stripslashes($_POST['retweet_design_sidebarborder']);
			$options['retweet_description'] = stripslashes($_POST['retweet_description']);
			$options['retweet_rss'] = stripslashes($_POST['retweet_rss']);
			update_option('classic_options', $options);
		} else {
			ClassicOptions::getOptions();
		}
		add_theme_page("Retweet Options", "Retweet Options", 'edit_theme_options', basename(__FILE__), array('ClassicOptions', 'display'));
	}
	function display() {
		$options = ClassicOptions::getOptions();

		$styleArray = array(
		"" => __("Default Style", 'retweet'),
        "01" => __("&quot;Sun hand&quot; Style", 'retweet'),
        "02" => __("&quot;I like to fly&quot; Style", 'retweet'),
        "03" => __("&quot;Fantasy Island&quot; Style", 'retweet'),
        "04" => __("&quot;Photosynthesis&quot; Style", 'retweet'),
        "custom" => __("Custom Style", 'retweet'),
		);
?>
<form action="#" method="post" enctype="multipart/form-data" name="classic_form" id="classic_form">
	<div class="wrap">
		<h2><?php _e('Retweet Theme Options', 'retweet'); ?></h2>
 		<table class="form-table">
			<tbody>
				<tr valign="top">
				<th scope="row">
				<strong><?php _e('Option', 'retweet'); ?></strong>
				<br/>
				<small style="font-weight:normal;"><?php _e('Basic option', 'retweet') ?></small>
				</th>
				<td>
				<label title="<?php _e('Enable it to show notice at homepage.You can also use HTML to add a link,js code etc.', 'retweet'); ?>">
					<input name="retweet_notice" type="checkbox" value="checkbox" <?php if($options['retweet_notice']) echo "checked='checked'"; ?> />
					<?php _e('Show Notice(HTML enabled)', 'retweet'); ?>
				</label>
				<br/>
				<label>
					<textarea name="retweet_notice_content" cols="50" rows="2" id="retweet_notice_content" style="width:98%;font-size:12px;overflow:auto;" class="code"><?php echo($options['retweet_notice_content']); ?></textarea>
				</label>
				<br/>
				<label title="<?php _e('Input a description and it is good for SEO.', 'retweet'); ?>">
					<?php _e('Blog description(Input for SEO,text only)', 'retweet'); ?>
				</label>
				<label>
					<textarea name="retweet_description" cols="50" rows="2" id="retweet_description" style="width:98%;font-size:12px;overflow:auto;" class="code"><?php echo($options['retweet_description']); ?></textarea>
				</label>
				<br/>
				<label title="<?php _e('You can use your Feedburner feed instead original.If you don\' need it please leave it blank.', 'retweet'); ?>">
					<?php _e('Custom RSS Feed (Leave blank if you don\'t need it)', 'retweet'); ?>
				</label>
				<label>
					<textarea name="retweet_rss" cols="50" rows="1" id="retweet_rss" style="width:98%;font-size:12px;overflow:hidden;" class="code"><?php echo($options['retweet_rss']); ?></textarea>
				</label>
				<br/>
				<label title="<?php _e('Input your twitter username to show your tweets at homepage', 'retweet'); ?>">
					<?php _e('Your twitter username : ', 'retweet'); ?><textarea name="retweet_twitter_username" cols="50" rows="1" id="retweet_twitter_username" style="width:100px;font-size:12px;overflow:hidden;" class="code"><?php echo($options['retweet_twitter_username']); ?></textarea>
				</label>
				<label title="<?php _e('Input your twitter username to show your tweets at homepage', 'retweet'); ?>">
					<?php _e('Tweet display number :', 'retweet'); ?><textarea name="retweet_twitter_number" cols="50" rows="1" id="retweet_twitter_number" style="width:30px;font-size:12px;overflow:hidden;" class="code"><?php echo($options['retweet_twitter_number']); ?></textarea>
				</label>
				<br/>
				<label title="<?php _e('I recommend you enable it though it doesn\'s work in IE and invalid CSS3', 'retweet'); ?>">
					<input name="retweet_round_border" type="checkbox" value="checkbox" <?php if($options['retweet_round_border']) echo "checked='checked'"; ?> />
					 <?php _e('Use Roundborder(do not work in IE and invalid CSS3).', 'retweet'); ?>
				</label>
				<br/>
				<label title="<?php _e('I recommend you enable it,but first of all you need to make a Logo image for yourself.', 'retweet'); ?>">
					<input name="retweet_logo" type="checkbox" value="checkbox" <?php if($options['retweet_logo']) echo "checked='checked'"; ?> />
					 <?php _e('Use logo image instead of text(The logo image PSD is under the theme image folder)', 'retweet'); ?>
				</label>
				<br/>
				<label title="<?php _e('Wide mode looks better in widescreen.The guests can control it at navmenu and save their habit by cookies.', 'retweet'); ?>">
					<input name="retweet_wide" type="checkbox" value="checkbox" <?php if($options['retweet_wide']) echo "checked='checked'"; ?> />
					<?php _e('Use wide mode default', 'retweet'); ?>
				</label>
				<br/>
				<label title="<?php _e('Open @reply and a link target the comment you reply.', 'retweet'); ?>">
					<input name="retweet_reply" type="checkbox" value="checkbox" <?php if($options['retweet_reply']) echo "checked='checked'"; ?> />
					<?php _e('Use @reply', 'retweet'); ?>
				</label>
				</td>
				</tr>
				<tr valign="top">
				<th scope="row">
				<strong><?php _e('Design', 'retweet'); ?></strong>
				<br/>
				<small style="font-weight:normal;"><?php _e('Just like your twitter!', 'retweet') ?></small>
				</th>
				<td>
				<label title="<?php _e('There is a default twitter style and four add-on style from twittergallery dot com.You can select &quot;Custom Style&quot; to design the style by yourself.', 'retweet'); ?>">
					<?php _e('Stylelist : ', 'retweet'); ?>
					<select style="width:240px;" name="retweet_design_switch" id="retweet_design_switch">
<?php
		if (is_array($styleArray)) {
			foreach ($styleArray as $key =>$style) {
				if ($key == $options['retweet_design_switch']) {
					$styleSelected = ' selected ';
				} else {
					$styleSelected = '';
				}
				echo '<option value="' . $key . '"' . $styleSelected . '>' . $style . '</option>' . "\n";
			}
		} else {
			echo '<option value="0">' . __('Please install a valid style first!', 'retweet') . '</option>';
		}
?>
					</select>
				</label>
				<br/>
				<label title="<?php _e('It works when you select &quot;Custom Style&quot; mode.', 'retweet'); ?>">
					<?php _e('Change background image : ', 'retweet'); ?><br><textarea name="retweet_design_background" cols="50" rows="1" id="retweet_design_background" style="width:98%;font-size:12px;overflow:hidden;" class="code"><?php echo($options['retweet_design_background']); ?></textarea>
				</label>
				<br/>
				<label>
					<input name="retweet_design_background_tile" type="checkbox" value="checkbox" <?php if($options['retweet_design_background_tile']) echo "checked='checked'"; ?> /><?php _e('Tile background', 'retweet'); ?>
				</label>
				<br/>
				<label title="<?php _e('It works when you select &quot;Custom Style&quot; mode.', 'retweet'); ?>">
					<?php _e('Change design colors(Don\'t contain \'#\') : ', 'retweet'); ?>
				</label>
				<br/>
				<label>
					<?php _e('background :', 'retweet'); ?><textarea name="retweet_design_bgcolor" cols="50" rows="1" id="retweet_design_bgcolor" style="width:80px;font-size:12px;color:#666;overflow:hidden;background:#<?php echo($options['retweet_design_bgcolor']); ?>;" class="code"><?php echo($options['retweet_design_bgcolor']); ?></textarea>
				</label>
				<label>
					<?php _e('text :', 'retweet'); ?><textarea name="retweet_design_text" cols="50" rows="1" id="retweet_design_text" style="width:80px;font-size:12px;color:#666;overflow:hidden;background:#<?php echo($options['retweet_design_text']); ?>;" class="code"><?php echo($options['retweet_design_text']); ?></textarea>
				</label>
				<label>
					<?php _e('links :', 'retweet'); ?><textarea name="retweet_design_links" cols="50" rows="1" id="retweet_design_links" style="width:80px;font-size:12px;color:#666;overflow:hidden;background:#<?php echo($options['retweet_design_links']); ?>;" class="code"><?php echo($options['retweet_design_links']); ?></textarea>
				</label>
				<br/>
				<label>
					<?php _e('sidebar :', 'retweet'); ?><textarea name="retweet_design_sidebar" cols="50" rows="1" id="retweet_design_sidebar" style="width:80px;font-size:12px;color:#666;overflow:hidden;background:#<?php echo($options['retweet_design_sidebar']); ?>;" class="code"><?php echo($options['retweet_design_sidebar']); ?></textarea>
				</label>
				<label>
					<?php _e('sidebar border :', 'retweet'); ?><textarea name="retweet_design_sidebarborder" cols="50" rows="1" id="retweet_design_sidebarborder" style="width:80px;font-size:12px;color:#666;overflow:hidden;background:#<?php echo($options['retweet_design_sidebarborder']); ?>;" class="code"><?php echo($options['retweet_design_sidebarborder']); ?></textarea>
				</label>
				<br/>
				</td>
				</tr>
			</tbody>
		</table>
		<p class="submit">
			<input type="submit" name="classic_save" value="<?php _e('Update Options &raquo;', 'retweet'); ?>" />
		</p>
	</div>
</form>
<?php
	}
}
 
add_action('admin_menu', array('ClassicOptions', 'init'));
 
?>
