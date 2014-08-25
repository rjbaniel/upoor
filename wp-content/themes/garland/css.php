<?php
//ob_end_flush();
garland_css_colors_css();
function garland_css_color( $color, $shift = false ) {
	$colors = garland_css_custom_colors();
	if ( isset($colors[$color]) )
		return ( $shift && $colors[$color][1] ? $colors[$color][1] : $colors[$color][0] );
	return $color;
}
function garland_css_custom_colors() {
	if ( !$colors = get_theme_mod( 'custom-colors' ) ) {
		$colors = array();
		foreach ( garland_css_colors() as $label => $color ) {
			$colors[$label] = array( $color['default'] );
			if ( isset($colors[$label]['shift']) )
				$colors[$label][] = $colors[$label]['shift'][0];
		}
	}
	return $colors;
}
function garland_css_colors() {
	return array(
		'base' => array( 'label' => 'Base', 'el' => 'body, #wrapper, .commentlist .thread-alt', 'prop' => 'background-color', 'default' => '#0072b9', 'shift' => array( '#EDF5FA', '#ffffff' )  ),
	//	'meta' => array( 'label' => __('Meta'), 'el' => '.meta', 'prop' => 'background-color', 'default' => '#0072b9', 'shift' => array( '#EDF5FA', '#ffffff' )  ),
		'meta' => array( 'label' => 'Meta', 'el' => '.meta', 'prop' => 'background-color', 'default' => '#EDF4F9' ),
		'quote' => array( 'label' => 'Quote', 'el' => 'blockquote', 'prop' => 'background-color', 'default' => '#EDF4F9' ),
		'link' => array( 'label' => 'Link', 'el' => 'a, a:link, a:hover, a:visited', 'prop' => 'color', 'default' => '#0062A0' ),
	//	'top'  => array( 'label' => 'Header Top', 'default' => '#0472EC' ),
	//	'bottom' => array( 'label' => 'Header Bottom', 'default' => '#67AAF4' ),
		'text' => array ( 'label' => 'Text', 'el' => '#wrapper', 'prop' => 'color', 'default' => '#494949' )
	);
}
function garland_css_images() {
	return array(
		'bg-navigation-item.png' => array( 'el' => array(
				'#dropmenu li a',
				'#dropmenu li a:hover'
			),
			'args' => array(
				array( 'top', 'bottom' ),
				array( 'top', 'bottom' )
			),
			'color' => array(
				'transparent',
				'transparent'
			),
			'post' => array(
				'no-repeat 50% 0',
				'no-repeat 50% -48px'
			 )
		),
		'bg-navigation.png' => array( 'el' => '#navigation', 'args' => 'base', 'post' => 'repeat-x 50% 100%' ),
		'body.png' => array( 'el' => '#wrapper', 'args' => array( 'base', 'top', 'bottom' ), 'color' => 'base', 'post' => 'repeat-x 50% 0'),
		'bg-content.png' => array( 'el' => '#wrapper #container #center #squeeze', 'args' => array( 'base', 'top', 'bottom' ), 'color' => '#fff', 'post' => 'repeat-x 50% 0'),
		'bg-content-right.png' => array( 'el' => '#wrapper #container #center .right-corner', 'args' => array( 'base', 'top', 'bottom' ), 'color' => 'transparent', 'post' => 'no-repeat 100% 0'),
		'bg-content-left.png' => array( 'el' => '#wrapper #container #center .right-corner .left-corner', 'args' => array( 'base', 'top', 'bottom' ), 'color' => 'transparent', 'post' => 'no-repeat 0 0')
	);
}
function garland_css_colors_css() {
header('Content-type: text/css');
$interval = 2595000;
$now = time();
$pretty_lmtime = gmdate('D, d M Y H:i:s', $now) . ' GMT';
$pretty_extime = gmdate('D, d M Y H:i:s', $now + $interval) . ' GMT';
// Backwards Compatibility for HTTP/1.0 clients
header("Last Modified: $pretty_lmtime");
header("Expires: $pretty_extime");
// HTTP/1.1 support
header("Cache-Control: private,max-age=$interval"); 
header("Pragma: ");
	foreach ( garland_css_colors() as $label => $color ) {
		echo "\n\t{$color['el']}" . ' { ' . "{$color['prop']}: " . garland_css_color( $label, true ) . '; } '; 
    }
 if( get_theme_mod( 'sbr' ) ) {
 echo "\n\tbody.sidebars #squeeze {margin: 0 0 0 210px;}";
 echo "\n\t#wrapper #container {margin: 0 auto; max-width: 95%; padding: 0 20px;}";
 }
 if( get_theme_mod( 'sbl' ) ) {
 echo "\n\tbody.sidebars #squeeze {margin: 0 210px 0 0;}";
 echo "\n\t#wrapper #container {margin: 0 auto; max-width: 95%; padding: 0 20px;}";
 }
 echo "\n\ttextarea, select {border:1px solid ". garland_css_color($label = 'bottom').";}";
  echo "\n\tinput {border:1px solid ". garland_css_color($label = 'bottom').";}";
  echo "\n\ttextarea:focus, input:focus { border:1px solid ". garland_css_color($label = 'top').";}";
   echo "\n\t.commentlist .commentnumber {color: " . garland_css_color($label = 'quote')." !important;}";
   echo "\n\t#dropmenu li ul {background-color: " . garland_css_color($label = 'top')." !important;}";
	foreach ( garland_css_images() as $src => $image ) {
		if ( is_array($image['el']) ) {
			foreach ( $image['el'] as $k => $el ) {
					echo "\n\t$el" . ' { background: ' . garland_css_color( $image['color'][$k], true ) . " url('" . get_stylesheet_directory_uri() . "/garland-image.php?src=$src";
				foreach ( (array) $image['args'][$k] as $color )
					echo "&$color=" . substr(garland_css_color( $color ), 1);
				echo "') {$image['post'][$k]}" . ' } ';
			}
		} else {
			echo "\n\t{$image['el']}" . ' { background: ' . garland_css_color( $image['color'], true ) . " url('" . get_stylesheet_directory_uri() . "/garland-image.php?src=$src";
			foreach ( (array) $image['args'] as $color )
				echo "&$color=" . substr(garland_css_color( $color ), 1);
			echo "') {$image['post']}" . ' } ';
		}
	}
}
?>
