<?php

/**
 * A class of helpful menu-related functions
 *
 * @package Rosh
 * @author Slushman <chris@slushman.com>
 */
class Rosh_Menukit {

	/**
	 * Constructor
	 */
	public function __construct() {} // __construct()

	/**
	 * Adds a class with the depth level to each menu item.
	 * Makes styling menus much easier.
	 *
	 * @hooked 		nav_menu_css_class 			10
	 * @param 		array 		$classes 		The current menu item classes.
	 * @param 		object 		$item 			The current menu item.
	 * @param 		array 		$args 			The wp_nav_menu args.
	 * @param 		int 		$depth 			The menu item depth.
	 * @return 		array 						The modified menu item classes.
	 */
	public function add_depth_to_menu_item_classes( $classes, $item, $args, $depth ) {

		$classes[] = 'menu-item-level-' . $depth;

		return $classes;

	} // add_depth_to_menu_item_classes()

	/**
	 * Adds classes to menu item links.
	 *
	 * Adds the depth class to make styling easier.
	 * Adds the "coin" class if the menu item has the text-coin class.
	 *
	 * @hooked 		nav_menu_link_attributes 		10
	 * @param 		array 		$atts 				The current menu item link attributes.
	 * @param 		object 		$item 				The current menu item.
	 * @param 		array 		$args 				The wp_nav_menu args.
	 * @param 		int 		$depth 				The menu item depth.
	 * @return 		array 							The modified menu item link attributes.
	 */
	public function add_depth_to_menu_item_links( $atts, $item, $args, $depth ) {

		$atts['class'] = '';
		$atts['class'] .= 'menu-item-link ';
		$atts['class'] .= 'menu-item-link-level-' . $depth . ' ';

		if ( in_array( 'text-coin', $item->classes ) ) {

			$atts['class'] .= 'coin ';

		}

		return $atts;

	} // add_depth_to_menu_item_links()

	 /**
 	 * Adds an icon in the menu item title, either with or without the title text.
 	 *
 	 * @exits 		If $args is empty or an array.
 	 * @exits 		If 'slushicons' is not in the classes array.
 	 * @hooked 		nav_menu_item_title 			10
 	 * @param 		string 		$title 				The menu item title.
 	 * @param 		object 		$item				The current menu item.
 	 * @param 		array 		$args 				The wp_nav_menu args.
 	 * @param 		int 		$depth 				The menu item depth.
 	 * @return 		string 							The modified menu item title.
 	 */
	public function add_icons_to_menu( $title, $item, $args, $depth ) {

		if ( empty( $args ) || is_array( $args ) ) { return $title; }
		if ( ! in_array( 'slushicons', $item->classes ) ) { return $title; }

		$icon_name 	= apply_filters( 'rosh-menu-item-icon-name', '', $item, $args );
		$icon 		= $this->get_icon( $icon_name );
		$textpos 	= apply_filters( 'rosh-menu-item-text-position', '', $item, $args );

		if ( empty( $icon_name ) && empty( $textpos ) ) { return $title; }

		$output = '';

		if ( 'right' === $textpos ) {

			$output .= $icon;

		}

		if ( 'hide' === $textpos ) {

			$output .= '<span class="screen-reader-text">' . esc_html( $title ) . '</span>';
			$output .= $icon;

		} elseif ( 'coin' === $textpos ) {

			$output .= '<div class="front menu-icon">';
			$output .= $icon;
			$output .= '</div><div class="back menu-label"><span class="text">';
			$output .= esc_html( $title );
			$output .= '</span></div>';

		} else {

			$output .= '<span class="menu-label">' . esc_html( $title ) . '</span>';

		}

		if ( 'left' === $textpos ) {

			$output .= $icon;

		}

		return $output;

	} // add_icons_to_menu()

	/**
	 * Adds a search form to the menu.
	 *
	 * @exits 		If not on the correct menu.
	 * @hooked 		wp_nav_menu_items 			10
	 * @param 		array 		$items 			The current menu items.
	 * @param 		array 		$args 			The menu args.
	 * @return 		array 						The menu items plus a search form.
	 */
	public function add_search_to_menu( $items, $args ) {

		if ( '' !== $args->theme_location ) { return $items; }

		return $items . get_search_form();

	} // add_search_to_menu()

	/**
	 * Returns the code for the icon.
	 *
	 * @exits 		If $icon is empty
	 * @exits 		if $icon is not an array.
	 * @hooked
	 * @param 		array 		$icon 			The icon info array.
	 * @return 		mixed 						The icon markup.
	 */
	private function get_icon( $icon ) {

		if ( empty( $icon ) || ! is_array( $icon ) ) { return; }

		$return = '';

		if ( 'dashicons' === $icon['type'] ) {

			$return = '<span class="dashicons dashicons-' . $icon['name'] . '"></span>';

		}

		if ( 'fontawesome' === $icon['type'] ) {

			$return = '<span class="fa fa-' . $icon['name'] . '"></span>';

		}

		if ( 'svg' === $icon['type'] ) {

			$check = rosh_get_svg( $icon['name'] );

			if ( ! is_null( $check ) ) {

				$return = $check;

			}

		}

		return $return;

	} // get_icon()

	/**
	 * Returns an array of info about the icon.
	 *
	 * @exits 		If $classes is empty.
	 * @hooked 		rosh-menu-item-icon-name 		10
	 * @param 		string 		$icon 					The current icon name.
	 * @param 		object 		$item					The menu item object.
	 * @param 		array 		$args 					The menu arguments.
	 * @return 		array 								The type and name of the icon.
	 */
	public function get_icon_info( $icon, $item, $args  ) {

		if ( empty( $item->classes ) ) { return; }

		$return = array();
		$checks = array( 'dic-', 'fas-', 'svg-' );

		foreach ( $item->classes as $class ) {

			if ( stripos( $class, $checks[0] ) !== FALSE ) {

				$return['type'] = 'dashicons';
				$return['name'] = str_replace( $checks[0], '', $class );
				break;

			}

			if ( stripos( $class, $checks[1] ) !== FALSE ) {

				$return['type'] = 'fontawesome';
				$return['name'] = str_replace( $checks[1], '', $class );
				break;

			}

			if ( stripos( $class, $checks[2] ) !== FALSE ) {

				$return['type'] = 'svg';
				$return['name'] = str_replace( $checks[2], '', $class );
				break;

			}

		} // foreach

		return $return;

	} // get_icon_info()

	/**
	 * Returns the text position from the menu item class.
	 *
	 * @exits 		If $classes is empty.
	 * @hooked 		rosh-menu-item-text-position 		10
	 * @param 		string 		$position 					The current text position.
	 * @param 		object 		$item						The menu item object.
	 * @param 		array 		$args 						The menu arguments.
	 * @return 		string 									The text position.
	 */
	public function get_text_position( $position, $item, $args ) {

		if ( empty( $item->classes ) ) { return; }

		if ( in_array( 'no-text', $item->classes ) ) { return 'hide'; }
		if ( in_array( 'text-left', $item->classes ) ) { return 'left'; }
		if ( in_array( 'text-right', $item->classes ) ) { return 'right'; }
		if ( in_array( 'text-coin', $item->classes ) ) { return 'coin'; }
		if ( in_array( 'text-above', $item->classes ) ) { return 'above'; }
		if ( in_array( 'text-below', $item->classes ) ) { return 'below'; }

		return;

	} // get_text_position()

	/**
	 * Adds the "+" show-hide trigger for mobile menus and the down caret for laptop menus.
	 *
	 * @exits 		If $args is empty or an array.
	 * @exits 		If not on the primary menu.
	 * @exits 		If 'menu-item-has-children' is not in the $classes array.
	 * @hooked 		nav_menu_item_title 			10
	 * @param 		string 		$title 				The menu item title.
	 * @param 		object 		$item				The current menu item.
	 * @param 		array 		$args 				The wp_nav_menu args.
	 * @param 		int 		$depth 				The menu item depth.
	 * @return 		string 							The modified menu item title.
	 */
	public function menu_show_hide( $title, $item, $args, $depth ) {

		if ( empty( $args ) || is_array( $args ) ) { return $title; }
		if ( 'primary' !== $args->theme_location ) { return $title; }
		if ( ! in_array( 'menu-item-has-children', $item->classes ) ) { return $title; }

		$output = '';
		$output .= $title;

		if ( 0 === $depth ) {

			$output .= '<span class="children">' . rosh_get_svg( 'caret-down' ) . '</span>';

		} else {

			$output .= '<span class="children">' . rosh_get_svg( 'caret-right' ) . '</span>';

		}
		
		$output .= '<span class="show-hide flex-center">+</span>';

		return $output;

	} // menu_show_hide()

} // class
