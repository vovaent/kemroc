const currentArticles = ($) => {
	/* global page_number, max_page, posts_per_page, page_slug */
	/* eslint no-undef: "error" */

	const $articlesList = $('.current-articles__list');
	const $articlesNavigation = $('.current-articles__navigation');

	if ($articlesList.length === 0) {
		return;
	}

	const loadArticles = (postsPerPage = null) => {
		const data = {
			action: 'current_articles_action',
			nonce: current_articles_object.nonce,
			page_slug: page_slug,
		};

		if (page_number !== undefined) {
			data.page_number = page_number;
		}

		if (postsPerPage !== null) {
			data.posts_per_page = postsPerPage;
		}

		$.ajax({
			type: 'POST',
			url: current_articles_object.url,
			data: data,
			dataType: 'json',
			success: function (resp) {
				if (!resp.success) {
					console.log('error:', resp);
				} else {
					console.log('success:', resp);
					if (
						resp.data.articles_list !== undefined &&
						resp.data.articles_list.length !== 0
					) {
						$articlesList.html('');

						$.each(
							resp.data.articles_list,
							function (indexInArray, valueOfElement) {
								$articlesList.append($(valueOfElement));
							}
						);
					}

					if (resp.data.navigation !== undefined) {
						$articlesNavigation.html(resp.data.navigation);
					}
				}
			},
		});
	};

	const windowWidth = $(window).width();

	if (windowWidth > 739 && windowWidth < 1180) {
		loadArticles(6);
	} else if (windowWidth < 740) {
		loadArticles(4);
	}
};

export { currentArticles };
