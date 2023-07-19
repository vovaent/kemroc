const navigation = ( $ ) => {
	$( '.header__mobile .main-navigation li' ).each( function () {
		const backTitle = $( this ).find( '>:first-child' ).text();
		// const backTitle = 'back';

		$( $( this ).find( '>.sub-menu > li' ) ).wrapAll(
			'<div class="sub-menu__items-wrapper"></div>'
		);

		$(
			'<li class="nav-back"><span class="back-btn">' +
				backTitle +
				'</span><button class="toggle-nav"></button></li>'
		).insertBefore( $( this ).find( '.sub-menu__items-wrapper' ) );
	} );

	$( document ).on( 'click', '.toggle-nav', function ( e ) {
		e.preventDefault();
		if ( $( '.header__mobile' ).hasClass( 'nav-active' ) ) {
			$( '.header__mobile' ).removeClass( 'nav-active' );
		} else {
			$( '.header__mobile' ).addClass( 'nav-active' );
		}
	} );

	$( document ).on(
		'click',
		'.header__mobile .nav-back .back-btn',
		function ( e ) {
			e.preventDefault();
			$( $( this ).parents( '.sub-menu' )[ 0 ] ).removeClass( 'active' );
		}
	);

	$( document ).on(
		'click',
		'.header__mobile li.menu-item-has-children > a',
		function ( e ) {
			e.preventDefault();

			const $this = $( this );
			const $thisSubmenu = $this.next( '.sub-menu' );

			$thisSubmenu.addClass( 'active' );
		}
	);

	const $liHasChildren = $( '.header__mobile li.menu-item-has-children' );

	$liHasChildren.each( function () {
		const $this = $( this );
		const $thisSubMenu = $( '>.sub-menu', $this );

		const $thisSubMenuWrapper = $(
			'.sub-menu__items-wrapper li:first',
			$thisSubMenu
		);

		$this
			.clone()
			.insertBefore( $thisSubMenuWrapper )
			.removeClass( 'menu-item-has-children' )
			.addClass( 'nav-parent-page' )
			.find( '.sub-menu' )
			.remove();
	} );

	if ( ! /iPhone|iPad|iPod/i.test( navigator.userAgent ) ) {
		$( '.main-navigation li' ).hover(
			function () {
				$( this ).addClass( 'hover' );
			},
			function () {
				$( this ).removeClass( 'hover' );
			}
		);
		$( '.main-navigation li>.sub-menu' ).hover(
			function () {
				$( this ).addClass( 'hover' );
			},
			function () {
				$( this ).removeClass( 'hover' );
			}
		);
		$( '.main-navigation li>.sub-menu a' ).hover(
			function () {
				$( this ).addClass( 'hover' );
			},
			function () {
				$( this ).removeClass( 'hover' );
			}
		);
	}
};

export { navigation };
