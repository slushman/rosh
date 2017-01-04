<?php

/**
 * Class for creating groups of form fields.
 *
 * Constructor requires:
 * 		Group type.
 * 		An array of group attributes.
 * 		An array of group properties.
 * 		An array of the fields within the group.
 *
 * TODO: Get datepickers, colorpickers, timepickers, and editors to work properly.
 * TODO: figure out checkbox groups.
 */
class Rosh_Field_Group {

	/**
	 * The group attributes.
	 * @var 	array
	 */
	protected $atts = '';

	/**
	 * The group properties.
	 * @var 	array
	 */
	protected $props = '';

	/**
	 * The total quantity of repeaters.
	 * @var 	integer
	 */
	protected $total = 0;

	/**
	 * The group type.
	 * @var 	string
	 */
	protected $type = '';

	/**
	 * Constructor. Sets the class variables.
	 *
	 * @param 		string 		$type 		The group type.
	 * @param 		array 		$atts 		The group attributes.
	 * @param 		array 		$props 		The group properties.
	 * @param 		array 		$fields 	The group fields.
	 */
	public function __construct( $type, $atts, $props, $fields ) {

		$this->set_type( $type );
		$this->set_attributes( $atts );
		$this->set_properties( $props );
		$this->set_fields( $fields );

		// echo '<pre>this->atts: '; print_r( $this->atts ); echo '</pre>';
		// echo '<pre>this->props: '; print_r( $this->props ); echo '</pre>';

	} // __construct()

	/**
	 * Display the group markup.
	 *
	 * @return 		mixed 		The group markup.
	 */
	public function display_group() {

		?><ul class="repeaters"><?php

			$this->set_total();
			$this->output_all_repeaters();
			$this->output_single_repeater( 'hidden' );
			$this->get_add_more_button();

		?></ul><!-- .repeaters --><?php

	} // display_group()

	/**
	 * Returns the default properties for the field type.
	 */
	protected function get_default_properties() {

		$default 						= array();
		$default['description'] 		= __( '', 'rosh' );
		$default['labels']['add'] 		= __( 'Add Field', 'rosh' );
		$default['labels']['edit'] 		= __( 'Edit Field', 'rosh' );
		$default['labels']['header'] 	= __( 'Field Name', 'rosh' );
		$default['labels']['remove'] 	= __( 'Remove Field', 'rosh' );

		return $default;

	} // get_default_properties()

	/**
	 * Returns the add more button.
	 *
	 * @return 		mixed 		The button markup.
	 */
	protected function get_add_more_button() {

		?><div class="repeater-more">
			<span class="repeater-description"><?php

				if ( ! empty( $this->props['description'] ) ) {

					echo esc_html( $this->props['description'] );

				}

			?></span>
			<a class="button add-repeater" href="#" id="add-repeater"><?php

				echo esc_html( apply_filters( PARENT_THEME_SLUG . '-repeater-more-link-label', $this->props['labels']['add'] ) );

			?></a>
		</div><!-- .repeater-more --><?php

	} // get_add_more_button()

	/**
	 * Returns the repeater title.
	 *
	 * @param 		string 		$uid 		The unique ID.
	 * @return 		string 					The repeater title.
	 */
	protected function get_repeater_title( $uid ) {

		if ( 'hidden' === $uid ) {

			$title = $this->props['labels']['header'];

		} else {

			$title = $this->atts['value'][$uid]['_repeater_title'];

		}

		return $title;

	} // get_repeater_title()

	/**
	 * Loops through all the repeaters and inserts a hidden repeater afterwards.
	 *
	 * @return 		mixed 		The group markup.
	 */
	protected function output_all_repeaters() {

		if ( empty( $this->atts['value'] ) ) { return; }

		foreach ( $this->atts['value'] as $values ) {

			$this->output_single_repeater( $values );

		}

	} // output_all_repeaters()

	/**
	 * Displays a single repeater and loops through each field.
	 *
	 * @param 		string|array 		$values 		The value(s) for the repeated item.
	 * @return 		mixed 								The repeated item markup.
	 */
	protected function output_single_repeater( $values ) {

		if ( is_array( $values ) ) {

			$uid = $values['_repeater_uid'];

		} else {

			$this->atts['class'] 	.= ' hidden hidden-repeater';
			$uid 					= 'hidden';

		}

		$title = $this->get_repeater_title( $uid );

		?><li class="<?php echo esc_attr( $this->atts['class'] ); ?>" id="<?php echo esc_attr( $this->atts['name'] . '[' . $uid . ']' ); ?>">
			<div class="repeater-handle">
				<span class="title-repeater"><?php

					echo esc_html( $title );

				?></span>
				<button aria-expanded="true" class="btn-edit repeater-edit-btn" type="button">
					<span class="screen-reader-text"><?php

						echo esc_html( $this->props['labels']['edit'], 'rosh' );

					?></span>
					<span class="repeater-toggle-arrow-open"></span>
				</button>
			</div><!-- .repeater-handle -->
			<div class="repeater-content">
				<div class="wrap-fields"><?php

					foreach ( $this->fields as $field ) {

						$this->output_field( $field, $uid, $values );

					} // foreach

					$this->output_hidden_repeater_title_field( $uid, $values );
					$this->output_hidden_repeater_uid_field( $uid, $values );

				?></div>
				<div>
					<a class="remove-repeater" href="#"><?php

						echo esc_html( apply_filters( PARENT_THEME_SLUG . '_repeater_remove_link_label', $this->props['labels']['remove'] ), 'rosh' );

					?></a>
				</div>
			</div>
		</li><!-- .repeater --><?php

	} // output_single_repeater()

	/**
	 * Returns an individual field.
	 *
	 * @exits 		If the field is empty.
	 * @param 		array 				$field 			The field.
	 * @param 		string 				$uid 			The unique ID.
	 * @param 		string|array 		$values 		The value(s) for the repeated item.
	 * @return 		mixed 								The field markup.
	 */
	protected function output_field( $field, $uid, $values ) {

		if ( empty( $field ) ) { return FALSE; }

		$atts 					= $field['atts'];
		$props 					= $field['props'];
		$type 					= $field['atts']['type'];
		$name 					= $field['atts']['name'];
		$atts['data-name'] 		= $field['atts']['name'];
		$atts['id'] 			= $this->atts['name'] . '[' . $uid . '][' . $atts['name'] . ']';
		$atts['name'] 			= $this->atts['name'] . '[' . $uid . '][' . $atts['name'] . ']';

		/**
		 * Unset type to allow for defaults in fields to work properly.
		 */
		unset( $atts['type'] );

		if ( 'hidden' === $values ) {

			$atts['disabled'] 	= 'disabled';

		}

		if ( ! empty( $this->atts['value'] ) ) {
		/*if ( empty( $this->atts['value'] ) ) {

			$atts['value'] = '';

		} else {
*/
			$atts['value'] = $this->atts['value'][$uid][$name];

		}

		/*?><p class="wrap-field"><?php*/

			//echo '<pre>'; print_r( $atts ); echo '</pre>';

			$new_field = new Rosh_Field( $type, $atts, $props );
			$new_field->display_field();

		/*?></p><?php*/

	} // output_field()

	/**
	 * Displays the hidden repeater title field.
	 *
	 * @param 		string 				$uid 			The unique ID.
	 * @param 		string|array 		$values 		The value(s) for the repeated item.
	 * @return		mixed 								The hidden field markup.
	 */
	protected function output_hidden_repeater_title_field( $uid, $values ) {

		if ( 'hidden' === $values ) {

			$atts['disabled'] 	= 'disabled';

		}

		$atts['id'] 			= '_repeater_title';
		$atts['name'] 			= $this->atts['name'] . '[' . $uid . '][_repeater_title]';
		$atts['value'] 			= $this->get_repeater_title( $uid );
		$field 					= new Rosh_Field( 'hidden', $atts, array() );
		$field->display_field();

	} // output_hidden_repeater_title_field()

	/**
	 * Displays the hidden repeater UID field.
	 *
	 * @param 		string 				$uid 			The unique ID.
	 * @param 		string|array 		$values 		The value(s) for the repeated item.
	 * @return		mixed 								The hidden field markup.
	 */
	protected function output_hidden_repeater_uid_field( $uid, $values ) {

		if ( 'hidden' === $values ) {

			$atts['disabled'] 	= 'disabled';

		}

		$atts['id'] 			= '_repeater_uid';
		$atts['name'] 			= $this->atts['name'] . '[' . $uid . '][_repeater_uid]';
		$atts['value'] 			= $uid;
		$field 					= new Rosh_Field( 'hidden', $atts, array() );
		$field->display_field();

	} // output_hidden_repeater_uid_field()

	/**
	 * Sets the group attributes class variable.
	 *
	 * Gets the defaults for the group, combines them
	 * with the $atts, then removes non-standard attributes and
	 * empty attributes, other than value.
	 *
	 * @param 		array 		$atts 		Array of attributes.
	 */
	protected function set_attributes( $atts ) {

		$defaults 	= array( 'class' => 'repeater', 'id' => '', 'name' => '', 'value' => '' );
		$this->atts = wp_parse_args( $atts, $defaults );

		foreach ( $this->atts as $key => $att ) {

			if ( ! array_key_exists( $key, $defaults ) ) { unset( $this->atts[$key] ); }

			if ( empty( $att ) && 'value' !== $key ) { unset( $this->atts[$key] ); }

		}

		$this->atts['value'] = maybe_unserialize( $this->atts['value'] );

	} // set_attributes()

	/**
	 * Sets the $fields class variable.
	 *
	 * @param 		array 		$fields 		The field data for this repeater.
	 */
	protected function set_fields( $fields ) {

		$this->fields = $fields;

	} // set_fields()

	/**
	 * Sets the group properties class variable.
	 *
	 * Gets the defaults for the group, combines them
	 * with the $props, then filters them to remove non-standard
	 * properties.
	 *
	 * @param 		array 		$props 		Array of properties.
	 */
	protected function set_properties( $props ) {

		$defaults 		= $this->get_default_properties();
		$this->props 	= wp_parse_args( $props, $defaults );

		foreach ( $this->props as $key => $prop ) {

			if ( ! array_key_exists( $key, $defaults ) ) { unset( $this->props[$key] ); }

			if ( empty( $prop ) ) { unset( $this->props[$key] ); }

		}

	} // set_properties()

	/**
	 * Sets the $total class variables.
	 *
	 * NOTE: If value is empty, count() returns 0.
	 */
	protected function set_total() {

		$this->total = count( $this->atts['value'] );

	} // set_total()

	/**
	 * Sets the group type.
	 */
	protected function set_type( $type ) {

		$this->type = $type;

	} // set_type()

} // class
