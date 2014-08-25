<?php
add_action( 'after_setup_theme', 'et_setup_theme' );
if ( ! function_exists( 'et_setup_theme' ) ){
	function et_setup_theme(){
		global $themename, $shortname, $default_colorscheme;
		$themename = "Basic";
		$shortname = "basic";
		$default_colorscheme = "";

		$template_dir = get_template_directory();

		require_once($template_dir . '/epanel/custom_functions.php');

		require_once($template_dir . '/includes/functions/comments.php');

		require_once($template_dir . '/includes/functions/sidebars.php');

		load_theme_textdomain('Basic',$template_dir.'/lang');

		require_once($template_dir . '/epanel/core_functions.php');

		require_once($template_dir . '/epanel/post_thumbnails_basic.php');

		include($template_dir . '/includes/widgets.php');

		add_action( 'pre_get_posts', 'et_home_posts_query' );
	}
}

add_action('wp_head','et_portfoliopt_additional_styles',100);
function et_portfoliopt_additional_styles(){ ?>
	<style type="text/css">
		#et_pt_portfolio_gallery { margin-left: -41px; }
		.et_pt_portfolio_item { margin-left: 35px; }
		.et_portfolio_small { margin-left: -40px !important; }
		.et_portfolio_small .et_pt_portfolio_item { margin-left: 32px !important; }
		.et_portfolio_large { margin-left: -26px !important; }
		.et_portfolio_large .et_pt_portfolio_item { margin-left: 11px !important; }
	</style>
<?php }

function register_main_menus() {
	register_nav_menus(
		array(
			'primary-menu' => __( 'Primary Menu', 'Basic' )
		)
	);
};
if (function_exists('register_nav_menus')) add_action( 'init', 'register_main_menus' );

/**
 * Filters the main query on homepage
 */
function et_home_posts_query( $query = false ) {
	/* Don't proceed if it's not homepage or the main query */
	if ( ! is_home() || ! is_a( $query, 'WP_Query' ) || ! $query->is_main_query() ) return;

	/* Set the amount of posts per page on homepage */
	$query->set( 'posts_per_page', (int) et_get_option( 'basic_homepage_posts', '6' ) );

	/* Exclude categories set in ePanel */
	$exclude_categories = et_get_option( 'basic_exlcats_recent', false );
	if ( $exclude_categories ) $query->set( 'category__not_in', array_map( 'intval', et_generate_wpml_ids( $exclude_categories, 'category' ) ) );
}

if ( ! function_exists( 'et_list_pings' ) ){
	function et_list_pings($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment; ?>
		<li id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?> - <?php comment_excerpt(); ?>
	<?php }
}

function et_epanel_custom_colors_css(){
	global $shortname; ?>

	<style type="text/css">
		#container { color: #<?php echo esc_html(get_option($shortname.'_color_mainfont')); ?>; }
		body { background-color: #<?php echo esc_html(get_option($shortname.'_color_bgcolor')); ?>; }
		#wrapper2 { border:10px solid #<?php echo esc_html(get_option($shortname.'_color_bordercolor')); ?>; }
		.post-info { background-color: #<?php echo esc_html(get_option($shortname.'_postinfo1_bgcolor')); ?>; }
		.post-info2 { background-color: #<?php echo esc_html(get_option($shortname.'_postinfo2_bgcolor')); ?>; }
		a:link, a:visited { color: #<?php echo esc_html(get_option($shortname.'_color_mainlink')); ?>; }
		#pages .home a:link, #pages .home a:visited, #pages .current_page_item a:link, #pages .current_page_item a:visited, #pages ul li a:link, #pages ul li a:visited, #pages ul li a:active { color: #<?php echo esc_html(get_option($shortname.'_color_pagelink')); ?>; }
		.sidebar-box h2 { color:#<?php echo esc_html(get_option($shortname.'_color_sidebar_titles')); ?>; }
		.titles a:link, .titles a:visited, .titles a:active { color:#<?php echo esc_html(get_option($shortname.'_color_heading')); ?>; }
	</style>

<?php }