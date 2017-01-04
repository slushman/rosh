<?php

/**
 * A class of methods related to users and their profiles.
 *
 * @since 			1.0.0
 * @package 		Rosh
 * @subpackage 		Rosh/classes
 */
class Rosh_Users {

	/**
	 * Constructor
	 *
	 * @since 		1.0.0
	 */
	public function __construct() {}

	/**
	 * Registers all the WordPress hooks and filters for this class.
	 */
	public function hooks() {

		add_filter( 'user_contactmethods', array( $this, 'remove_contact_methods' ), 10, 1 );
		add_filter( 'user_contactmethods', array( $this, 'add_contact_methods' ), 10, 1 );

	} // hooks()

	/**
	 * Adds contact method fields to the user profiles.
	 *
	 * @param 		array 		$contactmethods 		The current contact methods.
	 * @return 		array 								The modified contact methods.
	 */
	public function add_contact_methods( $contactmethods ) {

		$contactmethods['linkedin'] 	= __( 'LinkedIn' , 'rosh' );
		$contactmethods['youtube'] 		= __( 'YouTube' , 'rosh' );
		$contactmethods['vimeo'] 		= __( 'Vimeo' , 'rosh' );
		$contactmethods['wordpress'] 	= __( 'WordPress' , 'rosh' );
		$contactmethods['pinterest'] 	= __( 'Pinterest' , 'rosh' );
		$contactmethods['instagram'] 	= __( 'Instagram' , 'rosh' );

		return $contactmethods;

	} // add_contact_methods()

	/**
	 * Removes contact method fields from the user profiles.
	 *
	 * @param 		array 		$contactmethods 		The current contact methods.
	 * @return 		array 								The modified contact methods.
	 */
	public function remove_contact_methods( $contactmethods ) {

		unset( $contactmethods[ 'aim' ] );
		unset( $contactmethods[ 'yim' ] );
		unset( $contactmethods[ 'jabber' ] );

		return $contactmethods;

	} // remove_contact_methods()

} // class
