jQuery(function(){
	jQuery.noConflict();
	jQuery('ul.superfish').superfish({
		delay:       300,                            // one second delay on mouseout
		animation:   {opacity:'show',height:'show'},  // fade-in and slide-down animation
		speed:       'fast',                          // faster animation speed
		autoArrows:  true,                           // disable generation of arrow mark-up
		dropShadows: false                            // disable drop shadows
    });

		var pagemenuwidth = jQuery("ul#page-menu").width();
		var pagemleft = Math.round((950 - pagemenuwidth) / 2);
		if (pagemenuwidth < 950) jQuery("ul#page-menu").css('padding-left',pagemleft);

		var catmenuwidth = jQuery("ul#cats-menu").width();
		var catmleft = Math.round((950 - catmenuwidth) / 2);
		 if (catmenuwidth < 950) jQuery("ul#cats-menu").css('padding-left',catmleft);

	var maxHeight = 0;
	jQuery("#footer-widgets-inside .widget").each(function() {
		if ( jQuery(this).height() > maxHeight ) { maxHeight = jQuery(this).height(); }
	}).height(maxHeight);
});