<?php

/**
 * Class for creating a form field.
 *
 * Constructors requires:
 * 		The field type.
 * 		An array of attributes.
 * 		An array of properties.
 *
 * TODO: add map field (output displays a Google Map)
 * TODO: add oembed field (output displays the oembed content)
 */
class Rosh_Field {

	/**
	 * The field attributes.
	 * @var 	array
	 */
	protected $atts = '';

	/**
	 * The field properties.
	 * @var 	array
	 */
	protected $props = '';

	/**
	 * The field type.
	 * @var 	string
	 */
	protected $type = '';

	/**
	 * Constructor.
	 * Sets the class variables.
	 *
	 * @param 		string 		$type 		The field type.
	 * @param 		array 		$atts 		The field attributes.
	 * @param 		array 		$props 		The field properties.
	 */
	public function __construct( $type, $atts, $props ) {

		$this->set_type( $type );
		$this->set_attributes( $atts );
		$this->set_properties( $props );

	} // __construct()

	/**
	 * Display the field markup.
	 *
	 * @return 		mixed 		The field markup.
	 */
	public function display_field() {

		if ( empty( $this->props['selections'] ) && ! empty( $this->props['error'] ) ) {

			?><p class="field-error"><?php

				echo esc_html( $this->props['error'] );

			?></p><?php
			return;

		}

		$this->get_wrapper_begin();
		$this->get_label( 'before' );
		$this->get_description( 'before' );
		$this->get_icon();
		$this->preprocess_value();

		$this->output_field();

		$this->get_links();
		$this->get_label( 'after' );
		$this->get_description( 'after' );
		$this->get_wrapper_end();

	} // display_field()

	/**
	 * Returns the default aria text for the chosen select type.
	 *
	 * @param 		string 		$type 		The select type.
	 * @return 		string 					The default aria text.
	 */
	protected function get_default_aria_text() {

		if ( 'select' === $this->props['type'] ) {

			return __( 'Select an option.', 'rosh' );

		}

		$arias['select-formidable-form'] 	= __( 'Select a form.', 'rosh' );
		$arias['select-menu'] 				= __( 'Select a menu.', 'rosh' );
		$arias['select-page'] 				= __( 'Select a page.', 'rosh' );
		$arias['select-slider'] 			= __( 'Select a slider.', 'rosh' );
		$arias['select-taxonomy'] 			= __( 'Select a taxonomy.', 'rosh' );

		return $arias[$this->props['type']];

	} // get_default_aria_text()

	/**
	 * Returns the default field attributes for the field type.
	 * Uses the props->type value to differentiate fields better.
	 *
	 * Not supporting datalist and list due to poor browser support.
	 * Not supporting the form+ attributes since they are just for the submit button.
	 * Not supporting height and width since those are just for the image input type.
	 *
	 * @return 		array 		$defaults 		The default attributes for the field type.
	 */
	protected function get_default_attributes() {

		$default['autocomplete'] = '';
		$default['autofocus'] 	= '';
		$default['checked'] 	= '';
		$default['class'] 		= $this->get_default_class_attribute();
		$default['disabled'] 	= '';
		$default['id'] 			= '';
		$default['max'] 		= '';
		$default['maxlength'] 	= '';
		$default['min'] 		= '';
		$default['multiple'] 	= '';
		$default['name'] 		= '';
		$default['pattern'] 	= '';
		$default['placeholder'] = $this->get_default_placeholder();
		$default['readonly'] 	= '';
		$default['required'] 	= '';
		$default['size'] 		= '';
		$default['step'] 		= '';
		$default['type'] 		= $this->type;
		$default['value'] 		= '';

		/**
		 * Checkboxes have a default value of 1.
		 */
		 if ( 'checkbox' === $this->props['type'] ) {

			$default['value'] = 1;

		}

		if ( 'textarea' === $this->props['type'] ) {

			$default['cols'] = 50;
			$default['rows'] = 10;

		}

		if ( 'color' === $this->props['type'] ) {

			$default['data-alpha'] 	= 'true';
			$default['value'] 		= '#ffffff';

		}

		if ( 'color' === $this->props['type'] || 'date' === $this->props['type'] || 'time' === $this->props['type'] ) {

			$default['data-pick'] = $this->props['type'];

		}

		if ( 'file-upload' === $this->props['type'] ) {

			$default['data-pick'] = 'url-file';

		}

		if ( 'image-upload' === $this->props['type'] ) {

			$default['data-pick'] = 'image-id';

		}

		return $default;

	} // get_default_attributes()

	/**
	 * Returns the default blank text for the chosen select type.
	 *
	 * @return 		string 					The default blank text.
	 */
	protected function get_default_blank_text() {

		if ( 'select' === $this->props['type'] ) {

			return __( '- Select -', 'rosh' );

		}

		$blanks['select-formidable-form'] 	= __( '- Select form -', 'rosh' );
		$blanks['select-menu'] 			= __( '- Select menu -', 'rosh' );
		$blanks['select-page'] 			= __( '- Select page -', 'rosh' );
		$blanks['select-slider'] 			= __( '- Select slider -', 'rosh' );
		$blanks['select-taxonomy'] 		= __( '- Select taxonomy -', 'rosh' );

		return $blanks[$this->props['type']];

	} // get_default_blank_text()

	/**
	 * Returns the default class attribute for the field type.
	 */
	protected function get_default_class_attribute() {

		$classes['checkbox'] 		= 'widefat';
		$classes['color'] 			= 'color-picker';
		$classes['date'] 			= 'field-date';
		$classes['file-upload'] 	= 'widefat';
		$classes['image-upload'] 	= 'widefat';
		$classes['text'] 			= 'widefat';
		$classes['textarea'] 		= 'large-text';
		$classes['time'] 			= 'field-time';
		$classes['url'] 			= 'widefat';

		if ( array_key_exists( $this->props['type'], $classes ) ) {

			$class = $classes[$this->props['type']];

		} elseif ( 'select' === $this->type ) {

			$class = 'widefat';

		} else {

			$class = '';

		}

		return $class;

	} // get_default_class_attribute()

	/**
	 * Returns the default error text for the chosen select type.
	 *
	 * @return 		string 					The default error text.
	 */
	protected function get_default_error_text() {

		if ( 'select' === $this->props['type'] ) {

			return __( 'There was an error with the selections for this field.', 'rosh' );

		}

		$errors['select-formidable-form'] 	= __( 'Please publish a form to use the form select field.', 'rosh' );
		$errors['select-menu'] 				= __( 'Please publish a menu to use the menu select field.', 'rosh' );
		$errors['select-page'] 				= __( 'Please publish a page to use the page select field.', 'rosh' );
		$errors['select-slider'] 			= __( 'Please publish a slider to use the slider select field.', 'rosh' );
		$errors['select-taxonomy'] 			= __( 'Please create a taxonomy to use the taxonomy select field.', 'rosh' );

		return $errors[$this->props['type']];

	} // get_default_error_text()

	/**
	 * Returns the default placeholder text for the field type.
	 */
	protected function get_default_placeholder() {

		$holds['date'] = __( 'Select date', 'rosh' );
		$holds['time'] = __( 'Select time', 'rosh' );

		if ( array_key_exists( $this->type, $holds ) ) {

			$placeholder = $holds[$this->type];

		} else {

			$placeholder = '';

		}

		return $placeholder;

	} // get_default_placeholder()

	/**
	 * Returns the default properties for the field type.
	 */
	protected function get_default_properties() {

		$default 				= array();
		$default['description'] = __( '', 'rosh' );
		$default['error'] 		= __( '', 'rosh' );
		$default['label'] 		= __( '', 'rosh' );
		$default['type']		= $this->props['type'];

		if ( 'editor' === $this->props['type'] ) {

			$default['settings'] = array();

		}

		if ( 'file-upload' === $this->props['type'] ) {

			$default['labels']['remove'] 	= __( 'Remove file', 'rosh' );
			$default['labels']['upload'] 	= __( 'Choose/Upload file', 'rosh' );

		}

		if ( 'image-upload' === $this->props['type'] ) {

			$default['labels']['remove'] 	= __( 'Remove image', 'rosh' );
			$default['labels']['upload'] 	= __( 'Choose/Upload image', 'rosh' );

		}

		if ( 'radio' === $this->props['type'] ) {

			$default['class-fieldset'] 	= '';
			$default['class-input'] 	= '';
			$default['class-label'] 	= '';
			$default['selections'] 		= array();
			$default['wrap-tag'] 		= '';

		}

		if ( 'select' === $this->type ) {

			$default['aria'] 		= $this->get_default_aria_text();
			$default['blank'] 		= $this->get_default_blank_text();
			$default['error'] 		= $this->get_default_error_text();
			$default['selections'] 	= array();

		}

		return $default;

	} // get_default_properties()

	/**
	 * Displays the field description.
	 *
	 * @exits 		If the location is empty.
	 * @exits 		If $this->props is empty or not an array.
	 * @exits 		If the description is empty.
	 * @return 		mixed 					The field description markup.
	 */
	protected function get_description( $location ) {

		if ( empty( $location ) || ! is_string( $location ) ) { return; }
		if ( empty( $this->props ) || ! is_array( $this->props ) ) { return; }
		if ( empty( $this->props['description'] ) ) { return; }

		if ( 'before' === $location && 'radio' === $this->type ) {

			?><legend class="description"><?php

				echo wp_kses( $this->props['description'], array( 'code' => array() ) );

			?></legend><?php

		}

		if ( 'before' === $location || 'radio' === $this->props['type'] ) { return; }

		if ( 'file-upload' === $this->props['type'] || 'image-upload' === $this->props['type'] ) {

			$class = 'float-right';

		}

		?><span class="description <?php echo esc_attr( $class ); ?>"><?php

			echo wp_kses( $this->props['description'], array( 'code' => array() ) );

		?></span><?php

	} // get_description()

	/**
	 * Displays the field label.
	 *
	 * @exits 		If $atts is empty or not an array.
	 * @exits 		If $this->props is empty or not an array.
	 * @exits 		If the id attribute is empty.
	 * @exits 		If the label is empty.
	 * @return 		mixed 					The field label markup.
	 */
	protected function get_field_label() {

		if ( empty( $this->atts ) || ! is_array( $this->atts ) ) { return; }
		if ( empty( $this->props ) || ! is_array( $this->props ) ) { return; }
		if ( empty( $this->atts['id'] ) ) { return; }
		if ( empty( $this->props['label'] ) ) { return; }

		?><label for="<?php echo esc_attr( $this->atts['id'] ); ?>">
			<span class="label"><?php

				echo wp_kses( $this->props['label'], array( 'code' => array() ) );

			?></span>
		</label><?php

	} // get_field_label()

	/**
	 * Returns the icons for the date and time picker fields.
	 *
	 * @exits 		If the field not date, time, or image-upload.
	 * @return 		mixed 		The icon markup.
	 */
	protected function get_icon() {

		if ( 'date' !== $this->props['type'] && 'time' !== $this->props['type'] && 'image-upload' !== $this->props['type'] ) { return; }

		if ( 'date' === $this->props['type'] ) {

			?><span class="dashicons dashicons-calendar-alt date-field-icon"></span><?php

		} elseif ( 'time' === $this->props['type'] ) {

			?><span class="dashicons dashicons-clock time-field-icon"></span><?php

		} elseif ( 'image-upload' === $this->props['type'] ) {

			$preview_class 	= ( empty( $this->atts['value'] ) ? 'image-upload-preview bordered-img-preview' : 'image-upload-preview' );
			$thumbnail 		= ( empty( $this->atts['value'] ) ? '' : wp_get_attachment_image_src( $this->atts['value'] )[0] );

			?><div class="<?php echo esc_attr( $preview_class ); ?>" id="<?php echo esc_attr( $atts['id'] . '-img' ); ?>" style="background-image:url(<?php echo esc_url( $thumbnail ); ?>);"></div><?php

		}

	} // get_icon()

	/**
	 * Determines where field labels appear.
	 *
	 * NOTE: not checking $this->props since its not used in this function.
	 * 			$this->props is checked in get_field_label();
	 *
	 * @exits 		If $location is empty or not a string.
	 * @exits 		If location is before and field is checkbox.
	 * @param 		string 		$location 		Where this label may appear.
	 * @return 		mixed 						The field label markup.
	 */
	protected function get_label( $location ) {

		if ( empty( $location ) || ! is_string( $location ) ) { return; }
		if ( 'before' === $location && 'checkbox' === $this->props['type'] ) { return; }

		if ( 'after' === $location && 'checkbox' === $this->props['type'] ) {

			return $this->get_field_label();

		}

		if ( 'before' !== $location ) { return; }
		if ( 'checkbox' === $this->props['type'] || 'hidden' === $this->props['type'] || 'radio' === $this->props['type'] ) { return; }

		return $this->get_field_label();

	} // get_label()

	/**
	 * Returns the links for image and file uploader fields.
	 *
	 * @exits 		If not a file or image uploader field.
	 * @return 		mixed 		The links markup.
	 */
	protected function get_links() {

		if ( 'file-upload' !== $this->props['type'] && 'image-upload' !== $this->props['type'] ) { return; }

		$remove_class = ( empty( $atts['value'] ) ? 'hide' : '' );
		$upload_class = ( empty( $atts['value'] ) ? '' : 'hide' );

		if ( 'file-upload' === $this->props['type'] ) {

			$upload_class .= 'upload-file';
			$remove_class .= 'remove-file';

		} elseif ( 'image-upload' === $this->props['type'] ) {

			$upload_class .= 'upload-img';
			$remove_class .= 'remove-img';

		}

		?><a href="#" class="<?php echo esc_attr( $upload_class ); ?>"><?php
			echo wp_kses( $this->props['labels']['upload'], array( 'code' => array() ) );
		?></a>
		<a href="#" class="<?php echo esc_attr( $remove_class ); ?>"><?php
			echo wp_kses( $this->props['labels']['remove'], array( 'code' => array() ) );
		?></a><?php

	} // get_links()

	/**
	 * Returns the beginning wrapper markup for file-upload, image-upload
	 * and radios fields.
	 *
	 * @exits 		If not a file-upload, image-upload, or set of radios.
	 * @return 		mixed 		The appropriate wrapper beginning markup.
	 */
	protected function get_wrapper_begin() {

		if ( 'file-upload' === $this->props['type'] ) {

			?><div class="file-upload-field wrap-field"><?php

		} elseif ( 'image-upload' === $this->props['type'] ) {

			?><div class="image-upload-field wrap-field"><?php

		} elseif ( 'radio' === $this->props['type'] ) {

			?><fieldset class="wrap-radios wrap-field <?php echo esc_attr( $this->props['class-fieldset'] ); ?>" role="radiogroup" ><?php

		} elseif ( ! empty( $this->props['wrap-tag'] ) && 'radio' === $this->props['type'] ) {

			?><<?php echo esc_attr( $this->props['wrap-tag'] ); ?> class="wrap-field"><?php

		} else {

			?><p class="wrap-field"><?php

		}

	} // get_wrapper_begin()

	/**
	 * Returns the ending wrapper markup for file-upload, image-upload
	 * and radios fields.
	 *
	 * @exits 		If not a file-upload, image-upload, or set of radios.
	 * @return 		mixed 		The appropriate wrapper ending markup.
	 */
	protected function get_wrapper_end() {

		if ( 'file-upload' === $this->props['type'] ) {

			?></div><!-- .file-upload-field --><?php

		} elseif ( 'image-upload' === $this->props['type'] ) {

			?></div><!-- .image-upload-field --><?php

		} elseif ( 'radio' === $this->props['type'] ) {

			?></fieldset><!-- .radios --><?php

		} elseif ( ! empty( $this->props['wrap-tag'] ) && 'radio' === $this->props['type'] ) {

			?></<?php echo esc_attr( $this->props['wrap-tag'] ); ?>><!-- .wrap-field --><?php

		} else {

			?></p><!-- .wrap-field --><?php

		}

	} // get_wrapper_end()

	/**
	 * Output the markup of each field type.
	 *
	 * @return 		mixed 		The field markup.
	 */
	protected function output_field() {

		if ( 'checkbox' === $this->type ) {

			?><input <?php
				checked( 1, $this->atts['value'], true );
				echo $this->print_attributes( $this->atts );
			?> /><?php

		} elseif ( 'editor' === $this->type ) {

			wp_editor( $this->atts['value'], $this->atts['id'], $this->props['settings'] );

		} elseif ( 'radio' === $this->type ) {

			foreach ( $this->props['selections'] as $selection ) {

				$this->output_selection( $selection );

			}

		} elseif ( 'select' === $this->type ) {

			?><select <?php echo $this->print_attributes(); ?>><?php

			foreach ( $this->props['selections'] as $selection ) {

				$this->output_selection( $selection );

			} // foreach

			?></select><?php

		} elseif ( 'textarea' === $this->type ) {

			?><textarea <?php echo $this->print_attributes(); ?>><?php

				echo esc_textarea( $this->atts['value'] );

			?></textarea><?php

		} else {

			?><input <?php echo $this->print_attributes(); ?> /><?php

		}

	} // output_field()

	/**
	 * Returns the individual selections for selects and radios.
	 *
	 * @exits 		If the selection is empty.
	 * @param 		string|array 		$selection 		The selection.
	 * @return 		mixed 								The selection markup.
	 */
	protected function output_selection( $selection, $count = '' ) {

		if ( empty( $selection ) ) { return; }

		$label = ( is_array( $selection ) ? $selection['label'] : $selection );
		$value = ( is_array( $selection ) ? $selection['value'] : sanitize_title( $selection ) );

		if ( 'radio' === $this->type ) {

			?><label class="<?php echo esc_attr( $this->props['class-label'] ); ?>" for="<?php echo esc_attr( $value ); ?>">
				<input <?php
					checked( $value, $this->atts['value'], true );
					echo $this->print_attributes();
				?> />
				<span class=""><?php

					echo wp_kses( $label, array( 'code' => array() ) );

				?></span>
			</label><?php

		} elseif ( 'select' === $this->type ) {

			?><option
				value="<?php echo esc_attr( $value ); ?>" <?php
				selected( $this->atts['value'], $value ); ?>><?php

				echo wp_kses( $label, array( 'code' => array() ) );

			?></option><?php

		}

	} // output_selection()

	/**
	 * Sets the value attribute for particular fields.
	 *
	 * @exits 		If not a date or repeater field.
	 */
	protected function preprocess_value() {

		if ( 'date' !== $this->type ) { return; }

		$this->atts['value'] = strtotime( $this->atts['value'] );

	} // preprocess_value()

	/**
	 * Converts the attributes array into a string.
	 * Used for printing the attributes in markup.
	 *
	 * @exits 		If the attributes are empty or not an array.
	 * @return 		string 		A space-separated string of the field attributes.
	 */
	protected function print_attributes() {

		//echo '<pre>'; print_r( $this->atts ); echo '</pre>';

		if ( empty( $this->atts ) || ! is_array( $this->atts ) ) { return ''; }

		$return = implode( ' ',
			array_map(
				function( $key, $value ){ return $key . '="' . esc_attr( $value ) . '"'; },
				array_keys( $this->atts ),
				array_values( $this->atts )
			)
		);

		return $return;

	} // print_attributes()

	/**
	 * Sets the field attributes class variable.
	 *
	 * Gets the defaults for the field type, combines them
	 * with the $atts, then removes non-standard attributes and
	 * empty attributes, other than value.
	 *
	 * @param 		array 		$atts 		Array of attributes.
	 */
	protected function set_attributes( $atts ) {

		$defaults 	= $this->get_default_attributes();

		//echo '<pre>'; print_r( $defaults ); echo '</pre>';

		$this->atts = wp_parse_args( $atts, $defaults );

		//echo '<pre>'; print_r( $this->atts ); echo '</pre>';

		foreach ( $this->atts as $key => $att ) {

			if ( FALSE !== stripos( $key, 'data-' ) ) { continue; }
			if ( 'value' === $key ) { continue; }

			if ( ! array_key_exists( $key, $defaults ) ) { unset( $this->atts[$key] ); }

			if ( empty( $att ) ) { unset( $this->atts[$key] ); }

		}

		//echo '<pre>'; print_r( $this->atts ); echo '</pre>';

	} // set_attributes()

	/**
	 * Sets the field properties class variable.
	 *
	 * Gets the defaults for the field type, combines them
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

			if ( empty( $prop ) && 'type' !== $key ) { unset( $this->props[$key] ); }

		}

		if ( 'select' !== $this->props['type'] && 'select' === $this->type && empty( $this->props['selections'] ) ) {

			$this->set_selections();

		}

		if ( 'select' === $this->type && ! empty( $this->props['selections'] ) ) {

			$blank = array( 'label' => $this->props['blank'], 'value' => '' );

			array_unshift( $this->props['selections'], $blank );

		}

	} // set_properties()

	/**
	 * Sets the field selections.
	 */
	protected function set_selections() {

		if ( empty( $this->props['query'] ) ) {

			$this->props['query']['orderby'] = 'title';

		}

		if ( 'select-formidable-form' === $this->props['type'] ) {

			if ( ! function_exists( 'FrmForm::get_published_forms' ) ) { return; }

			$forms 		= FrmForm::get_published_forms();
			$selections = array_map( function( $forms ){ return array( 'value' => $form->form_key, 'label' => $form->name ); }, $forms );

		} elseif ( 'select-menu' === $this->props['type'] ) {

			$menus 		= get_terms( $this->props['query'] );
			$selections = array_map( function( $menu ){ return array( 'value' => $menu->slug, 'label' => $menu->name ); }, $menus );

		} elseif ( 'select-page' === $this->props['type'] ) {

			$pages 		= get_pages( $this->props['query'] );
			$selections = array_map( function( $page ){ return array( 'value' => $page->ID, 'label' => $page->post_title ); }, $pages );

		} elseif ( 'select-slider' === $this->props['type'] ) {

			$sliders 	= rosh_get_posts( 'soliloquy', $this->props['query'], 'select-slider' );

			if ( empty( $sliders->posts ) ) { return; }

			$selections = array_map( function( $slider ){ return array( 'value' => $slider->ID, 'label' => $slider->post_title ); }, $sliders->posts );

		} elseif ( 'select-taxonomy' === $this->props['type'] ) {

			$taxes 		= get_taxonomies( $this->props['query'], 'objects' );
			$selections = array_map( function( $tax ){ return array( 'value' => $tax->name, 'label' => $tax->label ); }, $taxes );

		}

		if ( ! empty( $selections ) ) {

			$this->props['selections'] = $selections;

		}

	} // set_selections()

	/**
	 * Sets the actual field type based on the requested field type.
	 *
	 * For field types that must be replaced, the requested field type is assigned
	 * to the type field property.
	 */
	protected function set_type( $type ) {

		$types['color'] 					= 'text';
		$types['date'] 						= 'text';
		$types['file-upload'] 				= 'url';
		$types['image-upload'] 				= 'hidden';
		$types['select-formidable-form'] 	= 'select';
		$types['select-menu'] 				= 'select';
		$types['select-page'] 				= 'select';
		$types['select-slider'] 			= 'select';
		$types['select-taxonomy'] 			= 'select';
		$types['time'] 						= 'text';
		$this->props['type'] 				= $type;

		if ( array_key_exists( $type, $types ) ) {

			$this->type = $types[$type];

		} else {

			$this->type = $type;

		}

	} // set_type()

} // class
