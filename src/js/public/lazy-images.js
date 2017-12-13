/**
 * Lazy loads all images using the IntersectionObserver API.
 *
 * Images need to have the image src in a data-src attribute and
 * the lazy-image class.
 *
 * @link 		https://deanhume.com/Home/BlogPost/lazy-loading-images-using-intersection-observer/10163
 */
( function() {

	const images = document.querySelectorAll( '.lazy-image' );

	const config = {
		rootMargin: '50px 0px',
		threshold: 0.01
	};

	/**
	 * Stops observing images already loaded in the viewport.
	 *
	 * @param 		array 		entries 		Array of images.
	 */
	function onIntersection( entries ) {

		for ( let i = 0; i < entries.length; i++ ) {

			if ( entries[i].intersectionRaiot > 0 ) {

				observer.unobserve( entries[i].target );

				preloadImage( entries[i].target );

			}

		});

	} // onIntersection()

	if ( ! ( 'IntersectionObserver' in window ) ) {

		for ( let i = 0; i < images.length; i++ ) {

			preloadImage( images[i] );

		};

	} else {

		let observer = new IntersectionObserver( onIntersection, config );

		for ( let i = 0; i < images.length; i++ ) {

			observer.observe( images[i] );

		};

	}

} )();
