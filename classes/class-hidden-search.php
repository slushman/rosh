<?php

/**
 * A class of methods using hooks in the theme.
 *
 * @since 			1.0.0
 * @package 		Rosh
 * @subpackage 		Rosh/classes
 */
class Rosh_Hidden_Search {

	/**
	 * Constructor
	 */
	public function __construct() {}

	/**
	 * Registers all the WordPress hooks and filters for this class.
	 */
	public function hooks() {

		add_action( 'rosh_body_top', array( $this, 'add_hidden_search' ), 15 );

		add_filter( 'rosh_search_form_class', array( $this, 'add_class_to_form' ), 10, 1 );
		add_filter( 'rosh_search_field_class', array( $this, 'add_class_to_field' ), 10, 1 );
		add_filter( 'rosh_search_button_class', array( $this, 'add_class_to_button' ), 10, 1 );

	} // hooks()

	/**
	 * Adds a custom class to the search form.
	 * @param 		string 		$class 		The current classes.
	 * @return 		string 		$class 		The modified classes.
	 */
	public function add_class_to_form( $class ) {

		$class .= ' hidden-search-form';

		return $class;

	} // add_class_to_form()

	/**
	 * Adds a custom class to the search field.
	 * @param 		string 		$class 		The current classes.
	 * @return 		string 		$class 		The modified classes.
	 */
	public function add_class_to_field( $class ) {

		$class .= ' hidden-search-field';

		return $class;

	} // add_class_to_field()

	/**
	 * Adds a custom class to the search button.
	 * @param 		string 		$class 		The current classes.
	 * @return 		string 		$class 		The modified classes.
	 */
	public function add_class_to_button( $class ) {

		$class .= ' hidden-search-btn';

		return $class;

	} // add_class_to_button()

	/**
	 * Adds a hidden search field
	 *
	 * @hooked 		rosh_body_top 		15
	 * @return 		mixed 				The HTML markup for a search field
	 */
	public function add_hidden_search() {

		?><div aria-hidden="true" class="hidden-search-top" id="hidden-search-top">
			<div class="hidden-search-wrap"><?php

			get_search_form();

			?></div>
		</div><?php

	} // add_hidden_search()

} // class
