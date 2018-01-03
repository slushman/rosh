<?php

/**
 * Autoloader for PHP 5.3+
 *
 * @since 			1.0.0
 * @package 		Rosh
 * @subpackage 		Rosh/classes
 */
class Rosh_Autoloader {

	/**
	* Autoloader function
	*
	* @param 		string 			$class_name
	*/
	public static function autoloader( $class_name ) {

		if ( 0 !== strpos( $class_name, 'Rosh_' ) ) { return; }

		$class_name = str_replace( 'Rosh_', '', $class_name );
		$lower 		= strtolower( $class_name );
		$file      	= 'class-' . str_replace( '_', '-', $lower ) . '.php';
		$base_path 	= trailingslashit( get_template_directory() );
		$paths[] 	= $base_path . $file;
		$paths[] 	= $base_path . 'classes/' . $file;

		foreach ( $paths as $path ) :

			if ( is_readable( $path ) && file_exists( $path ) ) {

				require_once( $path );
				return;

			}

		endforeach;

		return FALSE;

	} // autoloader()

} // class

spl_autoload_register( 'Rosh_Autoloader::autoloader' );
