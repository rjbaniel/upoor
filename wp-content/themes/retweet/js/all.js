$(document).ready(function(){
(function(){
function SetCookie(c_name,value,expiredays){
var exdate=new Date();
exdate.setDate(exdate.getDate()+expiredays);
document.cookie=c_name+"="+escape(value)+((expiredays==null)?"":";expires="+exdate.toGMTString())+";path=/"; 
}
window['RootCookies'] = {};
window['RootCookies']['SetCookie'] = SetCookie;
})();
$('.wide-container').click(function() { 
RootCookies.SetCookie('wide_container', '1');
$(this).css({display:'inline'}); 
$('.wide-container').hide();
$('.normal-container').show();
$('#container').animate({width: "880px"}, 700);
$('#profiletext').animate({width: "610px"}, 700);
$('#content').animate({width: "680px"}, 500);
});
$('.normal-container').click(function() {  
RootCookies.SetCookie('wide_container', '0');
$(this).css({display:'inline'});    
$('.normal-container').hide();
$('.wide-container').show();
$('#container').animate({width: "763px"}, 700);
$('#content').animate({width: "564px"}, 700);
$('#profiletext').animate({width: "495px"}, 700);
}); 
});
$(document).ready(function()
{
	$(".collapsible").click(function()
		 {
			$(".sidebar-menu").slideToggle("fast");$(this).toggleClass("collapsed")
		});
});
$(document).ready(function(){
$(".comment_heading span.tab_button:first").addClass("current");
$(".comment_heading ol:not(:first)").hide();

$(".comment_heading span.tab_button").click(function(){
$(".comment_heading span.tab_button").removeClass("current");
$(this).addClass("current");
$(".comment_heading ol").hide();
$("."+$(this).attr("id")).fadeIn("slow");
});});
$("a[rel='external'],a[rel='external nofollow']").click(function(){window.open(this.href);return false})