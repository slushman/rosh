/**
 * customizer.js
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */
( function( $ ) {

	/**
	 * AlterClass function by Pete Boere.
	 *
	 * @link https://gist.github.com/peteboere/1517285
	 * @param 		string 		removals 		Classses to remove.
	 * @param 		string 		additions 		Classes to add.
	 * @return 		string 						Classes for an element.
	 */
	$.fn.alterClass = function ( removals, additions ) {

		var self = this;

		if ( removals.indexOf( '*' ) === -1 ) {
			// Use native jQuery methods if there is no wildcard matching
			self.removeClass( removals );
			return !additions ? self : self.addClass( additions );
		}

		var patt = new RegExp( '\\s' +
				removals.
					replace( /\*/g, '[A-Za-z0-9-_]+' ).
					split( ' ' ).
					join( '\\s|\\s' ) +
				'\\s', 'g' );

		self.each( function ( i, it ) {
			var cn = ' ' + it.className + ' ';
			while ( patt.test( cn ) ) {
				cn = cn.replace( patt, ' ' );
			}
			it.className = $.trim( cn );
		});

		return !additions ? self : self.addClass( additions );
	};

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );

	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title, .site-description' ).css( {
					'color': to,
				} );
			}
		} );
	} );

	// Tablet Menu Style
	wp.customize( 'tablet_menu', function( value ) {

		value.bind( function( to ){

			$('body').alterClass( 'tablet-*' );

			var tabletClass;

			switch( to ) {

				case 'tablet-slide-ontop-from-left': 	tabletClass = 'tablet-slide tablet-slide-sides tablet-slide-ontop-from-left'; break;
				case 'tablet-slide-ontop-from-right': 	tabletClass = 'tablet-slide tablet-slide-sides tablet-slide-ontop-from-right'; break;
				case 'tablet-slide-ontop-from-top': 	tabletClass = 'tablet-slide tablet-slide-topbot tablet-slide-ontop-from-top'; break;
				case 'tablet-slide-ontop-from-bottom': 	tabletClass = 'tablet-slide tablet-slide-topbot tablet-slide-ontop-from-bottom'; break;
				case 'tablet-push-from-left': 			tabletClass = 'tablet-push tablet-push-from-left'; break;
				case 'tablet-push-from-right': 			tabletClass = 'tablet-push tablet-push-from-right'; break;
				default: 								tabletClass = ''; break;

			}

			console.log( tabletClass );

			$('body').addClass( tabletClass );

		});
	} );



/*
	wp.customize( 'text_field', function( value ) {
		value.bind( function( to ) {
			$( '.entry-title' ).text( to );
		} );
	} );

	// Doesn't work instantly, works after you go out of the field
	wp.customize( 'url_field', function( value ) {
		value.bind( function( to ) {
			$( '.entry-title a' ).attr( 'href', to );
		} );
	} );

	// Doesn't work instantly, works after you go out of the field
	wp.customize( 'email_field', function( value ) {
		value.bind( function( to ) {
			$( '.entry-title' ).text( to );
			//$( '.entry-title a' ).attr( 'href', 'mailto:'+to );
		} );
	} );

	wp.customize( 'date_field', function( value ) {
		value.bind( function( to ) {
			$( '.entry-date' ).text( to );
		} );
	} );

	wp.customize( 'checkbox_field', function( value ) {
		value.bind( function( to ) {
			$( '.entry-date' ).style.display( 'none' );
			if ( to ) {

			}
		} );
	} );

	wp.customize( 'color_field', function( value ) {
		value.bind( function( to ) {
			$( '.color_field' ).css( {
				'color': to,
			} );
		} );
	} );

	wp.customize( 'image_field', function( value ) {
		value.bind( function( to ) {
			$( '.image_field' ).css( {
				'color': to,
			} );
		} );
	} );
*/
} )( jQuery );
