/* global searchAjax */
/* eslint no-undef: "error" */

const search = ( $ ) => {
	const $searchArea = $( '.search-area' );
	const $headerSearchFormField = $( '.search-form__field', '.header' );
	const searchAreaResultWrapperSelector = '.search-area__result-wrapper';
	const $resultsSearchFormField = $(
		'.search-form__field',
		'.search-results'
	);
	const resultsResultWrapperSelector = '.search-results__result-wrapper';
	const $noResultsSearchFormField = $(
		'.search-form__field',
		'.search-no-results'
	);
	const noResultsResultWrapperSelector = '.search-no-results__result-wrapper';

	const minLength = 3;
	const autocompleteOptions = {
		delay: 500,
		minLength,
		source: ( request, response ) => ajaxRequest( request, response ),
		select: ( event, ui ) => goToPost( event, ui ),
	};
	const headerAutocompleteOptions = {
		...autocompleteOptions,
		appendTo: searchAreaResultWrapperSelector,
		position: {
			of: $( searchAreaResultWrapperSelector ),
			using( hash, params ) {
				params.element.top = 0;
				params.element.left = 0;
				params.element.width = '100%';
			},
		},
		open() {
			$( searchAreaResultWrapperSelector ).fadeIn();
		},
		close() {
			$( searchAreaResultWrapperSelector ).hide();
		},
	};
	const resultsAutocompleteOptions = {
		...autocompleteOptions,
		appendTo: resultsResultWrapperSelector,
		position: {
			of: $( resultsResultWrapperSelector ),
			using( hash, params ) {
				params.element.top = 0;
				params.element.left = 0;
				params.element.width = '100%';
			},
		},
		open() {
			$( resultsResultWrapperSelector ).fadeIn();
		},
		close() {
			$( resultsResultWrapperSelector ).hide();
		},
	};

	const noResultsAutocompleteOptions = {
		...autocompleteOptions,
		appendTo: noResultsResultWrapperSelector,
		position: {
			of: $( noResultsResultWrapperSelector ),
			using( hash, params ) {
				params.element.top = 0;
				params.element.left = 0;
				params.element.width = '100%';
			},
		},
		open() {
			$( noResultsResultWrapperSelector ).fadeIn();
		},
		close() {
			$( noResultsResultWrapperSelector ).hide();
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
				} else {
					response( resp );
				}
			},
		} );
	};

	const goToPost = ( event, ui ) => {
		window.location = ui.item.url;
	};

	const fieldOnFocusHandler = function ( elField, options ) {
		if ( elField.value.length > minLength ) {
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
			$( this ).autocomplete( headerAutocompleteOptions );
		} );

		$headerSearchFormField.on( 'focus', function () {
			fieldOnFocusHandler( this, headerAutocompleteOptions );
		} );

		$resultsSearchFormField.on( 'input', function () {
			$( this ).autocomplete( resultsAutocompleteOptions );
		} );

		$resultsSearchFormField.on( 'focus', function () {
			fieldOnFocusHandler( this, resultsAutocompleteOptions );
		} );

		$noResultsSearchFormField.on( 'input', function () {
			$( this ).autocomplete( noResultsAutocompleteOptions );
		} );

		$noResultsSearchFormField.on( 'focus', function () {
			fieldOnFocusHandler( this, noResultsAutocompleteOptions );
		} );
	};

	searchAreaHandler();
	modificationUiAutocomplete();
	inputFieldHandler();
};

export { search };
