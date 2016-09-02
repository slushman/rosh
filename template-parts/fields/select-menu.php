<?php

/**
 * Provides the markup for a menu select field
 *
 * @package    Rosh
 */
$defaults['aria'] 			= __( 'Select a menu', 'rosh' );
$defaults['blank'] 			= __( '- Select a menu -', 'rosh' );
$defaults['menu_args'] 		= array( 'taxonomy' => 'nav_menu', 'hide_empty' => true );
$atts 						= wp_parse_args( $atts, $defaults );
$menus 						= get_terms( $atts['menu_args'] );

if ( empty( $menus ) ) {

	?><p class="field-error"><?php
		esc_html_e( 'Please publish a menu to use the menu select field.', 'rosh' );
	?></p><?php

	return;

}

foreach ( $menus as $menu ) {

	$atts['selections'][] = array( 'value' => $menu->slug, 'label' => $menu->name );

}

include( get_stylesheet_directory() . '/template-parts/fields/select.php' );
