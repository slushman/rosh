/**
 * Shows/hides post format metaboxes based on the selected format.
 */
( function() {

	'use strict';

	const buttons = document.querySelectorAll( '.post-format' );
	if ( ! buttons ) { return; }

	const len = buttons.length;
	if ( 0 >= len ) { return; }

	const box = document.querySelector( '#post_format_data' );
	if ( ! box ) { return; }

	/**
	 * Hide the Post Format Metabox if the current
	 * post format is not selected.
	 */
	const checked = document.querySelector( '.post-format[checked]' );
	const valid = [ 'audio', 'image', 'link', 'video' ];

	if ( 0 > valid.indexOf( checked.value ) ) {

		box.classList.add( 'hide' );

	}

	/**
	 * Shows the correct post format metabox and hides the others.
	 */
	function showFormat() {

		let others = document.querySelectorAll( '.post-format-field:not( #post_format_' + this.value + ' )' );
		let field = document.querySelector( '#post_format_' + this.value );
		let otherslen = others.length;

		if ( 0 < otherslen ) {

			for ( let j = 0; j < otherslen; j++ ) {

				others[j].classList.add( 'hide' );

			}

		}

		if ( ! field ) {

			box.classList.add( 'hide' );
			return;

		}

		box.classList.remove( 'hide' );
		field.classList.remove( 'hide' );

	}

	for ( let i = 0; i < len; i++ ) {

		let button = buttons[i];
		let field = document.querySelector( '#post_format_' + button.value );

		button.addEventListener( 'click', showFormat );

	}

})();
