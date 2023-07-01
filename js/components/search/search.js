import 'jquery-autocomplete';
import 'jquery-autocomplete/jquery.autocomplete.css';

/* global searchAjax */
/* eslint no-undef: "error" */

const search = ( $ ) => {
	const searchAreaHandler = () => {
		const $searchIcon = $( '.site-search' );
		const $searchArea = $( '.search-area' );
		const $searchAreaClose = $( '.search-area__close' );

		if ( $searchIcon.length === 0 ) {
			return;
		}

		$searchIcon.on( 'click', () => $searchArea.fadeIn() );
		$searchAreaClose.on( 'click', () => $searchArea.fadeOut() );
	};

	const ajaxRequest = ( request, response ) => {
		if ( request === '' || typeof searchAjax === 'undefined' ) {
			return;
		}
		console.log( request );
		$.ajax( {
			url: searchAjax.url,
			data: {
				action: 'search_action',
				term: request.term,
			},
			success( data ) {
				console.log( { data } );
				response( data );
			},
		} );
	};

	const goToPost = ( event, ui ) => {
		console.log( { ui } );
		window.location = ui.item.url;
	};

	const autocompleteHandler = function ( $inputField ) {
		$inputField.autocomplete( {
			delay: 500,
			appendTo: 'search-area__result-list',
			minLength: 3,
			source: ( request, response ) => ajaxRequest( request, response ),
			select: ( event, ui ) => goToPost( event, ui ),
		} );
	};

	const onInputHandler = function () {
		// setTimeout( () => autocompleteHandler( $( this ) ), 2000 );
		autocompleteHandler( $( this ) );
	};

	const inputFieldHandler = () => {
		const $searchFormField = $( '.search-form__field' );

		if ( $searchFormField.length === 0 ) {
			return;
		}

		$searchFormField.on( 'input', onInputHandler );
	};

	searchAreaHandler();
	inputFieldHandler();
};

export { search };
