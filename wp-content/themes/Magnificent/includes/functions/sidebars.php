<?php
if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Sidebar Left Top',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div></div><!-- end .widget -->',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4><div class="widgetcontent">',
	));

if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Sidebar Left Bottom',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div></div><!-- end .widget -->',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4><div class="widgetcontent">',
	));

if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Sidebar Right Top',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div></div><!-- end .widget -->',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4><div class="widgetcontent">',
	));

if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Sidebar Right Bottom',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div></div><!-- end .widget -->',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4><div class="widgetcontent">',
	));

if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div></div><!-- end .widget -->',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4><div class="widgetcontent">',
	));

if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => 'Footer',
		'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
		'after_widget' => '</div> <!-- end .footer-widget -->',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
    ));
?>