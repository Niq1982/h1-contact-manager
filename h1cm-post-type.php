<?php
/**
 * Define post types
 */
function h1cm_register_post_types() {

	/**
	 * Custom labels for Contacts
	 * @var array
	 */
	$labels = array(
			    'name' => __( 'Contacts', 'h1cm' ),
			    'singular_name' => __( 'Contact', 'h1cm' ),
			    'add_new' => __( 'Add new', 'h1cm' ),
			    'add_new_item' => __( 'Add new Contact', 'h1cm' ),
			    'edit_item' => __( 'Edit Contact', 'h1cm' ),
			    'new_item' => __( 'New Contact', 'h1cm' ),
			    'all_items' => __( 'All Contacts', 'h1cm' ),
			    'view_item' => __( 'View Contact', 'h1cm' ),
			    'search_items' => __( 'Search Contacts', 'h1cm' ),
			    'not_found' =>  __( 'No Contacts found', 'h1cm' ),
			    'not_found_in_trash' => __( 'No Contacts found in Trash', 'h1cm' ), 
			    'parent_item_colon' => '',
			    'menu_name' => __( 'Contacts', 'h1cm' )	
			);

	/**
	 * Features of the Contact post type
	 * @var array
	 */
	$args = array(
				'labels' => $labels,
				'public' => true,
				'publicly_queryable' => true,
				'show_ui' => true, 
				'show_in_menu' => true, 
				'query_var' => true,
				'rewrite' => array( 'slug' => 'contact' ),
				'capability_type' => 'post',
				'has_archive' => true,
				'hierarchical' => false,
				'menu_position' => null,
				'supports' => array( 'thumbnail' )
			);

	register_post_type( H1CM_LABEL , $args );

}

/**
 * Register custom taxonomies
 * @return void
 */
function h1cm_register_taxonomies() {

	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name' => _x( 'Organizations', 'taxonomy general name' ),
		'singular_name' => _x( 'Organization', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Organizations' ),
		'all_items' => __( 'All Organizations' ),
		'parent_item' => __( 'Parent Organization' ),
		'parent_item_colon' => __( 'Parent Organization:' ),
		'edit_item' => __( 'Edit Organization' ), 
		'update_item' => __( 'Update Organization' ),
		'add_new_item' => __( 'Add New Organization' ),
		'new_item_name' => __( 'New Organization Name' ),
		'menu_name' => __( 'Organization' ),
	);

	$args = array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'show_admin_column' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'org' ),
		);

	register_taxonomy( 'h1_organization', H1CM_LABEL, $args );

}