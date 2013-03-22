<?php
/**
 * Filter the_content 
 * 
 * @param  [type] $content [description]
 * @return [type]
 */
function h1cm_entry_content( $content ) {
	if ( H1CM_LABEL != get_post_type() ) return $content;

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

    $content .= '<div class="h1cm-contact">';

    if ( has_post_thumbnail( $post->ID ) ) {
    	$content .= '<div class="h1cm-contact-photo">';
    	$content .= get_the_post_thumbnail( $post->ID, 'thumbnail' );
    	$content .= '</div>';
    }

    $content .= '<div class="h1cm-contact-info">';
    $content .= '<ul class="h1cm-contact-info-list">';
    if ( defined('ICL_LANGUAGE_CODE') && ICL_LANGUAGE_CODE == 'en' ) :
    $content .= h1cm_meta_field( 'title_en', &$custom_fields );
    else :
    $content .= h1cm_meta_field( 'title', &$custom_fields );
    endif;
    $content .= h1cm_meta_field( 'phone1', &$custom_fields );
    $content .= h1cm_meta_field( 'phone2', &$custom_fields );
    $content .= h1cm_meta_field( 'email', &$custom_fields );
    $content .= h1cm_meta_field( 'info', &$custom_fields );
    $content .= '</ul>';
    $content .= '</div>';

    $content .= '</div><!-- .h1cm-contact -->';

	return $content;
}
/**
 * Helper function for getting a single meta value
 * 
 * @param  string $key Meta key without prefix
 * @param  &array $custom_fields
 * @return string $html
 */
function h1cm_meta_field( $key, &$custom_fields ) {

	$html = '';

	if ( isset( $custom_fields[ H1CM_PREFIX . $key ][ 0 ] ) ) {
	    $html = '<li>' . $custom_fields[ H1CM_PREFIX . $key ][ 0 ] . '</li> ' ;
	}

	return $html;
}