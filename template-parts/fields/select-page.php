<?php

/**
 * Provides the markup for a page select field
 *
 * @package    Rosh
 */
$defaults['aria'] 			= __( 'Select a page', 'rosh' );
$defaults['blank'] 			= __( '- Select a page -', 'rosh' );
$defaults['pages_args'] 	= array();
$atts 						= wp_parse_args( $atts, $defaults );
$pages 						= get_pages( $atts['pages_args'] );

if ( empty( $pages ) ) {

	?><p class="field-error"><?php
		esc_html_e( 'Please publish a page to use the page select field.', 'rosh' );
	?></p><?php

	return;

}

foreach ( $pages as $page ) {

	$atts['selections'][] = array( 'value' => $page->ID, 'label' => $page->post_title );

}

include( get_stylesheet_directory() . '/template-parts/fields/select.php' );
