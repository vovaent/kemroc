const header = ( $ ) => {
	const $header = $( '.header' );
	const $window = $( window );
	const $document = $( document );

	if ( $header.length === 0 ) {
		return;
	}

	let lastScrollTop = 0;

	const windowScrollHandler = function () {
		const st = $document.scrollTop();
		if ( st > lastScrollTop ) {
			// downscroll code
			if ( ! $header.hasClass( 'header--translate-to-up' ) ) {
				$header.addClass( 'header--translate-to-up' );
				$document.trigger( 'headerIsHidden' );
			}
		} else {
			// upscroll code
			$header.removeClass( 'header--translate-to-up' );
			$document.trigger( 'headerIsVisible' );
		}
		lastScrollTop = st;
	};

	$window.scroll( windowScrollHandler );
};

export { header };
