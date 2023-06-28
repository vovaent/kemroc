const navigation = ( $ ) => {
	$( '.header.mobile .main-navigation li' ).each( function () {
		const backTitle = $( this ).find( '>:first-child' ).text();
		$(
			'<li class="nav-back"><span class="back-btn">' +
				backTitle +
				'</span><button class="toggle-nav"></button></li>'
		).insertBefore( $( this ).find( '.sub-menu > li:first-child' ) );
		$( $( this ).find( '.sub-menu > li:not(:first-child)' ) ).wrapAll(
			'<div class="sub-menu__items-wrapper"></div>'
		);
	} );
	$( document ).on( 'click', '.toggle-nav', function ( e ) {
		e.preventDefault();
		if ( $( '.header.mobile' ).hasClass( 'nav-active' ) ) {
			$( '.header.mobile' ).removeClass( 'nav-active' );
		} else {
			$( '.header.mobile' ).addClass( 'nav-active' );
		}
	} );
	$( document ).on(
		'click',
		'.header.mobile .nav-back .back-btn',
		function ( e ) {
			e.preventDefault();
			$( this ).parents( '.sub-menu' ).removeClass( 'active' );
		}
	);
	$( document ).on( 'click', '.header.mobile li > a', function ( e ) {
		e.preventDefault();
		$( this ).next( '.sub-menu' ).addClass( 'active' );
	} );
};

export { navigation };
