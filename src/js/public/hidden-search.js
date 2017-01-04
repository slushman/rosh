/**
 * hidden-search.js
 *
 * Handles toggling the appearance of a hidden search field
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

	/**
	 * Shows the hidden search field.
	 *
	 * @param 		object 		event 		The event.
	 * @return {[type]}       [description]
	 */
	function showSearch( event ) {

		event.preventDefault();

		search.classList.toggle( 'hidden-search-open' );

		if ( search.classList.contains( 'hidden-search-open' ) ) {

			search.setAttribute( 'aria-hidden', 'false' );

		} else {

			search.setAttribute( 'aria-hidden', 'true' );

		}

		page.classList.toggle( 'open' );
		button.classList.toggle( 'open' );

	} // showSearch()

	button.addEventListener( 'click', showSearch );

} )();
