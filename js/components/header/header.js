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
		const isScrollDown = st > lastScrollTop;

		if ( isScrollDown ) {
			const headerIsScrolled = st > $header.height();

			if ( headerIsScrolled ) {
				if ( ! $header.hasClass( 'header--translate-to-up' ) ) {
					$header.addClass( 'header--translate-to-up' );
					$document.trigger( 'headerIsHidden' );
				}
			}
		} else {
			$header.removeClass( 'header--translate-to-up' );
			$document.trigger( 'headerIsVisible' );
		}
		lastScrollTop = st;
	};

	$window.scroll( windowScrollHandler );
};

export { header };
