<?php
/**
 * The metaboxes for post formats.
 *
 * @link 		https://www.slushman.com
 * @since 		1.0.0
 *
 * @package 	Rosh
 */
class Rosh_Metabox_Post_Format {

	/**
	 * Array of conditions where the metabox should appear.
	 *
	 * @since 		1.0.0
	 * @var 		array
	 */
	protected $conditions = array();

	/**
	 * Array of fields used in these metaboxes.
	 *
	 * @since 		1.0.0
	 *
	 * @var [type]
	 */
	protected $fields = array();

	/**
	 * The post meta data
	 *
	 * @since 		1.0.0
	 * @access 		protected
	 * @var 		string 			$meta    			The post meta data.
	 */
	protected $meta = array();

	/**
	 * The nonces for all the metaboxes.
	 *
	 * @since 		1.0.0
	 * @access 		protected
	 * @var 		string 			$nonce 			The nonce.
	 */
	protected $nonce = '';

	/**
	 * The ID of this theme.
	 *
	 * @since 		1.0.0
	 * @access 		protected
	 * @var 		string 			$theme_name 		The ID of this theme.
	 */
	protected $theme_name = '';

	/**
	 * The version of this theme.
	 *
	 * @since 		1.0.0
	 * @access 		protected
	 * @var 		string 			$version 			The current version of this theme.
	 */
	protected $version = '';

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 		1.0.0
	 * @param 		string 			$plugin_name 		The name of this theme.
	 * @param 		string 			$version 			The version of this theme.
	 */
	public function __construct( $theme_name, $version ) {

		$this->theme_name 	= $theme_name;
		$this->version 		= $version;
		$this->post_type 	= 'post';
		$this->nonce 		= 'nonce_rosh_post_format';

		$this->conditions['post_type'] 	= 'post';
		$this->conditions['cap'] 		= 'edit_post';

		$this->fields[] 	= array( 'post-audio', 'url', '' );
		$this->fields[] 	= array( 'post-image', 'hidden', '' );
		$this->fields[] 	= array( 'post-link', 'url', '' );
		$this->fields[] 	= array( 'post-video', 'url', '' );

	} // __construct()

	/**
	 * Registers metaboxes with WordPress
	 *
	 * @hooked 		add_meta_boxes
	 * @since 		1.0.0
	 * @access 	public
	 * @param 		string 			$post_type		The post type.
	 * @param 		object 			$post_obj 			The post object.
	 */
	public function add_metaboxes( $post_type, $post_obj ) {

		if ( ! is_admin() ) { return; }
		if ( ! $this->check_conditions( $post_obj ) ) { return; }

		$post_type = $this->get_post_type();

		add_meta_box(
			'post_format_data',
			apply_filters( $this->theme_name . '-post-format-data-title', esc_html__( 'Post Format Data', 'rosh' ) ),
			array( $this, 'metabox' ),
			$post_type,
			'top',
			'default',
			array(
				'file' => 'post-format-data'
			)
		);

	} // add_metaboxes()

	/**
	 * Uses the condition class to check if the metabox should appear or not.
	 *
	 * @exits 		If the class varialbes conditions is empty.
	 * @param 		obj 			$post_obj 		The post object
	 * @return 		bool 							Result of the checks.
	 */
	private function check_conditions( $post_obj ) {

		if ( empty( $this->conditions ) ) { return FALSE; }

		foreach ( $this->conditions as $type => $condition ) {

			if ( empty( $condition ) ) { continue; }

			$conditioner 	= new Rosh_Conditions();
			$check			= $conditioner->check( $type, $condition, $post_obj );

			if ( ! $check ) {

				return FALSE;

			}

		}

		return TRUE;

	} // check_conditions()

	/**
	 * Returns the post type or the current screen's post type.
	 *
	 * @return 		string 		The post type.
	 */
	private function get_post_type() {

		if ( array_key_exists( 'post_type', $this->conditions ) ) { return $this->conditions['post_type']; }

		$screen = get_current_screen();

		return $screen->post_type;

	} // get_post_type()

	/**
	 * Calls a metabox file specified in the add_meta_box args.
	 *
	 * @exits 		Not in the admin.
	 * @exits 		Not on the correct post type.
	 * @since 		1.0.0
	 * @access 		public
	 */
	public function metabox( $post_obj, $params ) {

		if ( ! is_admin() ) { return FALSE; }
		if ( ! $this->check_conditions( $post_obj ) ) { return FALSE; }

		include( get_stylesheet_directory() . '/template-parts/metaboxes/' . $params['args']['file'] . '.php' );

	} // metabox()

	/**
	 * Checks conditions before validating metabox submissions.
	 *
	 * Returns FALSE under these conditions:
	 * 		Doing autosave.
	 * 		User doesn't have the capabilities.
	 * 		Not on the correct post type.
	 * 		Nonce isn't set.
	 * 		Nonce does't validate.
	 *
	 * @param 		object 		$posted 		The submitted data.
	 * @param 		int 		$post_id 		The post ID.
	 * @param 		object 		$post_obj 			The post object.
	 * @return 		bool 						FALSE if any conditions are met, otherwise TRUE.
	 */
	private function pre_validation_checks( $posted, $post_id, $post_obj ) {

		if ( wp_is_post_autosave( $post_id ) ) { return FALSE; }
		if ( wp_is_post_revision( $post_id ) ) { return FALSE; }
		if ( ! $this->check_conditions( $post_obj ) ) { return FALSE; }
		if ( ! isset( $posted[$this->nonce] ) ) { return FALSE; }
		if ( isset( $posted[$this->nonce] ) && ! wp_verify_nonce( $posted[$this->nonce], $this->theme_name ) ) { return FALSE; }

		return TRUE;

	} // pre_validation_checks()

	/**
	 * Adds all metaboxes in the "top" priority to just under the title field.
	 *
	 * @exits 		If not on the correct post type.
	 * @hooked 		edit_form_after_title
	 * @param `		object 		$post_obj 		The post object.`
	 */
	public function promote_metaboxes( $post_obj ) {

		if ( ! $this->check_conditions( $post_obj ) ) { return FALSE; }

		global $wp_meta_boxes;

		do_meta_boxes( get_current_screen(), 'top', $post_obj );

		$post_type = $this->get_post_type();

		unset( $wp_meta_boxes[$post_type]['top'] );

	} // promote_metaboxes()

	/**
	 * Saves the metadata to the database.
	 *
	 * @exits 		If $meta is empty.
	 * @exits 		If $posted is empty.
	 * @param 		array 		$meta 		The field info.
	 * @param 		array 		$posted 		Data posted by the form.
	 * @param 		int 		$post_id 		The post ID.
	 * @return 		bool 					The result from update_post_meta().
	 */
	private function save_meta( $meta, $posted, $post_id ) {

		if ( empty( $meta ) ) { return FALSE; }
		if ( empty( $posted ) ) { return FALSE; }
		if ( empty( $post_id ) ) { return FALSE; }

		$sanitizer 	= new Rosh_Sanitize();
		$new_value 	= $sanitizer->clean( $posted[$meta[0]], $meta[1] );
		$updated 	= update_post_meta( $post_id, $meta[0], $new_value );

		return $updated;

	} // save_meta()

	/**
	 * Sets the class variable $options
	 *
	 * @exits 		Post is empty.
	 * @exits 		Not on the correct post type.
	 * @hooked 		add_meta_boxes
	 * @param 		string 			$post_type		The post type.
	 * @param 		object 			$post_obj 			The post object.
	 */
	public function set_meta( $post_type, $post_obj ) {

		if ( empty( $post_obj ) ) { return FALSE; }
		if ( ! $this->check_conditions( $post_obj ) ) { return FALSE; }

		$this->meta = get_post_custom( $post_obj->ID );

	} // set_meta()

	/**
	 * Saves metabox data
	 *
	 * @hooked 		save_post 		10
	 * @since 		1.0.0
	 * @access 		public
	 * @param 		int 			$post_id 		The post ID
	 * @param 		object 			$post_obj 			The post object
	 */
	public function validate_meta( $post_id, $post_obj ) {

		$validate = $this->pre_validation_checks( $_POST, $post_id, $post_obj );

		if ( ! $validate ) { return $post_id; }

		foreach ( $this->fields as $meta ) {

			// if ( 'post-image' == $meta[0] ) {
			//
			// 	wp_die( print_r( $meta ) );
			//
			// }

			$this->save_meta( $meta, $_POST, $post_id );

		} // foreach

	} // validate_meta()

} // class
