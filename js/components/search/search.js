const search = ( $ ) => {
	const $searchIcon = $( '.site-search' );

	if ( $searchIcon.length === 0 ) {
		return;
	}
	$searchIcon.on( 'click', function () {
		console.log( 'click' );
	} );
};

export { search };
