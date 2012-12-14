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

	/**
	 * Organization taxonomy
	 *
	 * The principal organization a contact belongs to, usually only one.
	 */
	$labels = array(
		'name' => _x( 'Organizations', 'taxonomy general name', 'h1cm' ),
		'singular_name' => _x( 'Organization', 'taxonomy singular name', 'h1cm' ),
		'search_items' =>  __( 'Search Organizations', 'h1cm' ),
		'all_items' => __( 'All Organizations', 'h1cm' ),
		'parent_item' => __( 'Parent Organization', 'h1cm' ),
		'parent_item_colon' => __( 'Parent Organization:', 'h1cm' ),
		'edit_item' => __( 'Edit Organization', 'h1cm' ), 
		'update_item' => __( 'Update Organization', 'h1cm' ),
		'add_new_item' => __( 'Add New Organization', 'h1cm' ),
		'new_item_name' => __( 'New Organization Name', 'h1cm' ),
		'menu_name' => __( 'Organization', 'h1cm' ),
	);

	$args = array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'show_in_nav_menus' => true,
			'show_admin_column' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'org' ),
		);

	register_taxonomy( 'h1_organization', H1CM_LABEL, $args );

	/**
	 * Group taxonomy
	 *
	 * Groups are meant for arbitrary tagging of contacts, for easy creation of
	 */
	$labels = array(
		'name' => _x( 'Groups', 'taxonomy general name', 'h1cm' ),
		'singular_name' => _x( 'Group', 'taxonomy singular name', 'h1cm' ),
		'search_items' =>  __( 'Search Groups', 'h1cm' ),
		'all_items' => __( 'All Groups', 'h1cm' ),
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __( 'Edit Group', 'h1cm' ), 
		'update_item' => __( 'Update Group', 'h1cm' ),
		'add_new_item' => __( 'Add New Group', 'h1cm' ),
		'new_item_name' => __( 'New Group Name', 'h1cm' ),
		'popupar_items' => __( 'Popular groups', 'h1cm' ),
	    'separate_items_with_commas' => __( 'Separate groups with commas', 'h1cm' ),
	    'add_or_remove_items' => __( 'Add or remove groups', 'h1cm' ),
	    'choose_from_most_used' => __( 'Choose from the most used groups', 'h1cm' ),		
		'menu_name' => __( 'Group', 'h1cm' ),
	);

	$args = array(
			'hierarchical' => false,
			'labels' => $labels,
			'show_ui' => true,
			'show_in_nav_menus' => true,
			'show_admin_column' => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var' => true,
			'rewrite' => array( 'slug' => 'group' ),
		);

	register_taxonomy( 'h1_group', H1CM_LABEL, $args );

}