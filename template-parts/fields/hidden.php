<?php

/**
 * Provides the markup for any hidden field.
 *
 * @package    Rosh
 */
$defaults['name'] 			= '';
$defaults['value'] 			= '';
$atts 						= wp_parse_args( $atts, $defaults );

?><input<?php

	if ( ! empty( $atts['data'] ) ) {

		foreach ( $atts['data'] as $key => $value ) {

			?>data-<?php echo $key; ?>="<?php echo esc_attr( $value ); ?>"<?php

		}

	}

	?>name="<?php echo esc_attr( $atts['name'] ); ?>"
	type="hidden"
	value="<?php echo esc_attr( $atts['value'] ); ?>" /><?php
