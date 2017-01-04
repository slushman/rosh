<?php
/**
 * The metabox-specific functionality of the theme.
 *
 * @since 			1.0.0
 * @package 		Rosh
 * @subpackage 		Rosh/classes
 */
class Rosh_Metabox_Full_Repeater {

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

		$nonce 				= 'nonce_rosh_full_repeater';
		$subfields[] 		= array( 'full-peat-checkbox', 'checkbox', '' );
		$subfields[] 		= array( 'full-peat-color', 'color', '' );
		$subfields[] 		= array( 'full-peat-date', 'date', '' );
		$subfields[] 		= array( 'full-peat-editor', 'editor', '' );
		$subfields[] 		= array( 'full-peat-file', 'url', '' );
		$subfields[] 		= array( 'full-peat-image', 'hidden', '' );
		$subfields[] 		= array( 'full-peat-menu', 'select', '' );
		$subfields[] 		= array( 'full-peat-page', 'select', '' );
		$subfields[] 		= array( 'full-peat-taxonomy', 'select', '' );
		$subfields[] 		= array( 'full-peat-radios', 'radio', '' );
		$subfields[] 		= array( 'full-peat-select', 'select', '' );
		$subfields[] 		= array( 'full-peat-text', 'text', '' );
		$subfields[] 		= array( 'full-peat-textarea', 'textarea', '' );
		$subfields[] 		= array( 'full-peat-time', 'time', '' );
		$fields[] 			= array( 'full-repeater', 'repeater', $subfields );
		$props['id'] 		= 'full-repeater';
		$props['name'] 		= __( 'Full Repeater', 'rosh' );

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
