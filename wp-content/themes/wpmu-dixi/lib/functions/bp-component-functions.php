<?php

//////////////////////////
/// global add and update
//////////////////////////
function get_user_meta_values($my_id='',$metakey='') {
global $bp;
$my_id = $bp->displayed_user->id;
$get_user_meta_values = get_user_meta( $my_id, $metakey, true );
return $get_user_meta_values;
}

function update_user_meta_values($my_id= '',$metakey='', $metavalue='') {
global $bp;
$my_id = $bp->displayed_user->id;
$update_user_meta_values = update_user_meta( $my_id, $metakey, $metavalue );
return $get_user_meta_values;
}


///////////////////////////////////////////
/// profile inner slug - add component page
///////////////////////////////////////////

function bp_profile_header_setup() {
global $bp, $user_identity;
$display_user_link = $bp->displayed_user->domain;
$user_link = $display_user_link . $bp->settings->slug . '/';

bp_core_new_subnav_item(
array(
'name' => __( 'Flickr Youtube', TEMPLATE_DOMAIN ),
'slug' => 'flickr-youtube',
'parent_url' => $user_link,
'parent_slug' => $bp->settings->slug,
'screen_function' => 'bp_profile_social',
'position' => 10
)
);
}

function bp_profile_social() {
global $bp;
add_action( 'bp_template_content', 'bp_profile_social_output' );
bp_core_load_template( apply_filters( 'bp_core_template_plugin', 'members/single/plugins' ) );
}

function bp_profile_social_output() {
if ( file_exists( TEMPLATEPATH . '/lib/components/youtube-flickr.php'  ) ) {
load_template( TEMPLATEPATH . '/lib/components/youtube-flickr.php'  );
}
}

add_action( 'bp_setup_nav', 'bp_profile_header_setup' );


////////////////////////////////////////////////////////////////////////////
// init components builds
////////////////////////////////////////////////////////////////////////////

function output_flickr_youtube_content() {
global $bp, $wpdb;
$current_displayed_user = $bp->displayed_user->id;
$current_loggedin_user = $bp->loggedin_user->id;
$current_displayed_user_full_name = $bp->displayed_user->fullname;

$get_user_list = "SELECT user_login FROM " . $wpdb->base_prefix . "users WHERE ID= '" . $current_displayed_user . "' ORDER by ID limit 1";
$sql_get_user_list = $wpdb->get_var($get_user_list);

?>

<?php
if($current_displayed_user == $current_loggedin_user){
  $v_id = 'My';
  } else {
  $v_id = $sql_get_user_list . '&acute;s';
  }
?>


<?php
if($current_displayed_user == $current_loggedin_user){
  $u_id = 'My';
  } else {
  $u_id = $sql_get_user_list;
  }


$my_flickr_id = get_user_meta( $bp->displayed_user->id, 'user_flickr', true);
$my_video_id = get_user_meta( $bp->displayed_user->id, 'user_video', true);
$my_video_id_misc = get_user_meta( $bp->displayed_user->id, 'user_video_misc', true); ?>


<?php if( !bp_is_user_profile_edit() && !bp_is_user_change_avatar() ) { ?>
<?php if( $my_flickr_id ) { ?>
<div class="bp-widget">
<h4><?php echo $v_id; ?> <?php _e("Flickr",TEMPLATE_DOMAIN); ?>&nbsp;&nbsp;&nbsp;&nbsp;<span><a href="http://www.flickr.com/photos/<?php echo $my_flickr_id; ?>"><?php _e("See All &rarr;",TEMPLATE_DOMAIN); ?></a></span></h4>
<ul id="myflickr">
<li>
<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=10&amp;display=latest&amp;size=s&amp;layout=x&amp;source=user&amp;user=<?php echo "$my_flickr_id"; ?>">
</script>
</li>
</ul>
</div>
<?php } ?>


<?php if( $my_video_id ) { ?>
<div class="bp-widget">
<h4><?php echo $v_id; ?> <?php _e('Video', TEMPLATE_DOMAIN); ?></h4>

<div class="video-wrapper">
	<div class="video-container">
  <iframe width="1280" height="720" src="http://www.youtube.com/embed/<?php echo stripcslashes($my_video_id); ?>" frameborder="0" allowfullscreen></iframe>
  </div></div>

</div>
<?php } else { ?>

        <div class="bp-widget">
<h4><?php echo $v_id; ?> <?php _e('Video', TEMPLATE_DOMAIN); ?></h4>
<p>
<?php echo stripcslashes($my_video_id_misc); ?>
</p>
</div>

<?php } ?>

<?php } ?>
<?php }


if( !function_exists('output_flickr_youtube_css') ):

function output_flickr_youtube_css() { ?>
<?php print " <style> "; ?>
#custom .bp-widget ul#myflickr li {
	padding: 0px;
	float: left !important;
	list-style-type: none;
	width: 100% !important;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 25px;
	margin-left: 0px;
}
#custom .bp-widget ul#myflickr li .flickr_badge_image {
	margin: 0px 10px 10px 0px;
	padding: 5px;
	float: left !important;
	list-style-type: none;
	width: auto !important;
	border: 1px solid #ddd;
}
#custom .bp-widget ul#myflickr li .flickr_badge_image .img {
	margin: 0px;
	padding: 0px !important;
	float: left !important;
	list-style-type: none;
	border-top: 0px none;
	border-right: 0px none;
	border-bottom: 0px none;
	border-left: 0px none;
}
.video-container {
	position: relative;
	padding-bottom: 56.25%;
	padding-top: 30px;
	height: 0;
	overflow: hidden;
}
video {
	max-width: 100%;
	height: auto;
}
.video-wrapper {
	width: 100%;
	max-width: 95%;
}
.video-container iframe,
.video-container object,
.video-container embed {
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
}


<?php if(function_exists('colourCreator')):
$tn_wpmu_dixi_container_colour = get_option('tn_wpmu_dixi_container_colour');
if($tn_wpmu_dixi_container_colour !=''){ ?>
.bp-widget h4, .profile h4, .standard-form h4 { padding: 0px 0px 10px; margin: 0px 0px 20px 0px; border-bottom: 1px solid <?php echo colourCreator($tn_wpmu_dixi_container_colour, -20); ?>;}
<?php } ?>
<?php endif; ?>


.bp-widget h4 span {
	font-size: 13px;
	float: right;
}

<?php print " </style> "; ?>

<?php }

endif;

add_action('bp_after_profile_content', 'output_flickr_youtube_content');
add_action('wp_head', 'output_flickr_youtube_css');


?>