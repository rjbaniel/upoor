<?
/*
Plugin Name: Resource Library
Description: Plugin to create a library of resources
Version: 0.1
Author: Daniel Jones
License: GPL2
*/

/*  Copyright 2013  Daniel Jones  (email : drjones18@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
*/

add_action( 'init', 'create_library_resource_type' );
function create_library_resource_type() {
	register_post_type( 'lr_library_resource',
		array(
			'labels' => array(
				'name' => __( 'Resources' ),
				'singular_name' => __( 'Resource' )
			),
		'public' => true,
		'has_archive' => true,
		'rewrite' => array('slug' => 'resources'),
		'menu_position' => 5
		)
	);
}
?>
