// JavaScript Document
jQuery(document).ready(function() {
jQuery("#menu ul").css({display: "none"}); // Opera Fix
jQuery("#menu li").hover(function(){
		jQuery(this).find('ul:first').css({visibility: "visible",display: "none"}).show(400);
		},function(){
		jQuery(this).find('ul:first').css({visibility: "hidden"});
		});
});