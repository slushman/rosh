/**
 * Adds/removes file or image to selected field.
 */
( function() {

	/**
	 * Find each image uploader parent element.
	 */
	const repeaters = document.querySelectorAll( '.repeaters' );
	const imageFields = document.querySelectorAll( '.image-upload-field' );

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
	 * Opens the Media Library window.
	 * Sets the field value.
	 * Toggles the links.
	 *
	 * @todo 		Figure out how to get rid of jQuery "on" dependency here.
	 *
	 * @param 		object 		event 			The event object
	 */
	function openMediaLibraryChooser( event, target ) {

		event.preventDefault();

		var fileFrame, json;

		let upload = target;
		let parent = upload.parentNode;
		let field = parent.querySelector( '[data-pick="image-id"]' );
		let remove = parent.querySelector( '.remove-img' );
		let preview = parent.querySelector( '.image-upload-preview' );

		if ( undefined !== fileFrame ) {

			fileFrame.open();
			return;

		}

		fileFrame = wp.media.frames.fileFrame = wp.media({
			button: {
				text: 'Choose Image',
			},
			frame: 'select',
			multiple: false,
			title: 'Choose image'
		});

		fileFrame.on( 'select', function(){ // must use jQuery here - TODO - explore options

			json = fileFrame.state().get( 'selection' ).first().toJSON(); // also jQuery

			if ( 0 >= json.id.length ) { return; }

			field.value = json.id;
			preview.style.backgroundImage = 'url( ' + json.sizes.thumbnail.url + ' )';
			preview.classList.remove( 'bordered-img-preview' );
			upload.classList.add( 'hide' );
			remove.classList.remove( 'hide' );

		});

		fileFrame.open();

	} // openMediaLibraryChooser()

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

		if ( target.matches( '.upload-img' ) ) {

			openMediaLibraryChooser( event, target );

		}

		if ( target.matches( '.remove-img' ) ) {

			removeImageFromField( event, target );

		}

	} // processEvent()

	/**
	 * Removes the field value. Toggles the links.
	 *
	 * @param 		object 		event 			The event object
	 */
	function removeImageFromField( event, target ) {

		event.preventDefault();

		let remove = target;
		let parent = remove.parentNode;
		let field = parent.querySelector( '[data-pick="image-id"]' );
		let upload = parent.querySelector( '.upload-img' );
		let preview = parent.querySelector( '.image-upload-preview' );

		field.value = '';
		preview.style.backgroundImage = '';
		preview.classList.add( 'bordered-img-preview' );
		remove.classList.add( 'hide' );
		upload.classList.remove( 'hide' );

	} // removeImageFromField()

	/**
	 * Checks if the nodes are empty and if not, sets event
	 * listeners on each node.
	 *
	 * @param 		object 		nodes 		A list of nodes.
	 */
	function setEvents( nodes ) {

		if ( ! nodes || 0 >= nodes.length ) { return; }

		for ( let n = 0; n < nodes.length; n++ ) {

			nodes[n].addEventListener( 'click', processEvent );

		}

	} // setEvents()

	/**
	 * Set the events for each node found.
	 */
	setEvents( repeaters );
	setEvents( imageFields );

})();
