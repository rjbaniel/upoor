<?php
add_action( 'after_setup_theme', 'et_setup_theme' );
if ( ! function_exists( 'et_setup_theme' ) ){
	function et_setup_theme(){
		global $themename, $shortname, $default_colorscheme;
		$themename = "InterPhase";
		$shortname = "interphase";
		$default_colorscheme = "";

		$template_dir = get_template_directory();

		require_once($template_dir . '/epanel/custom_functions.php');

		require_once($template_dir . '/includes/functions/comments.php');

		require_once($template_dir . '/includes/functions/sidebars.php');

		load_theme_textdomain('InterPhase',$template_dir.'/lang');

		require_once($template_dir . '/epanel/core_functions.php');

		require_once($template_dir . '/epanel/post_thumbnails_interphase.php');

		include($template_dir . '/includes/widgets.php');

		add_action( 'pre_get_posts', 'et_home_posts_query' );
	}
}

add_action('wp_head','et_portfoliopt_additional_styles',100);
function et_portfoliopt_additional_styles(){ ?>
	<style type="text/css">
		#et_pt_portfolio_gallery { margin-left: -15px; }
		.et_pt_portfolio_item { margin-left: 21px; }
		.et_portfolio_small { margin-left: -40px !important; }
		.et_portfolio_small .et_pt_portfolio_item { margin-left: 32px !important; }
		.et_portfolio_large { margin-left: -11px !important; }
		.et_portfolio_large .et_pt_portfolio_item { margin-left: 3px !important; }
	</style>
<?php }

function register_main_menus() {
	register_nav_menus(
		array(
			'primary-menu' => __( 'Primary Menu', 'InterPhase' ),
			'secondary-menu' => __( 'Secondary Menu', 'InterPhase' )
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
	$query->set( 'posts_per_page', (int) et_get_option( 'interphase_homepage_posts', '6' ) );

	/* Exclude categories set in ePanel */
	$exclude_categories = et_get_option( 'interphase_exlcats_recent', false );
	if ( $exclude_categories ) $query->set( 'category__not_in', array_map( 'intval', et_generate_wpml_ids( $exclude_categories, 'category' ) ) );
}

global $shortname;
if ((get_option($shortname.'_enable_dropdowns') <> 'false') || (get_option($shortname.'_enable_dropdowns_categories') <> 'false')) {
	update_option($shortname.'_enable_dropdowns','false');
	update_option($shortname.'_enable_dropdowns_categories','false');
};
if (get_option($shortname.'_color_scheme') <> 'Default') update_option($shortname.'_color_scheme','Default');

function et_epanel_custom_colors_css(){
	global $shortname; ?>

	<style type="text/css">
		#container { color: #<?php echo esc_html(get_option($shortname.'_color_mainfont')); ?>; }
		#left-inside a { color: #<?php echo esc_html(get_option($shortname.'_color_mainlink')); ?>; }
		#pages ul li a:link, #pages ul li a:visited, #pages ul li a:active, #categories ul li a:link, #categories ul li a:visited, #categories ul li a:active { color: #<?php echo esc_html(get_option($shortname.'_color_pagelink')); ?>; }
		#pages ul li a:hover, #categories ul li a:hover { color: #<?php echo esc_html(get_option($shortname.'_color_pagelink_active')); ?>; }
		h1, h2, h3, h4, h5, h6, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a { color: #<?php echo esc_html(get_option($shortname.'_color_headings')); ?>; }

		#sidebar a { color:#<?php echo esc_html(get_option($shortname.'_color_sidebar_links')); ?>; }
		#footer { color:#<?php echo esc_html(get_option($shortname.'_footer_headings')); ?> }
		#footer a, #footer a:visited { color:#<?php echo esc_html(get_option($shortname.'_color_footerlinks')); ?> }
	</style>

<?php }