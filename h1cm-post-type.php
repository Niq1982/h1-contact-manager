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
				'supports' => array( 'thumbnail', 'custom-fields' )
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

	/**
	 * Unit taxonomy
	 *
	 * Units are meant for mostly K3 people
	 */
	$labels = array(
		'name' => _x( 'Units', 'taxonomy general name', 'h1cm' ),
		'singular_name' => _x( 'Unit', 'taxonomy singular name', 'h1cm' ),
		'search_items' =>  __( 'Search Units', 'h1cm' ),
		'all_items' => __( 'All Units', 'h1cm' ),
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __( 'Edit Unit', 'h1cm' ), 
		'update_item' => __( 'Update Unit', 'h1cm' ),
		'add_new_item' => __( 'Add New Unit', 'h1cm' ),
		'new_item_name' => __( 'New Unit Name', 'h1cm' ),
		'popupar_items' => __( 'Popular units', 'h1cm' ),
	    'separate_items_with_commas' => __( 'Separate units with commas', 'h1cm' ),
	    'add_or_remove_items' => __( 'Add or remove units', 'h1cm' ),
	    'choose_from_most_used' => __( 'Choose from the most used units', 'h1cm' ),		
		'menu_name' => __( 'Unit', 'h1cm' ),
	);

	$args = array(
			'hierarchical' => false,
			'labels' => $labels,
			'show_ui' => true,
			'show_in_nav_menus' => true,
			'show_admin_column' => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var' => true,
			'rewrite' => array( 'slug' => 'unit' ),
		);

	register_taxonomy( 'h1_unit', H1CM_LABEL, $args );

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