import { GetPostsAjax } from '../modules/GetPostsAjax';
import { FilterBtn } from '../modules/FilterBtn';

const allNews = ( $ ) => {
	/* global postsPerPageGlobal, pageNumberGlobal, pageSlugGlobal, allNewsAjax */
	/* eslint no-undef: "error" */

	const $articlesListSkeleton = $( '.all-news__list-skeletons' );
	const $articlesListOriginal = $( '.all-news__list-original' );
	const $articlesNavigation = $( '.all-news__navigation' );

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
			action: 'all_news_action',
			nonce: allNewsAjax.nonce,
			page_slug: pageSlug,
			posts_per_page: postsPerPage,
			page_number: pageNumber,
		},
		categoriesFilter: true,
		ajaxOptions: {
			url: allNewsAjax.url,
		},
	} );

	const categoriesFilterHandler = () => {
		const $catItems = $( '.all-news__categories-item' );

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

export { allNews };
