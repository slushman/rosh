<?php
/**
 * This file calls the init.php file, but only
 * if the child theme hasn't called it first.
 *
 * This method allows the child theme to load
 * the framework so it can use the framework
 * components immediately.
 *
 * This file is a core Rosh file and should not be edited.
 *
 * @package  Rosh
 * @author   slushman
 * @license  GPL-2.0+
 * @link     https://developer.wordpress.org/themes/basics/theme-functions/
 */

/**
 * Set the constants used throughout.
 */
define( 'PARENT_THEME_SLUG', 'rosh' );
define( 'PARENT_THEME_VERSION', '1.0.4' );

/**
 * Load Imagekit.
 */
require get_template_directory() . '/functions/imagekit.php';

/**
 * Load Themekit.
 */
require get_template_directory() . '/functions/themekit.php';

/**
 * Load Menu Walker.
 */
require get_template_directory() . '/classes/menu-walker.php';

/**
 * Load Autoloader
 */
require get_template_directory() . '/classes/class-autoloader.php';


/**
 * Create an instance of each class and load the hooks function.
 */
$classes[] = 'Authorbox';
$classes[] = 'Automattic';
$classes[] = 'Critical';
$classes[] = 'Customizer';
$classes[] = 'Editor';
$classes[] = 'Hidden_Search';
$classes[] = 'Menukit';
$classes[] = 'Metabox_Demo';
// $classes[] = 'Metabox_Full_Repeater';
// $classes[] = 'Metabox_Post_Format';
$classes[] = 'Metabox_Simple_Repeater';
$classes[] = 'Metabox_Subtitle';
$classes[] = 'Setup';
$classes[] = 'Shortcode_Listmenu';
$classes[] = 'Shortcode_Search';
$classes[] = 'Slushicons';
$classes[] = 'Soliloquy';
$classes[] = 'Themehooks';
$classes[] = 'Users';
$classes[] = 'Utilities';
$classes[] = 'WooCommerce';

foreach ( $classes as $class ) {

	$class_name 	= 'Rosh_' . $class;
	$class_obj 		= new $class_name();

	add_action( 'after_setup_theme', array( $class_obj, 'hooks' ) );

}
