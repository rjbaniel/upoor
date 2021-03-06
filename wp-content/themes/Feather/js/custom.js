jQuery.noConflict();

jQuery(document).ready(function(){
	var et_theme_folder = jQuery("meta[name=et_theme_folder]").attr('content'),
		$et_top_menu = jQuery('ul#top-menu > li > ul'),
		et_disable_toptier = jQuery("meta[name=et_disable_toptier]").attr('content');

	jQuery('ul.nav').superfish({
		delay:       300,                            // one second delay on mouseout
		animation:   {opacity:'show',height:'show'},  // fade-in and slide-down animation
		speed:       'fast',                          // faster animation speed
		autoArrows:  true,                           // disable generation of arrow mark-up
		dropShadows: false                            // disable drop shadows
	});

	if ( $et_top_menu.length ){
		$et_top_menu.prepend('<li class="menu-gradient"></li>');
	}

	var $featured_content = jQuery('#featured #slides'),
		et_featured_slider_auto = jQuery("meta[name=et_featured_slider_auto]").attr('content'),
		et_featured_auto_speed = jQuery("meta[name=et_featured_auto_speed]").attr('content');

	jQuery(window).load( function(){
		if ($featured_content.length){
			var et_featured_options = {
				timeout: 0,
				speed: 500,
				cleartypeNoBg: true,
				prev:   '#featured a#featured-left',
				next:   '#featured a#featured-right',
				pager:  '#controllers'
			}
			if ( et_featured_slider_auto == 1 ) et_featured_options.timeout = et_featured_auto_speed;

			$featured_content.css( 'backgroundImage', 'none' );
			$featured_content.cycle( et_featured_options );

			if ( $featured_content.find('.slide').length == 1 ){
				$featured_content.find('.slide').css({'position':'absolute','top':'0','left':'0'}).show();
				jQuery('#featured-left, #featured-right').hide();
			}
		}
	} );

	var $et_media_slider = jQuery('#media-slider');
	if ( $et_media_slider.length ){
		$et_media_slider.cycle( {
			timeout: 0,
			speed: 500,
			cleartypeNoBg: true,
			prev:   '.recent-inner a#media-left',
			next:   '.recent-inner a#media-right'
		} );
	}

	var $et_media_thumb = jQuery('.media-thumb');
	$et_media_thumb.hover(function(){
		jQuery(this).find('img').fadeTo('fast', 0.8);
		jQuery(this).find('.more,.zoom').fadeTo('fast', 1);
	}, function(){
		jQuery(this).find('img').fadeTo('fast', 1);
		jQuery(this).find('.more,.zoom').fadeTo('fast', 0);
	});

	var $footer_widget = jQuery("#footer-widgets .footer-widget");
	if ( $footer_widget.length ) {
		$footer_widget.each(function (index, domEle) {
			if ((index+1)%3 == 0) jQuery(domEle).addClass("last").after("<div class='clear'></div>");
		});
	}

	et_search_bar();

	function et_search_bar(){
		var $searchform = jQuery('#search-form'),
			$searchinput = $searchform.find("input#searchinput"),
			searchvalue = $searchinput.val();

		$searchinput.focus(function(){
			if (jQuery(this).val() === searchvalue) jQuery(this).val("");
		}).blur(function(){
			if (jQuery(this).val() === "") jQuery(this).val(searchvalue);
		});
	}

	if ( et_disable_toptier == 1 ) jQuery("ul.nav > li > ul").prev("a").attr("href","#");

	var $comment_form = jQuery('form#commentform');
	$comment_form.find('input, textarea').focus(function(){
		if (jQuery(this).val() === jQuery(this).next('label').text()) jQuery(this).val("");
	}).blur(function(){
		if (jQuery(this).val() === "") jQuery(this).val( jQuery(this).next('label').text() );
	});

	// remove placeholder text before form submission
	$comment_form.submit(function(){
		$comment_form.find('input:text, textarea').each(function(index,domEle){
			var $et_current_input = jQuery(domEle),
				$et_comment_label = $et_current_input.siblings('label'),
				et_comment_label_value = $et_current_input.siblings('label').text();

			if ( $et_comment_label.length && $et_comment_label.is(':hidden') ) {
				if ( $et_comment_label.text() == $et_current_input.val() )
					$et_current_input.val( '' );
			}
		});
	});
});