<?php

/**
 * A set of methods for working with the WP REST API.
 *
 * @since 			1.0.0
 * @package 		Rosh
 * @subpackage 		Rosh/classes
 */
class Rosh_RESTAPI {

	/**
	 * Constructor
	 */
	public function __construct(){}

	public function hooks() {

		remove_filter( 'rest_pre_serve_request', 'rest_send_cors_headers' );

		add_filter( 'rest_query_var-post_per_page', array( $this, 'set_default_posts_per_page' ) );
		add_filter( 'rest_pre_serve_request', array( $this, 'set_cors_header' ) );

	} // hooks()

	/**
	 * Sets the CORS header to prevent corss-origin security errors.
	 * Prevents unauthorized AJAX requests.
	 *
	 * Add allowed domains in the $okdomains array to allow for cross-origin requests.
	 *
	 * @param 		mixed 		$value 		The current query.
	 * @return 		mixed 					The current query and/or the CORS header.
	 */
	public function set_cors_header( $value ) {

		$origin 		= get_http_origin();
		$okdomains[] 	= '';
		$allowed 		= in_array( $origin, $okdomains )

		if ( ! $origin || ! in_array( $origin, $allowed ) ) { return $value; }

		header( 'Access-Control-Allow-Origin: ' . esc_url_raw( $origin ) );
		header( 'Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE' );
		header( 'Access-Control-Allow-Credentials: true' );

		return $value;

	} // set_cors_header()

	/**
	 * Sets a default value for the quantity of posts per page
	 * that can be requested to prevent DDOS attacks through the REST API.
	 *
	 * @param 		int 		$posts_per_page 		The requested posts per page quantity.
	 * @return 		int 								The modified posts per page quantity.
	 */
	public function set_default_posts_per_page( $posts_per_page ) {

		if ( 10 < intval( $posts_per_page ) ) {

			$posts_per_page = 10;

		}

		return $posts_per_page;

	} // set_default_posts_per_page()

} // class
