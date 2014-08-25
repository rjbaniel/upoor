<?php
add_action( 'after_setup_theme', 'et_setup_theme' );
if ( ! function_exists( 'et_setup_theme' ) ){
	function et_setup_theme(){
		global $themename, $shortname, $default_colorscheme;
		$themename = "eGallery";
		$shortname = "egallery";
		$default_colorscheme = "";

		$template_dir = get_template_directory();

		require_once($template_dir . '/epanel/custom_functions.php');

		require_once($template_dir . '/includes/functions/comments.php');

		require_once($template_dir . '/includes/functions/sidebars.php');

		load_theme_textdomain('eGallery',$template_dir.'/lang');

		require_once($template_dir . '/epanel/core_functions.php');

		require_once($template_dir . '/epanel/post_thumbnails_egallery.php');

		include($template_dir . '/includes/widgets.php');

		add_action( 'pre_get_posts', 'et_home_posts_query' );
	}
}

add_action('wp_head','et_portfoliopt_additional_styles',100);
function et_portfoliopt_additional_styles(){ ?>
	<style type="text/css">
		div.pp_default .pp_content_container .pp_details { color: #666; }
		.et_pt_portfolio_image img { border: none; }
		.et_pt_portfolio_item h2 { color: #fff; }
		#et_pt_portfolio_gallery { margin-left: -26px; }
		.et_pt_portfolio_item { margin-left: 30px; }
		.et_portfolio_small { margin-left: -20px !important; }
		.et_portfolio_small .et_pt_portfolio_item { margin-left: 20px; }
		.et_portfolio_large { margin-left: -18px !important; }
		.et_portfolio_large .et_pt_portfolio_item { margin-left: 7px; }
	</style>
<?php }

function register_main_menus() {
	register_nav_menus(
		array(
			'primary-menu' => __( 'Primary Menu', 'eGallery' )
		)
	);
};
if (function_exists('register_nav_menus')) add_action( 'init', 'register_main_menus' );

if ( ! function_exists( 'et_list_pings' ) ){
	function et_list_pings($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment; ?>
		<li id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?> - <?php comment_excerpt(); ?>
	<?php }
}

/**
 * Filters the main query on homepage
 */
function et_home_posts_query( $query = false ) {
	/* Don't proceed if it's not homepage or the main query */
	if ( ! is_home() || ! is_a( $query, 'WP_Query' ) || ! $query->is_main_query() ) return;

	/* Set the amount of posts per page on homepage */
	$query->set( 'posts_per_page', (int) et_get_option( 'egallery_homepage_posts', '6' ) );

	/* Exclude categories set in ePanel */
	$exclude_categories = et_get_option( 'egallery_exlcats_recent', false );
	if ( $exclude_categories ) $query->set( 'category__not_in', array_map( 'intval', et_generate_wpml_ids( $exclude_categories, 'category' ) ) );
}

global $shortname;
if ((get_option($shortname.'_enable_dropdowns') <> 'false') || (get_option($shortname.'_enable_dropdowns_categories') <> 'false')) {
	update_option($shortname.'_enable_dropdowns','false');
	update_option($shortname.'_enable_dropdowns_categories','false');
}

function et_epanel_custom_colors_css(){
	global $shortname; ?>

	<style type="text/css">
		body { color: #<?php echo esc_html(get_option($shortname.'_color_mainfont')); ?>; }
		#left-inside a { color: #<?php echo esc_html(get_option($shortname.'_color_mainlink')); ?>; }
		#lavaLampVariableImage li a:active, #lavaLampVariableImage li a:visited { color: #<?php echo esc_html(get_option($shortname.'_color_pagelink')); ?>; }
		#lavaLampVariableImage li a:hover { color: #<?php echo esc_html(get_option($shortname.'_color_pagelink_active')); ?>; }
		h1, h2, h3, h4, h5, h6, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a { color: #<?php echo esc_html(get_option($shortname.'_color_headings')); ?>; }

		#sidebar a { color:#<?php echo esc_html(get_option($shortname.'_color_sidebar_links')); ?>; }
		#footer { color:#<?php echo esc_html(get_option($shortname.'_footer_headings')); ?> }
		#footer a, #footer a:visited { color:#<?php echo esc_html(get_option($shortname.'_color_footerlinks')); ?> }
	</style>

<?php }