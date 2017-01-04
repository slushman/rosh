<?php
/**
 * The markup for the Subtitle metabox.
 *
 * @package 		Rosh
 */

wp_nonce_field( PARENT_THEME_SLUG, 'nonce_rosh_subtitle' );

$atts['id'] 			= 'subtitle';
$atts['name'] 			= 'subtitle';

if ( ! empty( $this->meta[$atts['id']][0] ) ) {

	$atts['value'] = $this->meta[$atts['id']][0];

}

$atts 	= apply_filters( 'rosh-field-atts-' . $atts['id'], $atts, $props );
$props 	= apply_filters( 'rosh-field-props-' . $atts['id'], $props, $atts );
$field 	= new Rosh_Field( 'text', $atts, $props );
$field->display_field();

unset( $atts );
unset( $props );
unset( $field );
