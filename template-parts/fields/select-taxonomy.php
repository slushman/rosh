<?php

/**
 * Provides the markup for a taxonomy select field
 *
 * @package    Rosh
 */
$defaults['aria'] 		= __( 'Select a taxonomy', 'rosh' );
$defaults['blank'] 		= __( '- Select a taxonomy -', 'rosh' );
$defaults['tax_args'] 	= array();
$atts 					= wp_parse_args( $atts, $defaults );
$taxes 					= get_taxonomies( $atts['tax_args'], 'objects' );

foreach ( $taxes as $tax ) {

	$atts['selections'][] = array( 'value' => $tax->name, 'label' => $tax->label );

}

include( get_stylesheet_directory() . '/template-parts/fields/select.php' );
