/**
 * Initialize the Jquery UI Time Picker
 *
 * Triggers from either entering the field or clicking the clock icon.
 *
 * Uses the Timepicker add-on by Trent Richardson.
 *
 * @link 		https://github.com/trentrichardson/jQuery-Timepicker-Addon
 */
(function( $ ) {

	'use strict';

	$( function() {

		$( '[data-pick="time"]' ).timepicker({ timeFormat: "h:mm tt"});
		$( '.time-field-icon' ).on( 'click', function(){
			$( '[data-pick="time"]' ).timepicker( 'show' );
		});

	});

})( jQuery );
