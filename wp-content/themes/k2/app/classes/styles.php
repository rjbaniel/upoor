<?php
/**
 * K2 Styles
 *
 * Custom CSS for K2
 *
 * @package K2
 */

// Prevent users from directly loading this file
defined( 'K2_CURRENT' ) or die ( 'Error: This file can not be loaded directly.' );

class K2Styles {
	/**
	 * Initializes K2Styles
	 * called by 'k2_init' action
	 */
	function init() {
		// Load the current styles functions.php if it is readable
		$active_styles = get_option('k2styles');
		if ( ! empty($active_styles) ) {
			foreach ($active_styles as $style) {
				$style_functions = dirname( K2Styles::get_styles_dir() . '/' . $style ) . '/functions.php';
				if ( is_readable($style_functions) )
					include_once($style_functions);
			}
		}
	}


	/**
	 * Adds styles related options into the database
	 * called by 'k2_install' action
	 */
	function install() {
		add_option('k2styles', array());
		add_option('k2styleinfo', '');
		add_option('k2stylespath', '%k2%/styles');
		add_option('k2stylesdir', TEMPLATEPATH . '/styles');
		add_option('k2stylesurl', TEMPLATEPATH . '/styles');
	}


	/**
	 * Removes styles related options
	 * called by 'k2_uninstall' action
	 */
	function uninstall() {
		delete_option('k2styles');
		delete_option('k2styleinfo');
		delete_option('k2stylespath');
		delete_option('k2stylesdir');
		delete_option('k2stylesurl');
	}


	/**
	 * Starts the upgrade process
	 * called by 'k2_upgrade' action
	 *
	 * @param string $previous Previous version K2
	 */
	function upgrade($previous) {
		if ( version_compare($previous, '1.0-RC8', '<') ) {
			$style = get_option('k2style');
			if ( ! empty($style) ) {
				update_option( 'k2styles', array($style) );
			}
		}
	}


	/**
	 * Parses the local path for styles
	 *
	 * @param string $path k2stylespath
	 * @return string absolute path
	 */
	function set_styles_dir( $path = false ) {
		if ( empty($path) )
			$path = get_option('k2stylespath');
			
		$dir = str_replace(
					array( '%k2%', '%child%', '%content%' ),
					array( TEMPLATEPATH, STYLESHEETPATH, WP_CONTENT_DIR ),
					$path
				);

		update_option( 'k2stylesdir', $dir );

		return $dir;
	}


	/**
	 * Gets the local path for styles
	 *
	 * @param string $path k2stylespath
	 * @return string absolute path
	 */
	function get_styles_dir( $path = false ) {
		$dir = get_option('k2stylesdir');

		if ( ! empty($dir) )
			return $dir;

		return K2Styles::set_styles_dir( $path );
	}


	/**
	 * Parses the url for styles
	 *
	 * @param string $path k2stylespath
	 * @return string url
	 */
	function set_styles_url( $path = false ) {
		if ( empty($path) )
			$path = get_option('k2stylespath');
		
		$url = str_replace(
					array( '%k2%', '%child%', '%content%' ),
					array( get_template_directory_uri(), get_stylesheet_directory_uri(), content_url() ),
					$path
				);

		update_option( 'k2stylesurl', $url );

		return $url;
	}


	/**
	 * Gets the url for styles
	 *
	 * @param string $path k2stylespath
	 * @return string url
	 */
	function get_styles_url( $path = false ) {
		$url = get_option('k2stylesurl');

		if ( ! empty($url) )
			return $url;

		return K2Styles::set_styles_url( $path );
	}


	/**
	 * Displays user configurable options
	 * called by 'k2_display_options' action
	 */
	function display_options() {
		$styles_path = explode('/', get_option('k2stylespath'), 2);
		$styles_dir = get_option('k2stylesdir');

		// Get the current K2 Style
		$active_styles = (array) get_option('k2styles');

		// Get the style files
		$style_files = K2Styles::get_styles();

		$path_options = array(
				'%k2%' => 'K2',
				'%child%' => __('Child Theme', 'k2_domain'),
				'%content%' => 'wp-content'
			);
?>
		<li>
			<h3><?php _e('Styles', 'k2_domain'); ?></h3>

			<?php if ( ! is_dir($styles_dir) ): ?>
				<div class="error">
				<?php printf( __('The directory: <strong>%s</strong>, needed to store custom styles is missing. For you to be able to use custom styles, you need to add this directory.', 'k2_domain'), $styles_dir ); ?>
				</div>
			<?php endif; ?>

			<p class="description">
				<?php _e('No need to edit core files, K2 is highly customizable.', 'k2_domain'); ?>
				<a href="http://code.google.com/p/kaytwo/wiki/K2CSSandCustomCSS"><?php _e('Read&nbsp;more.', 'k2_domain'); ?></a>
			</p>

			<table class="form-table">
				<tbody>
					<tr>
						<th scope="row">
							<label for="k2-styles-dir"><?php _e('Styles Directory:', 'k2_domain'); ?></label>
						</th>
						<td>
							<label for="k2-styles-root" class="hidden"><?php _e('Styles Root Directory:', 'k2_domain'); ?></label>
							<select id="k2-styles-root" name="k2[stylesroot]" style="width:auto;text-align:right;">
								<?php foreach ($path_options as $value => $label): ?>
									<option value="<?php echo $value; ?>" <?php selected( $value, $styles_path[0] ); ?>><?php echo $label; ?></option>
								<?php endforeach; ?>
							</select>
							<input id="k2-styles-dir" name="k2[stylesdir]" type="text" value="<?php echo esc_attr( $styles_path[1] ); ?>" />
						</td>
					</tr>
				</tbody>
			</table>

			<table id="k2-styles" class="widefat" cellspacing="0">
				<thead>
					<tr>
						<th class="manage-column column-cb check-column" scope="col">
							<input type="checkbox" />
						</th>
						<th class="manage-column column-title"><?php _e('Style', 'k2_domain'); ?></th>
						<th class="manage-column column-author"><?php _e('Author', 'k2_domain'); ?></th>
						<th class="manage-column column-version"><?php _e('Version', 'k2_domain'); ?></th>
						<th class="manage-column column-tags"><?php _e('Tags', 'k2_domain'); ?></th>
					</tr>
				</thead>
		
				<tbody>
					<?php if ( empty($style_files) ): ?>
						<tr>
							<td colspan="5">
								<?php printf( __('There are no css files found in: <strong>%s</strong>.', 'k2_domain'), $styles_dir); ?>
							</td>
						</tr>
					<?php else: foreach( $style_files as $style ): ?>
						<tr>
							<th class="check-column" scope="row">
								<input type="checkbox" name="k2[styles][]" value="<?php echo esc_attr($style['path']); ?>" <?php if ( in_array($style['path'], $active_styles) ) echo 'checked="checked"'; ?> />
							</th>
							<td class="column-title">
								<span class="style-name"><?php echo $style['stylename']; ?></span>
								<span class="style-path"><?php echo $style['path']; ?></span>
							</td>
							<td class="column-author">
								<a href="<?php echo $style['site']; ?>"><?php echo $style['author']; ?></a>
							</td>
							<td class="column-version">
								<?php echo $style['version']; ?>
							</td>
							<td class="column-tags">
								<?php echo $style['tags']; ?>
							</td>
						</tr>
					<?php endforeach; endif; ?>
				</tbody>
			</table>
		</li>
<?php
	}


	/**
	 * Updates submitted options
	 * called by 'k2_update_options' action
	 */
	function update_options() {
		// Style
		if ( isset($_POST['k2']['styles']) ) {
			update_option('k2styles', $_POST['k2']['styles']);
			K2Styles::update_style_info();
		} else {
			update_option('k2styles', array());
			update_option('k2styleinfo', array());
		}

		// Styles Path
		if ( isset($_POST['k2']['stylesroot']) and isset($_POST['k2']['stylesdir']) ) {
			$path = $_POST['k2']['stylesroot'] . '/' . untrailingslashit($_POST['k2']['stylesdir']);

			update_option( 'k2stylespath', $path );
			K2Styles::set_styles_dir( $path );
			K2Styles::set_styles_url( $path );
		}
	}


	/**
	 * Searches through 'styles' directory for css files
	 *
	 * @return array paths to style files
	 */
	function get_styles() {
		global $k2_styles;

		if ( ! empty($k2_styles) )
			return $k2_styles;

		$k2_styles = array();

		// get list of all style files
		$style_files = K2::files_scan( K2Styles::get_styles_dir(), 'css', 2 );
		sort($style_files);

		// get active styles
		$active_styles = get_option('k2styles');

		if ( ! empty($active_styles) ) {
			// get inactive styles
			$inactive_styles = array_diff($style_files, $active_styles);

			// merge active with inactive
			$style_files = array_merge($active_styles, $inactive_styles);
		}

		// loop through and get their data
		foreach ( (array) $style_files as $style_file ) {
			$style_data = K2Styles::get_style_data($style_file);

			if ( ! empty($style_data) )
				$k2_styles[] = $style_data;
		}

		return $k2_styles;
	}


	/**
	 * Adds styles to the list of editable files in the Theme Editor
	 */
	function theme_editor_append_styles() {
		global $wp_themes, $pagenow;

		$styles_dir = K2Styles::get_styles_dir();

		if ( ('theme-editor.php' == $pagenow) and strpos($styles_dir, WP_CONTENT_DIR) !== false ) {
			get_themes();
			$current = get_current_theme();

			// Get a list of style css
			$styles = K2::files_scan( $styles_dir, 'css', 2 );;

			// Loop through each style css and add to the list
			foreach ($styles as $style_css) {
				$wp_themes[$current]['Stylesheet Files'][] = "$style_dir/$style_css";
			}
		}
	}


	/**
	 * Load styles css in the <head> tag - called by 'wp_head' action
	 */
	function load_styles() {
		$styles_url = K2Styles::get_styles_url();

		// Styles
		$active_styles = get_option('k2styles');
		if ( ! empty($active_styles) ) {
			krsort($active_styles);
			foreach ( $active_styles as $style ) {
				echo '<link rel="stylesheet" type="text/css" href="' . $styles_url . '/' . $style . '" />' . "\n";
			}
		}
	}


	/**
	 * Adds current style data into database for quick access
	 *
	 * @return array style data
	 */
	function update_style_info() {
		$data = K2Styles::get_style_data( array_shift( get_option('k2styles') ) );

		if ( !empty($data) and ($data['stylename'] != '') and ($data['stylelink'] != '') and ($data['author'] != '') ) {
			// No custom style info
			if ( $data['footer'] == '' ) {
				$data['footer'] = __('Styled with <a href="%stylelink%" title="%style% by %author%">%style%</a>','k2_domain');
			}

			if ( strpos($data['footer'], '%') !== false ) {

				$keywords = array( '%author%', '%comments%', '%site%', '%style%', '%stylelink%', '%version%' );
				$replace = array( $data['author'], $data['comments'], $data['site'], $data['stylename'], $data['stylelink'], $data['version'] );
				$data['footer'] = str_replace( $keywords, $replace, $data['footer'] );
			}
		}

		update_option('k2styleinfo', $data);

		return $data;
	}


	/**
	 * Retrieve style data from parsed style file
	 *
	 * @param string $style_file style file path
	 * @return array style data
	 */
	function get_style_data( $style_file = '' ) {
		// if no style selected, exit
		if ( '' == $style_file )
			return false;

		$style_path = K2Styles::get_styles_dir() . "/$style_file";

		if ( ! is_readable($style_path) )
			return false;

		$style_data = implode( '', file($style_path) );
		$style_data = str_replace( '\r', '\n', $style_data );

		if ( preg_match("|Author Name\s*:(.*)$|mi", $style_data, $author) )
			$author = trim( $author[1] );
		else
			$author = '';

		if ( preg_match("|Author Site\s*:(.*)$|mi", $style_data, $site) )
			$site = esc_url( trim( $site[1] ) );
		else
			$site = '';

		if ( preg_match("|Style Name\s*:(.*)$|mi", $style_data, $stylename) )
			$stylename = trim( $stylename[1] );
		else
			$stylename = '';

		if ( preg_match("|Style URI\s*:(.*)$|mi", $style_data, $stylelink) )
			$stylelink = esc_url( trim( $stylelink[1] ) );
		else
			$stylelink = '';

		if ( preg_match("|Style Footer\s*:(.*)$|mi", $style_data, $footer) )
			$footer = trim( $footer[1] );
		else
			$footer = '';

		if ( preg_match("|Version\s*:(.*)$|mi", $style_data, $version) )
			$version = trim( $version[1] );
		else
			$version = '';

		if ( preg_match("|Comments\s*:(.*)$|mi", $style_data, $comments) )
			$comments = trim( $comments[1] );
		else
			$comments = '';

		if ( preg_match("|Header Text Color\s*:\s*#*([\dABCDEF]+)|i", $style_data, $header_text_color) )
			 $header_text_color = $header_text_color[1];
		else
			 $header_text_color = '';

		if ( preg_match("|Header Width\s*:\s*(\d+)|i", $style_data, $header_width) )
			$header_width = (int) $header_width[1];
		else
			$header_width = 0;

		if ( preg_match("|Header Height\s*:\s*(\d+)|i", $style_data, $header_height) )
			$header_height = (int) $header_height[1];
		else
			$header_height = 0;

		$layout_widths = array();
		if ( preg_match("|Layout Widths\s*:\s*(\d+)\s*(px)?,\s*(\d+)\s*(px)?,\s*(\d+)|i", $style_data, $widths) ) {
			$layout_widths[1] = (int) $widths[1];
			$layout_widths[2] = (int) $widths[3];
			$layout_widths[3] = (int) $widths[5];
		}

		if ( preg_match("|Tags\s*:(.*)$|mi", $style_data, $tags) )
			$tags = trim($tags[1]);
		else
			$tags = '';

		return array(
			'path' => $style_file,
			'modified' => filemtime($style_path),
			'author' => $author,
			'site' => $site,
			'stylename' => $stylename,
			'stylelink' => $stylelink,
			'footer' => $footer,
			'version' => $version,
			'comments' => $comments,
			'header_text_color' => $header_text_color,
			'header_width' => $header_width,
			'header_height' => $header_height,
			'layout_widths' => $layout_widths,
			'tags' => $tags
		);
	}
}

add_action( 'k2_init', array('K2Styles', 'init') );
add_action( 'k2_install', array('K2Styles', 'install') );
add_action( 'k2_uninstall', array('K2Styles', 'uninstall') );

add_action( 'k2_display_options', array('K2Styles', 'display_options'), 15 );
add_action( 'k2_update_options', array('K2Styles', 'update_options') );

add_action( 'admin_init', array( 'K2Styles', 'theme_editor_append_styles') );
add_action( 'wp_head', array('K2Styles', 'load_styles') );
