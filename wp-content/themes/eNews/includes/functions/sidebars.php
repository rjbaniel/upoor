<?php
if ( function_exists('register_sidebar') )
    register_sidebar(array(
    'name' => 'Sidebar',
    'before_widget' => '',
    'after_widget' => '</div> <!-- end sidebar block -->',
    'before_title' => '<h3>',
    'after_title' => '</h3><div class="sidebar-block">',
    ));
if ( function_exists('register_sidebar') )
    register_sidebar(array(
    'name' => 'Footer',
    'before_widget' => '<div class="widget">',
    'after_widget' => '</div> <!-- end widget -->',
    'before_title' => '<h4>',
    'after_title' => '</h4>',
    ));
?>