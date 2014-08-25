<?php
/*
Plugin Name: Pretty BuddyPress Docs
Description: Plugin to spruce up BuddyPress Docs
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
	function make_children_pretty ( $html, $child_data ) {
		if ( !empty( $child_data ) ) {
			$html = '<div class="child-docs">' . '<p>' . 'Children: ' . '</p>';
			$children_html = array();
			foreach( $child_data as $child ) {
				$children_html[] =
				'<div class="child-doc">
					<a class="child-doc-link" href="' . $child['post_link'] . '">
					<svg class="child-icon" width="100" height="100" viewBox="0 0 512 512">
						<path class="icon-path"
							d="M339.527,370.312H171.505v-30h168.022V370.312z M339.495,314.896h-167.99v-30h167.99V314.896z
	 									
							M339.495,259.562h-167.99v-30h167.99V259.562z M297.818,90v85.75h85.864V422H128.317V90H297.818 M322.818,50H88.317v412h335.365

							V150.75L322.818,50z" />
					</svg>' .
					$child['post_name'] .
				'</a></div>';
			}
			$html .= implode( $children_html );
			$html .= '</div>';
		}
		return $html;
	}

	add_filter( 'bp_docs_hierarchy_show_children', 'make_children_pretty', 15, 2);

	function make_parent_pretty ( $html, $parent ) {
		if ( !empty( $parent->ID ) ) {
			$parent_url = bp_docs_get_doc_link( $parent->ID );
			$parent_title = $parent->post_title;
			$html = '<div class="parent-doc">' . '<a class="parent-doc-link" href="' . $parent_url . '">' . '<p>' . __( 'Parent: ', 'bp-docs' ) . $parent_title . '</p>';
			$html .=
				'<svg class="folder-icon" x="0px" y="0px" width="100" height="100" viewBox="0 0 512 512">
					<path id="open-folder-icon" d="M432.583,422.34H74L50,234.528h412L432.583,422.34z M430,199.567v-77.303H228.021

						c-8.879,0-17.396-3.513-23.693-9.771L181.35,89.66H81v109.907H430z"/>
				</svg></a></div>';
		}
		return $html;
	}

	add_filter( 'bp_docs_hierarchy_show_parent', 'make_parent_pretty', 15, 2 );

	function enqueue_pretty_docs_styles() {
		global $post;
		global $bp;
		if ( $post->post_type == bp_docs_get_post_type_name() ) {
			wp_enqueue_style( 'pretty-bp-docs-style', get_stylesheet_url('pretty-bp-docs') );
		}
		if ( $bp->current_component == 'groups' && $bp->current_action == 'docs' ) {
			wp_enqueue_style( 'group-docs-home-style', get_stylesheet_url('group-docs-home') );
		}
	}
	function get_stylesheet_url( $stylesheet ) {
		return plugins_url( 'css/'. $stylesheet . '.css', __FILE__ );
	}
	add_action( 'wp_enqueue_scripts', 'enqueue_pretty_docs_styles' );
?>
