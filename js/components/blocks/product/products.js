import { GetPostsAjax } from '../modules/GetPostsAjax';

const products = ( $ ) => {
	/* global parentPageIdGlobal, postsPerPageGlobal, pageNumberGlobal, pageSlugGlobal, productsObject */
	/* eslint no-undef: "error" */

	const $productsListSkeletons = $( '.products__list--skeletons' );
	const $productsListOriginal = $( '.products__list--original' );
	const $productsNavigation = $( '.products__navigation' );

	if ( $productsListOriginal.length === 0 ) {
		return;
	}

	let postsPerPage = 16;

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

	const getPostsAjax = new GetPostsAjax( {
		els: {
			$original: $productsListOriginal,
			$skeleton: $productsListSkeletons,
			$navigation: $productsNavigation,
		},
		data: {
			action: 'products_action',
			nonce: productsObject.nonce,
			parent_page_id: parentPageIdGlobal,
			page_slug: pageSlug,
			posts_per_page: postsPerPage,
			page_number: pageNumber,
		},
		ajaxOptions: {
			url: productsObject.url,
		},
	} );

	getPostsAjax.load();
};

export { products };
