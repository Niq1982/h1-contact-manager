<?php
/*
Plugin Name: H1 Contact Manager
Plugin URI: http://h1.fi
Description: Add and manage contacts
Version: 0.1
Author: Daniel Koskinen / H1
Author URI: http://h1.fi
License: GPL2
*/
/*  Copyright 2012  Daniel Koskinen (email : dani@h1.fi)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
register_activation_hook( __FILE__, 'h1cm_activate' );

/**
 * Constants
 */
define( 'H1CM_LABEL', 'h1_contact' );
define( 'H1CM_PREFIX', 'h1cm_' );

/**
 * Hook our functions into WP hooks
 */
add_action( 'init', 'h1cm_init' );
add_action( 'admin_init', 'h1cm_admin' );
add_action( 'wp_insert_post', 'h1cm_update_post', 10, 2 );

/**
 * Tasks to run on activation
 * @return void
 */
function h1cm_activate() {
    /**
     * Initialize post types and taxonomies,
     * so they are available when flushing rewrites
     */
    h1cm_init();
    /**
     * Flushing rewrites ensures our post type & taxonomy slugs will work.
     */
    flush_rewrite_rules();
}
/**
 * Initialize the plugin
 * 
 * @return void
 */
function h1cm_init() {
    /**
     * Include custom post type definition
     */
    require_once( 'h1cm-post-type.php' );
    h1cm_register_post_types();
    h1cm_register_taxonomies();

}

/**
 * Admin init
 */
function h1cm_admin() {
    /**
     * Include admin customizations (meta fields etc)
     */
    require_once( 'h1cm-admin.php' );

    /**
     * Register meta boxes
     */
    h1cm_register_meta_boxes();

    /**
     * Move "Set featured image" box and modify text on post edit screen
     */
    add_action( 'do_meta_boxes', 'h1cm_move_featured_image_box' );
    add_filter( 'admin_post_thumbnail_html', 'h1cm_post_thumbnail_html', 10, 2 );
    add_filter( 'media_view_strings', 'h1cm_media_strings', 10, 2 );
}
/**
 * Clone meta fields and taxonomy terms into post_title and post_content
 * for easy full-text search and sorting by title.
 *
 * Should be run on wp_insert_post hook.
 * 
 * @param  int $post_id
 * @param  object $post
 * @return void
 */
function h1cm_update_post( $post_id, $post ) {

    if ( H1CM_LABEL != get_post_type( $post ) )
        return;

    $content = '';
    $title = '';

    $custom_fields = get_post_custom( $post_id );

    $clone_into_title = array( 'lastname', 'firstname' );
    $clone_into_content = array( 'email', 'phone1', 'phone2', 'title' );

    /**
     * Clone lastname, firstname into post_title
     */
    $count = 0;
    foreach ( $clone_into_title as $key ) {
        if ( ! empty( $custom_fields[ H1CM_PREFIX . $key ][ 0 ] ) ) {
            if ( $count > 0 ) $title .= ', ';
            $title .= $custom_fields[ H1CM_PREFIX . $key ][ 0 ];
            $count++;
        }
    }    
    /**
     * Clone all the rest into post_content
     */
    $count = 0;
    foreach ( $clone_into_content as $key ) {
        if ( ! empty( $custom_fields[ H1CM_PREFIX . $key ][ 0 ] ) ) {
            if ( $count > 0 ) $content .= ', ';
            $content .= $custom_fields[ H1CM_PREFIX . $key ][ 0 ];
            $count++;
        }
    }

    /**
     * Add taxonomy terms into post_content too
     */
    $taxonomies = array( 'h1_organization', 'post_tag' );
    $terms = wp_get_object_terms( $post_id, $taxonomies, array( 'fields' => 'all' ) );

    $content .= ',  ';

    foreach ( $terms as $term ) {
        $content .= ' ' . $term->name . ' ' . $term->description;
    }    

    /**
     * Get the post as an array
     * @var array
     */
    $post = get_post( $post_id, 'ARRAY_A' );
    /**
     * Set title
     */
    if ( !empty( $title ) ) { 
        $post[ 'post_title' ] = $title;
    }
    /**
     * Set content
     */
    if ( !empty( $content ) ) $post[ 'post_content' ] = $content;
    /**
     * Make sure we have a readable slug
     */
    $post[ 'post_name' ] = sanitize_title( $title, $post_id );
    /**
     * Remove actions to avoid infinite loops
     */
    remove_all_actions( 'save_post' );
    remove_action( 'wp_insert_post', 'h1cm_update_post', 10, 2 );
    /**
     * Finally save the data
     */
    wp_insert_post( $post );
    /**
     * Restore action
     */
    add_action( 'wp_insert_post', 'h1cm_update_post', 10, 2 );
}