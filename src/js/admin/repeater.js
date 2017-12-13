/**
 * Handles all the functionality for repeating field groups:
 * 		Add new.
 * 		Remove.
 * 		Collapse.
 * 		Change title.
 */
(function( $ ) {
	'use strict';

	const allRepeaters = document.querySelectorAll( '.repeaters' );
	if ( ! allRepeaters ) { return; }

	function addID( clone ) {

		let id 			= generateID();
		let inputs 		= clone.querySelectorAll( '[disabled="disabled"]' );
		let hidden 		= clone.querySelector( '[id="_repeater_uid"]' );
		hidden.value 	= id;

		resetAttribute( clone, 'id', id );

		for ( let i = 0; i < inputs.length; i++ ) {

			resetAttribute( inputs[i], 'name', id );
			resetAttribute( inputs[i], 'id', id );
			resetLabel( inputs[i], id );

		} // for

	} // addID()

	/**
	 * Changes the title of the repeatable item to the text
	 * from the target field.
	 *
	 * @param 		object 		repeater 		The repeater set object.
	 * @param 		object 		event 			The event.
	 * @param 		object 		target 			The event target.
	 */
	function changeTitle( repeater, event, target ) {

		let repeatedItem 	= getParent( target, 'repeater' );
		let fieldval 		= target.value;
		let title 			= repeatedItem.querySelector( '.title-repeater' );
		let titleField 		= repeatedItem.querySelector( '[data-title="repeater-title"]' );

		if ( 0 < fieldval.length ) {

			title.textContent = fieldval;
			titleField.value = fieldval;

		}

	} // changeTitle()

	/**
	 * Clones a repeatable item.
	 *
	 * @param 		object 		repeater 		The repeater set object.
	 * @param 		object 		event 			The event.
	 * @param 		object 		target 			The event target.
	 */
	function cloneRepeater( repeater, event, target ) {

		event.preventDefault();

		let hidden = repeater.querySelector( '.hidden-repeater' );
		let clone = hidden.cloneNode( true );

		clone.classList.remove( 'hidden' );
		clone.classList.remove( 'hidden-repeater' );
		addID( clone );
		removeDisabled( clone );
		repeater.insertBefore( clone, hidden );

	} // cloneRepeater()

	/**
	 * Collapses the content of a repeatable item.
	 *
	 * @param 		object 		repeater 		The repeater set object.
	 * @param 		object 		event 			The event.
	 * @param 		object 		target 			The event target.
	 */
	function collapseRepeater( repeater, event, target ) {

		let repeatedItem = getParent( target, 'repeater' );
		let content = repeatedItem.querySelector( '.repeater-content' );
		let handle = repeatedItem.querySelector( '.repeater-handle' );

		content.classList.toggle( 'hide' );
		target.classList.toggle( 'repeater-toggle-arrow-closed' );
		handle.classList.toggle( 'closed' );

	} // collapseRepeater()

	/**
	 * Generates a unique ID based on the time.
	 * @return 		string 		Unique ID.
	 */
	function generateID() {

		let d = new Date().getTime();

		if ( window.performance && typeof window.performance.now === "function" ) {

			d += performance.now(); //use high-precision timer if available

		}

		let uuid = 'xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {

			let r = ( d + Math.random() * 16 ) % 16 | 0;
			d = Math.floor( d / 16 );

			return ( c == 'x' ? r : ( r&0x3 | 0x8 ) ).toString( 16 );

		});

		return uuid;

	} // generateID()

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
	 * Returns the parent node with the requested class.
	 *
	 * This is recursive, so it will continue up the DOM tree
	 * until the correct parent is found.
	 *
	 * @param 		object 		el 				The node element.
	 * @param 		string 		className 		Name of the class to find.
	 * @return 		object 						The parent element.
	 */
	function getParent( el, className ) {

		let parent = el.parentNode;

		if ( '' !== parent.classList && parent.classList.contains( className ) ) {

			return parent;

		}

		return getParent( parent, className );

	} // getParent()

	/**
	 * Processes the event and call the correct
	 * action based on the event target.
	 *
	 * @param 		object 		event 		The event.
	 */
	function processEvent( event ) {

		let target = getEventTarget( event );

		event.stopPropagation();
		event.cancelBubble = true;

		if ( target.matches( '#add-repeater' ) ) {

			cloneRepeater( this, event, target );

		}

		if ( target.matches( '.link-remove' ) ) {

			removeRepeater( this, event, target );

		}

		if ( target.matches( '.toggle-arrow' ) ) {

			collapseRepeater( this, event, target);

		}

		if ( target.matches( '.repeater-title' ) ) {

			changeTitle( this, event, target );

		}

	} // processEvent()

	/**
	 * Removes the disabled attribute on newly cloned repeaters.
	 *
	 * @param 		object 		clone 		A newly cloned repeater.
	 */
	function removeDisabled( clone ) {

		let fields = clone.querySelectorAll( '[disabled="disabled"]' );

		for ( let f = 0; f < fields.length; f++ ) {

			fields[f].removeAttribute( 'disabled' );

		}

	} // removeDisabled()

	/**
	 * Removes the repeated item.
	 *
	 * @param 		object 		repeater 		The repeater set object.
	 * @param 		object 		event 			The event.
	 * @param 		object 		target 			The event target.
	 */
	function removeRepeater( repeater, event, target ) {

		event.preventDefault();

		let repeatedItem = getParent( target, 'repeater' );

		if ( ! repeatedItem.classList.contains( 'first' ) ) {

			repeater.removeChild( repeatedItem );

		}

	} // removeRepeater()

	/**
	 * Replaces the "hidden" text with an attribute.
	 *
	 * @param 		obj 		element 		The element.
	 * @param 		string 		attribute 		The attribute name.
	 * @param 		string 		newValue 		The new value for the attribute.
	 */
	function resetAttribute( element, attribute, newValue ) {

		let oldAtt = element.getAttribute( attribute );
		if ( ! oldAtt ) { return; }

		let newAtt = oldAtt.replace( 'hidden', newValue );

		element.setAttribute( attribute, newAtt );

	} // resetAttribute()

	/**
	 * Replaces the "hidden" text with the for attribute on the label.
	 *
	 * @param 		obj 		element 		The element.
	 * @param 		string 		newValue 		The new value for the attribute.
	 */
	function resetLabel( element, newValue ) {

		let parent = getParent( element, 'wrap-field' );
		if ( ! parent ) { return; }

		let label = parent.querySelector( 'label' );
		if ( ! label ) { return; }

		resetAttribute( label, 'for', newValue );

	} // resetLabel()

	/**
	 * Checks if repeaters is empty and if not, sets event
	 * listeners on each node.
	 *
	 * @param 		object 		repeaters 		A list of nodes.
	 */
	function setEvents( repeaters ) {

		if ( ! repeaters || 0 >= repeaters.length ) { return; }

		for ( let n = 0; n < repeaters.length; n++ ) {

			repeaters[n].addEventListener( 'click', processEvent );
			repeaters[n].addEventListener( 'keyup', processEvent );

		}

	} // setEvents()

	/**
	 * Sets the events on each repeater found.
	 */
	setEvents( allRepeaters );

	/**
	 * Makes the repeaters sortable.
	 */
	$(function() {

		$( '.repeaters' ).sortable({
			cursor: 'move',
			handle: '.repeater-handle',
			items: '.repeater',
			opacity: 0.6,
		});

	});

})( jQuery );
