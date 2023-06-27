import { filterBtn } from '../modules/filter-btn';

const currentArticles = ( $ ) => {
	/* global postsPerPageGlobal, pageNumberGlobal, pageSlugGlobal, currentArticlesObject */
	/* eslint no-undef: "error" */

	const $articlesListSkeleton = $( '.current-articles__list-skeleton' );
	const $articlesListOriginal = $( '.current-articles__list-original' );
	const $articlesNavigation = $( '.current-articles__navigation' );

	if ( $articlesListOriginal.length === 0 ) {
		return;
	}

	let postsPerPage = 9;

	if ( typeof postsPerPageGlobal !== undefined ) {
		postsPerPage = postsPerPageGlobal;
	}

	let pageNumber = 1;

	if ( typeof pageNumberGlobal !== undefined ) {
		pageNumber = pageNumberGlobal;
	}

	let pageSlug = 1;

	if ( typeof pageSlugGlobal !== undefined ) {
		pageSlug = pageSlugGlobal;
	}

	if ( postsPerPage > 6 ) {
		const windowWidth = $( window ).width();

		if ( windowWidth > 739 && windowWidth < 1180 ) {
			postsPerPage = 6;
		} else if ( windowWidth < 740 ) {
			postsPerPage = 4;
		}
	}

	const articlesOutput = ( resp ) => {
		if (
			typeof resp.data.articles_list !== undefined &&
			resp.data.articles_list.length !== 0
		) {
			$articlesListOriginal.html( '' );

			$.each(
				resp.data.articles_list,
				( indexInArray, valueOfElement ) => {
					$articlesListOriginal.append( $( valueOfElement ) );
				}
			);

			$articlesListSkeleton.hide();
			$articlesListOriginal.css( 'display', 'grid' );
		}

		if ( typeof resp.data.navigation !== undefined ) {
			$articlesNavigation.html( resp.data.navigation );
			navigationHandler();
		}
	};

	const ajaxSuccessHandler = ( resp ) => {
		if ( ! resp.success ) {
			console.log( 'error:', resp );
		} else {
			articlesOutput( resp );
		}
	};

	const loadArticles = ( data ) => {
		$articlesListOriginal.hide();
		$articlesListOriginal.html( '' );
		$articlesListSkeleton.show();

		const thisData = {
			action: 'current_articles_action',
			nonce: currentArticlesObject.nonce,
			page_slug: pageSlug,
			posts_per_page: postsPerPage,
			page_number: pageNumber,
			...data,
		};

		$.ajax( {
			type: 'POST',
			url: currentArticlesObject.url,
			data: thisData,
			dataType: 'json',
			success: ( resp ) => ajaxSuccessHandler( resp ),
		} );
	};

	const categoriesFilterHandler = () => {
		const $catItems = $( '.current-articles__categories-item' );

		if ( $catItems.length === 0 ) {
			return;
		}

		$catItems.on( 'click', function () {
			const $this = $( this );
			const $filterBtnThis = $( filterBtn.selector, $this );

			if ( $filterBtnThis.hasClass( filterBtn.classActive ) ) {
				return;
			}

			filterBtn.$btns.removeClass( filterBtn.classActive );
			$filterBtnThis.addClass( filterBtn.classActive );
			$filterBtnThis.addClass( filterBtn.classActive );

			const $thisTermId = $this.data( 'term-id' );
			loadArticles( { cat: $thisTermId } );
		} );
	};

	const navigationHandler = () => {
		const navigationPageNumbersClass = 'kemroc-navigation__page-numbers';
		const $navigationPageNumbers = $( '.' + navigationPageNumbersClass );

		if ( $navigationPageNumbers.length === 0 ) {
			return;
		}

		$navigationPageNumbers.on( 'click', function ( event ) {
			event.preventDefault();

			const $this = $( this );

			if (
				$this.hasClass( navigationPageNumbersClass + '--dots' ) ||
				$this.hasClass( navigationPageNumbersClass + '--current' )
			) {
				return;
			}

			const thisPageNumber = $this.data( 'page-number' );
			const $catItemsActive = $( filterBtn.selectorActive ).parent();
			let currentCategory = $catItemsActive.data( 'term-id' );

			if ( currentCategory === 'all' ) {
				currentCategory = '';
			}

			loadArticles( {
				page_number: thisPageNumber,
				cat: currentCategory,
			} );
		} );
	};

	loadArticles();
	categoriesFilterHandler();
};

export { currentArticles };
