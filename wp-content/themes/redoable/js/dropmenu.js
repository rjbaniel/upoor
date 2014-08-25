// JavaScript Document
jQuery(document).ready(function() {
jQuery("#alt_menu ul").css({display: "none"}); // Opera Fix
jQuery("#alt_menu li").hover(function(){
		jQuery(this).find('ul:first').css({visibility: "visible",display: "none"}).show(400);
		},function(){
		jQuery(this).find('ul:first').css({visibility: "hidden"});
		});
});