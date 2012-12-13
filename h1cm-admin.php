<?php
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
					'name'  => __( 'Title', 'h1cm' ),
					'id'    => "{$prefix}title",
					'desc'  => 'Eg. job title',
					'type'  => 'text',
				),

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