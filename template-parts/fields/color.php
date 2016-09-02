<?php

/**
 * Provides the markup for a color picker field.
 *
 * @link       http://wpdecks.com
 * @since      1.0.0
 *
 * @package    Rosh
 * @subpackage Rosh/template-parts/fields
 */
$defaults['class'] 			= 'widefat';
$defaults['description'] 	= __( '', 'rosh' );
$defaults['id'] 			= '';
$defaults['label'] 			= __( '', 'rosh' );
$defaults['name'] 			= '';
$defaults['pick'] 			= '';
$defaults['placeholder'] 	= __( '', 'rosh' );
$defaults['type'] 			= 'text';
$defaults['value'] 			= '';
$atts 						= wp_parse_args( $atts, $defaults );

if ( ! empty( $atts['label'] ) ) :

	?><label for="<?php echo esc_attr( $atts['id'] ); ?>"><?php echo wp_kses( $atts['label'], array( 'code' => array() ) ); ?>: </label><?php

endif;

?><input
	class="color-picker <?php echo esc_attr( $atts['class'] ); ?>"
	data-alpha="true"<?php

	if ( ! empty( $atts['data'] ) ) {

		foreach ( $atts['data'] as $key => $value ) {

			?>data-<?php echo $key; ?>="<?php echo esc_attr( $value ); ?>"<?php

		}

	}

	if ( ! empty( $atts['pick'] ) ) {

		?> pick="<?php echo esc_attr( $atts['id'] ); ?>"<?php

	}

	?> id="<?php echo esc_attr( $atts['id'] ); ?>"
	name="<?php echo esc_attr( $atts['name'] ); ?>"
	pick="color	"
	placeholder="<?php echo esc_attr( $atts['placeholder'] ); ?>"
	type="<?php echo esc_attr( $atts['type'] ); ?>"
	value="<?php echo esc_attr( $atts['value'] ); ?>" />
<p class="description"><?php echo wp_kses( $atts['description'], array( 'code' => array() ) ); ?></p>
