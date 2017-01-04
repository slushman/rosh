<?php
/**
 * The markup for the Repeater metabox.
 *
 * @package 		Rosh
 */

wp_nonce_field( PARENT_THEME_SLUG, 'nonce_rosh_simple_repeater' );

$atts['name'] 							= 'simple-repeater';
$fields[0]['atts']['class'] 			= 'widefat repeater-title';
$fields[0]['atts']['type'] 				= 'text';
$fields[0]['atts']['id'] 				= 'simple-peat-text';
$fields[0]['atts']['name'] 				= 'simple-peat-text';
$fields[0]['props']['description'] 		= __( 'Text Field Description', 'rosh' );
$fields[0]['props']['label'] 			= __( 'Text Field', 'rosh' );
$props['description'] 					= __( 'This repeating field is used for displaying blah blah. The Text Field above is also the name of the field.', 'rosh' );

if ( empty( $this->meta[$atts['name']] ) ) {

	$atts['value'] = array();

} else {

	$atts['value'] = $this->meta[$atts['name']][0];

}

$atts 	= apply_filters( 'rosh-field-atts-' . $atts['name'], $atts, $props );
$props 	= apply_filters( 'rosh-field-props-' . $atts['name'], $props, $atts );
$group 	= new Rosh_Field_Group( 'repeater', $atts, $props, $fields );
$group->display_group();

unset( $atts );
unset( $props );
unset( $fields );
unset( $group );
