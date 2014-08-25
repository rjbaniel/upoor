<?php
if (!defined('SHOW_AUTHORS')) define('SHOW_AUTHORS', 'true');
if (!defined('TEMPLATE_DOMAIN')) define('TEMPLATE_DOMAIN', 'freshy');
////////////////////////////////////////////////////////////////////////////////
// load text domain
////////////////////////////////////////////////////////////////////////////////
function init_localization( $locale ) {
return "en_EN";
}
// Uncomment add_filter below to test your localization, make sure to enter the right language code.
//add_filter('locale','init_localization');

load_theme_textdomain('freshy', TEMPLATEPATH . '/languages/');

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


<dt class="<?php echo $author_comment_class; ?>">
				<small class="date">
					<span class="date_day"><?php comment_time('j') ?></span>
					<span class="date_month"><?php comment_time('m') ?></span>
					<span class="date_year"><?php comment_time('Y') ?></span>
				</small>
		</dt>

		<dd class="commentlist_item <?php echo $oddcomment; echo $author_comment_class; ?>" id="comment-<?php comment_ID() ?>">

			<div class="comment">
				<strong class="author" style="height:32px;line-height:32px;">

 <?php if (function_exists('avatar_display_comments')) { ?>
<?php avatar_display_comments(get_comment_author_email(),'48',''); ?>
<?php } else { ?>
<?php if (function_exists('get_avatar')) { echo get_avatar( get_comment_author_email() , 48 ); } ?>
<?php } ?>&nbsp;&nbsp;<?php comment_author_link() ?></strong> <small>(<?php comment_time('H:i:s'); ?>)</small> : <?php edit_comment_link(__('edit',TEMPLATE_DOMAIN),'',''); ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
				<?php if ($comment->comment_approved == '0') : ?>
				<small><?php _e('Your comment is awaiting moderation',TEMPLATE_DOMAIN); ?></small>
				<?php endif; ?>

				<br style="display:none;"/>

				<div class="comment_text">
				<?php comment_text(); ?>
				</div>
			</div>
		</dd>

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












if ( function_exists('register_sidebar') ) {
    register_sidebar(array(
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
        'before_title' => '<h2 class="title">',
        'after_title' => '</h2>',
    ));
}

// modded version to highlight parent menu !
function freshy_wp_list_pages($args = '') {
	parse_str($args, $r);
	if ( !isset($r['depth']) )
		$r['depth'] = 0;
	if ( !isset($r['show_date']) )
		$r['show_date'] = '';
	if ( !isset($r['child_of']) )
		$r['child_of'] = 0;
	if ( !isset($r['title_li']) )
		$r['title_li'] = __('Pages');
	if ( !isset($r['echo']) )
		$r['echo'] = 1;

	$output = '';

	$pages = & get_pages($args);
	if ( $pages ) {

		if ( $r['title_li'] )
			$output .= '<li class="pagenav">' . $r['title_li'] . '<ul>';

		$page_tree = Array();
		foreach ( $pages as $page ) {
			$page_tree[$page->ID]['title'] = $page->post_title;
			$page_tree[$page->ID]['name'] = $page->post_name;
			if ( !empty($r['show_date']) ) {
				if ( 'modified' == $r['show_date'] )
					$page_tree[$page->ID]['ts'] = $page->post_modified;
				else
					$page_tree[$page->ID]['ts'] = $page->post_date;
			}
			if ( $page->post_parent != $page->ID)
				$page_tree[$page->post_parent]['children'][] = $page->ID;
		}
		$output .= freshy_page_level_out($r['child_of'],$page_tree, $r, 0, false);
		if ( $r['title_li'] )
			$output .= '</ul></li>';
	}

	$output = apply_filters('wp_list_pages', $output);

	if ( $r['echo'] )
		echo $output;
	else
		return $output;
}

// modded version to highlight parent menu !
function freshy_page_level_out($parent, $page_tree, $args, $depth = 0, $echo = true) {
	global $wp_query, $post, $wpdb;
	$queried_obj = $wp_query->get_queried_object();
	$output = '';
	
	$current_page = $post->ID;
	$i=0; // loop to get the top parent page
	while($current_page) {
		$i++;
		if (i>100) break; // avoid infinite loop
		$page_query = $wpdb->get_row("SELECT ID, post_title, post_parent FROM $wpdb->posts WHERE ID = '$current_page'");
		$current_page = $page_query->post_parent;
	}
	$parent_id = $page_query->ID;

	if ( $depth )
		$indent = str_repeat("\t", $depth);

	if ( !is_array($page_tree[$parent]['children']) )
		return false;

	foreach ( $page_tree[$parent]['children'] as $page_id ) {
		$cur_page = $page_tree[$page_id];
		$title = $cur_page['title'];

		$css_class = 'page_item';
		if ( $page_id == $queried_obj->ID || $page_id == $parent_id)
			$css_class .= ' current_page_item';

		$output .= $indent . '<li class="' . $css_class . '"><a href="' . get_page_link($page_id) . '" title="' . esc_html($title) . '">' . $title . '</a>';

		if ( isset($cur_page['ts']) ) {
			$format = get_option('date_format');
			if ( isset($args['date_format']) )
				$format = $args['date_format'];
			$output .= " " . mysql2date($format, $cur_page['ts']);
		}

		if ( isset($cur_page['children']) && is_array($cur_page['children']) ) {
			$new_depth = $depth + 1;

			if ( !$args['depth'] || $depth < ($args['depth']-1) ) {
				$output .= "$indent<ul>\n";
				$output .= freshy_page_level_out($page_id, $page_tree, $args, $new_depth, false);
				$output .= "$indent</ul>\n";
			}
		}
		$output .= "$indent</li>\n";
	}
	if ( $echo )
		echo $output;
	else
		return $output;
}


// SET OPTIONS

$freshy_options=array();
//update_option('freshy_options', $freshy_options);
$freshy_theme_default=array();
$freshy_theme_red=array();
$freshy_theme_blue=array();
$freshy_theme_lime=array();

freshy_set_options();

function freshy_set_options() {
	
	global $freshy_options, $freshy_theme_red, $freshy_theme_lime, $freshy_theme_blue;
	
	$freshy_theme_default['highlight_color']='#FF3C00';
	$freshy_theme_default['description_color']='#ADCF20';
	$freshy_theme_default['author_color']='#a3cb00';
	$freshy_theme_default['sidebar_bg']='#FFFFFF';
	$freshy_theme_default['sidebar_titles_color']='#f78b0c';
	$freshy_theme_default['sidebar_titles_bg']='#FFFFFF';
	$freshy_theme_default['menu_bg']='menu_start_triple.gif';
	$freshy_theme_default['menu_color']='#000000';
	$freshy_theme_default['header_bg']='header_image6.jpg';
	$freshy_theme_default['header_bg_custom']='';
	$freshy_theme_default['sidebar_titles_type']='stripes';
	
	$freshy_theme_default['first_menu_label']='Home';
	$freshy_theme_default['blog_menu_label']='Blog';
	$freshy_theme_default['last_menu_label']='Contact';
	$freshy_theme_default['last_menu_type']='';
	$freshy_theme_default['contact_email']='';
	$freshy_theme_default['contact_link']='';
	
	$freshy_theme_default['menu_type']='auto';
	$freshy_theme_default['args_pages']='sort_column=menu_order&title_li=';
	$freshy_theme_default['args_cats']='hide_empty=0&sort_column=name&optioncount=1&title_li=&hierarchical=1&feed=RSS&feed_image='.get_bloginfo('stylesheet_directory').'/images/icons/feed-icon-10x10.gif';
	
	$freshy_theme_lime['highlight_color']='#FF3C00';
	$freshy_theme_lime['description_color']='#ADCF20';
	$freshy_theme_lime['author_color']='#a3cb00';
	$freshy_theme_lime['sidebar_bg']='#FFFFFF';
	$freshy_theme_lime['sidebar_titles_color']='#f78b0c';
	$freshy_theme_lime['sidebar_titles_bg']='#FFFFFF';
	$freshy_theme_lime['menu_bg']='menu_start_triple.gif';
	$freshy_theme_lime['menu_color']='#000000';
	$freshy_theme_lime['header_bg']='header_image6.jpg';
	$freshy_theme_lime['header_bg_custom']='';
	$freshy_theme_lime['sidebar_titles_type']='stripes';

	
	$freshy_theme_red['highlight_color']='#d80f2a';
	$freshy_theme_red['description_color']='#eca50d';
	$freshy_theme_red['author_color']='#eca50d';
	$freshy_theme_red['sidebar_bg']='#F3F3F3';
	$freshy_theme_red['sidebar_titles_color']='#000000';
	$freshy_theme_red['sidebar_titles_bg']='#c2c2c2';
	$freshy_theme_red['menu_bg']='menu_start_triple_red.gif';
	$freshy_theme_red['menu_color']='#ffffff';
	$freshy_theme_red['header_bg']='header_image8.jpg';
	$freshy_theme_red['header_bg_custom']='';
	$freshy_theme_red['sidebar_titles_type']='stripes';
	

	$freshy_theme_blue['highlight_color']='#f5690c';
	$freshy_theme_blue['description_color']='#ff6c00';
	$freshy_theme_blue['author_color']='#f5bb0c';
	$freshy_theme_blue['sidebar_bg']='#dbefff';
	$freshy_theme_blue['sidebar_titles_color']='#0f80d8';
	$freshy_theme_blue['sidebar_titles_bg']='#FFFFFF';
	$freshy_theme_blue['menu_bg']='menu_start_triple_lightblue.gif';
	$freshy_theme_blue['menu_color']='#ffffff';
	$freshy_theme_blue['header_bg']='header_image3.jpg';
	$freshy_theme_blue['header_bg_custom']='';
	$freshy_theme_blue['sidebar_titles_type']='stripes';

		$freshy_options=$freshy_theme_default;

}


// ADD HEAD TO THE TEMPLATE

add_action('wp_head', 'freshy_head');

function freshy_head() {
	
	global $freshy_options, $freshy_theme_lime;
	
	$menu_triple = str_replace("menu_start_triple", "menu_triple", $freshy_options['menu_bg']);
	$menu_end_triple = str_replace("menu_start_triple", "menu_end_triple", $freshy_options['menu_bg']);

	
	?>

	<style type="text/css">
	.menu li a {
		background-image:url("<?php bloginfo('stylesheet_directory'); ?>/images/menu/<?php echo $menu_triple; ?>");
	}
	.menu li a.first_menu {
		background-image:url("<?php bloginfo('stylesheet_directory'); ?>/images/menu/<?php echo $freshy_options['menu_bg']; ?>");
	}
	.menu li a.last_menu {
		background-image:url("<?php bloginfo('stylesheet_directory'); ?>/images/menu/<?php echo $menu_end_triple; ?>");
	}
	.menu li.current_page_item a {
		color:<?php echo $freshy_options['menu_color']; ?> !important;
	}
	
	.description {
		color:<?php echo $freshy_options['description_color']; ?>;
	}
	#content .commentlist dd.author_comment {
		background-color:<?php echo $freshy_options['author_color']; ?> !important;
	}
	html > body #content .commentlist dd.author_comment {
		background-color:<?php echo $freshy_options['author_color']; ?> !important;
	}
	#content .commentlist dt.author_comment .date {
		color:<?php echo $freshy_options['author_color']; ?> !important;
		border-color:<?php echo $freshy_options['author_color']; ?> !important;
	}
	#content .commentlist .author_comment .author,
	#content .commentlist .author_comment .author a {
		color:<?php echo $freshy_options['author_color']; ?> !important;
		border-color:<?php echo $freshy_options['author_color']; ?> !important;
	}
	#sidebar h2 {
		color:<?php echo $freshy_options['sidebar_titles_color']; ?>;
		background-color:<?php echo $freshy_options['sidebar_titles_bg']; ?>;
		border-bottom-color:<?php echo $freshy_options['sidebar_titles_color']; ?>;
	}
	#sidebar {
		background-color:<?php echo $freshy_options['sidebar_bg']; ?>;
	}
	*::-moz-selection {
		background-color:<?php echo $freshy_options['highlight_color']; ?>;
	}

	#content a:hover {
		border-bottom:1px dotted <?php echo $freshy_options['highlight_color']; ?>;
	}

	#sidebar a:hover,
	#sidebar .current_page_item li a:hover,
	#sidebar .current-cat li a:hover,
	#sidebar .current_page_item a,
	#sidebar .current-cat a ,
	.readmore,
	#content .postmetadata a
	{
		color : <?php echo $freshy_options['highlight_color']; ?>;
	}
	
	#title_image {
		margin:0;
		text-align:left;
		display:block;
		height:95px;
	}
	
	</style>

	<?php
}


function freshy_stupid_dir() {
	return substr(strrchr(get_bloginfo('stylesheet_directory'), "/"),1);	
}

// Custom Headers

define('HEADER_TEXTCOLOR', '');
define('HEADER_IMAGE', '%s/images/headers/header_image6.jpg'); // %s is theme dir uri
define('HEADER_IMAGE_WIDTH', 780);
define('HEADER_IMAGE_HEIGHT', 95);
define( 'NO_HEADER_TEXT', true );

function freshy_admin_header_style() {
?>
<style type="text/css">
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

function header_style() {
?>
<style type="text/css">
	#title_image {
	background-image:url(<?php header_image() ?>);
	}
</style>
<?php
}

add_theme_support( 'custom-header', array('wp-head-callback' => 'header_style', 'admin-head-callback' => 'freshy_admin_header_style'));

$themecolors = array(
	'bg' => 'ffffff',
	'border' => 'ffffff',
	'text' => '000000',
	'link' => '515151'
);

?>
