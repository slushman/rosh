<?php

/**
 * A class of helpful menu-related functions
 *
 * @since 			1.0.0
 * @package 		Rosh
 * @subpackage 		Rosh/classes
 */
class Rosh_Menukit {

	/**
	 * Constructor
	 */
	public function __construct() {}

	/**
	 * Registers all the WordPress hooks and filters for this class.
	 */
	public function hooks() {

		add_filter( 'nav_menu_item_title', 					array( $this, 'submenu_toggle' ), 10, 4 );
		add_filter( 'nav_menu_item_title', 					array( $this, 'add_icons_to_menu' ), 10, 4 );

		add_filter( 'rosh_menu_item_text_position', 		array( $this, 'get_text_position' ), 10, 3 );

		add_filter( 'rosh_menu_item_icon_name', 			array( $this, 'get_icon_info' ), 10, 3 );

		add_filter( 'nav_menu_css_class', 					array( $this, 'add_depth_to_menu_item_classes' ), 10, 4 );
		add_filter( 'nav_menu_css_class', 					array( $this, 'add_menu_order_to_menu_item_classes' ), 10, 4 );
		add_filter( 'nav_menu_css_class', 					array( $this, 'add_current_and_menu_name_as_class' ), 10, 4 );
		add_filter( 'nav_menu_css_class', 					array( $this, 'add_menu_name_as_class' ), 10, 4 );

		add_filter( 'nav_menu_link_attributes', 			array( $this, 'add_depth_to_menu_item_links' ), 10, 4 );
		add_filter( 'nav_menu_link_attributes', 			array( $this, 'add_menu_order_to_menu_item_links' ), 10, 4 );
		add_filter( 'nav_menu_link_attributes', 			array( $this, 'add_current_to_menu_item_links' ), 10, 4 );

		add_filter( 'wp_setup_nav_menu_item', 				array( $this, 'add_menu_title_as_class' ), 10, 1 );

		add_filter( 'wp_nav_menu_container_allowedtags', 	array( $this, 'allow_section_tags_as_containers' ), 10, 1 );
		
		add_filter( 'wp_nav_menu_objects', 					array( $this, 'add_menu_name_to_parent_menu_items' ), 10, 2 );

		//add_filter( 'page_css_class', 						array( $this, 'add_menu_name_to_current_classes' ), 10, 5 );
		//add_filter( 'wp_nav_menu_items', 					array( $this, 'add_search_to_menu' ), 10, 2 );

	} // hooks()
	
	/**
	 * Adds a class with the menu name to each menu item.
	 *
	 * @exits 		If $args is empty.
	 * @hooked 		nav_menu_css_class 			10
	 * @param 		array 		$classes 		The current menu item classes.
	 * @param 		object 		$item 			The current menu item.
	 * @param 		array 		$args 			The wp_nav_menu args.
	 * @param 		int 		$depth 			The menu item depth.
	 * @return 		array 						The modified menu item classes.
	 */
	public function add_current_and_menu_name_as_class( $classes, $item, $args, $depth ) {

		if ( empty( $args ) ) { return $classes; }
		if ( ! $item->current ) { return $classes; }
		
		//echo '<pre>'; print_r( $item ); echo '</pre>';

		$classes[] = 'current-' . $args->menu_id . '-item';

		return $classes;

	} // add_current_and_menu_name_as_class()
	
	/**
	 * Adds the current-menu-item-link class to a menu item link
	 * if the menu item object_id matches the current page ID.
	 *
	 * @hooked 		nav_menu_link_attributes 		10
	 * @param 		array 		$atts 				The current menu item link attributes.
	 * @param 		object 		$item 				The current menu item.
	 * @param 		object 		$args 				The wp_nav_menu args.
	 * @param 		int 		$depth 				The menu item depth.
	 * @return 		array 							The modified menu item link attributes.
	 */	
	public function add_current_to_menu_item_links( $atts, $item, $args, $depth ) {
		
		if ( empty( $item ) ) { return $atts; }
		if ( ! $item->current ) { return $atts; }

		$atts['class'] .= 'current-' . $args->menu_id . '-item-link';
		
		if ( ! is_array( $item->classes ) ) { return $atts; }

		return $atts;
		
	} // add_current_to_menu_item_links()

	/**
	 * Adds a class with the menu name and depth level to each menu item.
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

		if ( empty( $item ) ) { return $classes; }
		if ( ! isset( $atts['class'] ) ) { $atts['class'] = ''; }

		$classes[] = $args->menu_id . '-item';
		$classes[] = $args->menu_id . '-item-' . $depth;
		
		if ( ! is_array( $item->classes ) ) { return $atts; }

		if ( in_array( 'text-coin', $item->classes ) ) {

			$atts['class'] .= 'coin ';

		}

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
	 * @param 		object 		$args 				The wp_nav_menu args.
	 * @param 		int 		$depth 				The menu item depth.
	 * @return 		array 							The modified menu item link attributes.
	 */
	public function add_depth_to_menu_item_links( $atts, $item, $args, $depth ) {

		if ( empty( $item ) ) { return $atts; }
		if ( ! isset( $atts['class'] ) ) { $atts['class'] = ''; }

		$atts['class'] .= $args->menu_id . '-item-link ';
		$atts['class'] .= $args->menu_id . '-item-link-' . $depth . ' ';
		
		if ( ! is_array( $item->classes ) ) { return $atts; }

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

		$icon_name 	= apply_filters( 'igrowmacon_menu_item_icon_name', '', $item, $args );
		$icon 		= $this->get_icon( $icon_name );
		$textpos 	= apply_filters( 'igrowmacon_menu_item_text_position', '', $item, $args );

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
	 * Adds a class with the menu name to each menu item.
	 *
	 * @exits 		If $args is empty.
	 * @hooked 		nav_menu_css_class 			10
	 * @param 		array 		$classes 		The current menu item classes.
	 * @param 		object 		$item 			The current menu item.
	 * @param 		array 		$args 			The wp_nav_menu args.
	 * @param 		int 		$depth 			The menu item depth.
	 * @return 		array 						The modified menu item classes.
	 */
	public function add_menu_name_as_class( $classes, $item, $args, $depth ) {

		if ( empty( $args ) ) { return $classes; }

		$classes[] = $args->menu_id . '-item';

		return $classes;

	} // add_menu_name_as_class()

	/**
	 * Adds the menu name as a class for the current page, current page ancestor,
	 * and current page parent.
	 *
	 * @param 		array 			$css_class 			An array of CSS classes to be applied
	 *                                 						to each list item.
	 * @param 		WP_Post 		$page 				Page data object.
	 * @param 		int 			$depth 				Depth of page, used for padding.
	 * @param 		array 			$args 				An array of arguments.
	 * @param 		int 			$current_page 		ID of the current page.
	 * @return 		array 			$css_class 			The modified CSS classes array.
	 */
	public function add_menu_name_to_current_classes( $css_class, $page, $depth, $args, $current_page ) {

		if ( ! empty( $current_page ) ) {

			$_current_page = get_post( $current_page );

			if ( $_current_page && in_array( $page->ID, $_current_page->ancestors ) ) {

				$css_class[] = $args->menu_id . '-current_page_ancestor';

			}

			if ( $page->ID == $current_page ) {

				$css_class[] = $args->menu_id . '-current_page_item';

			} elseif ( $_current_page && $page->ID == $_current_page->post_parent ) {

				$css_class[] = $args->menu_id . '-current_page_parent';

			}

		} elseif ( $page->ID == get_option( 'page_for_posts' ) ) {

			$css_class[] = $args->menu_id . '-current_page_parent';

		}

		return $css_class;

	} // add_menu_name_to_current_classes()
	
	/**
	 * Adds the menu name to the menu-item-has-children class to 
	 * each parent menu item.
	 * 
	 * @param 		array 		$sorted_items 		The sorted menu items
	 * @param		array 		$args 				The wp_nav_menu args.
	 * @return 		array 		$sorted_items 		The modified sorted menu items
	 */
	public function add_menu_name_to_parent_menu_items( $sorted_items, $args ) {
		
		$parents = array();
		
		foreach ( $sorted_items as $menu_item ) {
			
			if ( 0 >= $menu_item->menu_item_parent ) { continue; }
				
			$parents[] = $menu_item->menu_item_parent;
			
		}
		
		if ( empty( $parents ) ) { return $sorted_items; }
		
		foreach ( $sorted_items as $menu_item ) {
						
			if ( ! in_array( $menu_item->ID, $parents ) ) { continue; }
						
			$menu_item->classes[] = $args->menu_id . '-item-has-children';
			
		}
			
		return $sorted_items;
		
	} // add_menu_name_to_parent_menu_items()
	
	/**
	 * Adds a class with the menu name and depth level to each menu item.
	 * Makes styling menus much easier.
	 *
	 * @hooked 		nav_menu_css_class 			10
	 * @param 		array 		$classes 		The current menu item classes.
	 * @param 		object 		$item 			The current menu item.
	 * @param 		array 		$args 			The wp_nav_menu args.
	 * @param 		int 		$depth 			The menu item depth.
	 * @return 		array 						The modified menu item classes.
	 */
	public function add_menu_order_to_menu_item_classes( $classes, $item, $args, $depth ) {
		
		if ( empty( $item ) ) { return $classes; }
		
		if ( 1 === $item->menu_order ) {
			
			$classes[] = $args->menu_id . '-item-first';
			$classes[] = $args->menu_id . '-item-' . $depth . '-first';
			
		}
		
		if ( $args->menu->count === $item->menu_order ) {
			
			$classes[] = $args->menu_id . '-item-last';
			$classes[] = $args->menu_id . '-item-' . $depth . '-last';
			
		}
		
		return $classes;

	} // add_menu_order_to_menu_item_classes()

	/**
	 * Adds classes to menu item links.
	 *
	 * Adds the depth class to make styling easier.
	 * Adds the "coin" class if the menu item has the text-coin class.
	 *
	 * @hooked 		nav_menu_link_attributes 		10
	 * @param 		array 		$atts 				The current menu item link attributes.
	 * @param 		object 		$item 				The current menu item.
	 * @param 		object 		$args 				The wp_nav_menu args.
	 * @param 		int 		$depth 				The menu item depth.
	 * @return 		array 							The modified menu item link attributes.
	 */
	public function add_menu_order_to_menu_item_links( $atts, $item, $args, $depth ) {

		if ( empty( $item ) ) { return $atts; }
		
		if ( 1 === $item->menu_order ) {
			
			$atts['class'] .= $args->menu_id . '-item-link-first ';
			$atts['class'] .= $args->menu_id . '-item-link-' . $depth . '-first ';
			
		}
		
		if ( $args->menu->count === $item->menu_order ) {
			
			$atts['class'] .= $args->menu_id . '-item-link-last ';
			$atts['class'] .= $args->menu_id . '-item-link-' . $depth . '-last ';
			
		}

		return $atts;

	} // add_menu_order_to_menu_item_links()

	/**
	 * Adds the Menu Item Title as a class on the menu item
	 *
	 * @hooked 		wp_setup_nav_menu_item
	 * @param 		object 		$menu_item 			A menu item object
	 */
	public function add_menu_title_as_class( $menu_item ) {

		$title = sanitize_title( $menu_item->title );

		if ( empty( $menu_item->classes ) || ! is_array( $menu_item->classes ) ) {

			$menu_item->classes[0] = $title;

		} elseif ( ! in_array( $title, $menu_item->classes ) ) {
			
			$menu_item->classes[] = $title;
			
		}

		return $menu_item;

	} // add_menu_title_as_class()
	
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
	 * Adds more allowed tags for WP menu containers.
	 *
	 * @hooked 		wp_nav_menu_container_allowedtags
	 * @param 		array 			$tags 			The current allowed tags
	 * @return 		array 							The modified allowed tags
	 */
	public function allow_section_tags_as_containers( $tags ) {

		$tags[] = 'section';

		return $tags;

	} // allow_section_tags_as_containers()
	
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

		// if ( 'fontawesome' === $icon['type'] ) {
		// 
		// 	$return = '<span class="fa fa-' . $icon['name'] . '"></span>';
		// 
		// }

		if ( 'svg' === $icon['type'] ) {

			$check = igrowmacon_get_svg( $icon['name'] );

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
	 * @hooked 		rosh_menu_item_icon_name 			10
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
	 * @hooked 		rosh_menu_item_text_position 			10
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
	 * Adds the "+" menu-1-submenu-toggle trigger for mobile menus and the down caret for laptop menus.
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
	public function submenu_toggle( $title, $item, $args, $depth ) {

		if ( empty( $args ) || is_array( $args ) ) { return $title; }
		if ( 'menu-1' !== $args->theme_location ) { return $title; }
		if ( ! in_array( 'menu-item-has-children', $item->classes ) ) { return $title; }

		$output = '';
		$output .= $title;

		if ( 0 === $depth ) {

			//$output .= '<span class="submenu-icon">' . igrowmacon_get_svg( 'caret-down' ) . '</span>';
			$output .= '<span class="menu-1-submenu-icon triangle-down"></span>';

		} else {

			//$output .= '<span class="submenu-icon">' . igrowmacon_get_svg( 'caret-right' ) . '</span>';
			$output .= '<span class="menu-1-submenu-icon triangle-right"></span>';

		}

		$output .= '<button class="menu-1-submenu-toggle flex-center">+</button>';

		return $output;

	} // submenu_toggle()

} // class
