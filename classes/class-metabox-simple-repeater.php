<?php
/**
 * The metabox-specific functionality of the theme.
 *
 * @since 			1.0.0
 * @package 		Rosh
 * @subpackage 		Rosh/classes
 */
class Rosh_Metabox_Simple_Repeater {

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

		$nonce 				= 'nonce_rosh_simple_repeater';
		$subfields[] 		= array( 'simple-peat-text', 'text', '' );
		$fields[] 			= array( 'simple-repeater', 'repeater', $subfields );
		$props['id'] 		= 'simple-repeater';
		$props['name'] 		= __( 'Simple Repeater', 'rosh' );

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
