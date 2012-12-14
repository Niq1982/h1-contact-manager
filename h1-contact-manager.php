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


}