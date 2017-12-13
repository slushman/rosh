<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.com/
 * @since 			1.0.0
 * @package 		Rosh
 * @subpackage 		Rosh/classes
 */
class Rosh_Automattic {

	/**
	 * Constructor
	 */
	public function __construct() {} // __construct()

	/**
	 * Registers all the WordPress hooks and filters for this class.
	 *
	 * @exits 		If Jetpack Version constant is not found.
	 */
	public function hooks () {

		if ( ! defined( 'JETPACK_VERSION' ) ) { return; }

		add_action( 'after_setup_theme', array( $this, 'jetpack_setup' ) );
		add_action( 'after_setup_theme', array( $this, 'wpcom_setup' ) );

	} // hooks()

	/**
	 * Jetpack setup function.
	 *
	 * @see: https://jetpack.com/support/infinite-scroll/
	 * @see: https://jetpack.com/support/responsive-videos/
	 * @see: https://jetpack.com/support/content-options/
	 * @hooked 		after_setup_theme
	 */
	function jetpack_setup() {

		add_theme_support( 'infinite-scroll', array(
			'container' => 'main',
			'render'    => 'rosh_infinite_scroll_render',
			'footer'    => 'page',
		) );

		add_theme_support( 'jetpack-responsive-videos' );

		// Add theme support for Content Options.
		add_theme_support( 'jetpack-content-options', array(
			'post-details' => array(
				'stylesheet' 	=> 'rosh-style',
				'date'			=> '.posted-on',
				'categories'	=> '.cat-links',
				'tags'			=> '.tags-links',
				'author'		=> '.byline',
				'comment'		=> '.comments-link',
			)
		) );

	} // jetpack_setup()

	/**
	 * Adds support for wp.com-specific theme functions.
	 *
	 * @hooked 		after_setup_theme
	 * @global 		array $themecolors
	 */
	function wpcom_setup() {

		global $themecolors;

		if ( isset( $themecolors ) ) { return; }

		$themecolors = array(
			'bg'     => '',
			'border' => '',
			'text'   => '',
			'link'   => '',
			'url'    => '',
		);

	} // wpcom_setup()

} // class

/**
 * Custom render function for Infinite Scroll.
 */
function rosh_infinite_scroll_render() {

	while ( have_posts() ) {

		the_post();

		if ( is_search() ) {

			get_template_part( 'template-parts/content', 'search' );

		} else {

			get_template_part( 'template-parts/content', get_post_type() );

		}

	}

} // rosh_infinite_scroll_render()
