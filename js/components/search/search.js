/* global searchAjax */
/* eslint no-undef: "error" */

const search = ( $ ) => {
	const $searchArea = $( '.search-area' );
	const $headerSearchFormField = $(
		'.search-form__field',
		'.search-form--on-header'
	);
	const $resultsSearchFormField = $(
		'.search-form__field',
		'.search-form--on-page'
	);

	const wrapperOnHeaderSelector =
		'.search-form--on-header .search-form__result-wrapper';
	const $wrapperOnHeader = $( wrapperOnHeaderSelector );

	const wrapperOnPageSelector =
		'.search-form--on-page .search-form__result-wrapper';
	const $wrapperOnPage = $( wrapperOnPageSelector );

	const autocompleteOptions = {
		delay: 500,
		minLength: 3,
		source: ( request, response ) => ajaxRequest( request, response ),
		select: ( event, ui ) => goToPost( event, ui ),
	};
	const autocompleteOnHeaderOptions = {
		...autocompleteOptions,
		appendTo: wrapperOnHeaderSelector,
		position: {
			of: $wrapperOnHeader,
			using( hash, params ) {
				params.element.top = 0;
				params.element.left = 0;
				params.element.width = '100%';
			},
		},
		open() {
			$wrapperOnHeader.fadeIn();
		},
		close() {
			$wrapperOnHeader.hide();
		},
	};
	const autocompleteOnPageOptions = {
		...autocompleteOptions,
		appendTo: wrapperOnPageSelector,
		position: {
			of: $wrapperOnPage,
			using( hash, params ) {
				params.element.top = 0;
				params.element.left = 0;
				params.element.width = '100%';
			},
		},
		open() {
			$wrapperOnPage.fadeIn();
		},
		close() {
			$wrapperOnPage.hide();
		},
	};

	const modificationUiAutocomplete = () => {
		$.widget( 'ui.autocomplete', $.ui.autocomplete, {
			_renderItem( ul, item ) {
				$( ul ).addClass( 'search-result-list' );

				const $searchCardText = $( '<div>', {
					class: 'search-card__text',
				} )
					.append( item.value )
					.append( item.excerpt )
					.append( item.more );

				item.value = item.label;

				return $( '<li>', {
					class: 'search-result-list__item',
				} )
					.addClass( 'search-card search-card--wide' )
					.append( item.thumb )
					.append( $searchCardText )
					.appendTo( ul );
			},
		} );
	};

	const searchIconClickHandler = () => {
		if ( $searchArea.length === 0 ) {
			return;
		}
		if ( $headerSearchFormField.length === 0 ) {
			return;
		}

		$searchArea.fadeIn();
		$headerSearchFormField.focus();
	};

	const searchAreaHandler = () => {
		const $searchIcon = $( '.site-search' );
		const $searchAreaClose = $( '.search-area__close' );

		if ( $searchIcon.length === 0 ) {
			return;
		}

		if ( $searchAreaClose.length === 0 ) {
			return;
		}

		$searchIcon.on( 'click', searchIconClickHandler );
		$searchAreaClose.on( 'click', () => $searchArea.fadeOut() );
	};

	const ajaxRequest = ( request, response ) => {
		if ( request === '' || typeof searchAjax === 'undefined' ) {
			return;
		}

		let rqstTerm = request.term;

		if ( rqstTerm.length > 500 ) {
			rqstTerm = rqstTerm.substr( 0, 500 );
		}

		$.ajax( {
			url: searchAjax.url,
			data: {
				action: 'search_action',
				term: rqstTerm,
			},
			success( resp ) {
				if ( ! resp.success ) {
					console.log( 'error:', resp );
				} else if ( resp.data ) {
					response( resp.data );
				}
			},
		} );
	};

	const goToPost = ( event, ui ) => {
		window.location = ui.item.url;
	};

	const fieldOnFocusHandler = function ( elField, options ) {
		if ( elField.value.length > autocompleteOptions.minLength ) {
			const $this = $( elField );
			const autocompeteIsInit =
				typeof $this.autocomplete( 'instance' ) !== 'undefined';

			elField.setSelectionRange(
				elField.value.length,
				elField.value.length
			);

			if ( autocompeteIsInit ) {
				$this.autocomplete( 'search' );
			} else {
				$this.autocomplete( options );
				$this.autocomplete( 'search' );
			}

			$this.autocomplete( 'widget' ).show();
		}
	};

	const inputFieldHandler = () => {
		$headerSearchFormField.on( 'input', function () {
			$( this ).autocomplete( autocompleteOnHeaderOptions );
		} );

		$headerSearchFormField.on( 'focus', function () {
			fieldOnFocusHandler( this, autocompleteOnHeaderOptions );
		} );

		$resultsSearchFormField.on( 'input', function () {
			$( this ).autocomplete( autocompleteOnPageOptions );
		} );

		$resultsSearchFormField.on( 'focus', function () {
			fieldOnFocusHandler( this, autocompleteOnPageOptions );
		} );
	};

	searchAreaHandler();
	modificationUiAutocomplete();
	inputFieldHandler();
};

export { search };
