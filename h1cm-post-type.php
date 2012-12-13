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
			'supports' => array( 'title', 'thumbnail' )

		);

	register_post_type( H1CM_LABEL , $args );

}