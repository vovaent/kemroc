import { FilterBtn } from '../modules/FilterBtn';

const applicationAreasFilter = ( $ ) => {
	const $areaItems = $( '.application-areas-filter__areas-item' );
	const $modelItems = $( '.application-areas-filter__model-item' );

	if ( 0 === $areaItems.length ) {
		return;
	}

	$areaItems.on( 'click', function () {
		const $this = $( this );
		const $filterBtnThis = $( FilterBtn.selector, $this );

		if ( $filterBtnThis.hasClass( FilterBtn.classActive ) ) {
			return;
		}

		FilterBtn.$btns.removeClass( FilterBtn.classActive );
		$filterBtnThis.addClass( FilterBtn.classActive );

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
