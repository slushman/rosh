<?php

/**
 * Class for creating a shortcode.
 *
 * @since 			1.0.0
 * @package 		Rosh
 * @subpackage 		Rosh/classes
 */

class Rosh_Shortcode_Listmenu {

	/**
	 * Constructor.
	 */
	public function __construct(){}

	/**
	 * Registers all the WordPress hooks and filters for this class.
	 */
	public function hooks() {

		add_shortcode( 'listmenu', array( $this, 'shortcode_list_menu' ) );

	} // hooks()

	/**
	 * Returns a WordPress menu for a shortcode.
	 *
	 * @hooked 		add_shortcode
	 * @param 		array 		$atts 			Shortcode attributes
	 * @param 		mixed 		$content 		The page content
	 * @return 		mixed 						A WordPress menu
	 */
	public function shortcode_list_menu( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'menu'            => '',
			'container'       => 'div',
			'container_class' => '',
			'container_id'    => '',
			'menu_class'      => 'menu',
			'menu_id'         => '',
			'echo'            => true,
			'fallback_cb'     => 'wp_page_menu',
			'before'          => '',
			'after'           => '',
			'link_before'     => '',
			'link_after'      => '',
			'depth'           => 0,
			'walker'          => '',
			'theme_location'  => ''),
			$atts )
		);

		return wp_nav_menu( array(
			'menu'            => $menu,
			'container'       => $container,
			'container_class' => $container_class,
			'container_id'    => $container_id,
			'menu_class'      => $menu_class,
			'menu_id'         => $menu_id,
			'echo'            => false,
			'fallback_cb'     => $fallback_cb,
			'before'          => $before,
			'after'           => $after,
			'link_before'     => $link_before,
			'link_after'      => $link_after,
			'depth'           => $depth,
			'walker'          => $walker,
			'theme_location'  => $theme_location )
		);

	} // list_menu()

} // class
