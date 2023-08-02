import { FilterBtn } from '../modules/FilterBtn';

const applicationAreasFilter = ( $ ) => {
	const $areaItems = $( '.application-areas-filter__areas-item' );
	const $modelItems = $( '.application-areas-filter__model-item' );

	if ( 0 === $areaItems.length ) {
		return;
	}

	const hash = $( location ).prop( 'hash' ).substr( 1 );

	if ( hash.length !== 0 ) {
		$.each( $areaItems, function () {
			const $this = $( this );
			const $thisFilterBtn = $( FilterBtn.selector, $this );
			const thisTermSlug = $this.data( 'term-slug' );

			if ( thisTermSlug === hash ) {
				FilterBtn.$btns.removeClass( FilterBtn.classActive );
				$thisFilterBtn.addClass( FilterBtn.classActive );

				const scrollToPos = $areaItems.offset().top - 250;

				setTimeout( () => {
					$( 'html, body' ).animate(
						{ scrollTop: scrollToPos },
						500
					);
				}, 500 );
			}
		} );
	}

	$areaItems.on( 'click', function () {
		const $this = $( this );
		const $thisFilterBtn = $( FilterBtn.selector, $this );

		if ( $thisFilterBtn.hasClass( FilterBtn.classActive ) ) {
			return;
		}

		FilterBtn.$btns.removeClass( FilterBtn.classActive );
		$thisFilterBtn.addClass( FilterBtn.classActive );

		const areaItemThisTermId = $this.data( 'term-id' );

		if ( 0 === $modelItems.length ) {
			return;
		}

		if ( 'all' === areaItemThisTermId ) {
			$modelItems.fadeIn();
		} else {
			$modelItems.hide();

			$modelItems.each( function () {
				const $modelItemThis = $( this );
				const modelItemThisTermIds = $modelItemThis.data( 'term-ids' );
				const modelHasTermId =
					modelItemThisTermIds.indexOf( areaItemThisTermId ) !== -1;

				if ( modelHasTermId ) {
					$modelItemThis.fadeIn();
				}
			} );
		}
	} );
};

export { applicationAreasFilter };
