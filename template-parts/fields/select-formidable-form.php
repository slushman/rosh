<?php

/**
 * Provides the markup for a Formidable form select field
 *
 * @package    ADM
 */
$defaults['aria'] 		= __( 'Select a form', 'rosh' );
$defaults['blank'] 		= __( '- Select a form -', 'rosh' );
$defaults['tax_args'] 	= array();
$atts 					= wp_parse_args( $atts, $defaults );
$forms 					= FrmForm::get_published_forms();

foreach ( $forms as $form ) {

	$atts['selections'][] = array( 'value' => $form->form_key, 'label' => $form->name );

}

include( get_stylesheet_directory() . '/template-parts/fields/select.php' );
