$(document).ready(function(){
$('.comment-reply-link').click(function() {
var atname = $(this).parents(".status-body").find("strong").text();
var aturl = $(this).parents(".status-body").find("a.commenturl").attr("href");
$("#comment").append("&lt;a href=\"" + aturl + "\"&gt;@" + atname + "&lt;/a&gt; , ").focus();
});
$('#cancel-comment-reply-link').click(function() {
$("#comment").empty();
});
});