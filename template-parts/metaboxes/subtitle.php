<?php
/**
 * The markup for the Subtitle metabox.
 *
 * @package 		Rosh
 */

wp_nonce_field( $this->theme_name, 'nonce_rosh_subtitle' );

$atts['id'] 			= 'subtitle';
$atts['name'] 			= 'subtitle';

if ( ! empty( $this->meta[$atts['id']][0] ) ) {

	$atts['value'] = $this->meta[$atts['id']][0];

}

$atts = apply_filters( 'rosh-field-' . $atts['id'], $atts );

?><p><?php

include( get_stylesheet_directory() . '/template-parts/fields/text.php' );
unset( $atts );

?></p>
