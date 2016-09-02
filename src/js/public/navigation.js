/**
 * navigation.js
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation suypport for dropdown menus.
 */
( function() {

	var container, button, menu, links, subMenus, i, len;

	container = document.querySelector( '#site-navigation' );
	if ( ! container ) { return; }

	button = container.querySelector( '.menu-toggle' );
	if ( 'undefined' === typeof button ) { return; }

	menu = container.querySelectorAll( 'ul' )[0];

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof menu ) {

		button.style.display = 'none';

		return;

	}

	menu.setAttribute( 'aria-expanded', 'false' );

	if ( -1 === menu.className.indexOf( 'nav-menu' ) ) {

		menu.className += ' nav-menu';

	}

	// Get all the link elements within the menu.
	links    = menu.querySelectorAll( 'a' );
	subMenus = menu.querySelectorAll( 'ul' );

	/**
	 * Tablet menu - pushing out from left

	var body = document.querySelector( 'body' );
	if ( 'undefined' === typeof body ) { return; }
	*/

	/**
	 * Sets or removes .focus class on an element.
	 */
	function toggleFocus() {

		var self = this;

		// Move up through the ancestors of the current link until we hit .nav-menu.
		while ( -1 === self.className.indexOf( 'nav-menu' ) ) {

			// On li elements toggle the class .focus.
			if ( 'li' === self.tagName.toLowerCase() ) {

				if ( -1 !== self.className.indexOf( 'focus' ) ) {

					self.className = self.className.replace( ' focus', '' );

				} else {

					self.className += ' focus';

				}

			}

			self = self.parentElement;
		}
	}

	/**
	 * Toggles `focus` class to allow submenu access on tablets.
	 */
	( function( container ) {
		var touchStartFn, i,
			parentLink = container.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );

		if ( 'ontouchstart' in window ) {
			touchStartFn = function( e ) {
				var menuItem = this.parentNode, i;

				if ( ! menuItem.classList.contains( 'focus' ) ) {
					e.preventDefault();
					for ( i = 0; i < menuItem.parentNode.children.length; ++i ) {
						if ( menuItem === menuItem.parentNode.children[i] ) {
							continue;
						}
						menuItem.parentNode.children[i].classList.remove( 'focus' );
					}
					menuItem.classList.add( 'focus' );
				} else {
					menuItem.classList.remove( 'focus' );
				}
			};

			for ( i = 0; i < parentLink.length; ++i ) {
				parentLink[i].addEventListener( 'touchstart', touchStartFn, false );
			}
		}
	}( container ) );

	/**
	 * Toggles menu open and closed.
	 */
	function toggleMenu() {

		var self = this;

		if ( -1 !== container.className.indexOf( 'toggled' ) ) {

			container.className = container.className.replace( ' toggled', '' );
			this.setAttribute( 'aria-expanded', 'false' );
			menu.setAttribute( 'aria-expanded', 'false' );

		} else {

			container.className += ' toggled';
			this.setAttribute( 'aria-expanded', 'true' );
			menu.setAttribute( 'aria-expanded', 'true' );

		}

		/**
		 * Tablet menu - pushing out from left

		if ( -1 !== body.className.indexOf( 'toggled' ) ) {

			body.className = body.className.replace( ' toggled', '' );

		} else {

			body.className += ' toggled';

		}
		*/
	}

	button.addEventListener( 'click', toggleMenu, true );

	// Set menu items with submenus to aria-haspopup="true".
	for ( i = 0, len = subMenus.length; i < len; i++ ) {

		subMenus[i].parentNode.setAttribute( 'aria-haspopup', 'true' );

	}

	// Each time a menu link is focused or blurred, toggle focus.
	for ( i = 0, len = links.length; i < len; i++ ) {

		links[i].addEventListener( 'focus', toggleFocus, true );
		links[i].addEventListener( 'blur', toggleFocus, true );

	}

} )();
