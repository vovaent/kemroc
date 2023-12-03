const faq = ( $ ) => {
	const faqItemClass = 'faq__item';
	const faqItemSelector = `.${ faqItemClass }`;
	const $faqItem = $( faqItemSelector );

	if ( $faqItem.length === 0 ) {
		return;
	}

	const collapseItem = () => {
		$faqItem.removeClass( `${ faqItemClass }--extended` );
	};

	const extendItem = ( $thisItem, thisItemIsExtended = false ) => {
		if ( thisItemIsExtended ) {
			return;
		}

		$thisItem.addClass( `${ faqItemClass }--extended` );
	};

	const faqItemClickHandler = ( $thisItem ) => {
		const thisItemIsExtended = $thisItem.hasClass(
			`${ faqItemClass }--extended`
		);

		collapseItem();
		extendItem( $thisItem, thisItemIsExtended );
	};

	$faqItem.on( 'click', function () {
		faqItemClickHandler( $( this ) );
	} );
};

export { faq };
