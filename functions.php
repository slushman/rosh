<?php
/**
 * Rosh functions and definitions
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package Rosh
 */

/**
 * Custom template tags for this theme.
 */
require get_stylesheet_directory() . '/inc/template-tags.php';

/**
 * Load The image function library
 */
require get_stylesheet_directory() . '/inc/imagekit.php';

/**
 * Load Slushman Themekit
 */
require get_stylesheet_directory() . '/inc/themekit.php';

/**
 * Load Main Menu Walker
 */
require get_stylesheet_directory() . '/inc/main-menu-walker.php';

/**
 * Autoloader function
 *
 * @param 		string 			$class_name
 */
function rosh_autoloader( $class_name ) {

	if ( 0 !== strpos( $class_name, 'Rosh_' ) ) { return; }

	$class_name = str_replace( 'Rosh_', '', $class_name );
	$lower 		= strtolower( $class_name );
	$file      	= 'class-' . str_replace( '_', '-', $lower ) . '.php';
	$base_path 	= trailingslashit( get_stylesheet_directory() );
	$paths[] 	= $base_path . $file;
	$paths[] 	= $base_path . 'classes/' . $file;

	/**
	 * rosh-autoloader-paths filter
	 */
	$paths = apply_filters( 'rosh-autoloader-paths', $paths );

	foreach ( $paths as $path ) :

		if ( is_readable( $path ) && file_exists( $path ) ) {

			require_once( $path );
			return;

		}

	endforeach;

} // rosh_autoloader()

spl_autoload_register( 'rosh_autoloader' );

/**
 * Begins execution of the hooks.
 *
 * @since    1.0.0
 */
call_user_func( array( new Rosh_Controller(), 'run' ) );
