<?php
/**
 * The metaboxes for post formats.
 *
 * @since 			1.0.0
 * @package 		Rosh
 * @subpackage 		Rosh/classes
 */
class Rosh_Metabox_Post_Format {

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

		$conditions['cap'] 			= 'edit_post';
		$conditions['post_type'] 	= 'post';
		$conditions['support'] 		= 'post-formats';
		$nonce 						= 'nonce_rosh_post_format';
		$fields[] 					= array( 'post-audio', 'url', '' );
		$fields[] 					= array( 'post-image', 'hidden', '' );
		$fields[] 					= array( 'post-link', 'url', '' );
		$fields[] 					= array( 'post-video', 'url', '' );
		$props['context'] 			= 'top';
		$props['file'] 				= 'post-format-data';
		$props['id'] 				= 'post_format_data';
		$props['name'] 				= __( 'Post Format Data', 'rosh' );
		$props['screen'] 			= 'post';

		$this->metabox 				= new Rosh_Metabox( $props, $nonce, $fields, $conditions );

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
