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
				'supports' => array( 'thumbnail', 'page-attributes' )
			);

	register_post_type( H1CM_LABEL , $args );

}

/**
 * Register custom taxonomies
 * @return void
 */
function h1cm_register_taxonomies() {


	$labels = array(
		'name'					=> _x( 'Contact Groups', 'Taxonomy plural name', 'h1cm' ),
		'singular_name'			=> _x( 'Contact Group', 'Taxonomy singular name', 'h1cm' ),
		'search_items'			=> __( 'Search Contact Groups', 'h1cm' ),
		'popular_items'			=> __( 'Popular Contact Groups', 'h1cm' ),
		'all_items'				=> __( 'All Contact Groups', 'h1cm' ),
		'parent_item'			=> __( 'Parent Contact Group', 'h1cm' ),
		'parent_item_colon'		=> __( 'Parent Contact Group', 'h1cm' ),
		'edit_item'				=> __( 'Edit Contact Group', 'h1cm' ),
		'update_item'			=> __( 'Update Contact Group', 'h1cm' ),
		'add_new_item'			=> __( 'Add New Contact Group', 'h1cm' ),
		'new_item_name'			=> __( 'New Contact Group Name', 'h1cm' ),
		'add_or_remove_items'	=> __( 'Add or remove Contact Groups', 'h1cm' ),
		'choose_from_most_used'	=> __( 'Choose from most used Contact Groups', 'h1cm' ),
		'menu_name'				=> __( 'Contact Group', 'h1cm' ),
	);

	$args = array(
		'labels'            => $labels,
		'public'            => true,
		'show_in_nav_menus' => true,
		'show_admin_column' => false,
		'hierarchical'      => false,
		'show_tagcloud'     => true,
		'show_ui'           => true,
		'query_var'         => true,
		'rewrite'           => true,
		'query_var'         => true,
		'capabilities'      => array(),
	);

	register_taxonomy( 'contact-group', array( H1CM_LABEL ), $args );

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
    $taxonomies = array( 'contact-group' );
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