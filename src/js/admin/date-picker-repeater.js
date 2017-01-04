/**
 * Initialize the Jquery UI Date Picker
 *
 * Triggers from either entering the field or clicking the calendar icon.
 */
(function( $ ) {

	'use strict';

	/**
	 * Find each image uploader parent element.
	 */
	var repeaters = document.querySelectorAll( '.repeaters' );
	var insertedNodes = [];

	/**
	 * Returns the event target.
	 *
	 * @param 		object 		event 		The event.
	 * @return 		object 		target 		The event target.
	 */
	function getEventTarget( event ) {

		event = event || window.event;

		return event.target || event.srcElement;

	} // getEventTarget()

	/**
	 * Processes the event and call the correct
	 * action based on the event target.
	 *
	 * @param 		object 		event 		The event.
	 */
	function processEvent( event ) {

		var target = getEventTarget( event );

		event.stopPropagation();
		event.cancelBubble = true;

		if ( target.matches( '[data-pick="date"]' ) ) {

			target.classList.remove( 'hasDatepicker' );

			console.log( target );

			$( target ).datepicker({
				changeMonth: true,
				changeYear: true,
				showButtonPanel: true
			});

			console.log( target );

		}

	/*	if ( target.matches( '.date-field-icon' ) ) {

			$( target ).on( 'click', function(){
				$( '[data-pick="date"]:not([disabled="disabled"])' ).datepicker( 'show' );
			});

		}*/

	} // processEvent()

	var observer = new MutationObserver( function( mutations ) {

		mutations.forEach( function( mutation ) {

			if ( 'childList' !== mutation.type ) { return; }

			for (var i = 0; i < mutation.addedNodes.length; i++) {

				insertedNodes.push( mutation.addedNodes[i] );

			};

		});

	});

	// configuration of the observer:
	var config = { attributes: true, childList: true, characterData: true };

	observer.observe( document, config );

	/**
	 * Checks if the nodes are empty and if not, sets event
	 * listeners on each node.
	 *
	 * @param 		object 		nodes 		A list of nodes.
	 */
	function setRepeaterEvents( nodes ) {

		if ( ! nodes || 0 >= nodes.length ) { return; }

		observer.observe( document, config );

		console.log( insertedNodes );

		for ( var n = 0; n < insertedNodes.length; n++ ) {

			observer.observe( nodes[n], config );

			//nodes[n].addEventListener( 'DOMNodeInserted', processEvent );

		}

	} // setRepeaterEvents()

	/**
	 * Set the events for each node found.
	 */
	setRepeaterEvents( repeaters );

})( jQuery );
