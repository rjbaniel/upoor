// JavaScript Document
jQuery(document).ready(function() {
jQuery("#topnav ul").css({display: "none"}); // Opera Fix
jQuery("#topnav li").hover(function(){
		jQuery(this).find('ul:first').css({visibility: "visible",display: "none"}).show(400);
		},function(){
		jQuery(this).find('ul:first').css({visibility: "hidden"});
		});
});