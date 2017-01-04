<?php
/**
 * The metabox-specific functionality of the theme.
 *
 * @since 			1.0.0
 * @package 		Rosh
 * @subpackage 		Rosh/classes
 */
class Rosh_Metabox_Demo {

	/**
	 * The metabox class object.
	 * @var 	obj.
	 */
	protected $metabox;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 		1.0.0
	 */
	public function __construct() {

		$fields[] 			= array( 'field-checkbox', 'checkbox', '' );
		$fields[] 			= array( 'field-color', 'color', '' );
		$fields[] 			= array( 'field-date', 'date', '' );
		$fields[] 			= array( 'field-editor', 'editor', '' );
		$fields[] 			= array( 'field-file', 'url', '' );
		$fields[] 			= array( 'field-image', 'hidden', '' );
		$fields[] 			= array( 'field-menu', 'select', '' );
		$fields[] 			= array( 'field-page', 'select', '' );
		$fields[] 			= array( 'field-taxonomy', 'select', '' );
		$fields[] 			= array( 'field-radios', 'radio', '' );
		$fields[] 			= array( 'field-select', 'select', '' );
		$fields[] 			= array( 'field-text', 'text', '' );
		$fields[] 			= array( 'field-textarea', 'textarea', '' );
		$fields[] 			= array( 'field-time', 'time', '' );
		$nonce 				= 'nonce_rosh_demo';
		$props['name'] 		= __( 'Demo', 'rosh' );
		$props['id'] 		= 'demo';

		$this->metabox 		= new Rosh_Metabox( $props, $nonce, $fields );

	} // __construct()

	/**
	 * Registers all the WordPress hooks and filters for this class.
	 */
	public function hooks() {

		add_action( 'add_meta_boxes', 			array( $this->metabox, 'add_metaboxes' ), 10, 2 );
		add_action( 'add_meta_boxes', 			array( $this->metabox, 'set_meta' ), 10, 2 );
		add_action( 'save_post', 				array( $this->metabox, 'save_meta' ), 10, 2 );
		add_action( 'edit_form_after_title',	array( $this->metabox, 'promote_metaboxes' ), 10, 1 );

	} // hooks()

} // class
