<?php
/*
Plugin Name: ZF Contact Manager
Plugin URI: http://zeelandfamily.fi
Description: Add and manage contacts
Version: 0.4
Author: Daniel Koskinen, Niku Hietanen / Zeeland Family
Author URI: http://zeelandfamily.fi
License: GPL2
*/
/*  Copyright 2012-2015  Daniel Koskinen (email : dani@h1.fi)

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
register_activation_hook( __FILE__, 'zfcm_activate' );

/**
 * Constants
 */
if ( ! defined( 'ZFCM_LABEL' ) ) {
	define( 'ZFCM_LABEL', 'contact' );
}
if ( ! defined( 'ZFCM_PREFIX' ) ) {
	define( 'ZFCM_PREFIX', '_' );
}

/**
 * Hook our functions into WP hooks
 */
add_action( 'init', 'zfcm_init' );
if ( is_admin() ) {
	zfcm_admin();
}

/**
 * Tasks to run on activation
 * @return void
 */
function zfcm_activate() {
	/**
	 * Initialize post types and taxonomies,
	 * so they are available when flushing rewrites
	 */
	zfcm_init();
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
function zfcm_init() {
	load_plugin_textdomain( 'zfcm', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	/**
	* Include custom post type definition
	*/
	require_once( 'zfcm-post-type.php' );
	zfcm_register_post_types();
	zfcm_register_taxonomies();

	/**
	* Do actions on save (clone custom fields into title & content)
	*/
	add_action( 'wp_insert_post', 'zfcm_update_post', 10, 2 );

	/**
	* Modify the_content and the_title on individual contact items
	*/
	require_once( 'zfcm-views.php' );
	add_filter( 'the_content', 'zfcm_entry_content' );
}

/**
 * Admin init
 */
function zfcm_admin() {
	/**
	 * Include admin customizations (meta fields etc)
	 */
	require_once( 'zfcm-admin.php' );

	/**
	 * Register meta boxes, support both Meta Box by Rilwis and Custom Meta Boxes by Humanmade
	 */
	add_action( 'cmb2_init', 'zfcm_register_meta_boxes' );
}
