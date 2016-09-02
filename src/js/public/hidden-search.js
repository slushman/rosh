/**
 * hidden-search.js
 *
 * Handles toggling the appearnace of a hidden search field
 */
( function() {

	var index, search, page, button;

	search = document.querySelector( '#hidden-search-top' );
	if ( ! search ) { return; }

	page = document.querySelector( '#page' );
	if ( ! page ) { return; }

	button = document.querySelector( '.btn-search' );
	if ( ! button ) { return; }

	search.setAttribute( 'aria-hidden', 'true' );

	button.onclick = function( e ) {

		e.preventDefault();

		search.classList.toggle( 'open' );

		if ( -1 !== search.className.indexOf( 'open' ) ) {

			search.setAttribute( 'aria-hidden', 'true' );

		} else {

			search.setAttribute( 'aria-hidden', 'false' );

		}

		var affected = [ page, button ];

		for	( index = 0; index < affected.length; index++ ) {

			affected[index].classList.toggle( 'open' );

		}

	};

} )();
