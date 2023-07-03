/* global searchAjax */
/* eslint no-undef: "error" */

const search = ( $ ) => {
	const $searchArea = $( '.search-area' );
	const $headerSearchFormField = $( '.search-form__field', '.header' );
	const searchAreaResultWrapperSelector = '.search-area__result-wrapper';
	const $mainSearchFormField = $( '.search-form__field', '.site-main' );
	const searchResultsResultWrapperSelector =
		'.search-results__result-wrapper';

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
	const mainAutocompleteOptions = {
		...autocompleteOptions,
		appendTo: searchResultsResultWrapperSelector,
		position: {
			of: $( searchResultsResultWrapperSelector ),
			using( hash, params ) {
				params.element.top = 0;
				params.element.left = 0;
				params.element.width = '100%';
			},
		},
		open() {
			$( searchResultsResultWrapperSelector ).fadeIn();
		},
		close() {
			$( searchResultsResultWrapperSelector ).hide();
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

		$.ajax( {
			url: searchAjax.url,
			data: {
				action: 'search_action',
				term: request.term,
			},
			success( data ) {
				response( data );
			},
		} );
	};

	const goToPost = ( event, ui ) => {
		window.location = ui.item.url;
	};

	const autocompleteHandler = function ( $inputField, options ) {
		$inputField.autocomplete( options );
	};

	const headerFieldOnInputHandler = function () {
		autocompleteHandler( $( this ), headerAutocompleteOptions );
	};

	const mainFieldOnInputHandler = function () {
		autocompleteHandler( $( this ), mainAutocompleteOptions );
	};

	const headerFieldOnFocusHandler = function () {
		if ( this.value.length > minLength ) {
			const autocompeteIsInit =
				typeof $( this ).autocomplete( 'instance' ) !== 'undefined';

			this.setSelectionRange( this.value.length, this.value.length );

			if ( autocompeteIsInit ) {
				$( this ).autocomplete( 'search' );
			} else {
				$( this ).autocomplete( headerAutocompleteOptions );
				$( this ).autocomplete( 'search' );
			}

			$( this ).autocomplete( 'widget' ).show();
		}
	};
	const mainFieldOnFocusHandler = function () {
		if ( this.value.length > minLength ) {
			const autocompeteIsInit =
				typeof $( this ).autocomplete( 'instance' ) !== 'undefined';

			this.setSelectionRange( this.value.length, this.value.length );

			if ( autocompeteIsInit ) {
				$( this ).autocomplete( 'search' );
			} else {
				$( this ).autocomplete( mainAutocompleteOptions );
				$( this ).autocomplete( 'search' );
			}

			$( this ).autocomplete( 'widget' ).show();
		}
	};

	const inputFieldHandler = () => {
		$headerSearchFormField.on( 'input', headerFieldOnInputHandler );
		$headerSearchFormField.on( 'focus', headerFieldOnFocusHandler );
		$mainSearchFormField.on( 'input', mainFieldOnInputHandler );
		$mainSearchFormField.on( 'focus', mainFieldOnFocusHandler );
	};

	searchAreaHandler();
	modificationUiAutocomplete();
	inputFieldHandler();
};

export { search };
