<?php

// WP 3.4 Theme Customizer
global $dixi_use_customizer_type, $dixi_use_customizer_id;
$shortprefix = '_'.$short_prefix;

$dixi_use_customizer_type = array('colorpicker', 'colourpicker');
$dixi_use_customizer_id = array(
	/*$shortname . $shortprefix  . "bg_image",
	$shortname . $shortprefix  . "bg_image_repeat",
	$shortname . $shortprefix  . "bg_image_attachment",
	$shortname . $shortprefix  . "bg_image_horizontal",
	$shortname . $shortprefix  . "bg_image_vertical",*/
	$shortname . $shortprefix  . "body_font",
	$shortname . $shortprefix  . "headline_font",
	$shortname . $shortprefix  . "font_size",
	$shortname . $shortprefix  . "nav_font",
	$shortname . $shortprefix  . "site_width",
	$shortname . $shortprefix  . "post_width",
	$shortname . $shortprefix  . "right_sidebar_width",
	$shortname . $shortprefix  . "left_sidebar_width",
	$shortname . $shortprefix  . "intro_header",
	$shortname . $shortprefix  . "intro_header_text",
);
$dixi_use_customizer_not_id = array(
	$shortname . $shortprefix  . "bg_colour",
);

/*
 * Custom control class
 *
 * Add description on control
 * */
if ( class_exists('WP_Customize_Control') ) {
class WPMUDEV_Customize_Control extends WP_Customize_Control {

	public $description = '';

	protected function render_content() {
		switch( $this->type ) {
			default:
				return parent::render_content();
			case 'text':
				?>
				<label>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					<?php if ( isset($this->description) && !empty($this->description) ): ?>
					<span class="customize-control-description"><?php echo $this->description ?></span>
					<?php endif ?>
					<input type="text" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> />
				</label>
				<?php
				break;
			case 'radio':
				if ( empty( $this->choices ) )
					return;

				$name = '_customize-radio-' . $this->id;

				?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php if ( isset($this->description) && !empty($this->description) ): ?>
				<span class="customize-control-description"><?php echo $this->description ?></span>
				<?php endif ?>
				<?php
				foreach ( $this->choices as $value => $label ) :
					?>
					<label>
						<input type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?> />
						<?php echo esc_html( $label ); ?><br/>
					</label>
					<?php
				endforeach;
				break;
			case 'select':
				if ( empty( $this->choices ) )
					return;

				?>
				<label>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					<?php if ( isset($this->description) && !empty($this->description) ): ?>
					<span class="customize-control-description"><?php echo $this->description ?></span>
					<?php endif ?>
					<select <?php $this->link(); ?>>
						<?php
						foreach ( $this->choices as $value => $label )
							echo '<option value="' . esc_attr( $value ) . '"' . selected( $this->value(), $value, false ) . '>' . $label . '</option>';
						?>
					</select>
				</label>
				<?php
				break;
			// Handle textarea
			case 'textarea':
				?>
				<label>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					<?php if ( isset($this->description) && !empty($this->description) ): ?>
					<span class="customize-control-description"><?php echo $this->description ?></span>
					<?php endif ?>
					<textarea rows="10" cols="40" <?php $this->link(); ?>><?php echo esc_attr( $this->value() ); ?></textarea>
				</label>
				<?php
				break;
		}
	}

}
}

if ( class_exists('WP_Customize_Color_Control') ) {
class WPMUDEV_Customize_Color_Control extends WP_Customize_Color_Control {

	public $description = '';

	public function render_content() {
		?>
		<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php if ( isset($this->description) && !empty($this->description) ): ?>
			<span class="customize-control-description"><?php echo $this->description ?></span>
			<?php endif ?>
			<div class="customize-control-content">
				<div class="dropdown">
					<div class="dropdown-content">
						<div class="dropdown-status"></div>
					</div>
					<div class="dropdown-arrow"></div>
				</div>
				<input class="color-picker-hex" type="text" maxlength="7" placeholder="<?php esc_attr_e('Hex Value'); ?>" />
			</div>
			<div class="farbtastic-placeholder"></div>
		</label>
		<?php
	}
}
}

function dixi_customize_register( $wp_customize ) {
	global $options, $options1, $shortname, $shortprefix, $bp_existed, $dixi_use_customizer_type, $dixi_use_customizer_id;
	$options_list = array_merge($options, $options1);
	$sections = array(
		array(
			'section' => 'home-box1',
			'title' => __("Site Intro Settings", TEMPLATE_DOMAIN),
			'priority' => 30
		),
		array(
			'section' => 'layout',
			'title' => __("Blog Layout Settings", TEMPLATE_DOMAIN),
			'priority' => 31
		), array(
			'section' => 'font',
			'title' => __("Blog Fonts Settings", TEMPLATE_DOMAIN),
			'priority' => 32
		), array(
			'section' => 'nav',
			'title' => __("Navigation &amp; Footer Colour Settings", TEMPLATE_DOMAIN),
			'priority' => 33
		)
	);
	// Add sections
	foreach ( $sections as $section ) {
		$wp_customize->add_section( $shortname . $shortprefix . $section['section'], array(
			'title' => $section['title'],
			'priority' => $section['priority']
		) );
	}
	// Add settings and controls
	foreach ( $options_list as $o => $option ) {
		if ( ! dixi_option_in_customize($option) )
			continue;
		if ( $option['inblock'] == 'content-layout' )
			$option['inblock'] = 'layout';
		$wp_customize->add_setting( $option['id'], array(
			'default' => $option['std'],
			'type' => 'option',
			'capability' => 'edit_theme_options',
			'transport' => 'postMessage'
		) );
		$control_param = array(
			'label' => strip_tags($option['name']),
			'description' => ( isset($option['description']) && !empty($option['description']) ? $option['description'] : '' ),
			'section' => $shortname . $shortprefix . $option['inblock'],
			'settings' => $option['id'],
			'priority' => $o // make sure we have the same order as theme options :)
		);
		if ( $option['type'] == 'colorpicker' || $option['type'] == 'colourpicker' || ( isset($option['custom']) && ( $option['custom'] == 'colorpicker' || $option['custom'] == 'colourpicker' ) ) ) {
			$wp_customize->add_control( new WPMUDEV_Customize_Color_Control( $wp_customize, $option['id'].'_control', $control_param ) );
		}
		else if ( $option['type'] == 'text' || $option['type'] == 'textarea' ) {
			$control_param['type'] = $option['type'];
			$wp_customize->add_control( new WPMUDEV_Customize_Control( $wp_customize, $option['id'].'_control', $control_param) );
		}
		else if ( $option['type'] == 'select' || $option['type'] == 'select-preview' ) {
			$control_param['type'] = 'select';
			// @TODO choices might get removed in future
			$choices = array();
			foreach ( $option['options'] as $choice )
				$choices[$choice] = $choice;
			$control_param['choices'] = $choices;
			$wp_customize->add_control( new WPMUDEV_Customize_Control( $wp_customize, $option['id'].'_control', $control_param) );
		}
	}

	// Support Wordpress custom background
	$wp_customize->get_setting('background_color')->transport = 'postMessage';
	$wp_customize->get_setting('background_image')->transport = 'postMessage';
	$wp_customize->get_setting('background_repeat')->transport = 'postMessage';
	$wp_customize->get_setting('background_position_x')->transport = 'postMessage';
	$wp_customize->get_setting('background_attachment')->transport = 'postMessage';
	$wp_customize->get_setting('header_image')->transport = 'postMessage';
	$wp_customize->get_setting('blogname')->transport = 'postMessage';
	$wp_customize->get_setting('blogdescription')->transport = 'postMessage';

	// Add transport script
	if ( $wp_customize->is_preview() && ! is_admin() )
		add_action('wp_footer', 'dixi_customize_preview', 21);
}
add_action('customize_register', 'dixi_customize_register');

function dixi_customize_preview() {
	global $options, $options1, $shortname, $shortprefix;
	$options_list = array_merge($options, $options1);
	?>
	<div id="theme-customizer-css"></div>

	<script type="text/javascript">
		var theme_customizer_css = [];
		function theme_update_css(){
			var css = '';
			for ( s in theme_customizer_css ){
				css += theme_customizer_css[s].selector + '{';
				for ( p in theme_customizer_css[s].properties ){
					var property = theme_customizer_css[s].properties[p];
					for ( v in property ){
						if ( v == 0 || v == 1 ) continue;
						css += property[0] + ':' + property[v] + property[1] + ';';
					}
				}
				css += '}';
			}
			jQuery('#theme-customizer-css').html('<style type="text/css">'+css+'</style>');
		}
		function theme_change_style( selector_list, property, values, priority ){
			if ( !priority ) priority = '';
			var prop = [property, priority];
			if ( typeof values == 'string' ) prop.push(values);
			else {
				for ( v in values ) prop.push(values[v]);
			}
			var add_selector = true, add_property = true;
			for ( s in theme_customizer_css ){
				if ( theme_customizer_css[s].selector == selector_list ){
					add_selector = false;
					for ( p in theme_customizer_css[s].properties ){
						if ( theme_customizer_css[s].properties[p][0] == property ){
							theme_customizer_css[s].properties[p] = prop;
							add_property = false;
							break;
						}
					}
					if ( add_property ) theme_customizer_css[s].properties.push(prop)
				}
			}
			if ( add_selector ){
				theme_customizer_css.push({
					selector: selector_list,
					properties: [prop]
				});
			}
			theme_update_css();
		}
		function theme_change_font_family( selector, value, priority ){
			// load font from Google Fonts API
			var fonts = value.split(',');
			var font = fonts[0];
			var supported_fonts = ["Cantarell", "Cardo", "Crimson Text", "Droid Sans", "Droid Serif", "IM Fell DW Pica",
				"Josefin Sans Std Light", "Lobster", "Molengo", "Neuton", "Nobile", "OFL Sorts Mill Goudy TT",
				"Reenie Beanie", "Tangerine", "Old Standard TT", "Volkorn", "Yanone Kaffessatz", "Just Another Hand",
				"Terminal Dosis Light", "Ubuntu"];
			var load_external = false;
			for ( i in supported_fonts ){
				if ( font == supported_fonts[i] ){
					load_external = true;
					break;
				}
			}
			if ( load_external ){
				if ( font == 'Ubuntu' ) font += ":light,regular,bold";
				font = font.replace(' ', '+');
				jQuery('body').append("<link href='http://fonts.googleapis.com/css?family="+font+"' rel='stylesheet' type='text/css'/>");
			}
			theme_change_style(selector, 'font-family', value, priority);
		}
		function theme_color_creator(color, per){
			color = color.toString().substring(1);
			rgb = '';
			per = per/100*255;
			if  (per < 0 ){
		        per =  Math.abs(per);
		        for (x=0;x<=4;x+=2)
		        {
		        	c = parseInt(color.substring(x, x+2), 16) - per;
		        	c = Math.floor(c);
		            c = (c < 0) ? "0" : c.toString(16);
		            rgb += (c.length < 2) ? '0'+c : c;
		        }
		    }
		    else{
		        for (x=0;x<=4;x+=2)
		        {
		        	c = parseInt(color.substring(x, x+2), 16) + per;
		        	c = Math.floor(c);
		            c = (c > 255) ? 'ff' : c.toString(16);
		            rgb += (c.length < 2) ? '0'+c : c;
		        }
		    }
		    return '#'+rgb;
		}

		window.onload = function(){
		<?php foreach ( $options_list as $option ): ?>
			<?php if ( ! dixi_option_in_customize($option) ) continue; ?>
			wp.customize( '<?php echo $option['id'] ?>', function(value) {
				value.bind(function(to){
					<?php if ( $option['type'] != 'text' && $option['type'] != 'textarea' ): ?>
					if ( !to ) return;
					<?php endif ?>
					<?php
					// Use printf for better readibility, place selector in argument
					switch ( str_replace($shortname . $shortprefix, '', $option['id']) ){
						case 'body_font':
							printf("theme_change_font_family('%s', to, '!important');", "body");
							break;
						case 'headline_font':
							printf("theme_change_font_family('%s', to, '!important');", "h1, h2, h3, h4, h5, h6");
							break;
						case 'nav_font':
							printf("theme_change_font_family('%s', to, '!important');", "#nav li");
							break;
						case 'font_size':
							printf("if ( to == 'small' ) var size = '0.6875em';");
							printf("else if ( to == 'bigger' ) var size = '0.85em';");
							printf("else if ( to == 'largest' ) var size = '0.9125em';");
							printf("else var size = '0.785em';");
							printf("theme_change_style('%s', 'font-size', size); ", "#wrapper");
							break;
						case 'body_font_colour':
							printf("theme_change_style('%s', 'color', to, '!important'); ", "body");
							printf("theme_change_style('%s', 'color', to, '!important'); ", "#custom .activity-list li.load-more a");
							printf("theme_change_style('%s', 'color', theme_color_creator(to, 10), '!important'); ", ".activity-list .activity-content .activity-header, .activity-list .activity-content .comment-header");
							break;
						case 'content_link_colour':
							printf("theme_change_style('%s', 'color', to, '!important'); ", ".content a, #top-header a");
							break;
						case 'content_link_hover_colour':
							printf("theme_change_style('%s', 'color', to, '!important'); ", "#container h1.post-title a:hover, .content a:hover, #top-header a:hover");
							break;
						case 'post_title_link_colour':
							printf("theme_change_style('%s', 'color', to, '!important'); ", "#container h1.post-title a");
							break;
						case 'content_line_colour':
							printf("theme_change_style('%s', 'border-left-color', to, '!important'); ", ".post-content blockquote");
							printf("theme_change_style('%s', 'border-color', to, '!important'); ", "#sidebar, #right-sidebar, ol.commentlist li");
							printf("theme_change_style('%s', 'background-color', to, '!important'); ", ".wp-caption");
							printf("theme_change_style('%s', 'border-bottom-color', to, '!important'); ", "#sidebar h3, #right-sidebar h3, #front-content h3");
							printf("theme_change_style('%s', 'border-bottom-color', to, '!important'); ", "li.feat-img");
							printf("theme_change_style('%s', 'border-bottom-color', to, '!important'); ", "ul.tabbernav ");
							printf("theme_change_style('%s', 'border-color', to, '!important'); ", "#.tabbertab .list, .tabbertab .feed-pull, .list .textf");
							printf("theme_change_style('%s', 'border-bottom-color', to, '!important'); ", "div.post, div.page, ol.pinglist li a, ol.pinglist li a:hover, #commentpost h4, #respond h3");
							printf("theme_change_style('%s', 'background-color', to, '!important'); ", "ol.commentlist li div.reply a, ol.commentlist li div.reply a:hover");
							printf("theme_change_style('%s', 'background-color', to, '!important'); ", "#cf");
							printf("theme_change_style('%s', 'border-bottom-color', to, '!important'); ", ".com, .com-alt");
							printf("theme_change_style('%s', 'border-color', to, '!important'); ", ".com-avatar img");
							printf("theme_change_style('%s', 'border-color', to, ''); ", "#content fieldset.bbp-form, #container fieldset.bbp-form, #wrapper fieldset.bbp-form");
							break;
						case 'container_colour':
							printf("theme_change_style('%s', 'background-color', to, '!important'); ", "#container");
							printf("theme_change_style('%s', 'background-color', theme_color_creator(to, 12), ''); ", "table thead tr, .bpfb_form_container");
							printf("theme_change_style('%s', 'background-color', theme_color_creator(to, 20), ''); ", "span.activity");
							printf("theme_change_style('%s', 'border-color', theme_color_creator(to, 10), ''); ", "span.activity");
							printf("theme_change_style('%s', 'color', theme_color_creator(to, 80), ''); ", "span.activity");
							printf("theme_change_style('%s', 'background-color', theme_color_creator(to, 20), ''); ", "table.forum tr.sticky td");
							printf("theme_change_style('%s', 'border-bottom-color', theme_color_creator(to, 20), ''); ", "table.forum tr.sticky td");
							printf("theme_change_style('%s', 'border-top-color', theme_color_creator(to, 20), ''); ", "table.forum tr.sticky td");
							printf("theme_change_style('%s', 'background-color', theme_color_creator(to, 6), '!important'); ", "#forums-dir-list .alt, table tr.alt td,ul#topic-post-list li.alt");
							printf("theme_change_style('%s', 'background-color', theme_color_creator(to, 8), ''); ", "div.activity-comments form.ac-form");
							printf("theme_change_style('%s', 'border-color', theme_color_creator(to, 10), ''); ", "div.activity-comments form.ac-form");
							printf("theme_change_style('%s', 'border-bottom-color', theme_color_creator(to, 10), ''); ", "ul.item-list li");
							printf("theme_change_style('%s', 'background-color', theme_color_creator(to, 15), ''); ", "div.item-list-tabs");
							printf("theme_change_style('%s', 'background-color', to, ''); ", "div#subnav.item-list-tabs");
							printf("theme_change_style('%s', 'background-color', to, ''); ", "div.item-list-tabs ul li.selected a, div.item-list-tabs ul li.current a");
							printf("theme_change_style('%s', 'background-color', theme_color_creator(to, 8), ''); ", "div.activity-comments > ul");
							printf("theme_change_style('%s', 'border-top-color', theme_color_creator(to, 15), ''); ", "div.activity-comments ul li");
							printf("theme_change_style('%s', 'background-color', theme_color_creator(to, 30), '!important'); ", ".activity-list li.load-more");
							printf("theme_change_style('%s', 'border-bottom-color', theme_color_creator(to, 10), ''); ", ".activity-list li.load-more");
							printf("theme_change_style('%s', 'border-right-color', theme_color_creator(to, 10), ''); ", ".activity-list li.load-more");
							printf("theme_change_style('%s', 'border-left-color', theme_color_creator(to, 20), ''); ", ".activity-list li.new_forum_post .activity-content .activity-inner, .activity-list li.new_forum_topic .activity-content .activity-inner");
							printf("theme_change_style('%s', 'border-bottom-color', theme_color_creator(to, 20), ''); ", "div#subnav.item-list-tabs");
							printf("theme_change_style('%s', 'background-color', theme_color_creator(to, 10), ''); ", ".post-content th");
							printf("theme_change_style('%s', 'border-right-color', theme_color_creator(to, 30), ''); ", "table tr td.label");
							printf("theme_change_style('%s', 'background-color', theme_color_creator(to, 20), ''); ", ".post-content table");
							printf("theme_change_style('%s', 'border-color', theme_color_creator(to, 10), ''); ", ".post-content table");
							printf("theme_change_style('%s', 'background-color', theme_color_creator(to, 40), ''); ", ".bbp-forums .even, .bbp-topics .even");
							printf("theme_change_style('%s', 'background-color', theme_color_creator(to, 60), '!important'); ", ".bbp-topics-front tr.super-sticky td, .bbp-topics tr.super-sticky td, .bbp-topics tr.sticky td, .bbp-forum-content tr.sticky td");
							printf("theme_change_style('%s', 'border-color', theme_color_creator(to, 30), ''); ", ".post-content th, .post-content td");
							printf("theme_change_style('%s', 'background-color', theme_color_creator(to, 10), ''); ", "table.bbp-forums th, table.bbp-topics th, table.bbp-topic th, table.bbp-replies th");
							break;
						case 'nv_footer_colour':
							printf("theme_change_style('%s', 'background-color', to, '!important'); ", "#footer");
							printf("theme_change_style('%s', 'background-color', to, '!important'); ", "#navigation");
							printf("theme_change_style('%s', 'background-color', to, '!important'); ", "#front-content .tabbernav li.tabberactive a");
							break;
						case 'nv_bg_hover_colour':
							printf("theme_change_style('%s', 'background-color', to, '!important'); ", "#nav li a:hover");
							break;
						case 'nv_link_colour':
							printf("theme_change_style('%s', 'color', to, '!important'); ", "#nav li a, #nav ul li a");
							break;
						case 'nv_link_hover_colour':
							printf("theme_change_style('%s', 'color', to, '!important'); ", "#nav li a:hover, #nav ul li a:hover");
							break;
						case 'nv_dropdown_bg_colour':
							printf("theme_change_style('%s', 'background-color', to, '!important'); ", "#nav ul li a");
							break;
						case 'nv_dropdown_bg_hover_colour':
							printf("theme_change_style('%s', 'background-color', to, '!important'); ", "#nav ul li a:hover");
							break;
						case 'nv_dropdown_line_colour':
							printf("theme_change_style('%s', 'border-bottom-color', to, '!important'); ", "#nav ul li a");
							break;
						case 'site_width':
							printf("theme_change_style('%s', 'width', to+'px', '!important'); ", "#wrapper");
							break;
						case 'post_width':
							printf("theme_change_style('%s', 'width', to+'px', '!important'); ", "#blog-content");
							printf("theme_change_style('%s', 'width', (parseInt(to)+parseInt(wp.customize('{$shortname}{$shortprefix}right_sidebar_width').get()))+'px', '!important'); ", "#post-entry");
							break;
						case 'right_sidebar_width':
							printf("theme_change_style('%s', 'width', (parseInt(to)-50)+'px', '!important'); ", "#right-sidebar");
							printf("theme_change_style('%s', 'width', (parseInt(to)+parseInt(wp.customize('{$shortname}{$shortprefix}post_width').get()))+'px', '!important'); ", "#post-entry");
							break;
						case 'left_sidebar_width':
							printf("theme_change_style('%s', 'width', (parseInt(to)-50)+'px', '!important'); ", "#sidebar");
							break;
						case 'intro_header':
							printf("if (! to) to = '%s';", __('This is intro header', TEMPLATE_DOMAIN));
							printf("jQuery('%s').html(to); ", "#intro-header");
							break;
						case 'intro_header_text':
							printf("if (! to) to = '%s';", __('You can replace area on this page with a new text in <a href="wp-admin/themes.php?page=site-intro.php">your theme options</a>', TEMPLATE_DOMAIN));
							printf("jQuery('%s').html(to); ", "#intro-header-text");
							break;

					}
					?>
				});
			} );
		<?php endforeach ?>

			wp.customize( 'background_color', function(value) {
				value.bind(function(to){
					theme_change_style('body', 'background-color', to, '!important');
				})
			});
			wp.customize( 'background_image', function(value) {
				value.bind(function(to){
					theme_change_style('body', 'background-image', 'url('+to+')', '!important');
					theme_change_style('body', 'background-repeat', wp.customize('background_repeat').get(), '!important');
					theme_change_style('body', 'background-position', 'top '+wp.customize('background_position_x').get(), '!important');
					theme_change_style('body', 'background-attachment', wp.customize('background_attachment').get(), '!important');
				})
			});
			wp.customize( 'background_repeat', function(value) {
				value.bind(function(to){
					theme_change_style('body', 'background-repeat', to, '!important');
				})
			});
			wp.customize( 'background_position_x', function(value) {
				value.bind(function(to){
					theme_change_style('body', 'background-position', 'top '+to, '!important');
				})
			});
			wp.customize( 'background_attachment', function(value) {
				value.bind(function(to){
					theme_change_style('body', 'background-attachment', to, '!important');
				})
			});
			wp.customize( 'header_image', function(value) {
				value.bind(function(to){
					jQuery('#custom-img-header img').attr('src', to);
				})
			});
			wp.customize( 'blogname', function(value) {
				value.bind(function(to){
					jQuery('#top-header h1 a').text(to);
				})
			});
			wp.customize( 'blogdescription', function(value) {
				value.bind(function(to){
					jQuery('#top-header p').text(to);
				})
			});
		};
	</script>
	<?php
}

// Add additional styling to better fit on Customizer options
function dixi_customize_controls_footer() {
	?>
	<style type="text/css">
		.customize-control-title { line-height: 18px; padding: 2px 0; }
		.customize-control-description { font-size: 11px; color: #666; margin: 0 0 3px; display: block; }
		.customize-control input[type="text"], .customize-control textarea { width: 98%; line-height: 18px; margin: 0; }
	</style>
	<?php
}
add_action('customize_controls_print_footer_scripts', 'dixi_customize_controls_footer');

function dixi_option_in_customize( $option ) {
	global $dixi_use_customizer_type, $dixi_use_customizer_id, $dixi_use_customizer_not_id;
	if ( in_array($option['id'], $dixi_use_customizer_not_id) )
		return false;
	if ( in_array($option['type'], $dixi_use_customizer_type) || in_array($option['id'], $dixi_use_customizer_id) || ( isset($option['custom']) && in_array($option['custom'], $dixi_use_customizer_type) ) )
		return true;
	return false;
}

?>