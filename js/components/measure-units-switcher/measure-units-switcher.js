const muSwitcher = ( $ ) => {
	const $muSwitcher = $( '#mu-switcher' );
	const $muFlag = $( '.mu-flag' );
	const $muValue = $( '.mu-value' );

	if ( $muSwitcher.length === 0 ) {
		return;
	}

	$muFlag.on( 'click', function () {
		const $thisFlag = $( this );
		const thisLangCode = $thisFlag.data( 'lang-code' );
		const muFlagItemId = $thisFlag.data( 'item-id' );

		if ( typeof muFlagItemId !== 'undefined' ) {
			$( `.mu-value[data-item-id="${ muFlagItemId }"]` ).hide();
			$(
				`.mu-value[data-lang-code="${ thisLangCode }"][data-item-id="${ muFlagItemId }"]`
			).fadeIn( 200 );
		} else {
			$muValue.hide();
			$( `.mu-value[data-lang-code="${ thisLangCode }"]` ).fadeIn( 200 );
		}
	} );
};

export { muSwitcher };
