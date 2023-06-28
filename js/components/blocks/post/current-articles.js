import { GetPostsAjax } from '../modules/GetPostsAjax';
import { FilterBtn } from '../modules/FilterBtn';

const currentArticles = ( $ ) => {
	/* global postsPerPageGlobal, pageNumberGlobal, pageSlugGlobal, currentArticlesObject */
	/* eslint no-undef: "error" */

	const $articlesListSkeleton = $( '.current-articles__list-skeletons' );
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

	const getPostsAjax = new GetPostsAjax( {
		els: {
			$original: $articlesListOriginal,
			$skeleton: $articlesListSkeleton,
			$navigation: $articlesNavigation,
		},
		data: {
			action: 'current_articles_action',
			nonce: currentArticlesObject.nonce,
			page_slug: pageSlug,
			posts_per_page: postsPerPage,
			page_number: pageNumber,
		},
		categoriesFilter: true,
		ajaxOptions: {
			url: currentArticlesObject.url,
		},
	} );

	const categoriesFilterHandler = () => {
		const $catItems = $( '.current-articles__categories-item' );

		if ( $catItems.length === 0 ) {
			return;
		}

		$catItems.on( 'click', function () {
			const $this = $( this );
			const $filterBtnThis = $( FilterBtn.selector, $this );

			if ( $filterBtnThis.hasClass( FilterBtn.classActive ) ) {
				return;
			}

			FilterBtn.$btns.removeClass( FilterBtn.classActive );
			$filterBtnThis.addClass( FilterBtn.classActive );
			$filterBtnThis.addClass( FilterBtn.classActive );

			getPostsAjax.data.cat = $this.data( 'term-id' );
			getPostsAjax.data.page_number = 1;
			getPostsAjax.load();
		} );
	};

	getPostsAjax.load();
	categoriesFilterHandler();
};

export { currentArticles };
