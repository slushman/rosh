/**
 * skip-link-focus-fix.js
 *
 * Helps with accessibility for keyboard only users.
 *
 * Learn more: https://git.io/vWdr2
 */
( function() {

	const isIe = /(trident|msie)/i.test( navigator.userAgent );

	if ( ! isIe || ! document.getElementById || ! window.addEventListener ) { return; }

	function hashChange() {

		let id = location.hash.substring( 1 );

		if ( ! ( /^[A-z0-9_-]+$/.test( id ) ) ) { return; }

		let element = document.getElementById( id );

		if ( ! element ) { return; }

		if ( ! ( /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) ) {
			element.tabIndex = -1;
		}

		element.focus();

	} // hashChange()

	window.addEventListener( 'hashchange', hashChange );

})();
