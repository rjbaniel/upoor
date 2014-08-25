<?php
add_action( 'after_setup_theme', 'et_setup_theme' );
if ( ! function_exists( 'et_setup_theme' ) ){
	function et_setup_theme(){
		global $themename, $shortname, $default_colorscheme;
		$themename = "Glider";
		$shortname = "glider";

		$default_colorscheme = "Default";

		$template_dir = get_template_directory();

		require_once($template_dir . '/epanel/custom_functions.php');

		require_once($template_dir . '/includes/functions/comments.php');

		require_once($template_dir . '/includes/functions/sidebars.php');

		load_theme_textdomain('Glider',$template_dir.'/lang');

		require_once($template_dir . '/epanel/core_functions.php');

		require_once($template_dir . '/epanel/post_thumbnails_glider.php');

		include($template_dir . '/includes/widgets.php');

		require_once($template_dir . '/includes/additional_functions.php');
	}
}

if ( ! function_exists( 'et_list_pings' ) ){
	function et_list_pings($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment; ?>
		<li id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?> - <?php comment_excerpt(); ?>
	<?php }
}

add_filter( 'body_class', 'et_check_cufon' );
function et_check_cufon( $classes ) {
	if ( 'false' == get_option( 'glider_cufon' ) )
		$classes[] = 'et_cufon_deactivated';

	return $classes;
}

function et_epanel_custom_colors_css(){
	global $shortname; ?>

	<style type="text/css">
		body { color: #<?php echo esc_html(get_option($shortname.'_color_mainfont')); ?>; }
		#main-rightarea { background: #<?php echo esc_html(get_option($shortname.'_color_bgcolor')); ?>; }
		.post a:link, .post a:visited { color: #<?php echo esc_html(get_option($shortname.'_color_mainlink')); ?>; }
		#main-leftarea a { color: #<?php echo esc_html(get_option($shortname.'_color_pagelink')); ?>; }
		#main-leftarea a:hover, #main-leftarea a.active { color: #<?php echo esc_html(get_option($shortname.'_color_activelink')); ?>; }
		.content-area h2.title, .content-area h1.title, .content-area h2.title a { color:#<?php echo esc_html(get_option($shortname.'_color_heading')); ?>; }
	</style>

<?php }