const contentPost = ($) => {
	/* global headerTag */
	/* eslint no-undef: "error" */

	const navLinkSelector = '.cp-article-navigation__item-link';
	const $articleNavlinks = $(navLinkSelector);

	const articleTitlesSelector =
		typeof headerTag !== 'undefined' && headerTag.length !== 0
			? headerTag
			: ':header';
	const $articleTitles = $(`.cp-article__content > ${articleTitlesSelector}`);

	if ($articleNavlinks.length === 0 || $articleTitles.length === 0) {
		return;
	}

	$articleTitles.each(function (index) {
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
		const articleHeaderPos = $articleTitles.eq(thisIndex).offset().top;
		const srollToPos = articleHeaderPos - 20;

		$('html, body').animate({ scrollTop: srollToPos }, 500);
	});

	const $window = $(window);
	const $articleContent = $('.cp-article__content');
	const navItemClassName = 'cp-article-navigation__item';
	const navItemSelector = '.' + navItemClassName;
	const activeNavItemClassName = navItemClassName + '--active';
	const activeNavItemSelector = '.' + activeNavItemClassName;

	const articleContentTopPos = $articleContent.offset().top - 70;
	const articleContentBottomPos =
		articleContentTopPos + 70 + $articleContent.height();
	const windowScrollTopPos = $window.scrollTop();

	$articleTitles.each(function () {
		const $thisTitle = $(this);

		const thisTitleTopPos = $thisTitle.offset().top - 60;
		const thisTitleId = $thisTitle.attr('id');

		if (windowScrollTopPos > thisTitleTopPos) {
			$articleNavlinks
				.parent(activeNavItemSelector)
				.removeClass(activeNavItemClassName);

			$('a[href="#' + thisTitleId + '"]')
				.parent(navItemSelector)
				.addClass(activeNavItemClassName);
		}
	});

	$window.scroll(function () {
		const windowScrollTopPos = $(this).scrollTop();

		if (windowScrollTopPos > articleContentBottomPos) {
			return;
		}

		$articleTitles.each(function (index) {
			const $thisTitle = $(this);
			const isLastTitle = index === $articleTitles.length - 1;
			const thisTitleTopPos = $thisTitle.offset().top - 60;
			const thisTitleId = $thisTitle.attr('id');

			let thisTitleBottomPos = 0;
			if (isLastTitle) {
				thisTitleBottomPos = thisTitleTopPos + articleContentBottomPos;
			} else {
				thisTitleBottomPos = $articleTitles.eq(++index).offset().top;
			}

			if (
				windowScrollTopPos > thisTitleTopPos &&
				windowScrollTopPos < thisTitleBottomPos
			) {
				$articleNavlinks
					.parent(activeNavItemSelector)
					.removeClass(activeNavItemClassName);

				$('a[href="#' + thisTitleId + '"]')
					.parent(navItemSelector)
					.addClass(activeNavItemClassName);
			} else if (windowScrollTopPos < thisTitleTopPos) {
				$('a[href="#' + thisTitleId + '"]')
					.parent(navItemSelector)
					.removeClass(activeNavItemClassName);
			}
		});
	});
};

export { contentPost };
