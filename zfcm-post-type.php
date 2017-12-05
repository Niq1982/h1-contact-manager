<?php
/**
 * Define post types
 */
function zfcm_register_post_types() {

	/**
	 * Custom labels for Contacts
	 * @var array
	 */
	$labels = array(
		'name'               => __( 'Contacts', 'zfcm' ),
		'singular_name'      => __( 'Contact', 'zfcm' ),
		'add_new'            => __( 'Add new', 'zfcm' ),
		'add_new_item'       => __( 'Add new Contact', 'zfcm' ),
		'edit_item'          => __( 'Edit Contact', 'zfcm' ),
		'new_item'           => __( 'New Contact', 'zfcm' ),
		'all_items'          => __( 'All Contacts', 'zfcm' ),
		'view_item'          => __( 'View Contact', 'zfcm' ),
		'search_items'       => __( 'Search Contacts', 'zfcm' ),
		'not_found'          => __( 'No Contacts found', 'zfcm' ),
		'not_found_in_trash' => __( 'No Contacts found in Trash', 'zfcm' ),
		'parent_item_colon'  => '',
		'menu_name'          => __( 'Contacts', 'zfcm' ),
		'featured_image'        => __( 'Henkilön kuva', 'text_domain' ),
		'set_featured_image'    => __( 'Aseta henkilön kuva', 'text_domain' ),
		'remove_featured_image' => __( 'Poista henkilön kuva', 'text_domain' ),
		'use_featured_image'    => __( 'Käytä henkilön kuvana', 'text_domain' ),
	);

	/**
	 * Features of the Contact post type
	 * @var array
	 */
	$args = array(
		'labels'                => $labels,
		'public'                => true,
		'publicly_queryable'    => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'query_var'             => true,
		'rewrite'               => array(
			'slug' => 'contact',
			),
		'capability_type'       => 'post',
		'has_archive'           => false,
		'hierarchical'          => false,
		'menu_position'         => null,
		'supports'              => array( 'thumbnail', 'page-attributes' ),
		'menu_icon'           	=> 'dashicons-phone',
	);

	register_post_type( ZFCM_LABEL , $args );

}

/**
 * Register custom taxonomies
 * @return void
 */
function zfcm_register_taxonomies() {

	$contact_group_labels = array(
		'name'					=> _x( 'Contact Groups', 'Taxonomy plural name', 'zfcm' ),
		'singular_name'			=> _x( 'Contact Group', 'Taxonomy singular name', 'zfcm' ),
		'search_items'			=> __( 'Search Contact Groups', 'zfcm' ),
		'popular_items'			=> __( 'Popular Contact Groups', 'zfcm' ),
		'all_items'				=> __( 'All Contact Groups', 'zfcm' ),
		'parent_item'			=> __( 'Parent Contact Group', 'zfcm' ),
		'parent_item_colon'		=> __( 'Parent Contact Group', 'zfcm' ),
		'edit_item'				=> __( 'Edit Contact Group', 'zfcm' ),
		'update_item'			=> __( 'Update Contact Group', 'zfcm' ),
		'add_new_item'			=> __( 'Add New Contact Group', 'zfcm' ),
		'new_item_name'			=> __( 'New Contact Group Name', 'zfcm' ),
		'add_or_remove_items'	=> __( 'Add or remove Contact Groups', 'zfcm' ),
		'choose_from_most_used'	=> __( 'Choose from most used Contact Groups', 'zfcm' ),
		'menu_name'				=> __( 'Contact Group', 'zfcm' ),
	);

	$contact_group_args = array(
		'labels'            => $contact_group_labels,
		'public'            => true,
		'show_in_nav_menus' => true,
		'show_admin_column' => true,
		'hierarchical'      => false,
		'show_tagcloud'     => true,
		'show_ui'           => true,
		'query_var'         => true,
		'rewrite'           => true,
		'query_var'         => true,
		'capabilities'      => array(),
	);

	register_taxonomy( 'contact-group', array( ZFCM_LABEL ), $contact_group_args );

	$title_labels = array(
		'name'					=> _x( 'Titles', 'Taxonomy plural name', 'zfcm' ),
		'singular_name'			=> _x( 'Title', 'Taxonomy singular name', 'zfcm' ),
		'search_items'			=> __( 'Search Titles', 'zfcm' ),
		'popular_items'			=> __( 'Popular Titles', 'zfcm' ),
		'all_items'				=> __( 'All Titles', 'zfcm' ),
		'parent_item'			=> __( 'Parent Title', 'zfcm' ),
		'parent_item_colon'		=> __( 'Parent Title', 'zfcm' ),
		'edit_item'				=> __( 'Edit Title', 'zfcm' ),
		'update_item'			=> __( 'Update Title', 'zfcm' ),
		'add_new_item'			=> __( 'Add New Title', 'zfcm' ),
		'new_item_name'			=> __( 'New Title Name', 'zfcm' ),
		'add_or_remove_items'	=> __( 'Add or remove Titles', 'zfcm' ),
		'choose_from_most_used'	=> __( 'Choose from most used Titles', 'zfcm' ),
		'menu_name'				=> __( 'Title', 'zfcm' ),
	);

	$title_args = array(
		'labels'            => $title_labels,
		'public'            => true,
		'show_in_nav_menus' => true,
		'show_admin_column' => true,
		'hierarchical'      => false,
		'show_tagcloud'     => true,
		'show_ui'           => true,
		'query_var'         => true,
		'rewrite'           => true,
		'query_var'         => true,
		'capabilities'      => array(),
	);

	register_taxonomy( 'title', array( ZFCM_LABEL ), $title_args );

	$location_labels = array(
		'name'					=> _x( 'Locations', 'Taxonomy plural name', 'zfcm' ),
		'singular_name'			=> _x( 'Location', 'Taxonomy singular name', 'zfcm' ),
		'search_items'			=> __( 'Search Locations', 'zfcm' ),
		'popular_items'			=> __( 'Popular Locations', 'zfcm' ),
		'all_items'				=> __( 'All Locations', 'zfcm' ),
		'parent_item'			=> __( 'Parent Location', 'zfcm' ),
		'parent_item_colon'		=> __( 'Parent Location', 'zfcm' ),
		'edit_item'				=> __( 'Edit Location', 'zfcm' ),
		'update_item'			=> __( 'Update Location', 'zfcm' ),
		'add_new_item'			=> __( 'Add New Location', 'zfcm' ),
		'new_item_name'			=> __( 'New Location Name', 'zfcm' ),
		'add_or_remove_items'	=> __( 'Add or remove Locations', 'zfcm' ),
		'choose_from_most_used'	=> __( 'Choose from most used Locations', 'zfcm' ),
		'menu_name'				=> __( 'Location', 'zfcm' ),
	);

	$location_args = array(
		'labels'            => $location_labels,
		'public'            => true,
		'show_in_nav_menus' => true,
		'show_admin_column' => true,
		'hierarchical'      => false,
		'show_tagcloud'     => true,
		'show_ui'           => true,
		'query_var'         => true,
		'rewrite'           => true,
		'query_var'         => true,
		'capabilities'      => array(),
	);

	register_taxonomy( 'location', array( ZFCM_LABEL ), $location_args );

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
function zfcm_update_post( $post_id, $post ) {

	if ( ZFCM_LABEL !== get_post_type( $post ) ) {
	    return;
	}

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
	    if ( ! empty( $custom_fields[ ZFCM_PREFIX . $key ][0] ) ) {
	        if ( $count > 0 ) {
	        	$title .= ', ';
	        }
	        $title .= $custom_fields[ ZFCM_PREFIX . $key ][0];
	        $count++;
	    }
	}
	/**
	 * Clone all the rest into post_content
	 */
	$count = 0;
	foreach ( $clone_into_content as $key ) {
	    if ( ! empty( $custom_fields[ ZFCM_PREFIX . $key ][0] ) ) {
	        if ( $count > 0 ) {
	        	$content .= ', ';
	        }
	        $content .= $custom_fields[ ZFCM_PREFIX . $key ][0];
	        $count++;
	    }
	}

	/**
	 * Add taxonomy terms into post_content too
	 */
	$taxonomies = array( 'contact-group' );
	$terms = wp_get_object_terms(
		$post_id,
		$taxonomies,
		array(
			'fields' => 'all',
	) );

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
	if ( ! empty( $title ) ) {
	    $post['post_title'] = $title;
	}
	/**
	 * Set content
	 */
	if ( ! empty( $content ) ) {
		$post['post_content'] = $content;
	}
	/**
	 * Make sure we have a readable slug
	 */
	$post['post_name'] = sanitize_title( $title, $post_id );
	/**
	 * Remove actions to avoid infinite loops
	 */
	remove_all_actions( 'save_post' );
	remove_action( 'wp_insert_post', 'zfcm_update_post', 10, 2 );
	/**
	 * Finally save the data
	 */
	wp_insert_post( $post );
	/**
	 * Restore action
	 */
	add_action( 'wp_insert_post', 'zfcm_update_post', 10, 2 );
}
