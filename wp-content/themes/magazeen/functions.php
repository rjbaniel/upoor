<?php
if (!defined('SHOW_AUTHORS')) define('SHOW_AUTHORS', 'true');
if (!defined('TEMPLATE_DOMAIN')) define('TEMPLATE_DOMAIN', 'magazeen');
if (!defined('OPTION_FILES')) define( 'OPTION_FILES', 'base.php' );
/**
 * @package WordPress
 * @subpackage Magazeen_Theme
 */

////////////////////////////////////////////////////////////////////////////////
// load text domain
////////////////////////////////////////////////////////////////////////////////

// Uncomment this to test your localization, make sure to enter the right language code.

//function test_localization( $locale ) {
//return "fr_FR";
//}
//add_filter('locale','test_localization');


load_theme_textdomain('magazeen', TEMPLATEPATH . '/languages/');

///////////////////////////////////////////////////////////////////////////////
// fetch post img
//////////////////////////////////////////////////////////////////////////////
function custom_get_post_img ($the_post_id='', $size='') {
$detect_post_id = $the_post_id;

$images = get_children(array(
'post_parent' => $the_post_id,
'post_type' => 'attachment',
'numberposts' => 1,
'post_mime_type' => 'image'));
if ($images) {
foreach($images as $image) {
$attachment=wp_get_attachment_image_src($image->ID, $size); ?>
<?php echo $attachment[0]; ?>
<?php
}
} else { ?>
<?php echo bloginfo('template_directory') . '/images/default.png'; ?>
<?php }
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
    register_sidebar(array(
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h5 class="widgettitle">',
        'after_title' => '</h5>',
    ));

/* Comments
/* ----------------------------------------------*/

function magazeen_comment( $comment, $args, $depth ) {

	$GLOBALS[ 'comment' ] = $comment;
?>

	<li id="comment-<?php comment_ID() ?>" <?php comment_class( 'clearfix' ); ?>>

		<div class="comment-wrap clearfix">

			<div class="comment-author clearfix">
			
				<?php 
					$comment_type = get_comment_type();
					if( $comment_type == 'comment' ) :
				?>	
					<div class="gravatar">
						<?php echo get_avatar( $comment, $size='38' ); ?>
					</div>
				<?php
					endif;
				?>
				<div class="author">
					<strong class="name"><?php echo get_comment_author_link(); ?> 
					<?php if( $comment_type == 'comment' ) : ?>	
						<span class="reply"><?php comment_reply_link( array_merge( $args, array( 'reply_text' => '(Reply)', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></span>
					<?php endif; ?>
					</strong>
					<?php if( $comment_type == 'comment' ) : ?>	
						<span class="date">on <?php the_time( 'l j, Y' ) ?></span>
					<?php endif; ?>
				</div>
				
			</div><!-- End comment-author -->
	
			<div class="comment-text">
				<?php if ($comment->comment_approved == '0') : ?>
					<p><em><?php _e('Your comment is awaiting moderation.') ?></em></p>
         		<?php endif; ?>
				
				<?php comment_text(); ?>
			</div><!-- End comment-text -->
						
		</div><!-- End comment-wrap -->	

<?php

}
	
/* Featured News Widget
/* ----------------------------------------------*/	

function featured_news() {

	$settings = get_option( 'widget_featured_news' );  
	$number = $settings[ 'number' ];
	$category = $settings[ 'category' ];

?>

	<li id="featured-news"><h5>Featured News</h5>
		<ul>
			
			<?php
				$recent = new WP_Query( 'showposts=' . $number . '&category_name=' . $category );
				while( $recent->have_posts() ) : $recent->the_post();

					global $post; global $wp_query;
                    $the_post_ids = get_the_ID();
			?>
		
			<li class="clearfix">

            <?php if( get_post_meta( $post->ID, "image_value", true ) ) : ?>

			<div class="sidebar-preview">
					 <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
					 <img src="<?php echo get_post_meta( $post->ID, "image_value", true ); ?>" alt="<?php the_title(); ?>" />
					 </a>
					</div>

                    <?php else: ?>

                     <div class="sidebar-preview">
					 <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
					 <img src="<?php echo custom_get_post_img ($the_post_id=$the_post_ids, $size='thumbnail'); ?>" alt="<?php the_title(); ?>" />
					 </a>
					</div>

				<?php endif; ?>


				<div class="sidebar-content">
					<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
					<span><a href="<?php the_permalink(); ?>/#comments" title="Read Comments"><?php comments_number('0 Comments', '1 Comment', '% Comments' );?></a></span>
				</div>
			</li>
			
			<?php
				endwhile;
			?>
			
		</ul>
		<a href="<?php echo get_category_link( get_cat_id( $category ) ); ?>" class="sidebar-read-more">Read More &raquo;</a>
	</li>

<?php

}

function featured_news_admin() {
	
	$settings = get_option( 'widget_featured_news' );

	if( isset( $_POST[ 'update_featured_news' ] ) ) {
		$settings[ 'number' ] = strip_tags( stripslashes( $_POST[ 'widget_featured_news_number' ] ) );
		$settings[ 'category' ] = strip_tags( stripslashes( $_POST[ 'widget_featured_news_category' ] ) );
		
		update_option( 'widget_featured_news', $settings );
	}
?>
	<p>
		<label for="widget_featured_news_number">How many items would you like to display?</label><br />
		<select id="widget_featured_news_number" name="widget_featured_news_number">
			<?php
				$settings = get_option( 'widget_featured_news' );  
				$number = $settings[ 'number' ];
				
				$numbers = array( "1", "2", "3", "4", "5", "6", "7", "8", "9", "10" );
				foreach ($numbers as $num ) {
					$option = '<option value="' . $num . '" ' . ( $number == $num? " selected=\"selected\"" : "") . '>';
						$option .= $num;
					$option .= '</option>';
					echo $option;
				}
			?>
		</select>
	</p>
	<p>
		<label for="widget_featured_news_category">Which Category is Featured?</label><br />
		<select id="widget_featured_news_category" name="widget_featured_news_category">
			<?php
				$settings = get_option( 'widget_featured_news' );  
				$category = $settings[ 'category' ];
				
				$categories= get_categories();
				foreach ($categories as $cat) {
					$option = '<option value="'.$cat->cat_name.'" ' . ( $category == $cat->category_nicename ? " selected=\"selected\"" : "") . '>';
						$option .= $cat->cat_name;
					$option .= '</option>';
					echo $option;
				}
			?>
		</select>
	</p>
	<input type="hidden" id="update_featured_news" name="update_featured_news" value="1" />

<?php

}

/* Recent News Widget
/* ----------------------------------------------*/	

function recent_news() {

	$settings = get_option( 'widget_recent_news' );  
	$number = $settings[ 'number' ];
	$home = $settings[ 'home' ];
	
	if( is_front_page() ) {
		if( $home == "Yes" ) {
			$show = true;
		} else {
			$show = false;
		}
	} else {
		$show = true;
	}
	
?>

	<?php if( $show ) : ?> 

	<li id="recent-news"><h5>Recent News</h5>
		<ul>
			
			<?php
				$recent = new WP_Query( 'showposts=' . $number );
				while( $recent->have_posts() ) : $recent->the_post(); 
					global $post; global $wp_query;
			?>
		
			<li class="clearfix">

                 <?php if( get_post_meta( $post->ID, "image_value", true ) ) : ?>

			<div class="sidebar-preview">
					 <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
					 <img src="<?php echo get_post_meta( $post->ID, "image_value", true ); ?>" alt="<?php the_title(); ?>" />
					 </a>
					</div>

                    <?php else: ?>

                     <div class="sidebar-preview">
					 <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
					 <img src="<?php echo custom_get_post_img ($the_post_id=$the_post_ids, $size='thumbnail'); ?>" alt="<?php the_title(); ?>" />
					 </a>
					</div>

				<?php endif; ?>


				<div class="sidebar-content">
					<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
					<span><a href="<?php the_permalink(); ?>/#comments" title="Read Comments"><?php comments_number('0 Comments', '1 Comment', '% Comments' );?></a></span>
				</div>
			</li>
			
			<?php
				endwhile;
			?>
			
		</ul>
		<a href="<?php bloginfo( 'rss2_url' ); ?>" class="sidebar-read-more-rss">RSS Feed &raquo;</a>
	</li>
	
	<?php endif; ?>

<?php

}

function recent_news_admin() {
	
	$settings = get_option( 'widget_recent_news' );

	if( isset( $_POST[ 'update_recent_news' ] ) ) {
		$settings[ 'number' ] = strip_tags( stripslashes( $_POST[ 'widget_recent_news_number' ] ) );
		$settings[ 'home' ] = strip_tags( stripslashes( $_POST[ 'widget_recent_news_home' ] ) );
		
		update_option( 'widget_recent_news', $settings );
	}
?>
	<p>
		<label for="widget_recent_news_number">How many items would you like to display?</label><br />
		<select id="widget_recent_news_number" name="widget_recent_news_number">
			<?php
				$settings = get_option( 'widget_recent_news' );  
				$number = $settings[ 'number' ];
				
				$numbers = array( "1", "2", "3", "4", "5", "6", "7", "8", "9", "10" );
				foreach ($numbers as $num ) {
					$option = '<option value="' . $num . '" ' . ( $number == $num? " selected=\"selected\"" : "") . '>';
						$option .= $num;
					$option .= '</option>';
					echo $option;
				}
			?>
		</select>
	</p>
	<p>
		<label for="widget_recent_recent_home">Show on Homepage?</label><br />
		<select id="widget_recent_recent_home" name="widget_recent_news_home">
			<?php
				$settings = get_option( 'widget_recent_news' );  
				$home = $settings[ 'home' ];
				
				$options = array( "Yes", "No" );
				foreach( $options as $op ) {
					$option = '<option value="' . $op . '" ' . ( $home == $op ? " selected=\"selected\"" : "") . '>';
						$option .= $op;
					$option .= '</option>';
					echo $option;
				}
			?>
		</select>
	</p>
	<input type="hidden" id="update_recent_news" name="update_recent_news" value="1" />

<?php

}

/* Sponsored Ad Widget
/* ----------------------------------------------*/	

function sponsored_ad() {

	$settings = get_option( 'widget_sponsored_ad' );  
	$code = $settings[ 'code' ];
	$title = $settings[ 'title' ];
	
?>

	<li id="sponsored-ad">
		<p class="sponsored-ad"><?php echo $title; ?></p>
						
		<?php echo $code; ?>
	</li><!-- End sponsored-ad -->
	
<?php

}

function sponsored_ad_admin() {

	$settings = get_option( 'widget_sponsored_ad' );

	if( isset( $_POST[ 'widget_sponsored_ad' ] ) ) {
		$settings[ 'code' ] = stripslashes( $_POST[ 'widget_code' ] );
		$settings[ 'title' ] = strip_tags( stripslashes( $_POST[ 'widget_code_title' ] ) );
		update_option( 'widget_sponsored_ad', $settings );
	}
	
	$settings = get_option( 'widget_sponsored_ad' );  
	$code = $settings[ 'code' ];
	$title = $settings[ 'title' ];
?>
	<p>
		<label for="widget_code_title">Ad Titles</label><br />
		<input type="text" name="widget_code_title" id+"widget_code_title" value="<?php echo $title; ?>" />
	<p>
		<label for="widget_code">Place Ad Code Below:</label><br />
		<textarea name="widget_code" id="widget_code" cols="" rows="6" style="width:290px;"><?php echo $code; ?></textarea>
	</p>
	<input type="hidden" id="widget_sponsored_ad" name="widget_sponsored_ad" value="1" />

<?php

}

wp_register_sidebar_widget( 'magazeen_sponsored-ad_1', 'Magazeen Sponsored Ad', 'sponsored_ad' );
wp_register_widget_control( 'magazeen_sponsored-ad_1', 'Magazeen Sponsored Ad', 'sponsored_ad_admin', 300, 200 );

wp_register_sidebar_widget( 'magazeen_featured-news_1', 'Magazeen Featured News', 'featured_news' );
wp_register_widget_control( 'magazeen_featured-news_1', 'Magazeen Featured News', 'featured_news_admin', 300, 200 );

wp_register_sidebar_widget( 'magazeen_recent-news_1', 'Magazeen Recent News', 'recent_news' );
wp_register_widget_control( 'magazeen_featured-news_1', 'Magazeen Recent News', 'recent_news_admin', 300, 200 );


/* Custom Write Panel
/* ----------------------------------------------*/

$meta_boxes =
	array(
		"image" => array(
			"name" => "image",
			"type" => "text",
			"std" => "",
			"title" => "Image",
			"description" => "Using the \"<em>Add an Image</em>\" button, upload an image and paste the URL here. Images will be resized. This is the Article's main image and will automatically be sized.")
	);

function meta_boxes() {
	global $post, $meta_boxes;
	
	echo'
		<table class="widefat" cellspacing="0" id="inactive-plugins-table">
		
			<tbody class="plugins">';
	
			foreach($meta_boxes as $meta_box) {
				$meta_box_value = get_post_meta($post->ID, $pre.'_value', true);
				
				if($meta_box_value == "")
					$meta_box_value = $meta_box['std'];
				
				echo'<tr>
						<td width="100" align="center">';		
							echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
							echo'<h2>'.$meta_box['title'].'</h2>';
				echo'	</td>
						<td>';
							echo'<input type="text" name="'.$meta_box['name'].'_value" value="'.get_post_meta($post->ID, $meta_box['name'].'_value', true).'" size="100%" /><br />';
							echo'<p><label for="'.$meta_box['name'].'_value">'.$meta_box['description'].' Visit the <a href="'.get_bloginfo('template_directory').'/readme.html" title="View ReadMe">README</a> for more information.</label></p>';
				echo'	</td>
					</tr>';
			}
	
	echo'
			</tbody>
		</table>';		
}

function create_meta_box() {
	global $theme_name;
	if ( function_exists('add_meta_box') ) {
		add_meta_box( 'new-meta-boxes', 'Magazeen Post Options', 'meta_boxes', 'post', 'normal', 'high' );
	}
}

function save_postdata( $post_id ) {
	global $post, $meta_boxes;
	
	foreach($meta_boxes as $meta_box) {
		// Verify
		if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) )) {
			return $post_id;
		}
	
		if ( 'page' == $_POST['post_type'] ) {
			if ( !current_user_can( 'edit_page', $post_id ))
				return $post_id;
		} else {
			if ( !current_user_can( 'edit_post', $post_id ))
				return $post_id;
		}
	
		$data = $_POST[$meta_box['name'].'_value'];
		
		if(get_post_meta($post_id, $meta_box['name'].'_value') == "")
			add_post_meta($post_id, $meta_box['name'].'_value', $data, true);
		elseif($data != get_post_meta($post_id, $pre.'_value', true))
			update_post_meta($post_id, $meta_box['name'].'_value', $data);
		elseif($data == "")
			delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_box['name'].'_value', true));
	}
}


add_action('admin_menu', 'create_meta_box');
add_action('save_post', 'save_postdata');

/* Custom Settings Page
/* ----------------------------------------------*/

$themename = "Magazeen";
$pre = "mag";

$options = array();

$functions_path = TEMPLATEPATH . '/inc/functions/';

function startit() {
	global $themename, $options, $pre, $functions_path;
		
	if (function_exists('add_menu_page')) {
		$basename = basename( OPTION_FILES );
	
		// Create the main Menu
		add_menu_page( $themename . ' Options', $themename . ' Options', 'edit_theme_options', $basename, 'build_options' );
		
		// Basic Options (Default Sub tab)
		add_submenu_page( $basename, __( $themename . ' Options &raquo; General' ), __( 'Basic Options' ), 'edit_theme_options', 'base.php', 'build_options' );
					
	}
}

function build_options() {
	global $themename, $pre, $functions_path;
			
	$page = $_GET["page"];
	
	include( $functions_path . '/options/' . $page );
			
	if ( isset($_REQUEST['action']) && 'save' == $_REQUEST['action'] ) {
				
		foreach ($options as $value) {
			if( isset( $_REQUEST[ $value['id'] ] ) ) { 
				update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); 
			} else { 
				delete_option( $value['id'] ); 
			} 
		}
	} 
		
	include( $functions_path . '/build.php' );
}

add_action('admin_menu', 'startit');


?>
