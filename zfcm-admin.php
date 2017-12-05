<?php
/**
 * Define meta fields for the Contact post type
 * @return void
 */
function zfcm_register_meta_boxes() {
	$prefix = ZFCM_PREFIX;

	$cmb = new_cmb2_box( array(
		// Meta box ID ( Not the id of the field! )
		'id' => $prefix . 'info',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' => __( 'Contact information', 'zfcm' ),

		// Post types
		'object_types' => array( ZFCM_LABEL ),

		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context' => 'normal',

		// Order of meta box: high (default), low. Optional.
		'priority' => 'default',
		)
	);
	$cmb->add_field( array(
			'name'  => __( 'Last name', 'zfcm' ),
			'id'    => "{$prefix}lastname",
			'desc'  => '',
			'type'  => 'text',
	) );
	$cmb->add_field( array(
			'name'  => __( 'First Name', 'zfcm' ),
			'id'    => "{$prefix}firstname",
			'desc'  => '',
			'type'  => 'text',
	) );
	$cmb->add_field( array(
			'name'  => __( 'Phone 1', 'zfcm' ),
			'id'    => "{$prefix}phone1",
			'desc'  => '',
			'type'  => 'text',
	) );
	$cmb->add_field( array(
			'name'  => __( 'Additional info', 'zfcm' ),
			'id'    => "{$prefix}info",
			'desc'  => '',
			'type'  => 'textarea',
	) );
}
