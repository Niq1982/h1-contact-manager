<?php
/**
 * Define meta fields for the Contact post type
 * @return void
 */
function h1cm_meta_fields() {
	$prefix = H1CM_PREFIX;

	global $meta_boxes;

	$meta_boxes[] = array(
		// Meta box ID ( Not the id of the field! )
		'id' => $prefix . 'info',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' => __( 'Contact information', 'h1cm' ),

		// Post types
		'pages' => array( H1CM_LABEL ),

		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context' => 'normal',

		// Order of meta box: high (default), low. Optional.
		'priority' => 'high',

		// List of meta fields
		'fields' => array(
			array(
					'name'  => __( 'Last name', 'h1cm' ),
					'id'    => "{$prefix}lastname",
					'desc'  => '',
					'type'  => 'text',
				),
			array(
					'name'  => __( 'First Name', 'h1cm' ),
					'id'    => "{$prefix}firstname",
					'desc'  => '',
					'type'  => 'text',
				),
			array(
					'name'  => __( 'Phone 1', 'h1cm' ),
					'id'    => "{$prefix}phone1",
					'desc'  => '',
					'type'  => 'text',
				),
			array(
					'name'  => __( 'Phone 2', 'h1cm' ),
					'id'    => "{$prefix}phone2",
					'desc'  => '',
					'type'  => 'text',
				),
			array(
					'name'  => __( 'Email address', 'h1cm' ),
					'id'    => "{$prefix}email",
					'desc'  => '',
					'type'  => 'text',
				),			
			array(
					'name'  => __( 'Title', 'h1cm' ),
					'id'    => "{$prefix}title",
					'desc'  => 'Eg. job title',
					'type'  => 'text',
				),
			array(
					'name'  => __( 'English Title', 'h1cm' ),
					'id'    => "{$prefix}title_en",
					'desc'  => 'Eg. job title',
					'type'  => 'text',
				),			
			array(
					'name'  => __( 'Additional info', 'h1cm' ),
					'id'    => "{$prefix}info",
					'desc'  => '',
					'type'  => 'textarea',
				),			
/*			array(
				'name'    => __( 'Organization', 'h1cm' ),
				'id'      => "{$prefix}organization",
				'type'    => 'taxonomy',
				'options' => array(
					// Taxonomy name
					'taxonomy' => 'h1_organization',
					// How to show taxonomy: 'checkbox_list' (default) or 'checkbox_tree', 'select_tree' or 'select'. Optional
					'type' => 'select_tree',
					// Additional arguments for get_terms() function. Optional
					'args' => array()
				),
			),*/
		)
	);
}

/**
 * Plug in to the Meta Box plugin and register the meta boxes
 * @return void
 */
function h1cm_register_meta_boxes() {
    // Make sure there's no errors when the plugin is deactivated or during upgrade
    if ( !class_exists( 'RW_Meta_Box' ) )
        return;

	/**
	 * Define the fields
	 */
	h1cm_meta_fields();

    /**
     * Register meta boxes
     */
    global $meta_boxes;
    foreach ( $meta_boxes as $meta_box )
    {
        new RW_Meta_Box( $meta_box );
    }
}

/**
 * Move the Featured image box to center stage
 */
function h1cm_move_featured_image_box() {

	remove_meta_box( 'postimagediv', H1CM_LABEL, 'side' );

	add_meta_box( 'postimagediv', __( 'Contact photo', 'h1cm'), 'post_thumbnail_meta_box', H1CM_LABEL, 'normal', 'high');
}


/**
 * Filter the featured image meta box. Currently this is necessary just to change the text
 * "Set featured image" to something else, because it has no filter of its own.
 * 
 * @param  string $content HTML block
 * @param  id $post_id
 * @return string
 */
function h1cm_post_thumbnail_html( $content, $post_id ) {
	global $content_width, $_wp_additional_image_sizes;

	$post = get_post( $post_id );
	$thumbnail_id = get_post_meta( $post->ID, '_thumbnail_id', true );

	$upload_iframe_src = esc_url( get_upload_iframe_src('image', $post->ID ) );
	$set_thumbnail_link = '<p class="hide-if-no-js"><a title="' . esc_attr__( 'Set contact photo', 'h1cm' ) . '" href="%s" id="set-post-thumbnail" class="thickbox">%s</a></p>';
	$content = sprintf( $set_thumbnail_link, $upload_iframe_src, esc_html__( 'Set contact photo', 'h1cm' ) );

	if ( $thumbnail_id && get_post( $thumbnail_id ) ) {
		$old_content_width = $content_width;
		$content_width = 266;
		if ( !isset( $_wp_additional_image_sizes['post-thumbnail'] ) )
			$thumbnail_html = wp_get_attachment_image( $thumbnail_id, array( $content_width, $content_width ) );
		else
			$thumbnail_html = wp_get_attachment_image( $thumbnail_id, 'post-thumbnail' );
		if ( !empty( $thumbnail_html ) ) {
			$ajax_nonce = wp_create_nonce( 'set_post_thumbnail-' . $post->ID );
			$content = sprintf( $set_thumbnail_link, $upload_iframe_src, $thumbnail_html );
			$content .= '<p class="hide-if-no-js"><a href="#" id="remove-post-thumbnail" onclick="WPRemoveThumbnail(\'' . $ajax_nonce . '\');return false;">' . esc_html__( 'Remove contact photo', 'h1cm' ) . '</a></p>';
		}
		$content_width = $old_content_width;
	}

	return $content;
}

/**
 * Change "Set featured image" to "Set contact photo" on featured image upload screen
 * 
 * @param  array $strings An array of localizable strings
 * @param  object $post
 * @return array
 */
function h1cm_media_strings( $strings, $post ) {

	if ( H1CM_LABEL == get_post_type( $post ) ) {

		$strings['setFeaturedImageTitle'] = __( 'Set contact photo', 'h1cm' );
		$strings['setFeaturedImage'] = __( 'Set contact photo', 'h1cm' );
	}

	return $strings;
}