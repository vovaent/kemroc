/* global searchAjax */
/* eslint no-undef: "error" */

const search = ( $ ) => {
	const $searchArea = $( '.search-area' );
	const $searchFormField = $( '.search-form__field' );
	const searchAreaResultWrapperSelector = '.search-area__result-wrapper';

	const searchIconClickHandler = () => {
		if ( $searchArea.length === 0 ) {
			return;
		}
		if ( $searchFormField.length === 0 ) {
			return;
		}

		$searchArea.fadeIn();
		$searchFormField.focus();
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

	const autocompleteHandler = function ( $inputField ) {
		$.widget( 'ui.autocomplete', $.ui.autocomplete, {
			_renderItem( ul, item ) {
				$( ul ).addClass( 'search-area__result-list' );

				const $searchCardText = $( '<div>', {
					class: 'search-card__text',
				} )
					.append( item.value )
					.append( item.excerpt )
					.append( item.more );

				item.value = item.label;

				return $( '<li>', {
					class: 'search-area__result-item',
				} )
					.addClass( 'search-card' )
					.append( item.thumb )
					.append( $searchCardText )
					.appendTo( ul );
			},
		} );

		$inputField.autocomplete( {
			delay: 500,
			appendTo: searchAreaResultWrapperSelector,
			minLength: 3,
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
			source: ( request, response ) => ajaxRequest( request, response ),
			select: ( event, ui ) => goToPost( event, ui ),
		} );
	};

	const onInputHandler = function () {
		autocompleteHandler( $( this ) );
	};

	const inputFieldHandler = () => {
		$searchFormField.on( 'input', onInputHandler );
	};

	searchAreaHandler();
	inputFieldHandler();
};

export { search };
