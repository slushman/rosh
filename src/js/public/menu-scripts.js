/**
 * Opens the current page's submenu. When hovering over another top-level
 * menu item, it closes the current page's submenu and opens the other.
 *
 * Only operates if the current menu item is defined (so not on the homepage).
 *
 * slideToggle prevents moving to vanilla JS.
 *
 * @link 	http://quagliero.github.io/posts/js/look-ma-no-jquery/
 */

( function( $ ) {

	var parents, submenus, clickers, i, len, checkclass;

	parents = document.querySelectorAll( '.menu-item-has-children' );
	if ( ! parents ) { return; }

	len = parents.length;
	if ( 0 >= len ) { return; }

	checkclass = 'open';

	function showSubmenu( event ) {

		event.preventDefault();

		var parent = this.parentNode;
		var submenu = parent.querySelector( '.wrap-submenu' );

		submenu.classList.toggle( 'closed' );
		parent.classList.toggle( checkclass );

		if ( -1 !== this.className.indexOf( checkclass ) ) {

			this.innerHTML = '-';

		} else {

			this.innerHTML = '+';

		}

	} // showSubmenu()

	for ( i = 0; i < len; i++ ) {

		var parent = parents[i];
		var clicker = parent.querySelector( '.show-hide' );

		enquire.register( 'screen and (max-width: 1023px)' , {
			match: function() {

				if ( 0 <= parent.className.indexOf( checkclass ) ) { return; }

				clicker.addEventListener( 'click', showSubmenu	);

			}
		}); // enquire

	} // for

} )( jQuery );
