<?php
/**
 * Filter the_content
 *
 * @param  [type] $content [description]
 * @return [type]
 */
function zfcm_entry_content( $content ) {
	if ( ZFCM_LABEL !== get_post_type() ) {
		return $content;
	}

	global $post;

	/**
	 * Reset content
	 * @var string
	 */
	$content = '';

	/**
	 * Store all custom fields in an array
	 * @var array
	 */
	$custom_fields = get_post_custom();

	$content .= '<div class="zfcm-contact">';

	if ( has_post_thumbnail( $post->ID ) && ! function_exists( 'genesis' ) ) {
		$content .= '<div class="zfcm-contact-photo">';
		$content .= get_the_post_thumbnail( $post->ID, 'thumbnail' );
		$content .= '</div>';
	}

	$content .= '<div class="zfcm-contact-info">';
	$content .= '<ul class="zfcm-contact-info-list">';
	$content .= zfcm_meta_field( 'title', $custom_fields );
	$content .= zfcm_meta_field( 'phone1', $custom_fields );
	$content .= zfcm_meta_field( 'phone2', $custom_fields );
	$content .= zfcm_meta_field( 'email', $custom_fields );
	$content .= zfcm_meta_field( 'info', $custom_fields );
	$content .= implode( ', ', zfcm_get_contact_taxonomies( $post->ID, 'title' ) );
	$content .= implode( ', ', zfcm_get_contact_taxonomies( $post->ID, 'location' ) );
	$content .= implode( ', ', zfcm_get_contact_taxonomies( $post->ID, 'contact-group' ) );
	$content .= '</ul>';
	$content .= '</div>';

	$content .= '</div><!-- .zfcm-contact -->';

	return $content;
}
/**
 * Helper function for getting a single meta value
 *
 * @param  string $key Meta key without prefix
 * @param  &array $custom_fields
 * @return string $html
 */
function zfcm_meta_field( $key, &$custom_fields ) {

	$html = '';

	if ( isset( $custom_fields[ ZFCM_PREFIX . $key ][0] ) ) {
	    $html = '<li>' . $custom_fields[ ZFCM_PREFIX . $key ][0] . '</li> ' ;
	}

	return $html;
}
// Function to get the taxonomies for the contact-info part
function zfcm_get_contact_taxonomies( $post_id, $slug ) {
	$contact_titles = wp_get_post_terms( $post_id, $slug, array( 'fields' => 'ids' ) );
	$contact_titles_translated = array();
	foreach ( $contact_titles as $key ) {

		if ( function_exists( 'pll_get_term' ) ) {
			if ( pll_get_term( $key ) ) {
				$term = get_term( pll_get_term( $key ) );
			} else {
				$term = get_term( pll_get_term( $key, 'fi' ) );
			}
		} else {
			$term = get_term( $key );
		}
		$contact_titles_translated[ $key ] = $term->name;
	}
	return $contact_titles_translated;
}
