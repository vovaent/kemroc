import { FilterBtn } from './FilterBtn';

/* global jQuery */
/* eslint no-undef: "error" */
const $ = jQuery;

class GetPostsAjax {
	constructor( options ) {
		this.els = options.els;
		this.data = options.data;
		this.categoriesFilter = options.categoriesFilter
			? options.categoriesFilter
			: false;
		this.ajaxOptions = {
			type: 'POST',
			data: this.data,
			dataType: 'json',
			success: ( resp ) => this.ajaxSuccessHandler( resp ),
			...options.ajaxOptions,
		};
	}

	load() {
		this.els.$original.hide();
		this.els.$original.html( '' );
		this.els.$skeleton.show();

		$.ajax( this.ajaxOptions );
	}

	output( resp ) {
		if (
			typeof resp.data.posts !== 'undefined' &&
			resp.data.posts.length !== 0
		) {
			this.els.$original.html( '' );

			$.each( resp.data.posts, ( indexInArray, valueOfElement ) => {
				this.els.$original.append( $( valueOfElement ) );
			} );

			this.els.$original.css( 'display', 'grid' );
		}

		this.els.$skeleton.hide();

		if ( typeof resp.data.navigation !== 'undefined' ) {
			this.els.$navigation.html( resp.data.navigation );
			this.navigationHandler();
		}
	}

	ajaxSuccessHandler( resp ) {
		if ( ! resp.success ) {
			console.log( 'error:', resp );
		} else {
			this.output( resp );

			this.goToSectionTopHandler();
		}
	}

	navigationHandler() {
		const navigationPageNumbersClass = 'kemroc-navigation__page-numbers';
		const $navigationPageNumbers = $( '.' + navigationPageNumbersClass );

		if ( $navigationPageNumbers.length === 0 ) {
			return;
		}

		$navigationPageNumbers.on( 'click', ( event ) => {
			event.preventDefault();

			const $this = $( event.target );

			if (
				$this.hasClass( navigationPageNumbersClass + '--dots' ) ||
				$this.hasClass( navigationPageNumbersClass + '--current' )
			) {
				return;
			}

			if ( this.categoriesFilter ) {
				const $catItemsActive = $( FilterBtn.selectorActive ).parent();
				let currentCategory = $catItemsActive.data( 'term-id' );

				if ( currentCategory === 'all' ) {
					currentCategory = '';
				}

				this.data.cat = currentCategory;
			}

			this.data.page_number = $this.data( 'page-number' );
			this.load();
		} );
	}

	goToSectionTopHandler() {
		const isHomePage = $( 'body' ).hasClass( 'home' );

		if ( ! isHomePage ) {
			const scrollToPos = this.els.$section.offset().top - 180;
			const paginationIsPresent =
				$( '.kemroc-navigation__nav-links' ).length !== 0;
			const scrollPositionBelowSection =
				$( document ).scrollTop() > scrollToPos;

			if ( paginationIsPresent && scrollPositionBelowSection ) {
				$( 'html, body' ).animate( { scrollTop: scrollToPos }, 500 );
			}
		}
	}
}

export { GetPostsAjax };
