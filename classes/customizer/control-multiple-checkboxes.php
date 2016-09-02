<?php

if ( ! class_exists( 'WP_Customize_Control' ) ) { return NULL; }

/**
 * Multiple checkbox customize control class.
 *
 * @author  Justin Tadlock
 * @since  1.0.0
 * @access public
 */
class Customize_Control_Checkbox_Multiple extends WP_Customize_Control {

	/**
	 * The type of customize control being rendered.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'checkbox-multiple';

	/**
	 * Enqueue scripts/styles.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue() {

		wp_enqueue_script( 'customize-controls', trailingslashit( get_stylesheet_directory_uri() ) . 'customizer-multi-checkbox.min.js', array( 'jquery' ) );

	} // enqueue()

	/**
	 * Displays the control content.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function render_content() {

		if ( empty( $this->choices ) ) { return false; }

		if ( !empty( $this->label ) ) :
			?><span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span><?php
		endif;

		if ( !empty( $this->description ) ) :
			?><span class="description customize-control-description"><?php echo $this->description; ?></span><?php
		endif;

		if ( is_array( $this->value() ) ) {

			$multi_values = $this->value();

		} else {

			$multi_values = explode( ',', $this->value() );

		}

		?><ul><?php

		foreach ( $this->choices as $value => $label ) :

			?><li>
				<label>
					<input type="checkbox" value="<?php echo esc_attr( $value ); ?>" <?php checked( in_array( $value, $multi_values ) ); ?> /><?php

					echo esc_html( $label );

				?></label>
			</li><?php

		endforeach;

		?></ul>

		<input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr( implode( ',', $multi_values ) ); ?>" /><?php

	} // render_content()

} // class
