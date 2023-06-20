const singlePost = ($) => {
	/* global headerTag */
	/* eslint no-undef: "error" */

	const navLinkSelector = '.article-aside__nav-item-link';
	const $articleNavlinks = $(navLinkSelector);

	const articleHeadersSelector =
		typeof headerTag !== 'undefined' && headerTag.length !== 0
			? headerTag
			: ':header';
	const $articleHeaders = $(`.article__content > ${articleHeadersSelector}`);

	if ($articleNavlinks.length === 0 || $articleHeaders.length === 0) {
		return;
	}

	$articleHeaders.each(function (index) {
		if ($articleNavlinks.eq(index).length === 0) {
			return;
		}

		const articleNavlinkAnchor = $articleNavlinks.eq(index).attr('href');
		const thisId = articleNavlinkAnchor.replace('#', '');

		$(this).attr('id', thisId);
	});

	$articleNavlinks.on('click', function (event) {
		event.preventDefault();

		const thisIndex = $(this).index(navLinkSelector);
		const articleHeaderPos = $articleHeaders.eq(thisIndex).offset().top;
		const srollToPos = articleHeaderPos - 20;

		$('html, body').animate({ scrollTop: srollToPos }, 500);
	});
};

export { singlePost };
